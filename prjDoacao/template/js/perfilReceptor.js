// variables

necessidadeList = [];
TipoMercadoria = [];

// FUNÇÕES

function listarNecessidades() {
    $.ajax({
        url: '/necessidades/listar',
        success: function (result) {
            try {
                necessidadeList = JSON.parse(result);
            } catch (e) {
                necessidadeList = result;
            }
        },
        complete: function () {
            $('#itensListNec').empty();
            if ($.isArray(necessidadeList) && necessidadeList != "") {
                index = 0;
                necessidadeList.forEach(function (nec) {
                    item = '<li value="' + index + '">';
                    item += '<div class="controls"> <button class="btn edit"></button><button class="btn delete"></button></div>';
                    item += '<h3>' + nec.nome + '</h3>';

                    item += '<progress value="' + nec.quantCompleta + '" max="' + nec.quantidade + '"></progress>';
                    item += '<p>' + nec.quantCompleta + ' de ' + nec.quantidade + ' doados</p>';
                    item += '</li>'

                    $('#itensListNec').append(item);
                });
            }else{
                $('#itensListNec').append('<p>Nenhuma necessidade cadastrada</p>');
            }
        },
        error: function () {
            alert('ajax Error');
        }
    })
}

//carregar tipos de mercadoria
function loadTipoMercadoria() {
    $.ajax({
        dataType: 'json',
        url: "/mercadoria/novo",
        success: function (result) {
            TipoMercadoria = result;
        },
        error: function () {
            alert('Erro ao realizar requisição Ajax');
        }

    });
}

function searchTipoMercadoria(termo = "") {
    $('#tipos').empty();
    if (termo != "") {
        var rgxp = new RegExp(termo, "g");
        TipoMercadoria.forEach(function (item) {
            if (item.nome.match(rgxp)) {
                $('#tipos').append('<li value="' + item.codigo + '">' + item.nome + '</li>');
            }

        });
        return;
    }

    TipoMercadoria.forEach(function (item) {
        $('#tipos').append('<li value="' + item.codigo + '">' + item.nome + '</li>');
    });
}


// adicionar necessidades
function toggleAddItem() {
    if ($('#frmNovaNecessidade').is(':hidden')) {
        loadTipoMercadoria();
        $('#blackcover').fadeIn('fast');
        $('#frmNovaNecessidade').fadeIn('fast');
    } else {
        $('#frmNovaNecessidade').fadeOut('fast');
        $('#blackcover').fadeOut('fast');
    }
}

//SalvarNecessidade
function salvarNecessidade(_tipo, _nome, _quantidade, _unidade) {
    $.ajax({
        type: 'POST',
        data: {
            tipo: _tipo,
            nome: _nome,
            quantidade: _quantidade,
            unidade: _unidade
        },
        url: '/necessidades/novo',
        success: function (result) {
            if (result == 'false') {
                alert('Já existe uma necessidade identica registrada em sua conta!');
                return;
            }
            toggleAddItem();
            listarNecessidades();
        },
        error: function () {
            alert('Ajax Error');
        }
    })
}

function novoPost(_conteudo) {
    $.ajax({
        type: 'POST',
        data: {
            tipo: '1',
            conteudo: _conteudo
        },
        url: 'publicacao/novo',
        success: function (result) {
            loadFeed();
        },
        error: function (result) {
            alert('erro de ajax');
        }
    })
}


/* -- EVENTOS -- */
$(document).ready(function () {
    //CARROSSEL DE INFOS TOPO
    $('#photos').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '10%',
        nextArrow: '<button type="button" class="slick-next"></button>',
        prevArrow: '<button type="button" class="slick-prev"></button>',
        infinite: false
    });

    //on load events
    listarNecessidades();
    loadFeed();

    $(document).click(function (evt) {
        if (!$(evt.target).is('#tipoMercadoria')) {
            $('#tipos').hide();
        }
    });

    //blackcover click
    $('#blackcover').click(function (evt) {
        if ($('#frmNovaNecessidade').is(':visible')) {
            toggleAddItem();
        }
        if ($('#mensagem').is(':visible')) {
            toggleMensagem();
        }
    });

    //btnAdicionar Necessidade
    $('#bntNovaNecessidade').click(function (evt) {
        toggleAddItem();
    });

    //tipo de mercadoria keydown event
    $('#tipoMercadoria').keyup(function (evt) {
        if (!(evt.which == 37 || evt.which == 38 || evt.which == 39 || evt.which == 40)) {
            $(this).removeClass('selected');
            searchTipoMercadoria($(this).val());
            $('#tipos').show();
        }
    });
    //seleciona a opcao
    $(document).on('click', '#tipos > li', function (evt) {
        $('#tipoMercadoria').val($(this).html());
        $('#tipoMercadoria').addClass('selected');
        $('#cdTipoMercadoria').val($(this).val());
        $('#tipos').hide();
        $("#tipoMercadoria").trigger('change');
    });

    //unid change evnt
    $("#tipoMercadoria").change(function () {
        cd = $('#cdTipoMercadoria').val();
        unidades = [];
        TipoMercadoria.forEach(function (item) {
            if (item.codigo == cd) {
                unidades = item.unidades;
            }
        })
        $("#unid").empty();
        unidades.forEach(function (un) {
            $("#unid").append('<option value="' + un + '">' + un + '</option>');
        })

    });

    //Salvar necessidade
    $('#btnConcluir').click(function (evt) {
        var nome = $('#txtNome').val();
        var tipo = $('#cdTipoMercadoria').val();
        var unidade = $('#unid').val();
        var quantidade = $('#nbrQuantidade').val();

        if (nome == null || nome == "") {
            alert('Preencha o nome da necessidade!');
            return;
        }
        if (!$('#tipoMercadoria').hasClass('selected')) {
            alert('Selecione o tipo da mercadoria!');
            return;
        }
        if (unidade == null || unidade == "") {
            alert('Selecione a unidade');
            return;
        }

        salvarNecessidade(tipo, nome, quantidade, unidade);

    });

    //postar
    $('#postar').click(function () {
        var conteudo = $('#cont').val();
        novoPost(conteudo);

    });

});
