<?php
    require_once 'models/common.php';

    class publicacao{

        private $dt_publicacao;
        private $cd_usuario;
        private $cd_tipo_publicacao;
        private $ds_conteudo_publicacao;

         function __set($atrib, $value){
            $this->$atrib = $value;
        }
        
        function __get($atrib){
            return $this->$atrib;            
        }
		
        
        function __construct($_dt_publi, $_cd_user, $_cd_tipo_publi, $_ds_conteudo_publi){
            
            $this -> dt_publi = $_dt_publi;
            $this -> cd_user = $_cd_user;
            $this -> cd_tipo_publi = $_cd_tipo_publi;
            $this -> ds_conteudo_publi = $_ds_conteudo_publi;
            
        }

        function Nova($_cd_user, $cd_tipo_publicacao, $_ds_conteudo_publi){

                $com = "INSERT INTO publicacao VALUES(now(), $_cd_user, $cd_tipo_publicacao, '$_ds_conteudo_publi'";
                
                $query = mysqli_query(get_conexao(), $com) or die ("Erro ao Publicar!");

                return "Pulicado com Sucesso!";
        }

        function Editar($_ds_conteudo_publi, $_dt_publi)
        {
            $com = "UPDATE publicacao SET ds_conteudo_publicacao = $_ds_conteudo_publi WHERE dt_publicacao =  STR_TO_DATE($_dt_publi, '%d, %m, %Y')";

            $query = mysqli_query(get_conexao(), $com) or die ("Erro ao Editar a Publicação");

            return "Publicação Editada comm Sucesso!";
        }

        function Excluir($_dt_publi, $_cd_user)
        {
            $com = "DELETE FROM publicacao WHERE dt_publicacao =  STR_TO_DATE($_dt_publi, '%d, %m, %Y') AND cd_usuario = $_cd_user";

            $query = mysqli_query(get_conexao(), $com) or die ("Erro ao Excluir a Publicação");

            return "Publicação Excluída com Sucesso!";
        }

        function Carrega($_cd_tipo_publi, $_cd_user)
        {
            $com = "SELECT dt_publicacao, ds_conteudo_publicacao WHERE cd_tipo_publicacao = $_cd_tipo_publi AND cd_usuario = $_cd_user";

            $query = mysqli_query(get_conexao(), $com) or die ("Erro ao Carregar as Publicações");

            while ($row = mysqli_fetch_array($query))
                $listPublicacao[] = new publicacao($row[0], $row[1]);
            
            return $listPublicacao;

        }
    }        
?>