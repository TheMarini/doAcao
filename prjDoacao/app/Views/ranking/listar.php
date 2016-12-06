<?php
namespace prjDoacao\app\Views\ranking;

use prjDoacao\sys\View;
use prjDoacao\app\Views\partials as partials;

/**
 * Show ranking
 */
class listar extends View
{
    public function render(){
        if(sizeof($this->model) > 0){
            $rankingList = [];
            foreach($this->model as $ranking){
                $rankingObj["pontos"] = $ranking->quantPontos;
                $rankingObj["nome"] = $ranking->usuario->nome;
                $rankingObj["photo"] = $ranking->usuario->getPhoto();
                $rankingList[] = $rankingObj;
            }
            echo json_encode($rankingList);
        }
    }
}
