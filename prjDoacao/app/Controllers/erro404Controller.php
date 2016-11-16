<?php
namespace prjDoacao\app\Controllers;

use prjDoacao\sys\Controller as Controller;
use prjDoacao\app\Views\erro404 as erro404;

/**
 * This Controller is called when any controller is found
 */
class erro404Controller extends Controller
{
    public function indexAction(){
        $erroview = new erro404\erro404();
        $erroview->render();
    }
}
