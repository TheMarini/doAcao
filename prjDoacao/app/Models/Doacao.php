<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;
use prjDoacao\sys\session\Session;

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

    public function Listar($usuario = null, $afterCode = null ,$status = null)
    {
        $comand = "SELECT * FROM doacao";

        if(!is_null($usuario) || !is_null($afterCode) || !is_null($status)){
            $comand .= " WHERE";
        }

        if(!is_null($usuario)){
            $comand .= " "
        }

    }
}