<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Models\Doacao;
use prjDoacao\app\Models\TipoMercadoria;
use prjDoacao\app\Views\doacoes as view;
use prjDoacao\sys\Router;
use prjDoacao\sys\session\Session;

/**
 * Index Controller
 */
class doacoesController extends Controller
{
    public function indexAction()
    {
        $doacoesview = new view\doacoes();
        $doacoesview->render();
    }

    /**
    * Listar itens
    */
    public function listarAction(){
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

       // if(!$this->request->isAjax()){
         //   header('Location: ' . BASE_URL . 'doacoes');
           // return;
        //}

        $doacaomodel = new Doacao();
        $listarview = new view\listar([],$doacaomodel->Listar());
        $listarview->render();
    }
}