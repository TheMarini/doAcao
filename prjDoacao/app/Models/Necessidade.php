<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;
use prjDoacao\sys\session\Session;
use prjDoacao\app\Models\TipoMercadoria;
use prjDoacao\app\Models\Usuario;

/**
 * Mercadoria model class
 */
class Necessidade extends Model
{
    public $usuario;
    public $nome;
    public $quantidade;
    public $tipo;
    public $unidade;

    function __construct($_usuario = null, $_tipo = null, $_unidade = null) 
    {
        parent::__construct();
        if(!is_null($_usuario) && !is_null($_tipo) && !is_null($_unidade)){
            $comand = "SELECT * FROM necessidade WHERE cd_usuario = $_usuario AND cd_tipo_mercadoria = $_tipo AND cd_unidade = $_unidade";
            $result = $this->db->query($comand);

            if($result){
                $row = $result->fetch_array();

                $this->usuario = (new Usuario)->getById($row[0]);
                $this->tipo = $row[1];
                $this->unidade = $row[2];
                $this->nome = $row[3];
                $this->quantidade = $row[4];
            }
        } 
    }

}