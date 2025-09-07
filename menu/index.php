<?php 
    session_start();
    include_once('../conexao.php');
    include_once('../usuario.php');

     if (!isset ($_SESSION['email'])){
        header("Location: ../login/index.html");
        exit;
    }
    else{
        $nome = $_SESSION['nome'];
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
                        <a class="nav-link active" id="comeco" href="#inicio">Início</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Criar novo hábito</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Seus hábitos</a>
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

        <div id="principal">
          <div id="esquerda">
          <div id="apresentacao">
              <h1 id="apre">Olá, <span id="seunome"><?php echo $nome?></span>!</h1>
              <h2 id="pergunta">Como está o seu dia hoje?</h2>
          </div>
          <div id="criarhabito">
              <a href="../criar/index.html"><button type="button" id="criarh"><img src="../imagens/adicao.png" id="adicao">  Criar hábito</button></a>
          </div>
          
          <div id="frase">
              <h3 id="motiva">"Se a vida é feita de hábitos, que sejam bons hábitos."</h3>
          </div>
          </div>
          <div id="direita">
          <div id="seushabitos">
              <h1>Seus hábitos:</h1>
          </div>
          </div>
          

        </div>
</body>
</html>