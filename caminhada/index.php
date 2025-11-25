<?php 
    include_once('../conexao.php');
    include_once('../usuario.php');
    include_once('../criar/primparte.php');

     if (!isset ($_SESSION['email'])){
        header("Location: ../login/index.html");
        exit;
    }
    else{
        $nome = $_SESSION['nome'];
        $idUsuario = $_SESSION['id'];
        global $percentual;
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
</head>
<body>
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
                    <a class="nav-link text-white FonteLink" href="#">Perguntas frequentes</a>
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
          <h1 id="tx3">Seu desempenho nesse hábito está:</h1>
          <div id="desem">
            <p><?php echo "$percentual"?></p>
          </div>
          <hr>
          <br>
          <div id="vamos">
          <h1 id="tx4">Vamos entender o porquê?</h1>
          <div id="motivos">
            <ol class="list-group list-group-numbered">
              <li class="list-group-item">A list item</li>
              <li class="list-group-item">A list item</li>
              <li class="list-group-item">A list item</li>
            </ol>
          </div>
          </div>
        </div><br>
        <div id="divisor"><span>🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez 🚶‍➡️ Um passo de cada vez</span></div>
        
        <div id="terparte">
          <h1 id="tx5">Seu desempenho essa semana:</h1>
          <div id="desemp">
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
                  labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
                  datasets: [{
                    label: 'Temperatura Média (°C)',
                    data: [22, 24, 27, 25, 20, 18],
                    borderColor: 'rgba(75, 192, 192, 1)', // cor da linha
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // área sob a linha
                    borderWidth: 2,
                    tension: 0.4, // suaviza a linha (0 = reta, 1 = bem curva)
                    fill: true,   // preenche o fundo da linha
                    pointRadius: 2, // tamanho dos pontos
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)'
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
                <div class="progress-bar" style="width: 25%">25%</div>
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
        <div id="quinparte"></div>
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
              alert("Atualização cancelada.");
          }   
      }
    </script>

</body>
</html>