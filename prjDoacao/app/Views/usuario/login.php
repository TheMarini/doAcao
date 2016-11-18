<?php
namespace prjDoacao\app\Views\usuario;

use prjDoacao\sys\View as View;
use prjDoacao\app\Views\partials as partials;
/**
 * View class for Login actions on usuario
 */
class login extends View
{
    public function render(){
        $head = new partials\head();
        $head->setTitle('Entrar');
        $head->render();
        parent::render();
    }
}
