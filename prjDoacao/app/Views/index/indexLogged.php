<?php
namespace prjDoacao\app\Views\index;

use prjDoacao\sys\View as View;
use prjDoacao\app\Views\partials as partials;

/**
 * Index view
 */
class indexLogged extends View
{
   public function render()
   {
       (new partials\headerLogged)->render();
       parent::render();
       (new partials\footer)->render();
   }
   
}
