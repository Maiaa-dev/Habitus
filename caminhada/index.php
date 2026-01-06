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
        $idHabito = 3; // Hábito de Caminhada
        $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 2";
        $resultado = mysqli_query($conexao,$sql);
        
        $metaTotal = 0;
        
        if (mysqli_num_rows($resultado) > 0){
            $dados = mysqli_fetch_assoc($resultado);
            $nomeMeta = $dados['nome_meta'];
            
            // Convertendo a Meta para numeros inteiros
            if($nomeMeta == '30min'){
                $metaTotal = 30;
            } else if($nomeMeta == '35min'){
                $metaTotal = 35;
            } else if($nomeMeta == '40min'){
                $metaTotal = 40;
            }
        }
        
        // 2. Obtendo o Consumo Total do Dia
        $sql = "SELECT SUM(rc.meta_cumprida) AS total_tempo FROM registros_caminhada rc WHERE rc.id_usuario = '$idUsuario' AND rc.id_habito = 3 AND DATE(data_feito) = CURDATE()";
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
          $motivo1 = "O cansaço reduz disposição para atividade física leve, diminuindo a caminhada diária.";
          $motivo2 = "Calma, é super normal!: Indivíduos com baixa aptidão física tendem a caminhar menos nos primeiros dias de hábito.";
          $motivo3 = "Cuidado em ficar por horas prolongadas sentado(a)!.";
        }
        else if($percentual_formatado > 40 && $percentual_formatado <= 70){
          $motivo1 = "Clima desfavorável: Chuva, calor intenso ou frio podem desmotivar a caminhada ao ar livre.";
          $motivo2 = "Já é possível caminhar apenas em trajetos naturais (até o ponto de ônibus, escola etc.), atingindo apenas parte da meta.";
          $motivo3 = "Adaptação é assim mesmo: Pessoas iniciantes podem sentir desconfortos leves que reduzem o desempenho.";
        }
        else if($percentual_formatado > 70 && $percentual_formatado < 100){
          $motivo1 = "Subir escadas, ir a pé a locais próximos e pausas ao longo do dia ajudam a quase atingir a meta.";
          $motivo2 = "Sua saúde cardiovascular: Quem já tem condicionamento moderado realiza caminhadas mais longas com facilidade!";
          $motivo3 = "Cuide-se: Pessoas que veem caminhada como lazer ou autocuidado tendem a manter alto desempenho.";
        }
        else{
          $motivo1 = "Você já deve incluir caminhadas planejadas e incorporadas ao seu estilo de vida.";
          $motivo2 = "Autocontrole e disciplina: Você já consegue manter regularidade mesmo em dias difíceis.";
          $motivo3 = "Saúde mental em dia: Caminhar libera endorfinas e melhora humor, fortalecendo a continuidade!";
        }

         $semana = array_fill(0, 7, 0); // O array de 7 posições começa com zero

        $sql = "SELECT (DAYOFWEEK(data_feito) - 2 + 7) % 7 AS indice_semana, SUM(meta_cumprida) AS total_dia FROM registros_caminhada WHERE id_usuario = '$idUsuario' AND id_habito = '$idHabito' AND WEEK(data_feito, 1) = WEEK(CURDATE(), 1) AND YEAR(data_feito) = YEAR(CURDATE()) GROUP BY indice_semana ORDER BY indice_semana;";

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
    <title>Caminhada 🚶‍➡️</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php mostrarAlerta(); ?>
    <div id="container">
        <div id="inicio">   
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #ab4700ff;">
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
            <h1 id="tx1">caminhada</h1>
            <h2 id="tx2">Meta: 
                <?php 
                $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 3";
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
                    echo "Excelente! Você já atingiu sua meta diária de caminhada. Continue assim!";
                } 
                else if ($percentual_formatado >= 70) {
                    echo "Muito bom! Você está quase lá, continue caminhando para alcançar sua meta diária!";
                } 
                else if ($percentual_formatado >= 40) {
                    echo "Bom esforço! Você está no caminho certo, não desista!";
                } 
                else {
                    echo "Vamos lá! Parece que você não caminhou muito hoje. Que tal dar uma volta para alcançar sua meta diária?";
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
        <div id="divisor"><span>🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez</span></div>
        
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
                    label: 'Tempo caminhado (em minutos/dia)',
                    data: dados, //aqui entra as variáveis do php
                    borderColor: '#af4d07ff', // cor da linha
                    backgroundColor: '#d69a6fbd', // área sob a linha
                    borderWidth: 2,
                    tension: 0.4, // suaviza a linha (0 = reta, 1 = bem curva)
                    fill: true,   // preenche o fundo da linha
                    pointRadius: 2, // tamanho dos pontos
                    pointBackgroundColor: '#af4d07ff'
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
              <p id="pergunta">Então, quantos minutos você já caminhou?</p>
              <div id="resposta" class="row">
              <form action="registro.php" method="post">
              <select class="form-select" name="opcao">
                <option value="10">10 min</option>
                <option value="15">15 min</option>
                <option value="20">20 min</option>
                <option value="25">25 min</option>
                <option value="30">30 min</option>
                <option value="35">35 min</option>
                <option value="40">40 min</option>
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
            <li class="list-group-item">Um estudo mostrou que exercício físico promove uma redução nos níveis de cortisol em indivíduos com depressão.<br>
            <div class="linkpes"><a href="https://pubmed.ncbi.nlm.nih.gov/30570106/">Pesquisa - PubMed</a></div>
            </li>
            <li class="list-group-item">O objetivo desse estudo é mostrar os benefícios da prática regular da caminhada na qualidade de vida dos adultos.<br>
            <div class="linkpes"><a href="https://repositorio-aberto.up.pt/bitstream/10216/14431/2/38536.pdf">Pesquisa - Universidade do Porto</a></div>
            </li>
            <li class="list-group-item">Um estudo avaliou a eficácia de exercícios de baixa intensidade na melhoria da saúde física e mental de pessoas idosas.<br>
            <div class="linkpes"><a href="https://pubmed.ncbi.nlm.nih.gov/26512340/">Pesquisa - PubMed</a></div>
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

          const valor = prompt("Digite a nova meta (lembre-se: 30min, 35min ou 40min - Escrever exatamente neste formato):");

          if(valor !== null && (valor == "30min" || valor == "35min" || valor == "40min")){
              inputMeta.value = valor;
              form.submit();  
          }
          else {
              alert("Valor inválido! Por favor, insira 1L, 2L ou 2.5L exatamente neste formato.");
              window.location.href = "index.php";
          }   
      }
    </script>

</body>
</html>