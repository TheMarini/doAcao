<?php
namespace prjDoacao\app\Views\index;

use prjDoacao\sys\View as View;
use prjDoacao\app\Views\partials as partials;

/**
 * Index Doador view
 */
class indexDoador extends View
{
   public function render()
   {
       $head = new partials\head();
       $head->setIncludeCss('css/index.css');
       $head->setIncludeCss('css/feed-widget.css');
       $head->setIncludeCss('css/ranking-widget.css');
       $head->setIncludeScript('js/indexDoador.js');
       $head->setIncludeScript('js/feed.js');
       $head->render();
       $nav = new partials\nav();
       $nav->render();
       parent::render();
       (new partials\footer)->render();
   }
   
}
