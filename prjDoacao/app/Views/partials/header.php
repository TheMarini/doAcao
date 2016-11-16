<?php
namespace prjDoacao\app\Views\partials;

use prjDoacao\sys\View as View;

/**
 * partial header view
 */
class header extends View
{
    public function render($value='')
    {
        $this->setTemplate('head');
        $this->concatenateTemplate('header');
        parent::render();
    }
}
