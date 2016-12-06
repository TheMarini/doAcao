<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model as Model;
use prjDoacao\sys\session\Session as Session;

/**
 * Model de usuario
 */
class Cep extends Model
{
    public $cep;
    public $local = "";
    public $bairro = "";
    public $cidade = "";
    public $regiao = "";
    public $estado = "";
    public $siglaEstado = "";

    function __construct($cep) {
        parent::__construct();
        $this->cep = $cep;
        
        $result = $this->db->query("SELECT cd_cep, nm_local, nm_bairro, nm_cidade, nm_regiao, nm_estado, e.sg_estado from estado e JOIN (regiao r JOIN (cidade c JOIN (cep cp JOIN bairro b on (cp.cd_bairro = b.cd_bairro)) on (c.cd_cidade = b.cd_cidade)) on (r.cd_regiao = c.cd_regiao)) on (e.sg_estado = r.sg_estado) WHERE cd_cep = '$cep'");

        $result = $result->fetch_object();

        if(!is_null($result)){
        $this->local = $result->nm_local;
        $this->bairro = $result->nm_bairro;
        $this->cidade = $result->nm_cidade;
        $this->regiao = $result->nm_regiao;
        $this->estado = $result->nm_estado;
        $this->siglaEstado = $result->sg_estado;
        }
    }
}
