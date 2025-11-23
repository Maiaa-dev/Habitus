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
        $sql = "SELECT h.id_habito FROM habitos h, habito_usuario hu WHERE h.id_habito=hu.id_habito and id_usuario = $idUsuario";
        $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
        if (mysqli_num_rows($resultado) > 0){
          while($dados = mysqli_fetch_assoc($resultado)){
                $idHabitos[] = $dados['id_habito']; //Armazena em uma array todos os hábitos(id)
          }

                /*$tamanhoHabitos = count($nomesHabitos);
                for($i = 0; $i < $tamanhoHabitos;$i++){
                      echo "● ". $nomesHabitos[$i] . '</br>';
                }*/
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seus hábitos</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.js" async></script>
    <link href="style.css" rel="stylesheet">
    <style>
      #div-hidratacao,#div-leitura,#div-caminhada{
        border: 4px solid black;
        border-radius: 20px;
        margin-top: 2%;
        margin-left: 5%;
        margin-right: 35%;
        padding: 1.2%;
        transition: 0.5s;
      }
      .inativo {
        display: none; /* esconde completamente */
      }    
      #vazio{
        font-family: 'DM Sans',sans-serif;
        font-style: italic;
        font-size: 25px;
        color: #270a6b;
        padding-left: 5%;
      } 
    </style>
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
                        <a class="nav-link" href="index.php">Seus hábitos</a>
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
        <h1 id="tx1">Selecione um dos seus hábitos:</h1>
        <div id="vazio">
          <?php 
            if(empty($idHabitos)){
              echo "...Parece que você ainda não tem nenhum!";
            }
          ?>
        </div>
        <div id="div-hidratacao" class="habito <?php echo in_array(1, $idHabitos) ? '' : 'inativo'; ?>">
          <h1 id="tx2"><a href="../hidratacao/index.php">Hidratação</a></h1>
          <h3 class="meta">
            <?php 
              $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 1";
              $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
              if (mysqli_num_rows($resultado) == 0){
                echo "Nenhuma meta! Ou seja, sem hábito!";
              }
              else{
                $dados = mysqli_fetch_assoc($resultado);
                $nomeMeta = $dados['nome_meta'];
                echo "$nomeMeta";
              }
            ?>
          </h3>
        </div>
        <div id="div-leitura" class="habito <?php echo in_array(2, $idHabitos) ? '' : 'inativo'; ?>">
          <h1 id="tx3"><a href="../leitura/index.php">Leitura</a></h1>
          <h3 class="meta">
            <?php 
              $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 2";
              $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
              if (mysqli_num_rows($resultado) == 0){
                echo "Nenhuma meta! Ou seja, sem hábito!";
              }
              else{
                $dados = mysqli_fetch_assoc($resultado);
                $nomeMeta = $dados['nome_meta'];
                echo "$nomeMeta";
              }
            
            ?>
          </h3>
        </div>
        <div id="div-caminhada" class="habito <?php echo in_array(3, $idHabitos) ? '' : 'inativo'; ?>">
          <h1 id="tx4">Caminhada</h1>
          <h3 class="meta">
            <?php 
              $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 3";
              $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
              if (mysqli_num_rows($resultado) == 0){
                echo "Nenhuma meta! Ou seja, sem hábito!";
              }
              else{
                $dados = mysqli_fetch_assoc($resultado);
                $nomeMeta = $dados['nome_meta'];
                echo "$nomeMeta";
              }
            ?>
          </h3>
        </div>
        </div>
    </div>
    </div>
</body>
</html>