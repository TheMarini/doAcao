<?php
namespace prjDoacao\sys;

/**
 * View base 
 */
class View
{
    public $data;
    protected $templateArchive;

    public function __construct ($data = [])
    {
        $this->data = $data;
        $this->data["%TEMPLATE_PATH%"] = TEMPLATE_PATH;
        $this->setTemplate(substr(get_class($this), strrpos(get_class($this), '\\') +  1));
    }

    public function setTemplate($archive){
        $this->templateArchive = file_get_contents(ROOT . TEMPLATE_PATH . $archive . '.html');
    }

    public function concatenateTemplate($archive){
        $this->templateArchive .= file_get_contents(ROOT . TEMPLATE_PATH . $archive . '.html');
    }

    public function render(){
        echo str_replace(array_keys($this->data), array_values($this->data), $this->templateArchive);
    }

}
?>