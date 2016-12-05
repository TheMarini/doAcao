<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;
use prjDoacao\app\Models\Mercadoria;

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

    public function listarCombinacoes($_codigoMercadoria){
        $result = $this->db->query("SELECT * from combinacao WHERE cd_mercadoria = $_codigoMercadoria ORDER BY vl_relevancia");
        $listMatch = [];
        if($result){
            while($row = $result->fetch_array()){
                $novamatch = new Match();
                $novamatch->codigoMercadoria = new Mercadoria($row[0]);
                $novamatch->usuarioReceptor = (new Usuario)->getById($row[1]);
                $novamatch->tipo = $row[2];
                $novamatch->unidade = $row[3];
                $novamatch->relevancia = $row[4];
                $listMatch[] = $novamatch;
            }
            return $listMatch;
        }
        return false;
    }
}
