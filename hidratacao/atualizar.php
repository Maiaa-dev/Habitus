<?php 
    include_once('../usuario.php');
    include_once('../conexao.php');

    if (isset($_POST['novaMeta'])) {
        $novaMeta = $_POST['novaMeta'];
        $idUsuario = $_SESSION['id'];
        $idHabito = 1;

        $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 1";
        $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

        $dados = mysqli_fetch_assoc($resultado);
        //$idMeta = $dados['id_meta'];
        $nomeMeta = $dados['nome_meta'];

        if($novaMeta == $nomeMeta){
            echo '<script>alert("Nenhuma atualização foi feita!");window.location.href = "index.php";</script>';
            exit;
        }
        else{
            $sql = "SELECT id_meta FROM metas WHERE nome_meta = '$novaMeta'";
            $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

            if (mysqli_num_rows($resultado) > 0){
                $dados = mysqli_fetch_assoc($resultado);
                $idMeta = $dados['id_meta'];

                $sql = "UPDATE habito_usuario SET id_meta = '$idMeta' WHERE id_usuario = '$idUsuario' and id_habito = '$idHabito'";
                $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

                if($resultado){
                    echo '<script>alert("Meta atualizada! :)");window.location.href = "index.php";</script>';
                    exit;
                }
                else{
                    echo '<script>alert("Não foi possível atualizar a meta!");window.location.href = "index.php";</script>';
                    exit;
                }

            }
        }
    }
    else{
        echo 'window.location.href = "index.php";</script>';
        exit;
    }
?>