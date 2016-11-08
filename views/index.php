<?php get_header(); 
    if(is_logged()){
?>
<div class="clearfix">
    <section id="feed">
        <h1>FEED</h1>
    </section>
    <aside id="feedSidebar">
        <div id="feedDoacao" class="feedSideWidget">
            <h2>DOACAO</h2>
        </div>
        <div id="feedMercadoria" class="feedSideWidget">
            <h2>MERCADORIA</h2>
        </div>
        <div id="feedRanking" class="feedSideWidget">
            <h2>RANKING</h2>
        </div>
    </aside>
</div>
<?php }else{ 
?>
    <h1>Bem vindo ao DoAção pré pré beta</h1>
    <h2><a href="index.php?pag=login"> Fazer Login </a></h2>
    <h2><a href="index.php?pag=registrar"> Cadastrar-se </a></h2>
<?php
} get_footer(); ?>