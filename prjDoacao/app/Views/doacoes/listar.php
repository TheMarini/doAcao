<?php 
namespace prjDoacao\app\Views\doacoes;

use prjDoacao\sys\View;

/**
 * Listar itens que correspondem as doações
 */
class listar extends View
{
    public function render(){
        echo json_encode($this->model);
    }
}

