<?php
    require_once './models/common.php';
    
    class mercadoria{
        
        private $cd_mercadoria;
        private $nm_mercadoria;
        private $ds_mercadoria;
        private $qt_mercadoria;
        private $cd_email_usuario;
        private $cd_tipo_mercadoria;
        private $sg_unidade;
        
         function __set($atrib, $value){
            $this->$atrib = $value;
        }
        
        function __get($atrib){
            return $this->$atrib;            
        }
		
        
        function __construct($_cd_merc, $_nm_merc, $_ds_merc, $_qt_merc, $_email_user, $_cd_tipo_merc, $_sg_unit){
            
            $this -> cd_merc = $_cd_merc;
            $this -> nm_merc = $_nm_merc;
            $this -> ds_merc = $_ds_merc;
            $this -> qt_merc = $_qt_merc;
            $this -> email_user = $_email_user;
            $this -> cd_tipo_merc = $_cd_tipo_merc;
            $this -> sg_unit = $_sg_unit;
            
        }
        
        function Salvar($_cd_merc, $_nm_merc , $_ds_merc, $_qt_merc, $_email_user, $_tipo_merc, $_sg_unit){
            
            $com = "INSERT INTO mercadoria VALUES (null, '$_nm_merc', $_ds_merc', $qt_mercadoria, '$_email_user', $cd_tipo_merc, '$_sg_unit')";
            
            $query = mysqli_query(get_conexao(), $com) or die ("Erro ao inserir a Mercadoria");           
            
            return "Mercadoria Cadastrada com Sucesso!";
        }
        
        function Consultar($_email_user){
            
        $com = "SELECT * FROM mercadoria WHERE cd_email_usuario = '$_email_user' ORDER BY";	
				
		$query = mysqli_query(get_conexao(), $com);

		$listUsers = array();

	    while ($row = mysqli_fetch_array($query)){
			$listUsers[] = new user($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
		}

		return $listUsers;
        }
        
        function Atualizar($_cd_merc, $_nm_merc, $_ds_merc, $_email_user){ 
            
            $com = "UPDATE mercadoria SET nm_mercadoria = '$_nm_merc', ds_mercadoria = '$_ds_merc' WHERE cd_mercadoria = $_cd_merc AND cd_email_usuario = '$_email_user'";
            
            $query = mysqli_query(get_conexao(), $com);
            
            return "Mercadoria Atualizada";
        }
        
    }
?>