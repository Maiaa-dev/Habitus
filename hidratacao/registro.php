<?php 
    include_once('../conexao.php');
    include_once('../usuario.php');
    include_once('../alert.php');

    if (isset($_POST['opcao'])) {
        $metaCumprida = $_POST['opcao'];
        $idUsuario = $_SESSION['id'];
        $idHabito = 1;
        //identificando a meta estipulada
        $sql = "SELECT m.nome_meta,m.id_meta FROM metas m, usuario u, habito_usuario hu, habitos h WHERE m.id_meta = hu.id_meta and u.id_usuario = hu.id_usuario and h.id_habito = hu.id_habito and hu.id_usuario = '$idUsuario' and hu.id_habito = '$idHabito'";
        $resultado = mysqli_query($conexao,$sql); //armazena o resultado da consulta anterior

        $dados = mysqli_fetch_assoc($resultado);
        $idMeta = $dados['id_meta'];
        $nomeMeta = $dados['nome_meta'];
        
        //Transformando em ml para facilitar a verificação
        if($nomeMeta == '1L'){
            $nomeMeta = 1000;
        }
        else if($nomeMeta == '2L'){
            $nomeMeta = 2000;
        }
        else{
            $nomeMeta = 2500;
        }

        //Pegando todos os registros do dia:
        $sql = "SELECT rh.meta_cumprida FROM registros_hidratacao rh WHERE rh.id_usuario = '$idUsuario' and rh.id_habito = '$idHabito' and DATE(data_feito) = CURDATE()";
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
                mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 0"); //desabilitar a verificação de chave estrangeira
                $sql = "INSERT INTO registros_hidratacao (id_usuario,id_habito,id_meta,meta_cumprida) VALUES ('$idUsuario','$idHabito','$idMeta','$metaCumprida')";
                if (mysqli_query($conexao,$sql)){
                    mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 1"); //reabilitar a verificação de chave estrangeira
                    exibirAlerta("success", "Registro feito com sucesso!", "Parabéns por cuidar da sua hidratação! Mas, você ainda pode beber mais água hoje!");
                    header("Location: index.php");
                    exit;
                }   
                else{
                    exibirAlerta("error", "Ops...!", "Houve um erro ao registrar. Tente novamente mais tarde.");
                    header("Location: index.php");
                    exit;
                }
            }
            else{
                exibirAlerta("info", "Muito bom, mas...", "Você já atingiu sua meta de hidratação para hoje, logo, não é necessário registrar mais consumo de água.");
                header("Location: index.php");
                exit;
            }
    }
?>