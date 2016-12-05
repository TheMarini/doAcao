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
    public $quantDoacao;
    public $pontos;
    public $mercadoria;
    public $necessidade;
    public $status; // 1 = pendente | 2 = finalizada
    public $anonima = false;

    public function Listar($status = null)
    {
        $comand = "SELECT * FROM doacao d join mercadoria m on (d.cd_mercadoria_doacao = m.cd_mercadoria)";
        if(Session::getSession('userid')->tipo != 2)
            $comand .= " WHERE m.cd_usuario = " . Session::getSession('userid')->codigo;
        else{
            $comand .= " WHERE d.cd_usuario = ". Session::getSession('userid')->codigo;   
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
                $doacao->quantDoacao = $row[4];
                $doacao->pontos = $row[5];
                $doacao->mercadoria = new Mercadoria($row[6]);
                $doacao->necessidade = new Necessidade($row[7], $row[8], $row[9]);
                $doacao->status = $row[2] == null? 1:2;
                $doacao->anonima = $row[10];
                $listDoacao[] = $doacao;
            }
            return $listDoacao;
        }
        return false;
    }

    public function Salvar(){

        $cd_mercadoria = $this->mercadoria->codigo;
        $cd_tipo_mercadoria = $this->mercadoria->tipo;
        $cd_unidade = $this->mercadoria->unidade;
        $quantidade = $this->mercadoria->quantidade;
        $usuario = $this->usuario->codigo;

        $comand = "INSERT INTO doacao VALUES(NULL, now(), NULL, NULL, $this->quantDoacao, NULL, $cd_mercadoria, $usuario ,$cd_tipo_mercadoria, '$cd_unidade', $this->anonima)";
        
        if($result = $this->db->query($comand)){

            $result = $this->db->query("UPDATE mercadoria SET qt_mercadoria = $quantidade - 1 WHERE cd_mercadoria = $cd_mercadoria");
            return $result === true;
        }
        
        return false;
    }

}
