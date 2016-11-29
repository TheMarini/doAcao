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

        $nome = $this->request->post('nome');
        $codigoTipoMercadoria = $this->request->post('tipo');
        $unidade = $this->request->post('unidade');
        $quantidade = $this->request->post('quantidade');
        $descricao = $this->request->post('descricao');

        if(empty($nome)){
            echo json_encode("Preencha o nome!");
            return;
        }
        if(empty($codigoTipoMercadoria)){
            echo json_encode("Selecione o tipo de mercadoria!");
            return;
        }
        if(empty($unidade)){
            echo json_encode("Selecione a unidade da mercadoria!");
            return;
        }
        if(empty($quantidade) || $quantidade <= 0){
            echo json_encode("Quantidade Inválida");
            return;
        }

        $novamercadoria = new Mercadoria();
        $novamercadoria->nome = $nome;
        $novamercadoria->tipo = $codigoTipoMercadoria;
        $novamercadoria->unidade = $unidade; 
        $novamercadoria->quantidade = $quantidade;
        $novamercadoria->descricao = $descricao;
        $novamercadoria->usuario = Session::getSession('userid')->codigo;

        if($novamercadoria->Salvar()){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

}
