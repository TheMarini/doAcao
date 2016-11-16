<?php
namespace prjDoacao\sys;

/**
 * Model base 
 */
class Model
{
    private $db;

    public function __set($atrib, $value){
        $this->$atrib = $value;
    }
        
    public function __get($atrib){
        return $this->$atrib;            
    }

    public function __construct() {
        $this->db = new mysqli('localhost','root', 'root', 'doacao');
    }
    
}

?>