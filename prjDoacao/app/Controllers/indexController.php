<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Views\index as index;
use prjDoacao\sys\session\Session as Session;

/**
 * Index Controller
 */
class indexController extends Controller
{
    public function indexAction(){
        if(Session::isLogged()){
            $indexview = new index\indexLogged();
            $indexview->data["%variavel%"] = "Aqui vai um texto na index!";
            $indexview->render();
        }else{
            $indexview = new index\index();
            $indexview->render();
        }   
    }
}
