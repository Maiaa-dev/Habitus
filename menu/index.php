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
        $sql = "SELECT h.nome_habito FROM habitos h, habito_usuario hu WHERE h.id_habito=hu.id_habito and id_usuario = '$idUsuario'";
        $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.js" async></script>
    <link href="style.css" rel="stylesheet">
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

        <div id="principal">
          <div id="esquerda">
          <div id="apresentacao">
              <h1 id="apre">Olá, <span id="seunome"><?php echo $nome?></span>!</h1>
              <h2 id="pergunta">Como está o seu dia hoje?</h2>
          </div>
          <div id="criarhabito">
              <a href="../criar/index.php"><button type="button" id="criarh"><img src="../imagens/adicao.png" id="adicao">  Criar hábito</button></a>
          </div>
          
          <div id="frase">
              <h3 id="motiva">"Se a vida é feita de hábitos, que sejam bons hábitos."</h3>
          </div>
          </div>
          <div id="direita">
          <div id="seushabitos">
              <h1>Seus hábitos:</h1>
              <?php 
                $nomesHabitos = [];
                if (mysqli_num_rows($resultado) > 0){
                while($dados = mysqli_fetch_assoc($resultado)){
                    $nomesHabitos[] = $dados['nome_habito'];
                }
                    $tamanhoHabitos = count($nomesHabitos);

                    for($i = 0; $i < $tamanhoHabitos;$i++){
                      echo "● ". $nomesHabitos[$i] . '</br>';
                    }

                }
                else{
                  echo 'Parece que você ainda não tem nenhum hábito!</br> O que acha de criar um?';
                }
              ?>
          </div>
          </div>
          

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>