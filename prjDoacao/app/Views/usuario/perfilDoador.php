<?php
namespace prjDoacao\app\Views\usuario;

use prjDoacao\sys\View;
use prjDoacao\app\Views\partials as partials;

/**
 * Show Perfil of request user
 */
class perfilDoador extends View
{
    public function render()
    {
        $head = new partials\head();
        $head->setIncludeCss('css/perfil.css');
        $head->setTitle($this->model->nome);
        $head->render();
        $nav = new partials\nav();
        $nav->render();

        $this->data['%nome_usuario%'] = $this->model->nome;
        $this->data['%usuario_photo%'] = BASE_URL . $this->model->getPhoto();

        parent::render();
    }
}