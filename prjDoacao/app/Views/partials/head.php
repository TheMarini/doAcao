<?php
namespace prjDoacao\app\Views\partials;

use prjDoacao\sys\View as View;

/**
 * partial head view
 */
class head extends View
{
    private $includeCss = "";
    private $includeScript = "";
    private $pageTitle = "doAcao";

    public function setIncludeCss($url, $mediatype = 'all'){
        $this->includeCss .= '<link href="'. BASE_URL . TEMPLATE_PATH_INV . $url .'" type="text/css" rel="stylesheet" media="'.$mediatype.'">' . PHP_EOL;
    }

    public function setIncludeScript($url){
        $this->includeScript .= '<script src="'. BASE_URL . TEMPLATE_PATH_INV . $url.'"></script>'. PHP_EOL;
    }

    public function setTitle($title){
        $this->pageTitle = $title . " - doAcao";
    }

    public function render(){
        $this->data["%include_css%"] = $this->includeCss;
        $this->data["%include_script%"] = $this->includeScript;
        $this->data["%page_title%"] = $this->pageTitle;
        parent::render();
    }
    
}
