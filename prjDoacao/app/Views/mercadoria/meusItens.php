<?php
namespace prjDoacao\app\Views\mercadoria;

use prjDoacao\sys\View;
use prjDoacao\sys\session\Session;
use prjDoacao\app\Views\partials as partials;

/**
 * All itens view
 */
class meusItens extends View
{
    public function render()
    {
        $head = new partials\head();
        $head->setTitle('Meus Itens');
        $head->setIncludeCss('css/items.css');
        $head->setIncludeScript('js/mercadoria.js');
        $head->render();
        $nav = new partials\nav();
        $nav->render();
        parent::render();
    }
}
