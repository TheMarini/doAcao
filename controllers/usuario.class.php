<?php
/* include do model usuario */
    require_once './models/usuario.class.php';
/* classe */

class user_atual{
       // $user
        
    }

/* funções */
    function login($email, $senha){
        
        session_start();
        
			
			if (mysqli_num_rows($query) > 0){				
				$_SESSION['email'] = $cd_email_usuario;
				$_SESSION['senha'] = $cd_senha_usuario;
				return "Logou";
			}
			else{
				unset ($_SESSION['email']);
				unset ($_SESSION['senha']);
				return "não logou";
			}            
    }
?>