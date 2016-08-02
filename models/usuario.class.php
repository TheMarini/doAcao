<?php
    require_once './models/common.php';
    
    class user{
        
        private $email;
        private $nome;
        private $senha;
		private $tipo;
		private $cpf;	
		private $cnpj;
		private $cep;
		private $numero_endereco;
		private $telefone;
		private $facebook;
		private $twitter;
		private $instagram;
		private $permalink;
		private $biografia;
		private $participaranking;
        
        /* ENCAPSULAMENTO (vai ser útil dps!) */
        
        function __set($atrib, $value){
            $this->$atrib = $value;
        }
        
        function __get($atrib){
            return $this->$atrib;            
        }
		
        /* CONSTRUTOR */
     	function __construct($email, $tipo, $nome, $senha, etc )
        
        /* PRINCIPAIS FUNÇÕES */
        function static consultar($termo, $tipo){
            /* - consultar usuario - */
        }
        
        function salvar(){
            /* - salvar novo usuário -*/ 
        }
        
        function update(){
            /* - atualizar dados do usuário - */
        }
        
        function static deletar($email){
            /* - apagar usuário - */
        }
        
        /* FUNÇÕES NECESSÁRIAS */
        
		function _user_login ($cd_email_usuario, $cd_senha_usuario){
			$comm = "SELECT * FROM usuario WHERE cd_email_usuario = '$cd_email_usuario' AND cd_senha_usuario = 									 md5('$cd_senha_usuario'))";
			
			$query = mysqli_query($comm);
			
			if ($result = mysqli_fetch_array($query))
				return "Logou";
		}
        
    }
?>