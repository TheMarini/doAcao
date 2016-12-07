<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model;
use prjDoacao\sys\session\Session;
use prjDoacao\app\Models\Usuario;

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
               $this->usuario = (new Usuario)->getById($row[4]);
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
           $com = "SELECT * FROM mercadoria WHERE qt_mercadoria <> 0";

           if(!is_null($_usuario)){
               $com .= " AND cd_usuario = $_usuario ";
           }
           if(!is_null($_termo)){
               $com .=" AND nm_mercadoria like '%$_termo%' ";
           }
       
           $result = $this->db->query($com);

           if($result){
               $listMercadorias = [];

               while ($row = $result->fetch_array()){
                   $mercadoria = new Mercadoria();
                   $mercadoria->codigo = $row[0];
                   $mercadoria->nome = $row[1];
                   $mercadoria->descricao = $row[2];
                   $mercadoria->quantidade = $row[3];
                   $mercadoria->usuario = (new Usuario)->getById($row[4]);
                   $mercadoria->tipo = $row[5];
                   $mercadoria->unidade = $row[6];

                   $listMercadorias[] = $mercadoria;
               }

               return $listMercadorias;
           }

    }

    /**
    *   Insert new item 
    */
    public function Salvar()
    {
        $cd_usuario = $this->usuario->codigo;

        $comand = "INSERT INTO mercadoria VALUES(NULL, '$this->nome', '$this->descricao', $this->quantidade, $cd_usuario, $this->tipo, '$this->unidade')";
        
        $this->db->query("DELETE FROM combinacao");

        $result = $this->db->query($comand);
        if($result){
            return true;
        }

        return false;
    }

    public function Editar(){
        $comand = "SELECT * FROM doacao WHERE cd_mercadoria = $this->codigo";
        $result = $this->db->query('$comand');

        if($result->num_rows > 0 ){
            return "Está mercadoria não pode ser editada porque faz parte de uma doação!";
        }
        //DELETAR MATCHES
        $this->db->query("DELETE FROM combinacao");
        // FALTA FAZER
        //$comand = "UPDATE mercadoria SET "
    }

    /**
    *   Delete an item
    */
    public function Excluir($_codigo)
    {
        //VERIFY EXISTENCE
        $comand = "SELECT * FROM doacao WHERE cd_mercadoria = $this->codigo";
        $result = $this->db->query('$comand');

        if($result->num_rows > 0 ){
            return "Está mercadoria não pode ser editada porque faz parte de uma doação!";
        }
        //DELETAR MATCHES
        $this->db->query("DELETE FROM combinacao");
        //DELETE OPERATION
        $comand = "DELETE FROM mercadoria WHERE cd_mercadoria='$_codigo'";

        $result = $this->db->query($comand);
        if($result){
            return true;
        }

        return false;
    }

}
