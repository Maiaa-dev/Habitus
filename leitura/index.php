<?php 
    include_once('../conexao.php');
    include_once('../usuario.php');
    include_once('../criar/primparte.php');
    include_once('../alert.php');

     if (!isset ($_SESSION['email'])){
        header("Location: ../login/index.html");
        exit;
    }
    else{
        $nome = $_SESSION['nome'];
        $idUsuario = $_SESSION['id'];
        $idHabito = 2; // Hábito de Leitura
        $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 2";
        $resultado = mysqli_query($conexao,$sql);
        
        $metaTotal = 0;
        
        if (mysqli_num_rows($resultado) > 0){
            $dados = mysqli_fetch_assoc($resultado);
            $nomeMeta = $dados['nome_meta'];
            
            // Convertendo a Meta para mililitros (mL)
            if($nomeMeta == '15min'){
                $metaTotal = 15;
            } else if($nomeMeta == '20min'){
                $metaTotal = 20;
            } else if($nomeMeta == '30min'){
                $metaTotal = 30;
            }
        }
        
        // 2. Obtendo o Consumo Total do Dia
        $sql = "SELECT SUM(rl.meta_cumprida) AS total_tempo FROM registros_leitura rl WHERE rl.id_usuario = '$idUsuario' AND rl.id_habito = 2 AND DATE(data_feito) = CURDATE()";
        $resultado = mysqli_query($conexao, $sql);
        $dados = mysqli_fetch_assoc($resultado);
        $consumidoHoje = (int)$dados['total_tempo']; // Se não houver registro, será 0

        // 3. Calculando e Formatando o Percentual
        if ($metaTotal > 0) {
            $percentual_bruto = (floatval($consumidoHoje) / floatval($metaTotal)) * 100;
            
            // Garantindo que o percentual não ultrapasse 100%
            if ($percentual_bruto > 100) {
                $percentual_bruto = 100;
            }
            
            // Variável final para exibição no HTML (com formatação)
            $percentual_formatado = number_format($percentual_bruto, 0, '', ''); // Sem casas decimais
        } else {
            // Se não houver meta definida, o percentual é 0
            $percentual_bruto = 0;
            $percentual_formatado = 0; 
        }

        // Variável adicional para exibição com a casa decimal e '%'
        $percentual_exibicao = number_format($percentual_bruto, 2, ',', '.') . '%';

        if($percentual_formatado <= 40){
          $motivo1 = "Depois de estudar ou trabalhar muito, a mente fica cansada e reduz o foco para leitura voluntária.";
          $motivo2 = "Desligue um pouquinho o celular: Distrações digitais reduzem o tempo disponível para leitura.";
          $motivo3 = "A constância é a chave: Quem não lê com frequência tende a cansar nos primeiros minutos!";
        }
        else if($percentual_formatado > 40 && $percentual_formatado <= 70){
          $motivo1 = "Leitura intermitente: Pausas frequentes durante a leitura dificultam a imersão no conteúdo.";
          $motivo2 = "Escolha um tema que você goste: Livros neutros (nem muito bons, nem ruins) levam a uma progressão lenta.";
          $motivo3 = "Você ainda está se adaptando a esse novo hábito. Com o tempo, ficará mais fácil e prazeroso.";
        }
        else if($percentual_formatado > 70 && $percentual_formatado < 100){
          $motivo1 = "Motivação é tudo: Conteúdos interessantes aumentam engajamento.";
          $motivo2 = "Concentração: Leitores habituados conseguem longas sessões com menor fadiga mental.";
          $motivo3 = "Você tem uma rotina: Criar horários fixos (manhã/noite) melhora a constância.";
        }
        else{
          $motivo1 = "A leitura já faz parte do cotidiano.";
          $motivo2 = "Sessões dedicadas de leitura: Você organiza momentos exclusivos para ler, sem interrupções.";
          $motivo3 = "Leituras frequentes: A prática diária fortalece o hábito e aumenta a resistência mental.";
        }

        $semana = array_fill(0, 7, 0); // O array de 7 posições começa com zero

        $sql = "SELECT (DAYOFWEEK(data_feito) - 2 + 7) % 7 AS indice_semana, SUM(meta_cumprida) AS total_dia FROM registros_leitura WHERE id_usuario = '$idUsuario' AND id_habito = '$idHabito' AND WEEK(data_feito, 1) = WEEK(CURDATE(), 1) AND YEAR(data_feito) = YEAR(CURDATE()) GROUP BY indice_semana ORDER BY indice_semana;";

        $resultado = mysqli_query($conexao, $sql);

        while ($linha = mysqli_fetch_assoc($resultado)) {
            $indice = (int)$linha['indice_semana']; // 0 a 6 (Segunda a Domingo)
            $total = (int)$linha['total_dia'];
            $semana[$indice] = $total; 
        }

        $dadosPHP = json_encode($semana);

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leitura 📕</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php mostrarAlerta(); ?>
    <div id="container">
        <div id="inicio">   
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #690a20ff;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="../imagens/logo4.png" id="logop"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-4">
                    <a class="nav-link active text-white FonteLink" aria-current="page" href="../menu/index.php">Início</a>
                    </li>
                    <li class="nav-item me-4">
                    <a class="nav-link text-white FonteLink" href="../criar/index.php">Criar novo hábito</a>
                    </li>
                    <li class="nav-item me-4">
                    <a class="nav-link text-white FonteLink" href="../seushabitos/index.php">Seus hábitos</a>
                    </li>
                    <li class="nav-item me-5">
                    <a class="nav-link text-white FonteLink" href="../perguntas/index.php">Perguntas frequentes</a>
                    </li>
                    <li class="nav-item dropdown me-5">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo "$nome"?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../perfil/index.php">Meu perfil</a></li>
                        <li><a class="dropdown-item" href="../login/index.html">Sair</a></li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        </div>

        <div id="primparte">
            <h1 id="tx1">leitura</h1>
            <h2 id="tx2">Meta: 
                <?php 
                $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 2";
                $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
                if (mysqli_num_rows($resultado) == 0){
                    echo "Nenhuma meta! Ou seja, sem hábito!";
                }
                else{
                    $dados = mysqli_fetch_assoc($resultado);
                    $nomeMeta = $dados['nome_meta'];
                    echo "$nomeMeta/dia";
                }
            ?>
            </h2>
            <div id="juncao">
            <div id="opcoes" class="row"> 
              <div class="btt col"><form action="atualizar.php" method="post" id="formAtualizar"><input type="hidden" name="novaMeta" id="novaMeta"><button type="submit" id="botao" class="botaoAtualizar" onclick="atualizar()">Atualizar meta</button></form></div>
              <div class="btt col"><form action="excluir.php" method="post" onsubmit="return confirmar()"><button type="submit" id="botao">Excluir hábito</button></form></div>
            </div>
            </div>
        </div>
        <div id="segparte">
          <h1 id="tx3">Seu desempenho hoje nesse hábito está:</h1>
          <div id="desem">
            <p class="text-white mensagem">
              <?php 
                if ($percentual_formatado >= 100) {
                    echo "Excelente! Você já atingiu sua meta diária de leitura. Continue assim!";
                } 
                else if ($percentual_formatado >= 70) {
                    echo "Muito bom! Você está quase lá, continue lendo para alcançar sua meta diária!";
                } 
                else if ($percentual_formatado >= 40) {
                    echo "Bom esforço! Você está no caminho certo, não desista!";
                } 
                else {
                    echo "Vamos lá! Parece que você não leu muito hoje. Que tal ler um pouco para alcançar sua meta diária?";
                }
              ?>
            </p>
          </div>
          <hr>
          <br>
          <div id="vamos">
          <h1 id="tx4">Vamos entender o porquê?</h1>
          <p class="text-white" style="text-align: center;">(Alguns motivos que podem justificar seu desempenho)</p>
          <div id="motivos">
            <ol class="list-group list-group-numbered">
              <li class="list-group-item"><?php echo "$motivo1"?></li>
              <li class="list-group-item"><?php echo "$motivo2"?></li>
              <li class="list-group-item"><?php echo "$motivo3"?></li>
            </ol>
          </div>
          </div>
        </div><br>
        <div id="divisor"><span>📕 Leia um livro 📕 Leia um livro 📕 Leia um livro 📕 Leia um livro 📕 Leia um livro 📕 Leia um livro 📕 Leia um livro 📕 Leia um livro 📕 Leia um livro 📕 Leia um livro 📕 Leia um livro 📕 Leia um livro</span></div>
        
        <div id="terparte">
          <h1 id="tx5">Seu desempenho essa semana:</h1>
          <div id="desemp">
            <script>
              const dados = <?php echo $dadosPHP; ?>;
            </script>
              <!--Aqui entra o gráfico - Charts.js-->
            <div>
              <canvas id="myChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
              const ctx = document.getElementById('myChart');
              new Chart(ctx, {
                type: 'line', // 👈 tipo do gráfico
                data: {
                  labels: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado','Domingo'],
                  datasets: [{
                    label: 'Tempo de leitura (em minutos)',
                    data: dados, //aqui entra as variáveis do php
                    borderColor: '#d0395cff', // cor da linha
                    backgroundColor: '#ae6f7eb0', // área sob a linha
                    borderWidth: 2,
                    tension: 0.4, // suaviza a linha (0 = reta, 1 = bem curva)
                    fill: true,   // preenche o fundo da linha
                    pointRadius: 2, // tamanho dos pontos
                    pointBackgroundColor: '#d0395cff'
                  }]
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: true, // permite ajustar ao container
                  scales: {
                    y: {
                      beginAtZero: true // começa do zero
                    }
                  }
                }
              });
            </script>
          </div>
        </div>
        <div class="quarparte">
          <div class="esquerda">
              <h1 id="tx6">Você já cumpriu:</h1>
              <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: <?php echo $percentual_formatado; ?>%"><?php echo $percentual_formatado; ?>%</div>
              </div>
          </div>
          <hr style="width: 1px; height: 300px; background-color: gray; transform: rotate(180deg);">

          <div class="direita">
              <h1 id="tx7">Quer fazer um novo registro?</h1>
              <p id="pergunta">Então, quantos minutos você já passou lendo?</p>
              <div id="resposta" class="row">
              <form action="registro.php" method="post">
              <select class="form-select" name="opcao">
                <option value="5">5 min</option>
                <option value="10">10 min</option>
                <option value="15">15 min</option>
                <option value="20">20 min</option>
                <option value="25">25 min</option>
                <option value="30">30 min</option>
              </select>
              </div><br>
              <button type="submit" id="botao" class="registrar">Registrar</button>
            </form>
        </div>
        </div>
        <div id="quinparte">
          <br>
          <h1 id="tx6" class="text-white" style="text-align: center;">Ainda ficou dúvidas da importância desse hábito?</h1>
          <p id="p6" class="text-white" style="text-align: center;">Aqui estão três artigos científicos para você entender mais!</p>
          <p id="p7" class="text-white" style="text-align: center;font-style:italic">Alguns podem estar em inglês. Nesse caso, basta clicar em "Traduzir" na página</p>
          <ul class="list-group" style="padding-left: 2%;padding-right: 2%;">
            <li class="list-group-item">O hábito de ler estimula o cérebro e promove benefícios para a saúde mental<br>
            <div class="linkpes"><a href="https://www.thelancet.com/journals/ebiom/article/PIIS2352-3964(22)00586-2/fulltext">Matéria - PUCRS</a></div>
            </li>
            <li class="list-group-item">Um estudo afirma que a leitura pode proteger a função cognitiva do cérebro<br>
            <div class="linkpes"><a href="https://www.thelancet.com/journals/ebiom/article/PIIS2352-3964(22)00586-2/fulltext">Pesquisa - PubMed Central</a></div>
            </li>
            <li class="list-group-item">A leitura de ficção literária aprimora a teoria da mente, que está diretamente ligada às relações sociais.<br>
            <div class="linkpes"><a href="https://www.science.org/doi/10.1126/science.1239918">Pesquisa - Science</a></div>
            </li>
          </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script>
      function confirmar(){
        return confirm("Tem certeza que deseja excluir este hábito? Essa ação não poderá mais ser desfeita! Pense bem, não desista :)");
      }

      function atualizar(){
          const form = document.getElementById('formAtualizar');
          const inputMeta = document.getElementById('novaMeta');

          const valor = prompt("Digite a nova meta (lembre-se: 15min, 20min ou 30min - Escrever exatamente neste formato):");

          if(valor !== null && (valor == "15min" || valor == "20min" || valor == "30min")){
              inputMeta.value = valor;
              form.submit();  
          }
          else {
              alert("Valor inválido! Por favor, insira 1L, 2L ou 2.5L exatamente neste formato.");
          }
      }   
    </script>

</body>
</html>