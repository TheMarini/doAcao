<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;    
use prjDoacao\app\Views\instituicoes as view;
use prjDoacao\sys\session\Session;

/**
 * Ranking Controller
 */
class instituicoesController extends Controller
{
    public function indexAction()
    {
        $instituicoesview = new view\instituicoes();
        $instituicoesview->render();
    }
}
