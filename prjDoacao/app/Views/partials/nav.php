<?php
namespace prjDoacao\app\Views\partials;

use prjDoacao\sys\View as View;
use prjDoacao\sys\session\Session as Session;

/**
 * partial header view
 */
class nav extends View
{
     public function render()
    {
        //links
        $this->data['%perfil%'] = BASE_URL . "usuario/perfil";
        $this->data['%index%'] = BASE_URL;
        $this->data['%mercadorias%'] = BASE_URL . "mercadoria";
        $this->data['%logout%'] = BASE_URL . "usuario/logout";
        $this->data['%usuario_logado%'] = Session::getSession('userid')->nome;
        $this->data['%usuario_photo%'] = BASE_URL . Session::getSession('userid')->getPhoto();
        parent::render();
    }
}
