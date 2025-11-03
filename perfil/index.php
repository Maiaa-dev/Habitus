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
        $email = $_SESSION['email'];
    }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meu perfil</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div id="container">
    <div id="inicio">   
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3906b3;">
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
                    <a class="nav-link dropdown-toggle text-white FonteLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo "$nome"?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item FonteLink" href="index.php">Meu perfil</a></li>
                        <li><a class="dropdown-item FonteLink" href="../login/index.html">Sair</a></li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </div>

    <h1 id="tx1">Suas informações:</h1>
    <div id="tudo">
    <form action="atualizar.php" method="post" onsubmit="return atualizar()" class="row g-4" id="formAtu">
        <div class="col-md-6">
            <label for="inputEmail" class="form-label FonteLink" style="color: #3906b3;font-weight:bold;">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email"><div class="atual" style="font-style: italic; color:#504f5e"><?php echo "$email(atual)"?></div>
        </div>
        <div class="col-md-6">
            <label for="inputNome" class="form-label FonteLink" style="color: #3906b3; font-weight:bold;">Nome</label>
            <input type="text" class="form-control" id="inputNome" name="nome"><div class="atual" style="font-style: italic; color:#504f5e"><?php echo "$nome(atual)"?></div>
        </div>
        
        <div class="col-md-6">
            <label for="inputSenha" class="form-label FonteLink" style="color: #3906b3; font-weight:bold;">Senha</label>
            <input type="password" class="form-control" id="inputSenha" name="senha">
        </div>

        <div class="col-md-6">
            <label for="opcao" class="form-label FonteLink" style="color: #3906b3; font-weight:bold;">Gênero</label>
            <select class="form-select" id="opcao">
                <option selected>Selecione uma opção</option>
                <option value="Feminino">Feminino</option>
                <option value="Masculino">Masculino</option>
                <option value="Outro">Outro</option>
            </select>
        </div>
        <div id="caixa">
            <button type="submit" id="botao">Atualizar dados</button>
        </div>
    </form>
    
    <form action="excluir.php" method="post" onsubmit="return excluir()" id="formEx">
        <button type="submit" id="botao" class="">Excluir conta</button>
    </form>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        function atualizar(){
            return confirm("Deseja mesmo realizar as alterações no seu perfil?");
        }
        function excluir(){
            return confirm("Ah.. Tem certeza que deseja mesmo excluir sua conta? ESSA AÇÃO NÃO PODERÁ MAIS SER DESFEITA!");
        }
    </script>

</body>
</html>