<?php 
namespace prjDoacao\app\Views\doacoes;

use prjDoacao\sys\View;
use prjDoacao\app\Views\partials as partials;

/**
 * Exibe tela inicial de doacoes efetuadas
 */
class doacoes extends View
{
    public function render()
    {
        $head = new partials\head();
        $head->setTitle('Doações');
        $head->setIncludeCss('css/doacoes.css');
        $head->setIncludeScript('js/doacoes.js');
        $head->render();
        $nav = new partials\nav();
        $nav->render();
        parent::render();    
    }
    
}

