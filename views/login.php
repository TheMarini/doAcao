<?php
    require_once './controllers/usuario.class.php';

    $email = $_POST['useremail'];
    $senha = $_POST['userpass'];
    
    if(login($email,$senha)){
        echo 'logou';
        header('./index.php?pag=perfil');        
    }else{
        echo 'deu ruim';
        header('./index.php');
    }
    
?>