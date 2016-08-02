<?php 

// Conexão com o BD
    $conexao = mysqli_connect("localhost", "root", "root", "doAcao") or die("<h1>Não foi possível conectar!</h1");

    function get_conexao(){
        global $conexao;
        return $conexao;
    }
?>
