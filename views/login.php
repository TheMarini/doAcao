<?php get_header(); ?>
<?php
if(isset($_REQUEST['logoff'])){
    logout();    
}
    $loginMessage = "";
    $loginresult = login();
    
    if(!is_null($loginresult)){
        if($loginresult){
            header('Location: index.php');
        }else{
            $loginMessage = "Usuário ou senha inválidos!";
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
            <input type="submit" value="Entrar">
        </form>
        <h5 style="color:red;"><?php echo $loginMessage; ?></h5>
        
<?php get_footer(); ?>