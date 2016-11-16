<?php
namespace prjDoacao\app\Views\partials;

use prjDoacao\sys\View as View;

/**
 * partial header when Logged view
 */
class headerLogged extends View
{
    public function render($value='')
    {
        $this->setTemplate('head');
        $this->concatenateTemplate('headerLogged');
        parent::render();
    }
}
