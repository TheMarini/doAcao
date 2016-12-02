<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Views\index as views;
use prjDoacao\sys\session\Session as Session;

/**
 * Index Controller
 */
class indexController extends Controller
{
    public function indexAction(){
        if(Session::isLogged()){
            if(Session::getSession('userid')->tipo != 2){
                $indexviewdoador = new views\indexDoador();
                $indexviewdoador->render();
            }else{
                $indexviewreceptor = new views\indexReceptor();
                $indexviewreceptor->render();
            
            }
            return;
         }

        $indexview = new views\index();
        $indexview->render();
    }
}
