<?php 
    include_once('../conexao.php');
    include_once('../usuario.php');
     
    if (!isset ($_SESSION['email'])){
        header("Location: ../login/index.html");
        exit;
    }
    else{
        $logado = $_SESSION['senha'];
        echo "Olá " . $logado;
    }
?>