<?php 
    if (isset($_POST['habito'])) {
        $habitoescolhido = $_POST['habito'];
        echo "Você escolheu: " . $habitoescolhido;
    } 
    else {
        echo "Nenhuma habito foi selecionado.";
    }
?>