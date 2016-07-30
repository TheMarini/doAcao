<?php 
//Arquivo responsável por montar a página de exibição ao cliente utilizando os modelos presentes na pasta views 

/* -- includes -- */

require_once './controllers/common.php';

/* -- Trocador de página -- */

$url = isset($_GET['pag'])?htmlspecialchars($_GET['pag']):null;

if(!(is_null($url) || empty($url))){
    
}else{
    include "./views/index.php";
}


    
?>