<?php

    $conexao = mysqli_connect("localhost","root","","controle_de_habitos1");
    if(!$conexao){
        echo "Não conectado!";
    }
    else{
        echo "Conectado!";
    }

?>