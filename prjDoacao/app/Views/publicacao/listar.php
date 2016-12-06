<?php 
namespace prjDoacao\app\Views\publicacao;

use prjDoacao\sys\View;

/**
 * Listar itens que correspondem as doações
 */
class listar extends View
{
    public function render(){
        if(sizeof($this->model) > 0){
            $publicacaoList = [];
            foreach($this->model as $publicacao){
                $publicacaoObj["cd_usuario"] = $publicacao->usuario->codigo;
                $publicacaoObj["nm_usuario"] = $publicacao->usuario->nome;
                $publicacaoObj["photo"] = $publicacao->usuario->getPhoto();
                $publicacaoObj["tipo"] = $publicacao->tipo;
                $publicacaoObj["data"] = date('Y-m-d H:i:s');
                $publicacaoObj["conteudo"] = $publicacao->conteudo;
                $publicacaoList[] = $publicacaoObj;
            }
            echo json_encode($publicacaoList);
        }
    }
}