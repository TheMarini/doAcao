<?php
namespace prjDoacao\sys\Session;

/**
 * Session and Cookie treatment
 */
class Session
{
    
    public static function Start()
    {
        session_start();
    }

    public static function isLogged(){
        return isset($_SESSION['userid']);
    }

    public static function Close(){
        session_destroy();
    }

    public static function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function getSession($name)
    {
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }

    public static function cookieHash(){
        if(isset($_SESSION['userid'])){
            $hash = md5($_SESSION['userid']);

            for ($i=0; $i < 100; $i++) { 
                $hash = md5(hash);
            }

            return $hash;
        }
    }
}
