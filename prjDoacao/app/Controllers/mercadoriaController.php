<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Models\Mercadoria;
use prjDoacao\app\Models\TipoMercadoria;
use prjDoacao\app\Views\mercadoria as view;
use prjDoacao\sys\Router;
use prjDoacao\sys\session\Session;

/**
 * Index Controller
 */
class mercadoriaController extends Controller
{
    public function indexAction(){
        $meusitensview = new view\meusItens();
        $meusitensview->render(); 
    }

    /**
    *   List all itens - AJAX FUNCTION!
    */
    public function listarAction()
    {
        if(!$this->request->isAjax()){
            (new Router)->routeToController('erro404');
            return;
        }

        $mercadoriaModel = new Mercadoria();
        $listarview = new view\listar([],$mercadoriaModel->Consultar(Session::getSession('userid')->codigo));
        $listarview->setTemplate('meusItens-list-ajax');
        $listarview->render();
    }
    
    /**
    * Insert new item - AJAX FUNCTION!
    */
    public function novoAction()
    {
        if(!$this->request->isAjax()){
            (new Router)->routeToController('erro404');
            return;
        }

        if(empty($this->request->post())){
            echo json_encode((new TipoMercadoria)->Consultar());
            return;
        }
    }

}
