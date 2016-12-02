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
        //links
        $this->data['%registrar%'] = BASE_URL . "usuario/registrar";

        $head = new partials\head();
        $head->setTitle('Entrar');
        $head->setIncludeCss('css/cadastrar.css');
        $head->render();
        $nav = new partials\nav();
        $nav->render();
        
        parent::render();
    }
}
