<?php
namespace prjDoacao\app\Views\partials;

use prjDoacao\sys\View as View;

/**
 * partial header view
 */
class headerLogged extends View
{
    public function render()
    {
        $this->setTemplate('header');
        parent::render();
    }
    
}
