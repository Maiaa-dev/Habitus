<?php 
    session_start();
    include_once('../conexao.php');
    include_once('../usuario.php');

    if (isset($_POST['opcao'])) {
        $meta = $_POST['opcao'];
        $idUsuario = $_SESSION['id'];
        $idHabito = 1;

        mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 0"); //desabilitar a verificação de chave estrangeira
        $sql = "INSERT INTO registros (id_usuario,id_habito,meta_alcancada) VALUES ('$idUsuario','$idHabito','$meta')";
          if (mysqli_query($conexao,$sql)){
              mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 1"); //reabilitar a verificação de chave estrangeira
              echo "Deu tudo certo!";
          }   
          else{
              echo "Erro ao registrar: " . mysqli_error($conexao);
          }
    }

?>