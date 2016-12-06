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

    function __construct($codigo = null){
        parent::__construct();
        if(!is_null($codigo)){
            $comand = "SELECT * FROM doacao d join mercadoria m on (d.cd_mercadoria_doacao = m.cd_mercadoria) WHERE cd_doacao = $codigo";
            $result = $this->db->query($comand);

            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $this->codigo = $row[0];
                    $this->dataTermino = $row[2];
                    $this->codigoValidar = $row[3];
                    $this->quantDoacao = $row[4];
                    $this->pontos = $row[5];
                    $this->mercadoria = new Mercadoria($row[6]);
                    $this->necessidade = new Necessidade($row[7], $row[8], $row[9]);
                    $this->status = $row[2] == null? 1:2;
                    $this->anonima = $row[10];
                }
            }
        }
    }

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
        //PEGAR PONTOS
        $comand = "SELECT qt_pontos from unidade_tipo_mercadoria WHERE cd_tipo_mercadoria = $cd_tipo_mercadoria AND sg_unidade = '$cd_unidade'";
        
        $result = $this->db->query($comand)->fetch_object();

        $comand = "INSERT INTO doacao VALUES(NULL, now(), NULL, NULL, $this->quantDoacao, $result->qt_pontos, $cd_mercadoria, $usuario ,$cd_tipo_mercadoria, '$cd_unidade', $this->anonima)";
        //var_dump($comand);
        if($result = $this->db->query($comand)){

            $result = $this->db->query("UPDATE mercadoria SET qt_mercadoria = $quantidade - 1 WHERE cd_mercadoria = $cd_mercadoria");
            return $result === true;
        }
        
        return false;
    }

    public function Encerrar(){
        $comand = "UPDATE doacao SET dt_termino_doacao = now() WHERE cd_doacao = $this->codigo";

        if($this->db->query($comand)){
            //NOTIFICAR USUARIO
            if(Session::getSession('userid')->tipo == $this->mercadoria->usuario->tipo){
                $cd_user_notify = $this->necessidade->usuario->codigo;
                $cd_nome_doacao = $this->mercadoria->nome;
                $comand = "INSERT INTO notificacao VALUES(now(), $cd_user_notify, 1, 'Doação Cancelada', 'A doação $cd_nome_doacao foi cancelada pelo doador', '".BASE_URL."doacoes/item/$this->codigo')";
            }else{
                $cd_user_notify = $this->mercadoria->usuario->codigo;
                $cd_nome_doacao = $this->mercadoria->nome;
                $comand = "INSERT INTO notificacao VALUES(now(), $cd_user_notify, 1, 'Doação Finalizada', 'A doação $cd_nome_doacao foi cancelada pela instituição', '".BASE_URL."doacoes/item/$this->codigo')";
            }

            $this->db->query($comand);

            return true;
        }

        return false;
    }

}
