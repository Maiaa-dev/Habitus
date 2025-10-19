<?php 
    session_start();
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
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidratação 💧</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.js" async></script>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div id="container">
        <div id="inicio">   
        <header>
            <nav class="navbar fixed-top navbar-expand-lg bg-body-transparent">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php"><img src="../imagens/logo4.png" id="logop" alt="Logo"></a>
                 
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav" id="tudo">
                      <li class="nav-item">
                        <a class="nav-link active" id="comeco" href="../menu/index.php">Início</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="../criar/index.php">Criar novo hábito</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="../seushabitos/index.php">Seus hábitos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Perguntas frequentes</a>
                      </li>
                    </ul>
                      <a class="nav-link" href="#"><button type="submit" id="botao" class="dados"><img src="../imagens/user2.png" id="user1"><img src="../imagens/user.png" id="user2">   <?php echo $nome?></button></a>
                  </div>
                </div>
              </nav>
            </header>
        </div>
        <div id="primparte">
            <h1 id="tx1">hidratação</h1>
            <h2 id="tx2">Meta: 
                <?php 
                $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 1";
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
              <div class="btt col"><button type="button" id="botao">Atualizar meta</button></div>
              <div class="btt col"><button type="button" id="botao">Excluir hábito</button></div>
            </div>
            </div>
        </div>
        <div id="segparte">
          <h1 id="tx3">Seu desempenho nesse hábito está:</h1>
          <div id="desem">
            <p>Colocar informação</p>
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
        <div id="divisor"><span>💧 Beba água 💧 Beba água 💧 Beba água 💧 Beba água 💧 Beba água 💧 Beba água 💧 Beba água 💧 Beba água 💧 Beba água 💧 Beba água 💧 Beba água 💧 Beba água</span></div>
        
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
              <p id="pergunta">Então, quanto você acabou de consumir?</p>
              <div id="resposta" class="row">
              <form action="registro.php" method="post">
              <select class="form-select" name="opcao">
                <option value="300">300 ml (0,3L)</option>
                <option value="500">500 ml (0,5L)</option>
                <option value="700">700 ml (0,7L)</option>
                <option value="1000">1 L (1000 ml)</option>
                <option value="1500">1,5 L (1500 ml)</option>
                <option value="2000">2 L (2000 ml)</option>
                <option value="2500">2.5 L (2500 ml)</option>
              </select>
              </div><br>
              <button type="submit" id="botao" class="registrar">Registrar</button>
            </form>
        </div>
        </div>
        <div id="quinparte"></div>
    </div>
</body>
</html>