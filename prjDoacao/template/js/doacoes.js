/* ---- VARIAVEIS ---- */
doacoesList = [];

/* ------------------- */

/* Listar todos os itens */
function listarItens() {
    doacoesList = [];
    $.ajax({
       dataType: 'json',
       url: '/doacoes/listar',
       success: function (result) {
           doacoesList = result;
         },
       error: function () {  
           alert('erro de ajax');
       },
       complete: function () {
           $('#itensList').empty();
           doacoesList.forEach(function(item) {
                var newitem  = '<li value="'+ item.codigo +'">';
                    newitem += '<h2 class="nome">'+item.mercadoria.nome+'</h2>';
                    newitem += '<dd>para: <span class="interessados"><a href="">'+item+'</a></span></dd>';
                    newitem += '</li>'; 
                    newitem += '<svg><line x1="1" y1="1" x2="100%" y2="1"></svg>'
                $('#itensList').append(newitem);
           });
         }
    });
}

/* Selecionar item */


/* ---- EVENTS ---- */
$(document).ready(function (evt) {
    //on page load
    listarItens();
});