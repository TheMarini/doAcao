<?php
namespace prjDoacao\sys;

/**
* Make MVC routes
*/
class Router{
    /**
    * @var string Set Controllers name space
    */
    private $controllerNamespace = "prjDoacao\\app\\Controllers\\"; 
    
    /**
    * Make routes
    * @return void
    */
    public function route(){

        $url = '';
        $controller = 'indexController';
        $action = 'indexAction';
        $params = [];
        
        if(isset($_SERVER['PATH_INFO'])){
            $url = filter_var($_SERVER['PATH_INFO'], FILTER_SANITIZE_URL);
            $params = array_values(array_filter(explode('/', $url)));
            $controller = array_shift($params) . 'Controller';
            if(!empty($params)){
                $action = array_shift($params) . 'Action';
            }    
        }
        
        $controller = $this->controllerNamespace . $controller;

        if(!class_exists($controller)){
            $controller = $this->controllerNamespace . 'erro404Controller';
        }

        $controller = new $controller();

        if(!method_exists($controller, $action)){
            $action = "notFoundAction";
        }

        $controller->$action($params);
        
    }

    /**
    * Make route to a respective routeToController
    * @return void
    */
    public function routeToController($controller, $action = 'indexAction', $params = [])
    {
        $controller = $this->controllerNamespace . $controller;

        if(!class_exists($controller)){
            $controller = $this->controllerNamespace . 'erro404Controller';
        }

        $controller = new $controller();

        if(!method_exists($controller, $action)){
            $action = "notFoundAction";
        }

        $controller->$action($params);
    }
}
