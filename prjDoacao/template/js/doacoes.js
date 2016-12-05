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
           if(doacoesList.lenght > 0){
                var cd = 0;
                doacoesList.forEach(function(item) {
                        var newitem  = '<li value="'+ cd +'">';
                            newitem += '<h2 class="nome">'+item.mercadoria.nome+'</h2>';
                            newitem += '<dd>para: <span class="interessados"><a href="'+ BASE_URL + 'usuario/perfil/' + item.necessidade.usuario.codigo +'">'+item.necessidade.usuario.nome+'</a></span></dd>';
                            newitem += '<div class="status"><span>'+ (item.status == 1 ? 'Em Andamento' : 'Finalizada') +'</span></div>'
                            newitem += '</li>'; 
                            newitem += '<svg><line x1="1" y1="1" x2="100%" y2="1"></svg>'
                        $('#itensList').append(newitem);
                        cd++;
                });
                selecionarItem(0);
           }else{
               $('#itensList').append('<p>Nenhuma doação até o momento </p>');
           }
         }
    });
}

/* Selecionar item */
function selecionarItem(index){
    if(doacoesList.length == 0){
        $('#right').fadeOut();
        return;
    }
    //mark the selected list item
    $('.selectedItem').removeClass('selectedItem');
    $('#itensList li[value="'+index+'"]').addClass('selectedItem');
    //fill the fields
    var doacao = doacoesList[index];
    $('#txtNome').val(doacao.mercadoria.nome);
    $('#valMercadoria').text(doacao.mercadoria.nome);
    $('#valTipo').text(doacao.mercadoria.tipo);
    $('#valQuantidade').text(doacao.quantidade);
    $('#valData').text((new Date(doacao.dataInicio)).toLocaleDateString());
    $('#valStatus').text(doacao.status == 1? 'Em andamento':'Finalizada');
    $('#valPontos').text(doacao.pontos);
    $('#valInstituicao').text(doacao.necessidade.usuario.nome);
    $('#valNecessidade').text(doacao.necessidade.nome);
    $('#valEndereco').text(doacao.necessidade.usuario.cep);
    //show the right screen
    $('#right').fadeIn();
}

/* ---- EVENTS ---- */
$(document).ready(function (evt) {
    //on page load
    listarItens();
    

    //Left list item click
    $('#itensList').on('click', 'li', function(evt){
        selecionarItem($(evt.target).closest('li').val());
    });

});