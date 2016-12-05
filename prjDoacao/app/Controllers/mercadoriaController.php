<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Models\Mercadoria;
use prjDoacao\app\Models\TipoMercadoria;
use prjDoacao\app\Views\mercadoria as view;
use prjDoacao\sys\Router;
use prjDoacao\sys\session\Session;
use prjDoacao\app\Models\Match;
use prjDoacao\app\Models\Usuario;

/**
 * Index Controller
 */
class mercadoriaController extends Controller
{
    public function indexAction(){
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

        if(Session::getSession('userid')->tipo == 2){
            header('Location: '.BASE_URL);
            return;
        }

        $meusitensview = new view\meusItens();
        $meusitensview->render(); 
    }

    /**
    *   List all itens - AJAX FUNCTION!
    */
    public function listarAction()
    {
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

        if(!$this->request->isAjax()){
            header('Location: ' . BASE_URL . 'mercadoria');
            return;
        }

        $mercadoriaModel = new Mercadoria();
        $listarview = new view\listar([],$mercadoriaModel->Consultar(Session::getSession('userid')->codigo));
        $listarview->setTemplate('meusItens-list-ajax');
        $listarview->render();
    }

    public function listarCombinacoesAction($params)
    {
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

        if(!$this->request->isAjax()){
            header('Location: ' . BASE_URL . 'mercadoria');
            return;
        }

        if(isset($params[0])){
            $matchList = (new Match())->listarCombinacoes($params[0]);       
            echo json_encode($matchList);
            return;
        }
    }
    
    /**
    * Insert new item - AJAX FUNCTION!
    */
    public function novoAction()
    {
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }
        
        if(!$this->request->isAjax()){
            header('Location: ' . BASE_URL . 'mercadoria');
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

    /**
    * Select Item - AJAX FUNCTION!
    */
    public function itemAction($codigo)
    {
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

        if(!$this->request->isAjax()){
            header('Location: ' . BASE_URL . 'mercadoria');
            return;
        }

        if(is_null($codigo[0])){
            header('Location: ' . BASE_URL . 'mercadoria');
            return;
        }

        $mercadoriamodel = new Mercadoria($codigo[0]);

        //validating pass
        if(empty($mercadoriamodel->codigo)){
            header('Location: ' . BASE_URL . 'mercadoria');
            return;
        }
        if($mercadoriamodel->usuario != Session::getSession('userid')->codigo && Session::getSession('userid')->tipo != 2){
            header('Location: ' . BASE_URL . 'mercadoria');
            return;
        }

        echo json_encode($mercadoriamodel);
    }

    /**
    *   Remover item
    */
    public function removerAction()
    {
       if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

        if(!$this->request->isAjax()){
            header('Location: ' . BASE_URL . 'mercadoria');
            return;
        }

        $codigo = $this->request->post('codigo');

        if(empty($codigo)){
            header('Location ' . BASE_URL . 'mercadoria');
            return;
        }

        $mercadoriaModel = new Mercadoria($codigo);

        if($mercadoriaModel->usuario != Session::getSession('userid')->codigo){
            header('Location ' . BASE_URL . 'mercadoria');
            return;
        }

        if($mercadoriaModel->Excluir($codigo)){
            echo "Excluído com sucesso!";
        }else{
            echo "Erro ao excluir";
        }

    }

}
