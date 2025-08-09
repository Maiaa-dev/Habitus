<?php 
    session_start();
    include_once('../conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

    if (mysqli_num_rows($resultado) > 0){
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header("Location: ../menu/index.php");
        }
    else{
        echo '<script>alert("Email ou senha incorretos. Tente novamente!");window.location.href = "index.html";</script>';
            exit;
    }
?>