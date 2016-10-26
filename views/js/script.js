document.onreadystatechange = function (){
    if(document.readyState == "complete"){
        
        var loginbox = document.getElementById('loginPopUp');
        loginbox.hidden = true;

        var btnEntrar = document.getElementById('btnEntrar');

        btnEntrar.onclick = function(){
            loginbox.hidden = !loginbox.hidden;
        }
    }
}