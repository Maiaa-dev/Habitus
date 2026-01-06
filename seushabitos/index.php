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
    <link href="../system/navbar.css" rel="stylesheet">
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
         <nav class="navbar navbar-expand-lg navbar-dark">
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
          <h1 id="tx4"><a href="../caminhada/index.php">Caminhada</a></h1>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>