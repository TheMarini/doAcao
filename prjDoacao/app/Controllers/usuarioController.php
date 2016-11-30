<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller;
use prjDoacao\sys\Router;
use prjDoacao\app\Views\usuario as view;
use prjDoacao\app\Models\usuario as Usuario;
use prjDoacao\sys\session\Session as Session;

/**
 * Usuário controller actions
 */
class usuarioController extends Controller
{
    public function indexAction(){
       $this->perfilAction($params[0]=null);
    }

    public function loginAction(){
        if(Session::isLogged()){
            header('Location: '. BASE_URL);
            return;
        }
        
        $data["%txtEmail%"] = "";
        $data["%mensagem%"] = "";

        if(!is_null($this->request->post())){
            $email = $this->request->post('txtEmail');
            $senha = $this->request->post('txtSenha');

            //valida as entradas
            if(empty($email) || empty($senha)){
                $data["%mensagem%"] = "Preencha os campos corretamente!";
                $data["%txtEmail%"] = $email;
                $loginview = new view\login($data);
                $loginview->render();
                return;
            }

            //verifica login
            $usermodel = new Usuario();
            if($usermodel->login($email, $senha)){
                header('Location: '.BASE_URL);
            }else{
                $data["%mensagem%"] = "Usuário ou senha inválidos!";
                $data["%txtEmail%"] = $email;
                $loginview = new view\login($data);
                $loginview->render();
            }

        }else{
            //renderiza a view normalmente
            $loginview = new view\login($data);
            $loginview->render();
        }
    }

    public function logoutAction()
    {
        (new Usuario())->Logout();
        header('Location: '. BASE_URL);
    }

    public function registrarAction(){
        if(Session::isLogged()){
            header('Location: ' . BASE_URL);
            return;
        }

        $data["%h1Class%"] = "";
        $data["%mensagem%"] = "Agora precisamos de alguns dados...";
        $data["%txtNome%"] = "";
        $data["%txtEmail%"] = "";
        $data["%txtCNPJ%"] = "";
        $data["%txtSenha%"] = "";
        $data["%txtRepitaSenha%"] = "";
        $data["%tipo%"] = "0";
        
        if(!is_null($this->request->post())){
            $nome = $this->request->post('txtNome');
            $email = $this->request->post('txtEmail');
            $cnpj = $this->request->post('txtCNPJ');
            $senha = $this->request->post('txtSenha');
            $senhaVerif = $this->request->post('txtRepitaSenha');
            $tipo = $this->request->post('tipo');

            $data["%txtNome%"] = $nome;
            $data["%txtEmail%"] = $email;
            $data["%txtCNPJ%"] = $cnpj;
            $data["%txtSenha%"] = $senha;
            $data["%txtRepitaSenha%"] = $senhaVerif;
            $data["%tipo%"] = $tipo;

            if(empty($nome) || empty($email) || empty($senha) || empty($senhaVerif) || empty($tipo)){
                $data["%h1Class%"] = "error"; 
                $data["%mensagem%"] = "Preencha os campos corretamente!";

                $registerview = new view\registrar($data);
                $registerview->render();
                return;
            }

            if($tipo == 2 && empty($cnpj)){
                $data["%h1Class%"] = "alert"; 
                $data["%mensagem%"] = "É necessário preencher um cnpj válido!";

                $registerview = new view\registrar($data);
                $registerview->render();
                return;
            }

            if($senha != $senhaVerif){
                $data["%h1Class%"] = "alert"; 
                $data["%mensagem%"] = "As senhas não são identicas!";

                $registerview = new view\registrar($data);
                $registerview->render();
                return;
            }

            //realiza inserção no sistema
            $novousuario = new Usuario();
            $novousuario->nome = $nome; 
            $novousuario->email = $email;
            $novousuario->tipo = $tipo;
            $novousuario->cnpj = $tipo == 2?$cnpj:null;

            $result = $novousuario->Register($senha);

            if($result === true){
                $novousuario->login($email, $senha);
                header('Location: '.BASE_URL.'usuario/perfil');
            }else{
                $data["%h1Class%"] = "alert"; 
                $data["%mensagem%"] = "$result";
                
                $registerview = new view\registrar($data);
                $registerview->render();
            }
        }else{
            $registerview = new view\registrar($data);
            $registerview->render();
        }
    }
    
    public function perfilAction($params){
        if(!empty($params)){
            if($usuariomodel = (new Usuario())->getById($params[0])){
                if($usuariomodel->tipo != 1){
                    $perfilview = new view\perfil([], $usuariomodel);
                    $perfilview->render();
                    return;
                }
            }
            (new Router())->routeToController('erro404Controller');
            return;
        }

        if(Session::isLogged()){
            $usuariomodel = (new Usuario())->getById(Session::getSession('userid')->codigo);
            $perfilview = new view\perfil([], $usuariomodel);
            $perfilview->render();
        }else{
            $notLoggedview = new view\notLogged();
            $notLoggedview->render();
        }
    }

}
