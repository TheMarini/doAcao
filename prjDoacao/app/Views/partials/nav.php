<?php
namespace prjDoacao\app\Views\partials;

use prjDoacao\sys\View as View;

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
        $this->data['%logout%'] = BASE_URL . "usuario/logout";
        parent::render();
    }
}
