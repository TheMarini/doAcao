<?php get_header();

    if(is_logged()){
        header('Location: index.php');
        return;
    }

    $registroResult = registrar();

    //Caso não for nulo e o registro ocorrer bem
    if(!is_null($registroResult)){
        if(is_bool($registroResult) && $registroResult){
            header('Location: index.php');
        }
    }
 ?>
<h1>Registrar-se</h1>
<form id="frmUserCad" method="POST">
    <label for="txtNmUser">Nome:</label><br>
    <input id="txtNmUser" name="username" type="text"><br>
    <label for="txtCdEmail">Email:</label><br>
    <input id="txtCdEmail" name="useremail" type="text"><br>
    <label for="txtCdSenha">Senha:</label><br>
    <input id="txtCdSenha" name="userpass" type="password"><br>
    <label for="slcTipo">Tipo de usuário:</label><br>
    <select id="slcTipo" name="usertipo">
        <option value="1">Instituição</option>
        <option value="2">Doador</option>
    </select><br><br>
    <input type="submit" name="btnSend" value="Registrar">
    <h5 style="color:red;"><?php echo $registroResult; ?></h5>
</form>
<?php get_footer(); ?>