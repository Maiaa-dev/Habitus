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
    <title>Perguntas frequentes</title>
    <link href="style.css" rel="stylesheet">
    <link href="../system/navbar.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
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
                    <a class="nav-link dropdown-toggle text-white FonteLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

        <div class="container my-5">

          <h2 class="mb-4 FonteLink">Sobre o Habitus</h2>

          <div class="accordion mb-5" id="accordionSobreHabitus">

              <div class="accordion-item">
                  <h2 class="accordion-header" id="sobrehabitus-heading1">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sobrehabitus1">
                          1. O que é o Habitus?
                      </button>
                  </h2>
                  <div id="sobrehabitus1" class="accordion-collapse collapse" data-bs-parent="#accordionSobreHabitus">
                      <div class="accordion-body">
                          Habitus é um website de gerenciamento de hábitos que combina ciência e estatística. Nele, é possível:
                          <ul>
                              <li>Criar um novo hábito e estabelecer metas</li>
                              <li>Acompanhar seu progresso com gráficos descomplicados</li>
                              <li>Navegar por uma ferramenta intuitiva: construída para você e com foco no seu progresso!</li>
                          </ul>
                      </div>
                  </div>
              </div>

              <div class="accordion-item">
                  <h2 class="accordion-header" id="sobrehabitus-heading2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sobrehabitus2">
                          2. Quem desenvolveu e para que?
                      </button>
                  </h2>
                  <div id="sobrehabitus2" class="accordion-collapse collapse" data-bs-parent="#accordionSobreHabitus">
                      <div class="accordion-body">
                          A responsável por esse projeto: <strong>Aline Maia Guimarães!</strong><br><br>
                          O Habitus surgiu de uma necessidade pessoal. Por várias vezes, tentei utilizar aplicativos de rotina, mas não durava uma semana instalado no meu celular. O motivo? Simples: não havia motivação clara envolvida!
                          <br><br>
                          A maior parte dos aplicativos possuem metas e cobranças diárias, mas não explicam a importância de se ter aquele hábito para a saúde. Além disso, a falta de informações claras sobre meu próprio progresso tornava o uso desgastante.
                          <br><br>
                          Logo, a solução foi criar um aplicativo mais intuitivo, praticamente construído pelo próprio usuário. Agora, além de beneficiar a saúde, o Habitus também se torna fonte de ensinamento.
                      </div>
                  </div>
              </div>

              <div class="accordion-item">
                  <h2 class="accordion-header" id="sobrehabitus-heading3">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sobrehabitus3">
                          3. De onde vêm os artigos usados no Habitus?
                      </button>
                  </h2>
                  <div id="sobrehabitus3" class="accordion-collapse collapse" data-bs-parent="#accordionSobreHabitus">
                      <div class="accordion-body">
                          Os artigos utilizados no Habitus vêm de bases científicas confiáveis e publicações revisadas por especialistas.  
                          Eles foram selecionados para garantir que cada hábito seja sustentado por evidências reais e informações seguras.
                      </div>
                  </div>
              </div>

          </div>

          <h2 class="mb-4 FonteLink">Os hábitos</h2>

          <div class="accordion mb-5" id="accordionHabitos">

              <div class="accordion-item">
                  <h2 class="accordion-header" id="habitos-heading1">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#habitos1">
                          1. Quais hábitos você pode começar?
                      </button>
                  </h2>
                  <div id="habitos1" class="accordion-collapse collapse" data-bs-parent="#accordionHabitos">
                      <div class="accordion-body">
                          No Habitus, você pode iniciar três hábitos principais: caminhada, hidratação (ingestão de água) e leitura.  
                          Esses hábitos foram escolhidos por serem simples, acessíveis e com grande impacto positivo na saúde física e mental.
                      </div>
                  </div>
              </div>

              <div class="accordion-item">
                  <h2 class="accordion-header" id="habitos-heading2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#habitos2">
                          2. Por que esses hábitos foram escolhidos?
                      </button>
                  </h2>
                  <div id="habitos2" class="accordion-collapse collapse" data-bs-parent="#accordionHabitos">
                      <div class="accordion-body">
                          Eles foram selecionados por três motivos principais:
                          <ul>
                              <li>Benefícios cientificamente comprovados para o bem-estar.</li>
                              <li>Facilidade de implementação no dia a dia.</li>
                              <li>São universais — qualquer pessoa pode realizá-los.</li>
                          </ul>
                      </div>
                  </div>
              </div>

              <div class="accordion-item">
                  <h2 class="accordion-header" id="habitos-heading3">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#habitos3">
                          3. É possível excluir um hábito?
                      </button>
                  </h2>
                  <div id="habitos3" class="accordion-collapse collapse" data-bs-parent="#accordionHabitos">
                      <div class="accordion-body">
                          Sim! Você pode excluir qualquer hábito que tenha iniciado.  
                          Ao fazer isso, todos os dados relacionados a ele são removidos da sua conta.
                      </div>
                  </div>
              </div>

              <div class="accordion-item">
                  <h2 class="accordion-header" id="habitos-heading4">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#habitos4">
                          4. Como funcionam as metas?
                      </button>
                  </h2>
                  <div id="habitos4" class="accordion-collapse collapse" data-bs-parent="#accordionHabitos">
                      <div class="accordion-body">
                          Cada hábito possui três tipos de metas, variando conforme a atividade.  
                          Você escolhe uma meta ao criar o hábito — como tempo ou quantidade — e acompanha o progresso diariamente.  
                          As metas ajudam a manter constância e visualizar seu avanço através dos gráficos.
                      </div>
                  </div>
              </div>

              <div class="accordion-item">
                  <h2 class="accordion-header" id="habitos-heading5">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#habitos5">
                          5. É possível atualizar ou excluir uma meta?
                      </button>
                  </h2>
                  <div id="habitos5" class="accordion-collapse collapse" data-bs-parent="#accordionHabitos">
                      <div class="accordion-body">
                          <strong>Atualizar meta:</strong> Sim! Você pode atualizar a meta de um hábito já criado. <br><br>
                          <strong>Excluir meta:</strong> Não.  
                          As metas fazem parte da estrutura do hábito. Para remover uma meta, é necessário excluir o hábito inteiro.
                      </div>
                  </div>
              </div>

          </div>

          <h2 class="mb-4 FonteLink">Agradecimentos especiais</h2>

          <div class="accordion" id="accordionAgradecimentos">

              <div class="accordion-item">
                  <h2 class="accordion-header" id="agradecimentos-heading1">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#agradecimentos1">
                          1. Pessoas que contribuíram para que o Habitus se tornasse possível
                      </button>
                  </h2>
                  <div id="agradecimentos1" class="accordion-collapse collapse" data-bs-parent="#accordionAgradecimentos">
                      <div class="accordion-body">
                          Ao meu Deus, Jeová, que sempre esteve comigo em tudo.  
                          Agradeço profundamente aos meus pais, pela paciência durante todo esse período e por acreditarem no meu projeto desde o início.  
                          Também agradeço a todos os professores que me acompanharam ao longo do curso técnico — foi um prazer indescritível aprender com vocês.  
                          <br><br>
                          E, por fim, um agradecimento especial ao Raul e ao Nathan, que me ajudaram com os desafios de lógica durante o desenvolvimento.
                      </div>
                  </div>
              </div>

          </div>

        </div>


    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>