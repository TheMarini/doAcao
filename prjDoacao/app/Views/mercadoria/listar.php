<?php
namespace prjDoacao\app\Views\mercadoria;

use prjDoacao\sys\View;
use prjDoacao\sys\session\Session;
use prjDoacao\app\Views\partials as partials;
use prjDoacao\app\Models\Match;

/**
 * All itens view
 */
class listar extends View
{
    public function render(){
        if(sizeof($this->model) > 0){
                $marcadoriaList = [];
                foreach($this->model as $merc){
                    $mercadoria = array();
                    $mercadoria["model"] = $merc;
                    $mercadoria["interessados"] = (new Match)->interessadosMercadoria($merc->codigo);
                    $mercadoriaList[] = $mercadoria;
                }
                echo json_encode($mercadoriaList);
        }else{
            echo "<p>Você ainda não possui itens!<br> Cliquem em \"adicionar item\" para começar.</p>";
        }
    }
}
