<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Models\Necessidade;
use prjDoacao\app\Models\TipoMercadoria;
use prjDoacao\app\Views\necessidades as view;
use prjDoacao\sys\Router;
use prjDoacao\sys\session\Session;

/**
 * Index Controller
 */
class necessidadesController extends Controller
{
    public function indexAction()
    {
        header('Location: ' . BASE_URL . 'usuario/perfil');
        return;
    }

    public function listarAction($params){
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

        $cduser = Session::getSession('userid')->codigo;

        if(isset($params[0])){
            $cduser = $params[0];
        }

        if(!$this->request->isAjax()){
            header('Location: ' . BASE_URL . 'usuario/perfil');
            return;
        }

        $necessidademodel = new Necessidade();
        $necessidadeview = new view\listar([], $necessidademodel->Consultar($cduser));
        $necessidadeview->render();
    }

    public function novoAction(){
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

        //if(!$this->request->isAjax()){
        //    header('Location: ' . BASE_URL . 'usuario/perfil');
        //    return;
        //}

        if(!empty($this->request->post())){
            $novanecessidade = new Necessidade();
            $novanecessidade->tipo = $this->request->post('tipo');
            $novanecessidade->unidade = $this->request->post('unidade');
            $novanecessidade->nome = $this->request->post('nome');
            $novanecessidade->quantidade = $this->request->post('quantidade');

            if($result = $novanecessidade->Salvar()){
                echo json_encode(true);
                return;
            }

        }

        echo json_encode(false);
    }

}
