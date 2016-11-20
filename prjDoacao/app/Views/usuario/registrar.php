<?php
namespace prjDoacao\app\Views\usuario;

use prjDoacao\sys\View as View;
use prjDoacao\app\Views\partials as partials;

/**
 * Register view to insert new user in system
 */
class registrar extends View
{
    public function render()
    {
        $head = new partials\head();
        $head->setTitle("Registrar");
        $head->render();
        parent::render();
        (new partials\footer())->render();
    }
    
}