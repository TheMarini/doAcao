document.onreadystatechange = function (){
    if(document.readyState == "complete"){
        
        var loginbox = document.getElementById('loginPopUp');

        var btnEntrar = document.getElementById('btnEntrar');

        btnEntrar.onclick = function(){
            var hidden = false;
            loginbox.classList.forEach(function(element){
                if(element == 'hide'){
                    hidden = true;
                }
            }, this);

            if(hidden){
               loginbox.classList.remove('hide'); 
            }else{
               loginbox.classList.add('hide');
            }
        }
    }
}