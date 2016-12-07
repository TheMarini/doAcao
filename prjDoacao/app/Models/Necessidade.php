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
    public $quantCompleta;
    public $tipo;
    public $unidade;

    function __construct($_usuario = null, $_tipo = null, $_unidade = null) 
    {
        parent::__construct();
        if(!(is_null($_usuario) && is_null($_tipo) && is_null($_unidade))){
            $comand = "SELECT n.cd_usuario, n.cd_tipo_mercadoria, n.sg_unidade, n.nm_necessidade, n.qt_necessidade, sum(d.qt_mercadoria_doacao) FROM necessidade n left join doacao d on (d.cd_usuario = n.cd_usuario AND d.cd_tipo_mercadoria = n.cd_tipo_mercadoria AND d.sg_unidade = n.sg_unidade) WHERE n.cd_usuario = $_usuario AND n.cd_tipo_mercadoria = $_tipo AND n.sg_unidade = '$_unidade' GROUP BY n.cd_usuario, n.cd_tipo_mercadoria, n.sg_unidade";
            $result = $this->db->query($comand);

            if($result){
                $row = $result->fetch_array();

                $this->usuario = (new Usuario)->getById($row[0]);
                $this->tipo = $row[1];
                $this->unidade = $row[2];
                $this->nome = $row[3];
                $this->quantidade = $row[4];
                $this->quantCompleta = $row[5];
            }
        } 
    }

    function Consultar($usuario){
        $cSql = "SELECT n.cd_usuario, n.cd_tipo_mercadoria, n.sg_unidade, n.nm_necessidade, n.qt_necessidade, sum(d.qt_mercadoria_doacao) FROM necessidade n left join doacao d on (d.cd_usuario = n.cd_usuario AND d.cd_tipo_mercadoria = n.cd_tipo_mercadoria AND d.sg_unidade = n.sg_unidade) WHERE n.cd_usuario = $usuario GROUP BY n.cd_usuario, n.cd_tipo_mercadoria, n.sg_unidade";

        $result = $this->db->query($cSql);

        $listNecessidades = [];
        if($result){
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $necessidade = new Necessidade();

                    $necessidade->usuario = (new Usuario)->getById($row[0]);
                    $necessidade->tipo = $row[1];
                    $necessidade->unidade = $row[2];
                    $necessidade->nome = $row[3];
                    $necessidade->quantidade = $row[4];
                    $necessidade->quantCompleta = ($row[5] == null)? 0 : $row[5];
                    $listNecessidades[] = $necessidade;
                }
                return $listNecessidades;
            }
        }
        return false;
    }

    function Salvar(){
        $cdusuario = Session::getSession('userid')->codigo;
        $cSql = "INSERT INTO necessidade VALUES($cdusuario, $this->tipo, '$this->unidade', '$this->nome', '$this->quantidade')";
        
        $this->db->query('DELETE FROM combinacao');
        $result = $this->db->query($cSql);
        
        return $result === true;
    }

    function Editar(){
        $cSql = "UPDATE necessidade SET qt_necessidade";
    }

}
