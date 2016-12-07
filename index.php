<?php 
/**
* PROJETO DOAÇÃO TCC GRUPO 3 - 3N1 - ETEC ARISTÓTELES FERREIRA - 2016
* Authors: Bruno Marini, Bruno Thomaz, Esdras Nani, Luana Reis, Vinícius Teixeira
* GitHub: http://github.com/vinikis/doacao.git
* Description: A project to make more easier the donation process
*/

namespace prjDoacao;

define('APP_PATH', $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . 'prjDoacao' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR);
define('TEMPLATE_PATH', 'prjDoacao' . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR);
define('TEMPLATE_PATH_INV', 'prjDoacao/template/');
define('MEDIA_PATH', 'media' . DIRECTORY_SEPARATOR);
define('MEDIA_PATH_INV', 'media/');
define('ROOT',  $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR);
define('BASE_URL', (strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://').$_SERVER['HTTP_HOST'].'/');


//autoloader
require_once 'autoloader.php';
spl_autoload_register('autoloader');

//start session
\prjDoacao\sys\session\Session::Start();

//make routes
(new \prjDoacao\sys\Router())->route();
