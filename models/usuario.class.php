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
     	function __construct($_email, $_nome = 'Gerson', $_senha = 'ger1234', $_tipo = 0, $_cpf = '05472491552', $_cnpj = '67235103519252', $_cep = '88025000', $_numero_endereco = '528', $_telefone = '66792253', $_facebook = 'fb.com/larmcegas', $_twitter = '@mocascegas', $_instagram = '@mocascegas', $_permalink = 'po87', $_biografia = 'Uma ONG', $_participaranking = false ){
			
			$this -> email = $_email;
			$this -> nome = $_nome;
			$this -> senha = $_senha;
			$this -> tipo = $_tipo;
			$this -> cpf = $_cpf;
			$this -> cnpj = $_cnpj;
			$this -> cep = $_cep;
			$this -> numero_endereco = $_numero_endereco;
			$this -> telefone = $_telefone;
			$this -> facebook = $_facebook;
			$this -> twitter = $_twitter;
			$this -> instagram = $_instagram;
			$this -> permalink = $_permalink;
			$this -> biografia = $_biografia;
			$this -> participaranking = $_participaranking;
		}
        
        /* PRINCIPAIS FUNÇÕES */
        
		function consultar($termo){
			$com = "SELECT nm_usuario, cd_email_usuario FROM usuario ";
			
			if (strstr($termo, "@")){
				$com .= "WHERE cd_email_usuario LIKE '%$termo%' ORDER BY cd_email_usuario"; 
				
				return mysqli_query(get_conexao(), $com);
			}
			
			else{	
				$com .= "WHERE nm_usuario LIKE '%$termo%' ORDER BY cd_tipo_usuario"; 
				
				return mysqli_query(get_conexao(), $com);				
			}
			
			
        }
        
        function salvar($_email, $_nome, $_senha, $_tipo, $_cpf, $_cnpj, $_cep, $_numero_endereco, $_telefone, $_facebook, $_twitter, $_instagram, $_permalink, $_biografia, $_participaranking){
			
			$com = "SELECT * FROM usuario WHERE cd_email_usuario = '$termo'";
			
			$query = mysqli_query(get_conexao(), $com);
			
			if (mysqli_num_rows($query) > 0)
			{
				return "Usuário já existe";
			}
			
			else	
			{
				$com = "INSERT INTO usuario VALUES('$_email', '$nome', md5('$_senha'), $_tipo, '$_cpf', '$_cnpj', $_cep, '$_numero_endereco', $_telefone, '$_facebook', '$_twitter', '$_instagram', '$_permalink', '$_biografia', $_participaranking)";
				
				$query = mysqli_query(get_conexao(), $com);
				
				return "Usuário salvo com Sucesso";
				
			}
            
        }
        
        function update(){
            /* - atualizar dados do usuário - */
        }
        
        static function deletar($email){
            
				$com = "DELETE FROM usuario WHERE cd_email_usuario='$email'";

				$query = mysql_query($com);
				
				return "Usuário Excluído com Sucesso";			
			
        }
        
        /* FUNÇÕES NECESSÁRIAS */
        
		static function checklogin($_email, $_senha){
            $com = "SELECT * FROM usuario WHERE cd_email_usuario = '$_email' AND cd_senha_usuario = md5('$_senha');";
            
            $query = mysqli_query(get_conexao(), $com);
            
            if(mysqli_num_rows($query) > 0){
                return $_email;
            }else{
                return false;
            }
            
            mysqli_close($conexao);
			
		}
        
    }
?>