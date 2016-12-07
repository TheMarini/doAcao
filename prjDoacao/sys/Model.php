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
        $this->db = new mysqli("doacao.c6cugaa9w1j5.us-west-2.rds.amazonaws.com", "doacao", "doacao3024", "doAcao");
    }
    
}


