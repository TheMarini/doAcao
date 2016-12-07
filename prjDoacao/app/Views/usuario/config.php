<?php
namespace prjDoacao\app\Views\usuario;

use prjDoacao\sys\View;
use prjDoacao\app\Views\partials as partials;

/**
 * Show Perfil of request user
 */
class config extends View
{
    public function render(){
    $head = new partials\head();
    $head->setTitle('Dados de Usuário');
    $head->setIncludeCss('css/config.css');
    $head->render();
    $nav = new partials\nav();
    $nav->render();
    parent::render();
        }
    
}