<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller;
use prjDoacao\app\Views\usuario as view;
use prjDoacao\app\Models\usuario as Usuario;
use prjDoacao\sys\session\Session as Session;

/**
 * Usuário controller actions
 */
class usuarioController extends Controller
{
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

    public function perfilAction(){
        if(Session::isLogged()){

        }else{
            $notLoggedview = new view\notLogged();
            $notLoggedview->render();
        }
    }

}
