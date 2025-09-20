<?php 
    if (isset($_POST['meta'])) {
        $metaescolhida = $_POST['meta'];
        echo "Você escolheu: " . $metaescolhida;
    } 
    else{
        echo "Nenhuma meta selecionada";
    }
?>