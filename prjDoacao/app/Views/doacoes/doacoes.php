<?php 
namespace prjDoacao\app\Views\doacoes;

use prjDoacao\sys\View;
use prjDoacao\app\Views\partials as partials;
use prjDoacao\sys\session\Session;

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
        if(Session::getSession('userid')->tipo == 2){
            $this->setTemplate('doacoesReceptor');
            $head->setIncludeScript('js/doacoesReceptor.js');
        }else{
            $head->setIncludeScript('js/doacoes.js');
        }
        $head->render();
        $nav = new partials\nav();
        $nav->render();
        
        parent::render();    
    }
    
}

