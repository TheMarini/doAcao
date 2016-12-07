<?php
/**
*Autoloader to Projeto Doacao TCC
*Load all called classes to scope
*/

function autoloader($class){
    $className = str_replace('\\', DIRECTORY_SEPARATOR, ltrim($class, '\\'));
    $fileName = '';
    $namespace = '';
    
    if($LastNsIndex = strpos($className, '\\')){
        $namespace = substr($className, 0, $LastNsIndex);
        $className = substr($className, $LastNsIndex + 1);
        if($namespace != __NAMESPACE__){
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;        
        }
    }
    
    $fileName .= $className . '.php';

    if(file_exists($fileName)){
        require_once $fileName;
    }
}
