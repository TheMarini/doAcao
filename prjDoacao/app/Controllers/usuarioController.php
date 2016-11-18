<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller;
use prjDoacao\app\Views\usuario as usuario;
use prjDoacao\sys\session\Session as Session;

/**
 * Usuário controller actions
 */
class usuarioController extends Controller
{
    public function loginAction(){
        if(!is_null($this->request->post())){
            $email = $this->request->post('txtEmail');
            $senha = $this->request->post('txtSenha');

            if(empty($email) || empty($senha)){
                $data["%mensagem%"] = "Preencha os campos corretamente!";
                $data["%txtEmail%"] = $email;
                $loginview = new usuario\login($data);
                $loginview->render();
            }
        }else{
            
        }
    }

    public function perfilAction(){
        if(Session::isLogged()){
            
        }else{
            $notLoggedview = new usuario\notLogged();
            $notLoggedview->render();
        }
    }

}
