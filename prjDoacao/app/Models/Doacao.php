<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;
use prjDoacao\sys\session\Session;
use prjDoacao\app\Models\Necessidade;

/**
 * Mercadoria model class
 */
class Doacao extends Model
{
    public $codigo;
    public $dataInicio;
    public $dataTermino;
    public $codigoValidar;
    public $pontos;
    public $mercadoria;
    public $necessidade;
    public $status; // 1 = pendente | 2 = finalizada
    public $anonima = false;

    public function Listar($status = null)
    {
        $comand = "SELECT * FROM doacao";
        if(Session::getSession('userid')->tipo != 2)
            $comand .= " d join mercadoria m on (d.cd_mercadoria_doacao = m.cd_mercadoria) WHERE m.cd_usuario = " . Session::getSession('userid')->codigo;
        else{
            $comand .= " WHERE cd_usuario = ". Session::getSession('userid')->codigo;   
        }

        if($status == 1){
            $comand .= " AND dt_termino_doacao IS NULL";
        }
        if($status == 2){
            $comand .= " AND dt_termino_doacao <> NULL";
        }

        $result = $this->db->query($comand);

        $listDoacao = [];

        if($result){
            while($row = $result->fetch_array()){
                $doacao = new Doacao();
                $doacao->codigo = $row[0];
                $doacao->dataInicio = $row[1];
                $doacao->dataTermino = $row[2];
                $doacao->codigoValidar = $row[3];
                $doacao->pontos = $row[4];
                $doacao->mercadoria = new Mercadoria($row[5]);
                $doacao->necessidade = new Necessidade($row[6], $row[7], $row[8]);
                $doacao->status = $row[2] == null? 1:2;
                $doacao->anonima = $row[9];
                $listDoacao[] = $doacao;
            }
            return $listDoacao;
        }
        return false;
    }
}