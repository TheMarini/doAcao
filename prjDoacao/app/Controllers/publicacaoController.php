<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Models\Publicacao;
use prjDoacao\app\Views\publicacao as view;
use prjDoacao\sys\session\Session;

/**
 * Publicacao Controller
 */
class publicacaoController extends Controller
{
    public function indexAction(){
        header('Location: '. BASE_URL . 'usuario/perfil');
        return;
    }
    
    public function listarAction(){
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

        //if(!$this->request->isAjax()){
        //    header('Location: ' . BASE_URL . 'usuario/perfil');
        //    return;
        //}
        
        $publicacaomodel = new Publicacao();
        $publicacaoview = new view\listar([], $publicacaomodel->Consultar(Session::getSession('userid')->codigo));
        $publicacaoview->render();
        
    }
}