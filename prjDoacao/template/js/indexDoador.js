/* --- VARIABLES --- */

doacoesList = [];
mercadoriaList = [];
rankingList = [];
postList = [];


/* --- FUNCTIONS --- */
function loadDoacoes() {
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
           $('#donations > ul ').empty();
           if(doacoesList.lenght != 0){
                var cd = 0;
                doacoesList.forEach(function(item) {
                        var newitem  = '<li value="'+ cd +'">';
                            newitem += '<h2 class="nome">'+item.mercadoria.nome+'</h2>';
                            newitem += '<dd>para: <span class="interessados"><a href="'+ BASE_URL + 'usuario/perfil/' + item.necessidade.usuario.codigo +'">'+item.necessidade.usuario.nome+'</a></span></dd>';
                            newitem += '<div class="status"><span>'+ (item.status == 1 ? 'Em Andamento' : 'Finalizada') +'</span></div>'
                            newitem += '</li>';
                            newitem += '<svg><line x1="1" y1="1" x2="100%" y2="1"></svg>'
                        $('#donations > ul').append(newitem);
                        cd++;
                });
           }else{
               $('#donations > ul').append('<p>Nenhuma doação até o momento </p>');
           }
         }
    });
}

function loadMercadorias(){
    $.ajax({
        url: "/mercadoria/listar",
        success: function (result) {
            $('#mercadoria > ul').html(result);
        },
        error: function () {
            alert('Erro ao realizar requisição Ajax');
        }

    });
}

/* --- EVENTS --- */
/* -- when main doc is ready --*/
$('document').ready(function () {

    //STYLE FEATURES
    /*First post together to header*/
    var altura = parseInt($('header').height()) + parseInt($('header').css('padding')) + parseInt($('header').css('padding')) + parseInt($('#conquistas').css('height')) + parseInt($('svg').css('padding')) + parseInt($('#first-post').css('height')) + parseInt($('#first-post').css('margin-bottom'));

    $('#newsfeed').css('height', altura);

    /*Expand aside*/
    var aside_orig = parseInt($('.stat-container').css('height'));
    var aside_redu = aside_orig - 140;

    $('.stat-container').css('height', aside_redu);

    $('.stat-container').click(function () {
        $(this).css('height', aside_orig);
        $(this).css('border-bottom', '2px solid gray');
    });

    $('.stat-container').mouseover(function () {
        $(this).css('height', aside_orig);
        $(this).css('border-bottom', '2px solid gray');
    });

    $('.stat-container').mouseout(function () {
        $(this).css('height', aside_redu);
        $(this).css('border-bottom', 'none');
    });

    //on load evt
    loadDoacoes();
    loadMercadorias();
});
