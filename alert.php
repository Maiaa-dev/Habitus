<?php 
    include_once("conexao.php");
    include_once("usuario.php");

    if (!isset($_SESSION)) {
        session_start();
    }

    function exibirAlerta($tipo,$titulo,$mensagem) {
        $_SESSION['alerta'] = [
            'tipo' => $tipo,
            'titulo' => $titulo,
            'mensagem' => $mensagem
        ];
    }

    function mostrarAlerta() {
        if (isset($_SESSION['alerta'])) {
            $alert = $_SESSION['alerta'];
            echo "
                <script>
                Swal.fire({
                icon: '{$alert['tipo']}',
                title: '{$alert['titulo']}',
                text: '{$alert['mensagem']}',
                confirmButtonText: 'OK'
                });
                </script>";

            unset($_SESSION['alerta']);
        }
    }
?>