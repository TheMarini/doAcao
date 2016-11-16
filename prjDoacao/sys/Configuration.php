<?php
namespace prjDoacao\sys;

/**
 * Configuration class
 */
class Configuration
{
    public $controllerNamespace;

    function __construct($controllerNamespace = "prjDoacao\\app\\Controllers")
    {
        $this->controllerNamespace = $controllerNamespace;
    }
}
