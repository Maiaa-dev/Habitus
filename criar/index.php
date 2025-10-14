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
    <title>Criar hábito</title>
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
                        <a class="nav-link" href="index.php">Criar novo hábito</a>
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
        <div id="tudojunto" class="d-flex flex-column flex-md-row gap-4 align-items-center justify-content-center">
        <div class="list-group w-50 gap-4 align-items-center justify-content-center" id="radiosList" >
          <h1 class="tx1">Escolha um <span class="novo">novo</span> hábito:</h1>
          <form action="primparte.php" method="post">
            <div id="escolhas" class="ativa d-grid gap-2">
              <div class="opcao">
              <input type="radio" name="habito" value="Hidratação" class="btn-check" id="lgRadio1" autocomplete="off">
              <label class="list-group-item list-group-item-action gap-2 align-items-center rounded-3" for="lgRadio1" role="button">
              <div>
                <strong>Consumo de água</strong>
                <p class="parag">Você sabia que o corpo humano é composto de aproximadamente 70% de água?</p> 
              </div>
              </label>
              </div>
              <div class="opcao">
              <input type="radio" name="habito" value="Leitura" class="btn-check" id="lgRadio2" autocomplete="off">
              <label class="list-group-item list-group-item-action gap-2 align-items-center rounded-3" for="lgRadio2" role="button">
              <div>
                <strong>Leitura</strong>
                <p class="parag">“A leitura é o caminho mais curto para o conhecimento.” — Aristóteles</p> 
              </div>
              </label>
              </div>
              <div class="opcao">
              <input type="radio" name="habito" value="Caminhada" class="btn-check" id="lgRadio3" autocomplete="off">
              <label class="list-group-item list-group-item-action gap-2 align-items-center rounded-3" for="lgRadio3" role="button">
              <div>
                <strong>Caminhada</strong>
                <p class="parag">“A jornada mais longa começa com um único passo.” — Lao Tsé</p> 
              </div>
              </label>
              </div>
            </div><br>
        
            <div id="div-Hidratação" class="inativa">
              <div class="d-grid gap-2">
              <h1 class="tx1">Escolha uma <span class="novo">meta</span>:</h1>
              <div class="opcao">
              <input type="radio" name="meta" value="1L" class="btn-check" id="lgRadio4" autocomplete="off" required>
              <label class="list-group-item list-group-item-action d-flex gap-2 align-items-center rounded-3" for="lgRadio4" role="button">
              <div>
                <strong>1 litro</strong>
              </div>
              </label>
              </div>
              <div class="opcao">
              <input type="radio" name="meta" value="2L" class="btn-check" id="lgRadio5" autocomplete="off" required>
              <label class="list-group-item list-group-item-action d-flex gap-2 align-items-center rounded-3" for="lgRadio5" role="button">
              <div>
                <strong>2 litros</strong>
              </div>
              </label>
              </div>
              <div class="opcao">
              <input type="radio" name="meta" value="2.5L" class="btn-check" id="lgRadio6" autocomplete="off" required>
              <label class="list-group-item list-group-item-action d-flex gap-2 align-items-center rounded-3" for="lgRadio6" role="button">
              <div>
                <strong>2,5 litros</strong>
              </div>
              </label>
              </div>
              </div><br>
              <div id="pcriar">
                <button type="submit" id="criarbt">Criar</button>
              </div>
            </div>

            <div id="div-Leitura" class="inativa">
              <div class="d-grid gap-2">
              <h1 class="tx1">Escolha uma <span class="novo">meta</span>:</h1>
              <div class="opcao">
                <input type="radio" name="meta" value="15min" class="btn-check" id="lgRadio7" autocomplete="off" required> 
                <label class="list-group-item list-group-item-action d-flex gap-2 align-items-center rounded-3" for="lgRadio7" role="button">
                <div>
                  <strong>15 minutos</strong>
                </div>
                </label>
              </div>
              <div class="opcao">
                <input type="radio" name="meta" value="20min" class="btn-check" id="lgRadio8" autocomplete="off" required>
                <label class="list-group-item list-group-item-action d-flex gap-2 align-items-center rounded-3" for="lgRadio8" role="button">
                <div>
                  <strong>20 minutos</strong>
                </div>
                </label>
              </div>
              <div class="opcao">
                <input type="radio" name="meta" value="30min" class="btn-check" id="lgRadio9" autocomplete="off" required> 
                <label class="list-group-item list-group-item-action d-flex gap-2 align-items-center rounded-3" for="lgRadio9" role="button">
                <div>
                  <strong>30 minutos</strong>
                </div>
                </label>
              </div>
              </div><br>
              <div id="pcriar">
                <button type="submit" id="criarbt">Criar</button>
              </div>
            </div>

            <div id="div-Caminhada" class="inativa">
              <div class="d-grid gap-2">
              <h1 class="tx1">Escolha uma <span class="novo">meta</span>:</h1>
              <div class="opcao">
                <input type="radio" name="meta" value="30min" class="btn-check" id="lgRadio10" autocomplete="off" required>
                <label class="list-group-item list-group-item-action d-flex gap-2 align-items-center rounded-3" for="lgRadio10" role="button">
                <div>
                  <strong>30 minutos</strong>
                </div>
                </label>
              </div>
              <div class="opcao">
                <input type="radio" name="meta" value="35min" class="btn-check" id="lgRadio11" autocomplete="off" required>
                <label class="list-group-item list-group-item-action d-flex gap-2 align-items-center rounded-3" for="lgRadio11" role="button">
                <div>
                  <strong>35 minutos</strong>
                </div>
                </label>
              </div>
              <div class="opcao">
                <input type="radio" name="meta" value="40min" class="btn-check" id="lgRadio12" autocomplete="off" required>
                <label class="list-group-item list-group-item-action d-flex gap-2 align-items-center rounded-3" for="lgRadio12" role="button">
                <div>
                  <strong>40 minutos</strong>
                </div>
                </label>
              </div><br>
              <div id="pcriar">
                <button type="submit" id="criarbt">Criar</button>
              </div>
              </div>
            
            </div>
          </form>
        </div>
        </div>
    </div>
    <script src="script.js" defer></script>
</body>
</html>