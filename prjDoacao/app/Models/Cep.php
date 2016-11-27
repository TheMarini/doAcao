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
    private $local;
    private $bairro;
    private $cidade;
    private $regiao;
    private $estado;

    function __construct($cep) {
        $this->cep = $cep;
        
        $result = $this->db->query("SELECT * FROM cep WHERE cd_cep = '$cep'");
        $result = $result->fetch_object();

        $this->local = $result->nm_local;
        $this->
    }

}