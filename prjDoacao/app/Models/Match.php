<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;

/**
 * Match model class to relate necessidades and mercadoria
 */
class Match extends Model
{
    public $codigoMercadoria;
    public $usuarioReceptor;
    public $tipo;
    public $unidade;
    public $relevancia;

    public function interessadosMercadoria($_codigoMercadoria){
        $result = $this->db->query("SELECT count(cd_mercadoria) from combinacao WHERE cd_mercadoria = $_codigoMercadoria");
        if($result){
            $result = $result->fetch_array()[0];
        }
        return $result;
    }

}