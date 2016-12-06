<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Models\Ranking;
use prjDoacao\app\Views\ranking as view;
use prjDoacao\sys\session\Session;

/**
 * Ranking Controller
 */
class rankingController extends Controller
{
    public function indexAction()
    {
        $rankingview = new view\ranking();
        $rankingview->render();
    }
    
    public function listarAction(){
        if(!$this->request->isAjax()){
            header('Location: ' . BASE_URL . 'ranking');
            return;
        }
        
        $rankingmodel = new Ranking();
        $rankingview = new view\listar([], $rankingmodel->Listar());
        $rankingview->render();
    }
}
