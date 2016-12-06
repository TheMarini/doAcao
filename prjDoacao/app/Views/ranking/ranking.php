<?php
namespace prjDoacao\app\Views\ranking;

use prjDoacao\sys\View;
use prjDoacao\app\Views\partials as partials;

/**
 * Show ranking
 */
class ranking extends View
{
    function render(){
        $head = new partials\head();
        $head->setTitle('Ranking');
        $head->setIncludeCss('css/ranking.css');
        $head->setIncludeScript('js/ranking.js');
        $head->render();
        $nav = new partials\nav();
        $nav->render();
        parent::render();
    }
}
