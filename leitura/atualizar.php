<?php 
    include_once('../usuario.php');
    include_once('../conexao.php');
    include_once('../alert.php');   

    if (isset($_POST['novaMeta'])) {
        $novaMeta = $_POST['novaMeta'];
        $idUsuario = $_SESSION['id'];
        $idHabito = 2;

        $sql = "SELECT m.nome_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 2";
        $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

        $dados = mysqli_fetch_assoc($resultado);
        //$idMeta = $dados['id_meta'];
        $nomeMeta = $dados['nome_meta'];

        if($novaMeta == $nomeMeta){
            exibirAlerta("error", "Ops...!", "Nenhuma alteração foi feita, pois a meta selecionada é igual à atual.");
            header("Location: index.php");
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
                    exibirAlerta("success", "Tudo certo!", "Sua meta foi atualizada com sucesso :)");
                    header("Location: index.php");
                    exit;
                }
                else{
                    exibirAlerta("error", "Ops...!", "Houve um erro ao atualizar sua meta. Tente novamente mais tarde.");
                    header("Location: index.php");
                    exit;
                }

            }
        }
    }
    else if (!isset($_POST['novaMeta'])){
        header("Location: index.php");
        exit;
    }
?>