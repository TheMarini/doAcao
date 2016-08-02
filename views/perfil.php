<?php get_header();   
    if(!(user_atual::is_logged())){
        echo "<h1>Você não está logado!</h1>";
    }else{
?>
<h1>Perfil</h1>
<strong>Nome:</strong>
<strong>Email:</strong>
<strong>Tipo:</strong>
<strong>CPF:</strong>
<strong>CNPJ:</strong>
<strong>CEP:</strong>
<strong>NR:</strong>
<strong>Telefone:</strong>
<strong>Facebook:</strong>
<strong>Twitter:</strong>
<strong>Instagram:</strong>
<strong>Permalink:</strong>
<strong>Bio:</strong>
<strong>Participar do Ranking:</strong>

<form action="<?php user_atual::logout();?>">
    <input type="submit" value="sair">
</form>
<?php } get_footer(); ?>