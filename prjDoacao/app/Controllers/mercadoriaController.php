<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Views\mercadoria as mercadoria;

/**
 * Index Controller
 */
class mercadoriaController extends Controller
{
    public function indexAction(){
        $indexview = new mercadoria\index();
        $indexview->render();   
    }
}
