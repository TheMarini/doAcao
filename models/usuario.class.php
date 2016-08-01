<?php
    require_once './models/common.php';
    
    class user{
        
        private $cd_email_usuario;
        private $nm_usuario;
        private $cd_senha_usuario;
		private $cd_tipo_usuario;
		private $cd_cpf_usuario;	
		private $cd_cnpj_usuario;
		private $cd_cep;
		private $cd_nr_endereco_usuario;
		private $cd_telefone_usuario;
		private $cd_url_facebook;
		private $cd_url_twitter;
		private $cd_url_instagram;
		private $cd_permalink_usuario;
		private $ds_bio_usuario;
		private $ic_participar_ranking;
		
     	
		function _user_login ($cd_email_usuario, $cd_senha_usuario){
			$comm = "SELECT * FROM usuario WHERE cd_email_usuario = '$cd_email_usuario' AND cd_senha_usuario = 									 md5('$cd_senha_usuario'))";
			
			$query = mysqli_query($comm);
			
			if ($result = mysqli_fetch_array($query))
				return "Logou";
		}
        
    }
?>