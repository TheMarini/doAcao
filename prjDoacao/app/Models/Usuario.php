<?php
namespace prjDoacao\app\Models;

use prjDoacao\sys\Model as Model;
use prjDoacao\sys\session\Session as Session;

/**
 * Model de usuario
 */
class Usuario extends Model
{
    public $codigo;
    public $nome;
	public $email;
	public $tipo;
	public $cpf;	
	public $cnpj;
	public $cep;
	public $numero_endereco;
	public $telefone;
	public $facebook;
	public $twitter;
	public $instagram;
	public $biografia;
	public $participaranking;

    /* FUNÇÕES NECESSÁRIAS */
        
	/**
	* Login into system
	* @param $_email - User Email
	* @param $_senha - User Password
	* @return boolean
	*/
	public function Login($_email, $_senha)
    {
        $result = $this->db->query("SELECT * FROM usuario WHERE cd_email_usuario = '$_email' AND cd_senha_usuario = md5('$_senha');");

        if($result->num_rows > 0){
            $usuario_atual = new Usuario();
            while($row = $result->fetch_array()){
		        $usuario_atual->codigo = $row[0];
			    $usuario_atual->nome = $row[1];
			    $usuario_atual->email = $row[2];
			    $usuario_atual->tipo = $row[3];
		    }

            Session::setSession('userid', $usuario_atual);

            return true;
        }

        return false;
	}

	/**
	* Logout system
	* @return void
	*/
    public function Logout(){
        Session::Close();
    }

	/**
	* Register a new user into system
	* @param $senha
	* @return boolean
	*/
	public function Register($senha)
	{
		$emailCorresponds = $this->db->query("SELECT * FROM usuario WHERE cd_email_usuario = '$this->email'");

		if($emailCorresponds->num_rows > 0){
			return 'Email já cadastrado!';
		}

		$cnpj = is_null($this->cnpj)?"NULL": "'" . $this->cnpj . "'"; 

		$result	= $this->db->query("INSERT INTO usuario(nm_usuario, cd_email_usuario, cd_senha_usuario, cd_tipo_usuario, cd_cnpj_usuario) VALUES('$this->nome', '$this->email', md5('$senha'), $this->tipo, $cnpj);");

		return (bool)$result;
	}

	/**
	* Get user by ID
	* @param $senha
	* @return object
	*/
	public function getById($id){
		$result = $this->db->query("SELECT * FROM usuario WHERE cd_email_usuario = $id OR cd_usuario = $id");

		if($result->num_rows == 0){
			return false;
		}

		$row = $result->fetch_array();

		$usuario = new Usuario();
		$usuario->codigo = $row[0];
		$usuario->nome = $row[1];
		$usuario->email = $row[2];
		$usuario->tipo = $row[4];
		$usuario->cpf = $row[5];
		$usuario->cnpj = $row[6];
		$usuario->cep = $row[7];
		$usuario->numero_endereco = $row[8];
		$usuario->telefone = $row[9];
		$usuario->facebook = $row[10];
		$usuario->twitter = $row[11];
		$usuario->instagram = $row[12];
		$usuario->biografia = $row[13];
		$usuario->participaranking = $row[14];

		return $usuario;
	}

}
