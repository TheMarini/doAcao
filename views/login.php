<?php get_header(); ?>
<?php
    $loginstatus = "";
    $loginresult = user_atual::makelogin();
        if(empty($loginresult)){
        if($loginresult){
            header('Location:index.php?pag=perfil');
        }else{
            $loginstatus = "Usuário ou senha inválidos!";
        }
    }

?>
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
        <h5 style="color:red;"><?php echo $loginstatus; ?></h5>
        
<?php get_footer(); ?>