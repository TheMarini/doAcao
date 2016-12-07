<?php
namespace prjDoacao\sys;

use \mysqli as mysqli; 

/**
 * Model base 
 */
class Model
{
    protected $db;
    private $servidor = "localhost";
    private $usuario = "root";
    private $senha = "root";
    private $database = "doAcao";

    function __construct() {
        $this->db = new mysqli($this->servidor, $this->usuario, $this->senha, $this->database, "3306");
    }
    
}


