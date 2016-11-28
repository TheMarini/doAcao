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
        if(sizeof($this->model) > 0 ){
            foreach($this->model as $mercadoria){
                $this->data['%mercadoria_nome%'] = $mercadoria->nome;
                $this->data['%mercadoria_interessados%'] = (new Match)->interessadosMercadoria($mercadoria->codigo);
                $this->data['%mercadoria_id%'] = $mercadoria->codigo;
                parent::render();
            }
        }else{
            echo "<p>Você ainda não possui itens!<br> Cliquem em \"adicionar item\" para começar.</p>";
        }
    }
}