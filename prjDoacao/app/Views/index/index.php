<?php
namespace prjDoacao\app\Views\index;

use prjDoacao\sys\View as View;
use prjDoacao\app\Views\partials as partials;

/**
 * Index view
 */
class index extends View
{
   public function render()
   {
       (new partials\head)->render();
       parent::render();
   }
   
}
