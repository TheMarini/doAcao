<?php
namespace prjDoacao\sys;

use prjDoacao\sys\http as http;

/**
 * Controller base class
 */
class Controller
{
    protected $request;

    function __construct()
    {
        $this->request = new http\Request();
    }

    public function indexAction(){
        
    } 

    public function notFoundAction(){
        (new Router)->routeToController('erro404Controller');
    } 
}
