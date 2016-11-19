<?php
namespace prjDoacao\sys\http;

/**
 * Request class to get header parameters and apply filters
 */
class Request
{
    /**
    *Return method type
    *@param string method - set the expected method
    *@return boolean if the expected is satisfied or not
    *@return string whith value of method
    */
    public function method($method = null){
        if(!is_null($method)){
            return $method == $_SERVER['REQUEST_METHOD'];
        }
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
    *Return get header values
    *@param string arrayIndex - set index of get request
    *@return array with get values
    *@return get value if @param arrayIndex is set
    */
    public function get(string $arrayIndex = null){
        if(isset($_GET)){
            $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
            
            if(!is_null($arrayIndex)){
                return $get[$arrayIndex];
            }

            return $get;
        }
    }
    
    /**
    *Return post header values
    *@param string arrayIndex - set index of post request
    *@return array with post values
    *@return post value if @param arrayIndex is set
    */
    public function post(string $arrayIndex = null)
    {
         if(isset($_POST)){
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            if(!is_null($arrayIndex)){
                return $post[$arrayIndex];
            }

            return $post;
        }
    }

    /**
    *Return if is an ajax request
    */
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])? (strcmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0) : false; 
    }
   
}