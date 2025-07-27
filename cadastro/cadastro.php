<?php 
    include_once('../conexao.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha  = $_POST['senha'];
    $confiSenha = $_POST['confisenha'];

        if ($senha != $confiSenha){
            echo '<script>alert("As senhas não são iguais. Clique em OK para voltar para o cadastro!");window.location.href = "index.html";</script>';
            exit; //Misturei um pouquinho de JS com PHP, mas nesse caso, se as senhas forem incompatíveis, ele emite um alerta e não sai da página!
        }
        else{
        $sql = "SELECT * FROM usuario WHERE email = '$email'";
        $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

        if (mysqli_num_rows($resultado) > 0){
            echo "Esse email já foi cadastrado";
        }
        else{
            $senhaCripto = password_hash($senha,PASSWORD_DEFAULT); //criptografando a senha
            $sql = "INSERT INTO usuario (nome,email,senha_hash) VALUES ('$nome','$email','$senhaCripto')";
            if (mysqli_query($conexao,$sql)){
                header("Location: ../login/index.html");
                exit;
            }   
            else{
                echo "Erro ao cadastrar: " . mysqli_error($conexao);
            }
        }
    }
?>