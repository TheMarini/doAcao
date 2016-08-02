<?php get_header(); ?>
    <h1>Login</h1>
        <form action="index.php?pag=login" method="post">
            <label>Email
                <input type="text" placeholder="Digite seu email" name="useremail">
            </label></br>
            <label>Senha
            <input type="password" name="userpass">
            </label></br>
            <input type="submit">
        </form>
        
<?php get_footer(); ?>