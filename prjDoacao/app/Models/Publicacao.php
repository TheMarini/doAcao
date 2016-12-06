<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;
use prjDoacao\sys\session\Session;

/**
 * Publicacao model class
 */
class Publicacao extends Model
{
    public $data;
    public $usuario;
    public $tipo;
    public $conteudo;
    
    function __construct($_data = NULL, $_cd_usuario = NULL){
        parent::__construct();
        if(!(is_null($_data) && is_null($_cd_usuario))){
            $comand = "SELECT * FROM publicacao WHERE dt_publicacao = $_data AND cd_usuario = $_cd_usuario";
            $result = $this->db->query($comand);
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $this->data = $row[0];
                    $this->usuario = (new Usuario)->getById($row[1]);
                    $this->tipo = $row[2];
                    $this->conteudo = $row[3];
                }
            }
        }
    }
    
    public function Consultar($_cd_usuario = null){
        $comand = "SELECT * FROM publicacao ";
        
        if(!is_null($_cd_usuario)){
            $comand .= "WHERE cd_usuario = $_cd_usuario";
        }
        
        $result = $this->db->query($comand);
        $publicacoesList = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_array()){
                $publicacao = new Publicacao();
                $publicacao->data = $row[0];
                $publicacao->usuario = (new Usuario)->getById($row[1]);
                $publicacao->tipo = $row[2];
                $publicacao->conteudo = $row[3];
                $publicacoesList[] = $publicacao;
            }
        }
        return $publicacoesList;
    }

    public function Salvar(){
        $cd_user = $this->usuario->codigo;
        $comand = "INSER INTO publicacao VALUES(now(), $cd_user, $cd_user, $this->tipo, $this->conteudo)";

        $this->db->query($comand);
    }
    
}