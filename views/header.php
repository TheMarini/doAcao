<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="<?php path() ?>/css/style.css" rel="stylesheet" type="text/css">
    <script src="<?php path() ?>/js/script.js"></script>
    <title>DoAção - Um novo jeito de doar</title>
</head>
<body>
    <header id="header" >
        <p>Header aqui</p>
        <a href="javascript:void" id="btnEntrar" >Entrar</a>
        <a href="index.php?pag=registrar">Registrar-se</a>
        <form id="loginPopUp" action="index.php?pag=login" method="POST"">
            <label for="txtEmail" >Email:</label><br>
            <input id="txtEmail" name="useremail" type="Text"><br>
            <label for="txtSenha">Senha:</label><br>
            <input id="txtSenha" name="userpass" type="password"><br>
            <input type="submit" value="Entrar">
        </form>
    </header>
