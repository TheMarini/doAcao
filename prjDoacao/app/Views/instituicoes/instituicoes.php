<?php
namespace prjDoacao\app\Views\instituicoes;

use prjDoacao\sys\View as View;
use prjDoacao\app\Views\partials as partials;
/**
 * Erro 404 index view
 */
class instituicoes extends View
{
    public function render()
    {
        $head = new partials\head();
        $head->setTitle('Instituicoes');
        $head->setIncludeCss('css/instituicoes.css');
        $head->render();
        $nav = new partials\nav();
        $nav->render();
        parent::render();
    }
}
