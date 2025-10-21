<?php 
    session_start();
    include_once('../conexao.php');
    include_once('../usuario.php');
    

    if (isset($_POST['opcao'])) {
        $metaCumprida = $_POST['opcao'];
        $idUsuario = $_SESSION['id'];
        $idHabito = 1;
        //identificando a meta estipulada
        $sql = "SELECT m.nome_meta,m.id_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = 1";
        $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

        $dados = mysqli_fetch_assoc($resultado);
        $idMeta = $dados['id_meta'];
        $nomeMeta = $dados['nome_meta'];
        //Transformando em ml para facilitar a verificação
        if($nomeMeta == '1L'){
            $nomeMeta = 1000;
        }
        if($nomeMeta == '2L'){
            $nomeMeta = 2000;
        }
        else{
            $nomeMeta = 2500;
        }

        //Pegando todos os registros do dia:
        $sql = "SELECT rh.meta_cumprida FROM registros_hidratacao rh, usuario u WHERE rh.id_usuario = u.id_usuario and rh.id_habito = 1 and DATE(data_feito) = CURDATE()";
        $resultado = mysqli_query($conexao,$sql);
        $registroDia = [];

        if ($resultado && mysqli_num_rows($resultado) > 0){
            while($dados = mysqli_fetch_assoc($resultado)){
                $registroDia[] = (int)$dados['meta_cumprida'];
            }
        }

            $somaRegistro = array_sum($registroDia); //Somando todos os valores da array

            //Agora a comparação - Verificando se já bateu a meta - Registrando se ainda não
            if($somaRegistro < $nomeMeta){
                echo "Você ainda não bateu a meta";
                mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 0"); //desabilitar a verificação de chave estrangeira
                $sql = "INSERT INTO registros_hidratacao (id_usuario,id_habito,id_meta,meta_cumprida) VALUES ('$idUsuario','$idHabito','$idMeta','$metaCumprida')";
                if (mysqli_query($conexao,$sql)){
                    mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 1"); //reabilitar a verificação de chave estrangeira
                    echo "Deu tudo certo!";
                }   
                else{
                    echo "Erro ao registrar: " . mysqli_error($conexao);
                }
            }
            else{
                echo "Você já bateu a meta!";
            }
    }
?>