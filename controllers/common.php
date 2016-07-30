<?php
//FUNÇÕES COMUNS PARA USAR DURANTE O RUNTIME NA CAMADA VIEW

    function test(){
        echo 'aqui é um teste';        
    }

// -- PATH FUNCs --
    //Caminho da pasta views
    function path(){
        echo 'views';
    }
    //Retorno do caminho da pasta views
    function get_path(){
        return 'views';
    }

// -- INCLUDES --
    //Chama o modelo de header
    function get_header(){
       return include './views/header.php';
    }
    //Chama o modelo do rodapé
    function get_footer(){
       return include './views/footer.php';
    }
?>