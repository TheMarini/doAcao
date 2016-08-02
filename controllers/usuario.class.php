<?php
/* include do model usuario */
    require_once './models/usuario.class.php';

/* classe */

class user_atual{
       
    //realizar login
    static function makelogin(){
        
        $email = isset($_POST['useremail'])?$_POST['useremail'] : null;
        $senha = isset($_POST['userpass'])? $_POST['userpass'] : null;
        
        if(!(is_null($email) || is_null($senha))){
            
            session_start();
        	
            if ($useratual = user::checklogin($email, $senha)){				
				$_SESSION['email'] = $useratual;
				return true;
            }else{
               session_destroy();
               return false;
            }
        }else{
            return false;
        }
    }
}
?>