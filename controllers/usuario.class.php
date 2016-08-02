<?php
/* include do model usuario */
    require_once './models/usuario.class.php';

/* classe */

class user_atual{
    
    
    //verificar se está logado!
    static function is_logged(){
        return isset($_SESSION['email']);
    } 
    
    //realizar login
    static function makelogin(){
        //se o usuário já estiver logado ele retorna que o login foi efetuado com sucesso
        if(isset($_SESSION['email'])){
            return true;
        }
        
        $email = isset($_POST['useremail'])?$_POST['useremail'] : null;
        $senha = isset($_POST['userpass'])? $_POST['userpass'] : null;
        
        
        if(!(is_null($email) || is_null($senha))){
            ;
            
            if (($useratual = user::checklogin($email, $senha)) != false){
                $_SESSION['email'] = $useratual;
				return true;
            }else{
               return false;
            }
        } 
    }
    
    //sair
    static function logout(){
        session_destroy();
    }
}
?>