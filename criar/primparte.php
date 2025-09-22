<?php 
    session_start();
    include_once('../conexao.php');
    include_once('../usuario.php');
    if (isset($_POST['habito']) && isset($_POST['meta'])) {
        $habitoescolhido = $_POST['habito'];
        $metaescolhida = $_POST['meta'];
        $sql = "SELECT h.id_habito,m.id_meta FROM habitos h, metas m WHERE m.id_habito=h.id_habito and h.nome_habito = '$habitoescolhido' and m.nome_meta = '$metaescolhida'";
        $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

        if (mysqli_num_rows($resultado) > 0){
            $dados = mysqli_fetch_assoc($resultado);

            $idHabito = $dados['id_habito'];
            $idMeta = $dados['id_meta'];
            $idUsuario = $_SESSION['id'];

            $sql = "SELECT * FROM habito_usuario WHERE id_usuario = '$idUsuario' and id_habito = '$idHabito'";
            $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

            if (mysqli_num_rows($resultado) > 0){
                echo "Parece que você já tem esse hábito! Que tal criar um novo?";
            }
            else{
                mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 0"); //desabilitar a verificação de chave estrangeira
                $sql = "INSERT INTO habito_usuario (id_usuario,id_habito,id_meta) VALUES ('$idUsuario','$idHabito','$idMeta')";
                if (mysqli_query($conexao,$sql)){
                    mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 1"); //reabilitar a verificação de chave estrangeira
                    echo "Deu tudo certo!";
                }   
                else{
                    echo "Erro ao cadastrar: " . mysqli_error($conexao);
                }

        }}
    } 

?>