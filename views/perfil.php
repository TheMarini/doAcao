<?php get_header();   
    if(!(user_atual::is_logged())){
        echo "<h1>Você não está logado!</h1>";
    }else{
?>
<h1>Perfil</h1>
<strong>Nome:</strong></br>
<strong>Email:</strong></br>
<strong>Tipo:</strong></br>
<strong>CPF:</strong></br>
<strong>CNPJ:</strong></br>
<strong>CEP:</strong></br>
<strong>NR:</strong></br>
<strong>Telefone:</strong></br>
<strong>Facebook:</strong></br>
<strong>Twitter:</strong></br>
<strong>Instagram:</strong></br>
<strong>Permalink:</strong></br>
<strong>Bio:</strong>
<strong>Participar do Ranking:</strong>

<a href="<?php user_atual::logout(); ?>">Sair</a>
<?php } get_footer(); ?>