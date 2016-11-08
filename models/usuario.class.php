<?php
    require_once './models/common.php';
    
    class user{
        
		private $codigo;
        private $nome;
		private $email;
		private $tipo;
		private $cpf;	
		private $cnpj;
		private $cep;
		private $numero_endereco;
		private $telefone;
		private $facebook;
		private $twitter;
		private $instagram;
		private $biografia;
		private $participaranking;
        
        /* ENCAPSULAMENTO */
        
        function __set($atrib, $value){
            $this->$atrib = $value;
        }
        
        function __get($atrib){
            return $this->$atrib;            
        }
		
        /* CONSTRUTOR */
     	function __construct($_codigo = null, $_email = "", $_nome = "", $_tipo = 1, $_cpf = "", $_cnpj = "", $_cep = "", $_numero_endereco = "", $_telefone = "", $_facebook = "", $_twitter = "", $_instagram = "", $_biografia = "", $_participaranking = false ){
			
			$this->codigo = $_codigo;
			$this->nome = $_nome;
			$this->email = $_email;
			$this->tipo = $_tipo;
			$this->cpf = $_cpf;
			$this->cnpj = $_cnpj;
			$this->cep = $_cep;
			$this->numero_endereco = $_numero_endereco;
			$this->telefone = $_telefone;
			$this->facebook = $_facebook;
			$this->twitter = $_twitter;
			$this->instagram = $_instagram;
			$this->biografia = $_biografia;
			$this->participaranking = $_participaranking;
		}
        
        /* PRINCIPAIS FUNÇÕES */
        
		static function Consultar($termo = ""){
			$com = "SELECT * FROM usuario ";
			
			if (strstr($termo, "@")){//Por email
				$com .= "WHERE cd_email_usuario LIKE '%$termo%' ORDER BY cd_email_usuario"; 
			}
			else{//Por nome de usuário	
				$com .= "WHERE nm_usuario LIKE '%$termo%' ORDER BY cd_tipo_usuario"; 			
			}
				
			$result = mysqli_query(get_conexao(), $com);

			$listUsers = array();

			while($row = mysqli_fetch_array($result)){
				$listUsers[] = new user($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], $row[14]);
			}

			return $listUsers;
        }
        
        public function Salvar($_senha){
			
			$com = "SELECT * FROM usuario WHERE cd_email_usuario = '$this->email'";
			
			$query = mysqli_query(get_conexao(), $com);
			
			if (mysqli_num_rows($query) > 0)
			{
				return false;
			}
			
			else	
			{
				$com = "INSERT INTO usuario VALUES('$this->email', '$this->nome', md5('$_senha'), $this->tipo, '$this->cpf', '$this->cnpj', $this->cep, '$this->numero_endereco', $this->telefone, '$this->facebook', '$this->twitter', '$this->instagram', '$_permalink', '$_biografia', $_participaranking)";
				
				$query = mysqli_query(get_conexao(), $com);
				
				return true;
			}
        }
        
        function Atualizar($_email, $_nome, $_senha, $_cep, $_numero_endereco, $_telefone, $_facebook, $_twitter, $_instagram, $_biografia){ 
					$com = "UPDATE usuario SET nm_usuario = '$_nome', cd_senha_usuario = md5('$_senha'), cd_cep = $_cep, cd_nr_endereco_usuario = '$_numero_endereco', cd_telefone_usaurio = $_telefone, cd_url_facebook = '$_facebook', cd_url_twitter = '$_twitter', cd_url_instagram = '$_instagram', ds_bio_usuario = '$_biografia' WHERE cd_email_usuario = '$_email'";
					
					$query = mysqli_query(get_conexao(), $com);
					
					return "Usuário Atualizado com Sucesso";
					
        }
        
        static function Excluir($email){
            
				$com = "DELETE FROM usuario WHERE cd_email_usuario='$email'";

				$query = mysqli_query(get_conexao(), $com);
				
				return "Usuário Excluído com Sucesso";			
			
        }
        
        /* FUNÇÕES NECESSÁRIAS */
        
		static function Login($_email, $_senha){
            $com = "SELECT * FROM usuario WHERE cd_email_usuario = '$_email' AND cd_senha_usuario = md5('$_senha');";
            
            $query = mysqli_query(get_conexao(), $com);
            
			$usuario_atual = new user();

			while($row = mysqli_fetch_array($query)){
				$usuario_atual->codigo = $row[0];
				$usuario_atual->nome = $row[1];
				$usuario_atual->email = $row[2];
				$usuario_atual->email = $row[3];
			}

            if(mysqli_num_rows($query) > 0){
                return $usuario_atual;
            }else{
                return false;
            }
            
            mysqli_close($conexao);
			
		}
        
    }
?>