/* ---- VARIAVEIS ---- */

doacoesList = [];


/* ------------------- */

/* --- abrir mensagem --- */
function toggleDialog(){
    if($('#mensagem').is(':hidden')){
        $('#blackcover').fadeIn();
        $('#mensagem').fadeIn();
    }else{
        $('#dialog').val("");
        $('#mensagem').fadeOut();
        $('#blackcover').fadeOut();
    }
}

/* Listar todos os itens */
function listarItens() {
    doacoesList = [];
    $.ajax({
        url: '/doacoes/listar',
        success: function (result) {
            try {
                doacoesList = JSON.parse(result);
            } catch (e) {
                doacoesList = result;
            }
        },
        error: function () {
            alert('Ajax Request Error');
        },
        complete: function () {
            $('#itensList').empty();
            if ($.isArray(doacoesList)) {

                var cd = 0;
                doacoesList.forEach(function (item) {
                    var newitem = '<li value="' + cd + '">';
                    newitem += '<h2 class="nome">' + item.mercadoria.nome + '</h2>';
                    newitem += '<dd>para: <span class="interessados"><a href="' + BASE_URL + 'usuario/perfil/' + item.necessidade.usuario.codigo + '">' + item.necessidade.usuario.nome + '</a></span></dd>';
                    newitem += '<div class="status"><span>' + (item.status == 1 ? 'Em Andamento' : 'Finalizada') + '</span></div>'
                    newitem += '</li>';
                    newitem += '<svg><line x1="1" y1="1" x2="100%" y2="1"></svg>'
                    $('#itensList').append(newitem);
                    cd++;
                });
                selecionarItem(0);
            } else {
                $('#itensList').append(doacoesList);
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
    $('#valQuantidade').text(doacao.quantDoacao);
    $('#valData').text((new Date(doacao.dataInicio)).toLocaleDateString());
    if(doacao.status == 1){
               var btnMsg ='<button id="btnEnviarMensagem" class="btn">Enviar Mensagem</button>';
               var btnCancelar = '<button id="btnCancelarDoacao" class="btn delete">Finalizar</button>';
        $('#controls').html(btnMsg + btnCancelar);
    }else{
        $('#controls').html('<h2 style="font-weight: 400; margin: auto">Doação Finalizada</h2>');
    }
    $('#valStatus').text(doacao.status == 1? 'Em andamento':'Finalizada');
    $('#valPontos').text(doacao.pontos);
    $('#valDoador').text(doacao.mercadoria.usuario.nome);
    $('#valTelefone').text(doacao.mercadoria.usuario.telefone);
    $('#valEmail').text(doacao.mercadoria.usuario.email);
    //show the right screen
    $('#right').fadeIn();
}

/* ------ encerrar doacao ----- */
function encerrarDoacao(_codigo){
    $.ajax({
        url: '/doacoes/encerrar/'+_codigo,
        success: function (result) {
            alert('Doação finalizada');
          },
        error: function () {
            alert('Ajax Request Error');
         },
        complete: function () {
            listarItens();
          }
    })
}

/* ---- EVENTS ---- */
$(document).ready(function (evt) {
    //on page load
    listarItens();

    //dialog results
    $('#nao').click(function(){
        toggleDialog();
    });

    $('#sim').click(function () {
        if($('#dialog').val() == 'CancelarDoa'){
            var index = $('#itensList .selectedItem').val();
            encerrarDoacao(doacoesList[index].codigo);
            toggleDialog();
        }
     })

    //Left list item click
    $('#itensList').on('click', 'li', function(evt){
        selecionarItem($(evt.target).closest('li').val());
    });

    //btnCancelarDoacao click evt
    $('#controls').on('click', '#btnCancelarDoacao', function(){
        $('#dialog').val('CancelarDoa');
        $('#dialog').closest('h1').text('Deseja finalizar esta doação?');
        toggleDialog();
    });

    //btnValidarDoacao click evnt
    $('#btnValidarDoacao').click(function(){
        alert('validou!');
    })

});
