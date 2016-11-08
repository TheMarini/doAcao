<?php
    /* include do model usuario */
    require_once './models/usuario.class.php';

    session_start();    
    
    /* variaveis */
        $atual_user_query = null;
        $row = 0;
        $user = null;

        $useratual = isset($_SESSION['useratual'])? $_SESSION['useratual'] : null;
        
    //verifica se algum usuário está logado.
    function is_logged(){
        global $useratual;
        return !is_null($useratual);
    }
    
    function useratual(){
        global $useratual;
        return $useratual;
    }

    //realizar login
    function login(){
        //se o usuário já estiver logado ele retorna que o login foi efetuado com sucesso
        if(is_logged()){
            return true;
        }
        
        $email = isset($_POST['useremail'])? $_POST['useremail'] : null;
        $senha = isset($_POST['userpass'])? $_POST['userpass'] : null;
        
        
        if(!(is_null($email) || is_null($senha))){
            
            if ($loginuser = user::Login($email, $senha)){
                $_SESSION['useratual'] = $loginuser;                
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
    function registrar(){
        if(isset($_POST['btnSend'])){
            
            $nome = $_POST['username'];
            $email = $_POST['useremail'];
            $senha = $_POST['userpass'];
            $tipo = $_POST['usertipo'];

            $errormsg = "";
            
            if(empty($nome) || empty($email) || empty($senha) ){
                return "Preencha todos os campos";
            }

            $novouser = new user($email, $nome, $tipo);
            if($novouser->Salvar($senha)){
                $_SESSION['useratual'] = user::Login($email, $senha);
                return true;
            }else{
                return "Email já cadastrado!";
            }
            
        }       
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