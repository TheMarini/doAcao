<?php get_header(); ?>
<h1>Registrar-se</h1>
<form id="frmUserCad">
    <label for="txtNmUser">Nome:</label><br>
    <input id="txtNmUser" name="username" type="text"><br>
    <label for="txtCdEmail">Email:</label><br>
    <input id="txtCdEmail" name="useremail" type="text"><br>
    <label for="txtCdSenha">Senha:</label><br>
    <input id="txtCdSenha" name="usersenha" type="text"><br>
    <label for="slcTipo">Tipo de usuário:</label><br>
    <select id="slcTipo" name="slcTipo">
        <option value="1">Instituição</option>
        <option value="2">Doador</option>
    </select><br>
    <label for="txtCdCPFCNPJ">CPF/CNPJ:</label><br>
    <input id="txtCdCPFCPNJ" name="usercpfcnpj" type="text"><br>
    
</form>
<?php get_footer(); ?>