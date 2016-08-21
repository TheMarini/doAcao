<?php get_header();   
    if(!(is_logged())){
        echo "<h1>Você não está logado!</h1>";
    }else{
?>
<h1>Perfil</h1>
<?php 
if(user_consultar("esdras")){ while(user_consultar("esdras")){ ?> 
<strong>Nome:<?php echo $user->nome; ?></strong></br>
<strong>Email:<?php echo $user->email; ?></strong></br>
<strong>Tipo:<?php echo $user->tipo; ?></strong></br>
<strong>CPF:<?php echo $user->cpf; ?></strong></br>
<strong>CNPJ:</strong></br>
<strong>CEP:</strong></br>
<strong>NR:</strong></br>
<strong>Telefone:</strong></br>
<strong>Facebook:</strong></br>
<strong>Twitter:</strong></br>
<strong>Instagram:</strong></br>
<strong>Permalink:</strong></br>
<strong>Bio:</strong></br>
<strong>Participar do Ranking:</strong></br>
<span>---------------------------------</span>
<?php }}else{echo "Não retornou users <br>";}?>
<a href="">Sair</a>
<?php } get_footer(); ?>