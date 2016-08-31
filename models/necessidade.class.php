<?php
    require_once './models/common.php';
    
    class necessidade{
        
        private $cd_email_user;
        private $cd_tipo_mercadoria;
        private $sg_unidade;
        private $qt_necessidade;
        
        
        function __set($atrib, $value){
            $this->$atrib = $value;
        }
        
        function __get($atrib){
            return $this->$atrib;            
        }
        
        
           
        function __construct($_cd_email_user, $_cd_tipo_merc, $_sg_unidade, $_qt_necessidade){
            
            $this -> cd_email_user = $_cd_email_user;
            $this -> cd_tipo_merc = $_cd_tipo_merc;
            $this -> sg_unidade = $_sg_unidade;
            $this -> qt_necessidade = $_qt_necessidade;
            
        }
        
        function Salvar($_cd_email_user, $_cd_tipo_merc, $_sg_unidade, $_qt_necessidade){
            $com = "INSERT INTO necessidade VALUES('$_cd_email_user', $_cd_tipo_merc, '$_sg_unidade', $_qt_necessidade)";
            
            $query = mysqli_query(get_conexao(), $com);
            
            return "Necessidade Inserida com Sucesso";
        }
        
        function Consultar($_cd_tipo_merc, $_cd_email_user){
            
            $com = "SELECT cd_tipo_mercadoria, sg_unidade, qt_necessidade FROM necessidade WHERE cd_tipo_mercadoria LIKE '%$_cd_tipo_merc%' AND cd_email_usuario = '$_cd_email_user'";
            
            $query = mysqli_query(get_conexao(), $com);
            
            $listNecessidade = array();

            while ($row = mysqli_fetch_array($query)){
                $listNecessidade[] = new user($row[0], $row[1], $row[2]);
            }

            return $listNecessidade;
        }
        
        function Atualizar ($_qt_necessidade, $_cd_email_user, $_cd_tipo_merc){
            
            $com = "UPDATE necessidade SET qt_necessidade = $_qt_necessidade WHERE cd_email_usuario = '$_cd_email_user' AND cd_tipo_mercadoria = $_cd_tipo_merc";
            
            $query = mysqli_query(get_conexao(), $com);
            
            return "Necessidade Atualizada com Sucesso";
        }
        
        function Excluir ($_cd_tipo_merc, $_cd_email_user)
        {
            $com =  "DELETE FROM necessidade WHERE cd_email_usuario = '$_cd_email_user' AND cd_tipo_mercadoria = $_cd_tipo_merc";
            
            $query = mysqli_query(get_conexao(), $com);
            
            return "Necessidade Excluída com Sucesso";
        }
            
        
        
        
    }
?>