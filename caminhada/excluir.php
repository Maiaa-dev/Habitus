<?php 
    include_once('../usuario.php');
    include_once('../conexao.php');
    include_once('../alert.php');

    $idUsuario = $_SESSION['id'];
    $idHabito = 3;

    $sql = "DELETE FROM habito_usuario WHERE id_usuario = '$idUsuario'and id_habito = '$idHabito'";
    $resultado = mysqli_query($conexao,$sql);

    if ($resultado){
        exibirAlerta("success", "Hábito excluido!", "Se quiser retomar o hábito, basta adicioná-lo novamente em 'Criar hábito'");
        header("Location: ../menu/index.php");
        exit;
    }
    else{
        exibirAlerta("error", "Ops...!", "Houve um erro ao excluir o hábito. Tente novamente mais tarde.");
        header("Location: index.php");
        exit;
    }
?>