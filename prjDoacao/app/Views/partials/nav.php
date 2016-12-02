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
        if(Session::isLogged()){
            //user normal links
            $this->data['%perfil%'] = BASE_URL . "usuario/perfil";
            $this->data['%logout%'] = BASE_URL . "usuario/logout";
            $this->data['%usuario_logado%'] = Session::getSession('userid')->nome;
            $this->data['%usuario_photo%'] = BASE_URL . Session::getSession('userid')->getPhoto();

            //renderiza templates e links diferentes para doador e instituição - tipo 2 == Instituição || tipo 1 == Doador
            if(Session::getSession('userid')->tipo != 2){
                $this->data['%mercadorias%'] = BASE_URL . "mercadoria";
            }else{
                $this->setTemplate('navInst');
            }
        }else{
            $this->setTemplate('navNotLogged');
        }

        //index Link
            $this->data['%index%'] = BASE_URL;
        //login link
            $this->data['%login%'] = BASE_URL . "usuario/login";
        
        parent::render();
    }
}
