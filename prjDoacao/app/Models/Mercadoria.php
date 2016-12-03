<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;
use prjDoacao\sys\session\Session;

/**
 * Mercadoria model class
 */
class Mercadoria extends Model
{
    public $codigo;
    public $nome;
    public $descricao;
    public $quantidade;
    public $usuario;
    public $tipo;
    public $unidade;
    
    function __construct($_codigo = null)
    {
        parent::__construct();
        if(!is_null($_codigo)){
            $comand = "SELECT * FROM mercadoria WHERE cd_mercadoria = $_codigo";

            $result = $this->db->query($comand);

            if($result){
               $row = $result->fetch_array();

               $this->codigo = $row[0];
               $this->nome = $row[1];
               $this->descricao = $row[2];
               $this->quantidade = $row[3];
               $this->usuario = $row[4];
               $this->tipo = $row[5];
               $this->unidade = $row[6];
            }else{
                return false;
            }    
        }
    }

    /**
    * List all itens
    */
    public function Consultar($_usuario = null, $_termo = null ){
           $com = "SELECT * FROM mercadoria";

           if(!is_null($_usuario) || !is_null($_termo)){
               $com .= " WHERE ";
               if(!is_null($_usuario)){
                   $com .= "cd_usuario = $_usuario ";
               }
               if(!is_null($_termo)){
                   $com .= (!is_null($_usuario))? "AND ":"";
                   $com .="nm_mercadoria like '%$_termo%' ";
               }
           }

           //$com .= "ORDER BY nm_mercadoria";	
       
           $result = $this->db->query($com);

           if($result){
               $listMercadorias = array();

               while ($row = $result->fetch_array()){
                   $mercadoria = new Mercadoria();
                   $mercadoria->codigo = $row[0];
                   $mercadoria->nome = $row[1];
                   $mercadoria->descricao = $row[2];
                   $mercadoria->quantidade = $row[3];
                   $mercadoria->usuario = $row[4];
                   $mercadoria->tipo = $row[5];
                   $mercadoria->unidade = $row[6];

                   $listMercadorias[] = $mercadoria;
               }
               return $listMercadorias;
           }
           
           return false;
    }

    

    /**
    *   Insert new item 
    */
    public function Salvar()
    {
        $comand = "INSERT INTO mercadoria VALUES(NULL, '$this->nome', '$this->descricao', $this->quantidade, $this->usuario, $this->tipo, '$this->unidade')";
        $result = $this->db->query($comand);
        
        if($result){
            return true;
        }

        return false;
    }

    /**
    *   Delete an item
    */
    public function Excluir($_codigo)
    {
        $comand = "DELETE FROM mercadoria WHERE cd_mercadoria='$_codigo'";

        $result = $this->db->query($comand);
        if($result){
            return true;
        }

        return false;
    }

}
