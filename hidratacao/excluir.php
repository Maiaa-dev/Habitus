<?php 
    include_once('../usuario.php');
    include_once('../conexao.php');

    $idUsuario = $_SESSION['id'];
    $idHabito = 1;

    $sql = "DELETE FROM habito_usuario WHERE id_usuario = '$idUsuario'and id_habito = '$idHabito'";
    $resultado = mysqli_query($conexao,$sql);

    if ($resultado){
        echo '<script>alert("Hábito excluido!");window.location.href = "../menu/index.php";</script>';
        exit;
    }
    else{
        echo '<script>alert("Não foi possível excluir!");window.location.href = "index.php";</script>';
        exit;
    }
?>