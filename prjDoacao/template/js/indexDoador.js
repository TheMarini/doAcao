/* --- VARIABLES --- */

doacoesList = [];
mercadoriaList = [];
rankingList = [];
postList = [];


/* --- FUNCTIONS --- */
function loadDoacoes() {
    doacoesList = [];
    $.ajax({
        url: '/doacoes/listar',
        success: function (result) {
            doacoesList = result;
        },
        error: function (evt, xhr, obj, msg) {
            alert(msg);
        },
        complete: function () {
            $('#donations > ul ').empty();
            if ($.isArray(doacoesList)) {
                var cd = 0;
                doacoesList.forEach(function (item) {
                    var newitem = '<li value="' + cd + '">';
                    newitem += '<h2 class="nome">' + item.mercadoria.nome + '</h2>';
                    newitem += '<dd>para: <span class="interessados"><a href="' + BASE_URL + 'usuario/perfil/' + item.necessidade.usuario.codigo + '">' + item.necessidade.usuario.nome + '</a></span></dd>';
                    newitem += '<div class="status"><span>' + (item.status == 1 ? 'Em Andamento' : 'Finalizada') + '</span></div>'
                    newitem += '</li>';
                    newitem += '<svg><line x1="1" y1="1" x2="100%" y2="1"></svg>'
                    $('#donations > ul').append(newitem);
                    cd++;
                });
            } else {
                $('#donations > ul').append('<p align="center">Nenhuma doação até o momento </p>');
            }
        }
    });
}

function loadMercadorias() {
    $.ajax({
        url: "/mercadoria/listar",
        success: function (result) {
            try{
                mercadoriaList = JSON.parse(result);
            }catch(e){
                mercadoriaList = result;
            }
        },
        error: function () {
            alert('Erro ao realizar requisição Ajax');
        },
        complete: function () {
            $('#mercadoria > ul').empty();
            var index = 0;
            if ($.isArray(mercadoriaList)) {
                mercadoriaList.forEach(function (mercadoria) {
                    var item = '<li value="' + mercadoria.model.codigo + '">';
                    item += '<h2 class="nome">'+mercadoria.model.nome+'</h2>';
                    item += '<dd>interessados: <span class="interessados"><a href="">'+mercadoria.interessados+'</a></span></dd>';
                    item += '</li>';
                    item += '<svg><line x1="1" y1="1" x2="100%" y2="1" /></svg>';
                    $('#mercadoria > ul').append(item);
                })
            } else {
                $('#mercadoria > ul').append(mercadoriaList);
            }
        }
    });
}

function loadRanking() {
    $.ajax({
        url: '/ranking/listar',
        success: function (result) {
            rankingList = result;
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
        },
        complete: function () {
            $('#ranking ul').empty();
            if ($.isArray(rankingList)) {
                var index = 0;
                rankingList.forEach(function (rank) {
                    var item = '<li class="pos-' + (index + 1) + '">';
                    item += '<div>';
                    item += '<img src="' + BASE_URL + rank.photo + '" alt="" class="avatar">';
                    item += '<a href=""><p class="nome">' + rank.nome + '</p></a>';
                    item += '<p class="pontuacao">' + rank.pontos + ' pts.</p>';
                    item += '</div>';
                    item += '</li>';
                    $('#ranking ul').append(item);
                });
            }else{
                $('#ranking ul').append('<p align="center">Não há usuários o suficiente para criar o ranking</p>');
            }
        }
    })
}

/* --- EVENTS --- */
/* -- when main doc is ready --*/
$('document').ready(function () {

    //on load evt
    loadDoacoes();
    loadMercadorias();
    loadRanking();

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
});
