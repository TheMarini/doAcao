<?php
/* include do model usuario */
    require_once './models/usuario.class.php';
/* classe */



class user_atual{
       // $user
        
    }

/* funções */
    function login($_email, $_senha){
        
           session_start();
        		
		if ($useratual = user::login($_email, $_senha)){				
				$_SESSION['email'] = $useratual;
				return true;
        }
		else{
           session_destroy();
            return false;
        }            
    }
?>