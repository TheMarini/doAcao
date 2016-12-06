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
}
