<?php
namespace prjDoacao\sys;

/**
 * View base 
 */
class View
{
    public $data;
    protected $templateArchive = "No template";
    protected $model;

    public function __construct ($data = [], $model = null)
    {
        $this->model = $model;
        $this->data = $data;
        $this->data["%TEMPLATE_PATH%"] = BASE_URL . TEMPLATE_PATH_INV;
        $this->setTemplate(substr(get_class($this), strrpos(get_class($this), '\\') +  1));
    }

    public function setTemplate($archive){
        $path = ROOT . TEMPLATE_PATH . $archive . '.html';

        if(file_exists($path)){
            $this->templateArchive = file_get_contents($path);
        }else{
            $this->templateArchive = "Template File Not Found";
        }
    }

    public function concatenateTemplate($archive){
        $this->templateArchive .= file_get_contents(ROOT . TEMPLATE_PATH . $archive . '.html');
    }

    public function render(){
        echo str_replace(array_keys($this->data), array_values($this->data), $this->templateArchive);
    }

}
?>