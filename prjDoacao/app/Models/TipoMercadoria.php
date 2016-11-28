<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;

/**
 * Match model class to relate necessidades and mercadoria
 */
class TipoMercadoria extends Model
{
    public $codigo;
    public $nome;
    public $unidades = [];

    public function Consultar($_termo = null){
        $com = "SELECT * FROM tipo_mercadoria";

        if(!is_null($_termo)){
            $com .= " WHERE nm_tipo_mercadoria like '%$_termo%'";
        }

        $com .= " ORDER BY nm_tipo_mercadoria";

        $result = $this->db->query($com);
        if($result){
            $listTipos = array();
            while($row = $result->fetch_array()){
                $tipomercadoria = new TipoMercadoria();
                $tipomercadoria->codigo = $row[0];
                $tipomercadoria->nome = $row[1];
                $tipomercadoria->loadUnidades();
                $listTipos[] = $tipomercadoria;
            }
            return $listTipos;
        }

        return false;
    }

    private function loadUnidades(){
        $com = "SELECT sg_unidade FROM unidade_tipo_mercadoria WHERE cd_tipo_mercadoria = $this->codigo;";

        $result = $this->db->query($com);
        if($result){
            while($row = $result->fetch_array()){
                $this->unidades[] = $row[0];
            }
        }
    }

}