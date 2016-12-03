<?php
namespace prjDoacao\app\Views\erro404;

use prjDoacao\sys\View as View;
use prjDoacao\app\Views\partials as partials;
/**
 * Erro 404 index view
 */
class erro404 extends View
{
    public function render()
    {
        $head = new partials\head();
        $head->setTitle('Página Não Encontrada');
        $head->setIncludeCss('css/error404.css');
        $head->render();
        parent::render();
    }
}
