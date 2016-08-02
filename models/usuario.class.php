<?php
    require_once './models/common.php';
    
    class user{
        
		
        private $email;
        private $nome;
        private $senha;
		private $tipo;
		private $cpf;	
		private $_cnpj;
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
     	function __construct($_email, $_nome, $_senha, $_tipo, $_cpf, $_cnpj, $_cep, $_numero_endereco, $_telefone, $_facebook, $_twitter, $_instagram, $_permalink, $_biografia, $_participaranking ){
			
			$this -> $email = $_email;
			$this -> $nome = $_nome;
			$this -> $senha = $_senha;
			$this -> $tipo = $_tipo;
			$this -> $cpf = $_cpf;
			$this -> $cnpj = $_cnpj;
			$this -> $cep = $_cep;
			$this -> $numero_endereco = $_numero_endereco;
			$this -> $telefone = $_telefone;
			$this -> $facebook = $_facebook;
			$this -> $twitter = $_twitter;
			$this -> $instagram = $_instagram;
			$this -> $permalink = $_permalink;
			$this -> $biografia = $_biografia;
			$this -> $participaranking = $_participaranking;
		}
        
        /* PRINCIPAIS FUNÇÕES */
        static function consultar($termo, $tipo){
            
        }
        
        function salvar(){
            /* - salvar novo usuário -*/ 
        }
        
        function update(){
            /* - atualizar dados do usuário - */
        }
        
        static function deletar($email){
            /* - apagar usuário - */
        }
        
        /* FUNÇÕES NECESSÁRIAS */
        
		static function login($_email, $_senha){
            $comm = "SELECT * FROM usuario WHERE cd_email_usuario = '$_email' AND cd_senha_usuario = md5('$_senha');";
            
            $result = mysqli_query($com);
            
            if(mysqli_num_rows($result) > 0){
                return $_email;
            }else{
                return false;
            }
			
		}
        
    }
?>