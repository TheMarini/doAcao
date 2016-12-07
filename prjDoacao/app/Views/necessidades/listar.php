<?php
namespace prjDoacao\app\Views\necessidades;

use prjDoacao\sys\View;
use prjDoacao\sys\session\Session;
use prjDoacao\app\Views\partials as partials;
use prjDoacao\app\Models\Match;

/**
 * All itens view
 */
class listar extends View
{
    public function render()
    {
        if(sizeof($this->model) > 0){
            echo json_encode($this->model);
        }else{
            echo "Nenhuma necessidade";
        }
    }
}
