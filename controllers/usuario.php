<?php
    /* include do model usuario */
    require_once './models/usuario.class.php';

    session_start();    
    
    /* variaveis */
        $atual_user_query = null;
        $row = 0;
        $user = null;

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
            
            if (($useratual = user::Login($email, $senha)) != false){
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

    //Novo
    function user_registrar(){
        if(isset($_POST['username'])? $_POST['username']) : null;
        $email = isset($_POST['useremail'])? $_POST['useremail'] : null;
        $senha = isset($_POST['usersenha'])? $_POST['usersenha'] : null;
        $tipo = isset($_POST['usertipo'])? $_POST['usertipo'] : null;

        if($nome)    

                
    }

    //Consulta
	function user_consultar($termo = ""){
        global $atual_user_query;
        global $row;
        global $user;

        if(is_null($atual_user_query)){
            $atual_user_query = user::Consultar($termo);
            if(!is_null($atual_user_query)){
                $user = $atual_user_query[$row];
                return true;
            }
        }
        
        if(count($atual_user_query) > $row){
            $user = $atual_user_query[$row];
            $row++;
        }else{
            $atual_user_query = null;
            $row = 0;
        }
        return !is_null($atual_user_query);
    }
?>