<?php
/* include do model usuario */
    require_once './models/usuario.class.php';

/* classe */
    session_start();    
    
    $user_atual = new user('atual');

    //verifica se algum usuário está logado.
    function is_logged(){
        return isset($_SESSION['email']);
    }
    
    //realizar login
    function login(){
        //se o usuário já estiver logado ele retorna que o login foi efetuado com sucesso
        if(isset($_SESSION['email'])){
            return true;
        }
        
        $email = isset($_POST['useremail'])? $_POST['useremail'] : null;
        $senha = isset($_POST['userpass'])? $_POST['userpass'] : null;
        
        
        if(!(is_null($email) || is_null($senha))){
            
            if (($useratual = user::checklogin($email, $senha)) != false){
                $_SESSION['email'] = $useratual;
				return true;
            }else{
               return false;
            }
        } 
    }
    
    //sair
    function logout(){
        session_destroy();
    }
?>