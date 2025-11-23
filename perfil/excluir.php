<?php 
    include_once('../usuario.php');
    include_once('../conexao.php');

    $idUsuario = $_SESSION['id'];
    $idHabito = 1;

    $sql = "UPDATE usuario SET status_conta = 'inativo' WHERE id_usuario = '$idUsuario'";
    $resultado = mysqli_query($conexao,$sql);

    if ($resultado){
        echo '<script>alert("Sua conta foi excluída.");window.location.href = "../login/index.html";</script>';
        exit;
    }
    else{
        echo '<script>alert("Não foi possível excluir sua conta!");window.location.href = "index.php";</script>';
        exit;
    }
?>