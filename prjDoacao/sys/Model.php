<?php
namespace prjDoacao\sys;

use \mysqli as mysqli; 

/**
 * Model base 
 */
class Model
{
    protected $db;
    private $servidor = "doacao.c6cugaa9w1j5.us-west-2.rds.amazonaws.com";
    private $usuario = "doacao";
    private $senha = "doacao3024";
    private $database = "doAcao";

    function __construct() {
        $this->db = new mysqli($this->servidor, $this->usuario, $this->senha, $this->database, "3306");
    }
    
}

?>
