<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Models\Doacao;
use prjDoacao\app\Models\TipoMercadoria;
use prjDoacao\app\Views\doacoes as view;
use prjDoacao\sys\Router;
use prjDoacao\sys\session\Session;
use prjDoacao\app\Models\Mercadoria;
use prjDoacao\app\Models\Usuario;

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

        if(!$this->request->isAjax()){
            header('Location: ' . BASE_URL . 'doacoes');
            return;
        }

        $doacaomodel = new Doacao();
        $listarview = new view\listar([],$doacaomodel->Listar());
        $listarview->render();
    }

    /**
    * Nova Doacao
    */
    public function novoAction(){
        if(!Session::isLogged()){
            header('Location: '. BASE_URL . 'usuario/login');
            return;
        }

       // if(!$this->request->isAjax()){
        //    header('Location: ' . BASE_URL . 'doacoes');
        //    return;
       // }

        $novadoacao = new Doacao();
        $novadoacao->quantDoacao = $this->request->post('quantidade');
        $novadoacao->mercadoria = new Mercadoria($this->request->post('mercadoria'));
        $novadoacao->usuario = (new Usuario)->getById(($this->request->post('usuario')));
        $novadoacao->anonima = ($this->request->post('anonima') == 'yes')? true:false;

        var_dump($novadoacao->mercadoria);        
        if($novadoacao->Salvar()){
            echo 'foi';
        }else{
            echo 'não foi';
        }

    }

}