<?php
namespace prjDoacao\sys;

use \mysqli as mysqli; 

/**
 * Model base 
 */
class Model
{
    public $db;

    function __construct() {
        $this->db = new mysqli("localhost", "root", "root", "doAcao");
    }
    
}


