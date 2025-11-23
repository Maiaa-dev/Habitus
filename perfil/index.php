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
        $senha = $_SESSION['senha'];
        $genero = $_SESSION['genero'];
    }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meu perfil</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.js" async></script>
    <link href="style.css" rel="stylesheet">
    <style>
        /* pequeno ajuste para que o label mostre exatamente o estilo ativo do exemplo */
        input[type="radio"]:checked + label {
            background-color: #7747e7ff; /* Fundo azul quando selecionado */
            color: white;             /* Texto branco para melhor contraste */
            border-color: #7747e7ff;    /* Cor da borda quando selecionado */
        }
    </style>
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


        <div class="principal">
            <div class="esquerda">
                <h1 id="tx1">Suas informações:</h1>
                <br><br>
                <div class="dados">
                    <ul class="list-group">
                        <li class="list-group-item FonteLink" style="font-size:24px;"><span style="color: #1f0855ff; font-weight:bold;">Nome:  </span><?php echo "$nome"?></li>
                        <li class="list-group-item FonteLink" style="font-size:24px;"><span style="color: #1f0855ff;font-weight:bold;font-size:24px;">Email:  </span><?php echo "$email"?></li>
                        <li class="list-group-item FonteLink" style="font-size:24px;"><span style="color: #1f0855ff;font-weight:bold;font-size:24px;">Gênero:  </span><?php echo "$genero"?></li>
                    </ul>
                </div>
                <form action="excluir.php" method="post" onsubmit="return excluir()" id="formEx">
                        <button type="submit" id="botao" class="">Excluir conta</button>
                </form>
            </div>

            <hr style="width: 1px; height: 460px; background-color: gray; transform: rotate(180deg);">
            
            <div class="direita">
                <div id="tudo">
                    <h1 id="tx1">Atualize seus dados <span style="font-size: 15px; font-style:italic">(opcional)</span></h1>
                    <p id="p1">O que deseja mudar?</p>
                    <form action="atualizar.php" method="post" onsubmit="return atualizar()" class="row g-4" id="formAtu">
                        <div id="escolhas" class="ativa d-grid gap-2">
                            <div class="opcao">
                                <input type="radio" name="info" value="Nome" class="btn-check FonteLink" id="lgRadio1" autocomplete="off">
                                <label class="list-group-item list-group-item-action gap-2 align-items-center rounded-3" for="lgRadio1" role="button">
                                <div>
                                    <strong class="text-white">Nome</strong>
                                </div>
                                </label>
                            </div>
                            <div class="opcao">
                                <input type="radio" name="info" value="Email" class="btn-check FonteLink" id="lgRadio2" autocomplete="off">
                                <label class="list-group-item list-group-item-action gap-2 align-items-center rounded-3" for="lgRadio2" role="button">
                                <div>
                                    <strong class="text-white">Email</strong>
                                </div>
                                </label>
                            </div>
                            <div class="opcao">
                                <input type="radio" name="info" value="Genero" class="btn-check FonteLink" id="lgRadio3" autocomplete="off">
                                <label class="list-group-item list-group-item-action gap-2 align-items-center rounded-3" for="lgRadio3" role="button">
                                <div>
                                    <strong class="text-white">Gênero</strong>
                                </div>
                                </label>
                            </div>
                            <div class="opcao">
                                <input type="radio" name="info" value="Senha" class="btn-check FonteLink" id="lgRadio4" autocomplete="off">
                                <label class="list-group-item list-group-item-action gap-2 align-items-center rounded-3" for="lgRadio4" role="button">
                                <div>
                                    <strong class="text-white">Senha</strong> 
                                </div>
                                </label>
                            </div>
                        </div><br>
                    <hr>
                        <div id="div-Nome" class="inativa">
                                <div class="mb-3">
                                    <label for="novoNome" class="form-label FonteLink" style="color: #3906b3;font-weight:bold">Novo nome:</label>
                                    <input type="text" class="form-control" id="novoNome" name="novoNome">
                                </div>
                                <div id="pcriar">
                                    <button type="submit" id="criarbt">Atualizar</button>
                                </div>
                        </div>
                        <div id="div-Email" class="inativa">
                                <div class="mb-3">
                                    <label for="novoEmail" class="form-label FonteLink" style="color: #3906b3;font-weight:bold">Novo email:</label>
                                    <input type="email" class="form-control" id="novoEmail" name="novoEmail">
                                </div>
                                <div id="pcriar">
                                    <button type="submit" id="criarbt">Atualizar</button>
                                </div>
                        </div>
                        <div id="div-Genero" class="inativa">
                                <div class="mb-3">
                                    <label for="form-select" class="form-label FonteLink" style="color: #3906b3;font-weight:bold">Defina o gênero:</label>
                                    <select class="form-select" name="novoGenero">
                                        <option value="Feminino">Feminino</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Outro">Outro</option>
                                        <option value="Prefiro não informar">Prefiro não informar</option>
                                    </select>
                                </div>
                                <div id="pcriar">
                                    <button type="submit" id="criarbt">Atualizar</button>
                                </div>
                        </div>
                        <div id="div-Senha" class="inativa">
                                <div class="mb-3">
                                    <label for="senhaAntiga" class="form-label FonteLink" style="color: #3906b3;font-weight:bold">Digite sua senha antiga:</label>
                                    <input type="password" class="form-control" id="senhaAntiga" name="senhaAntiga">
                                </div>
                                <div class="mb-3">
                                    <label for="senhaNova" class="form-label FonteLink" style="color: #3906b3;font-weight:bold">Digite sua nova senha:</label>
                                    <input type="password" class="form-control" id="senhaNova" name="senhaNova">
                                </div>
                                <div id="pcriar">
                                    <button type="submit" id="criarbt">Atualizar</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        
        

    </div>

    <script src="script.js" defer></script>
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