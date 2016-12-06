<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;
use prjDoacao\sys\session\Session;

/**
 * Ranking model class
 */
class Ranking extends Model
{
    public $usuario;
    public $quantPontos;
    
    function __construct($_codigo = null){
        parent::__construct();
        if(!is_null($_codigo)){
            $comand = "SELECT m.cd_usuario, sum(d.qt_pontos_doacao) FROM doacao d JOIN mercadoria m on(d.cd_mercadoria_doacao = m.cd_mercadoria) GROUP BY m.cd_usuario WHERE m.cd_usuario = $_codigo";
            
            $result = $this->db->query($comand);
            if($result->num_rows > 0){
                $row = $result->fetch_object();
                
                $this->usuario = (new Usuario)->getById($row->cd_usuario);
                $this->quantPontos = $row->qt_pontos_doacao;
            }
        }
    }
    
    public function Listar(){
        $comand = "SELECT m.cd_usuario, sum(d.qt_pontos_doacao) FROM doacao d JOIN mercadoria m on(d.cd_mercadoria_doacao = m.cd_mercadoria) GROUP BY m.cd_usuario";
        
        $result = $this->db->query($comand);
        $listRanking = [];
        while($row = $result->fetch_array()){
            $ranking = new Ranking();
            $ranking->usuario = (new Usuario)->getById($row[0]);
            $ranking->quantPontos = $row[1];
            $listRanking = [];
        }
        return $listRanking;
    }

}
