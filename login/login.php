<?php 
    include_once('../conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

    if (mysqli_num_rows($resultado) > 0){
            echo "Login feito com sucesso! Bem-vindo!";
        }
    else{
        echo "Email ou senha incorretos!";
    }
?>