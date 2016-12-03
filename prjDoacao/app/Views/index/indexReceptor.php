<?php
namespace prjDoacao\app\Views\index;

use prjDoacao\sys\View as View;
use prjDoacao\app\Views\partials as partials;

/**
 * Index Receptor view
 */
class indexReceptor extends View
{
   public function render()
   {
       $head = new partials\head();
       $head->setIncludeCss('css/index.css');
       $head->render();
       $nav = new partials\nav();
       $nav->render();
       parent::render();
       (new partials\footer)->render();
   }
   
}
