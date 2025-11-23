<?php 
    include_once('../usuario.php');
    include_once('../conexao.php');

    //Variáveis da sessão, do BD, para comparar mais rápido
    $idUsuario = $_SESSION['id'];
    $email = $_SESSION['email'];
    $senha = $_SESSION['senha'];
    $genero = $_SESSION['genero'];
    $nome = $_SESSION['nome'];
    
    //Variáveis do formulário
    
    if (isset($_POST['info'])) {
        $atuali = $_POST['info'];

        if($atuali == "Nome"){
            $novoNome = $_POST['novoNome'];
            if($nome == $novoNome){
                echo "Os nomes são iguais, não é possível alterar!";
            }
            else{
                $sql = "UPDATE usuario SET nome = '$novoNome' WHERE id_usuario = '$idUsuario'";
                $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
                if($resultado){
                    $_SESSION['nome'] = $novoNome;
                    header("Location:index.php");
                    exit;
                }
            }
        }
        else if($atuali == "Email"){
            $novoEmail = $_POST['novoEmail'];
            if($email == $novoEmail){
                echo "Os emails são iguais, não é possível alterar!";
            }
            else{
                $sql = "UPDATE usuario SET email = '$novoEmail' WHERE id_usuario = '$idUsuario'";
                $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
                if($resultado){
                    $_SESSION['email'] = $novoEmail;
                    header("Location:index.php");
                    exit;
                }
            }
        }
        else if($atuali == "Genero"){
            $novoGenero = $_POST['novoGenero'];
            if($genero == $novoGenero){
                echo "Os gêneros são iguais, não é possível alterar!";
            }
            else{
                $sql = "UPDATE usuario SET genero = '$novoGenero' WHERE id_usuario = '$idUsuario'";
                $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
                if($resultado){
                    $_SESSION['genero'] = $novoGenero;
                    header("Location:index.php");
                    exit;
                }
            }
        }
        else if($atuali == "Senha"){
            $senhaAntiga = $_POST['senhaAntiga'];
            $novaSenha = $_POST['senhaNova'];
            if($senhaAntiga != $senha){
                echo "Sua senha antiga está errada. Não é possível alterar!";
            }
            else{
                if(password_verify($novaSenha, $senha)){
                    echo "As senhas são iguais, não é possível alterar!";
                }
                else{
                    $novaCripto = password_hash($novaSenha,PASSWORD_DEFAULT);
                    $sql = "UPDATE usuario SET genero = '$novaCripto' WHERE id_usuario = '$idUsuario'";
                    $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior
                    if($resultado){
                        $_SESSION['senha'] = $novaCripto;
                        header("Location:index.php");
                        exit;
                    }
                }
            }
            
        }
    }
?>