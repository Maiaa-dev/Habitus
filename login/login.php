<?php 
    session_start();
    include_once('../conexao.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

    if (mysqli_num_rows($resultado) > 0){
            $usuario = mysqli_fetch_assoc($resultado);

            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['id'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['genero'] = $usuario['genero'];
            $_SESSION['status'] = $usuario['status_conta'];
            header("Location: ../menu/index.html");
            exit;
        }
    else{
        echo '<script>alert("Email ou senha incorretos. Tente novamente!");window.location.href = "index.html";</script>';
            exit;
    }
?>