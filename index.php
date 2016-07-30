<?php 
//Arquivo responsável por montar a página de exibição ao cliente utilizando os modelos presentes na pasta views 

/* -- includes -- */

require_once './controllers/common.php';

/* -- Trocador de página -- */

$url = isset($_GET['pag'])?htmlspecialchars($_GET['pag']):null;
$id = isset($_GET['id'])?htmlspecialchars($_GET['id']):null;

if(!(is_null($url) || empty($url))){
    if(file_exists("./views/$url.php") && !($url == 'footer') && !($url == 'header')){
        include "./views/$url.php";
    }else{
        include "./views/erro404.php";
    }
}else{
    include "./views/index.php";
}


    
?>