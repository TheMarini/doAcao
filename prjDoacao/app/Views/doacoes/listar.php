<?php 
namespace prjDoacao\app\Views\doacoes;

use prjDoacao\sys\View;

/**
 * Listar itens que correspondem as doações
 */
class listar extends View
{
    public function render(){
        if(sizeof($this->model) > 0 ){
            echo json_encode($this->model);
        }else{
            echo "<p>Não consta nenhuma doação em sua conta</p>";
        }
    }
}

