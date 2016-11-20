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

    public function Logout(){
        Session::Close();
    }

	public function Register($senha)
	{
		$emailCorresponds = $this->db->query("SELECT * FROM usuario WHERE cd_email_usuario = '$this->email'");

		if($emailCorresponds->num_rows > 0){
			return 'invalid-email';
		}

		$result	= $this->db->query("INSERT INTO usuario VALUES(NULL,'$this->email', '$this->nome', md5('$_senha'), $this->tipo, '$this->cpf', '$this->cnpj', $this->cep, '$this->numero_endereco', $this->telefone, '$this->facebook', '$this->twitter', '$this->instagram', '$_permalink', '$_biografia', $_participaranking)");

		return (bool)$result;
	}

}
