/* GLOBAL VARS*/
TipoMercadoria = [];
mercadoriaList = [];
Combinacoes = [];

/* FUNCTIONS */
function listarItens() {
    $.ajax({
        url: "/mercadoria/listar",
        success: function (result) {
            try {
                mercadoriaList = JSON.parse(result);
            } catch (e) {
                mercadoriaList = result;
            }
        },
        error: function () {
            alert('Erro ao realizar requisição Ajax');
        },
        complete: function () {
            $('#itensList').empty();
            var index = 0;
            if ($.isArray(mercadoriaList)) {
                mercadoriaList.forEach(function (mercadoria) {
                    var item = '<li value="' + index + '">';
                    item += '<h2 class="nome">' + mercadoria.model.nome + '</h2>';
                    item += '<dd>interessados: <span class="interessados"><a href="">' + mercadoria.interessados + '</a></span></dd>';
                    item += '<div class="controls">';
                    item += '<button class="btn edit"></button>';
                    item += '<button class="btn delete"></button>';
                    item += '</div>';
                    item += '</li>';
                    item += '<svg><line x1="1" y1="1" x2="100%" y2="1" /></svg>';
                    $('#itensList').append(item);
                    index++;
                })
                selecionarItem(0);
            } else {
                $('#itensList').append(mercadoriaList);
                $('#right').fadeOut();
            }
        }
    });
}

function listarMatch(codigo) {
    $.ajax({
        url: 'mercadoria/listarCombinacoes/' + codigo,
        type: 'GET',
        data: {
            cd: codigo
        },
        success: function (result) {
            try {
                Combinacoes = JSON.parse(result);
            } catch (e) {
                Combinacoes = result;
            }
        },
        error: function () {
            alert('Erro ao efetuar Ajax');
        },
        complete: function () {
            $('#matchList').empty();
            if ($.isArray(Combinacoes) && Combinacoes != "") {
                var index = 0;
                Combinacoes.forEach(function (comb) {
                    var item = '<li value="' + index + '">';
                    item += '<h3>' + comb.usuarioReceptor.nome + '</h3>';
                    item += '<dd id="valLocal">' + comb.usuarioReceptor.cep.cidade + '/' + comb.usuarioReceptor.cep.siglaEstado + '</dd>';
                    item += '<div class="controls"><a href="' + BASE_URL + 'usuario/perfil/' + comb.usuarioReceptor.codigo + '">Ver Perfil</a><button class="btn">Doar</a></div></li>';

                    $('#matchList').append(item);
                    item++;
                });
            } else {
                $('#matchList').append('<span class="msg show">Nenhuma instituição interessada!</span>');
                return;
            }
        }
    })
}

function loadTipoMercadoria() {
    $.ajax({
        url: "/mercadoria/novo",
        success: function (result) {
            try {
                TipoMercadoria = JSON.parse(result);
            } catch (e) {
                TipoMercadoria = [];
            }
        },
        error: function () {
            alert('Erro ao realizar requisição Ajax');
        }
    });
}

function toggleAddItem() {
    if ($('#adicionar').is(':hidden')) {
        $('#blackcover').fadeIn('fast');
        $('#adicionar').slideDown('fast');
        $('#add-nome').val("");
        $('#tipoMercadoria').val("");
        $('#tipoMercadoria').removeClass("selected");
        $('#cdTipoMercadoria').val(-1);
        $('#unid').empty();
        $('#nbrQuantidade').val("1");
        $('#txtDesc').val("");
    } else {
        $('#blackcover').fadeOut('fast');
        $('#adicionar').slideUp('fast');
    }
}

function toggleMensagem() {
    if ($('#mensagem').is(':hidden')) {
        $('#blackcover').fadeIn('fast');
        $('#mensagem').fadeIn();
    } else {
        $('#blackcover').fadeOut('fast');
        $('#mensagem').fadeOut('fast');
    }
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

function salvar(_nome, _tipo, _unidade, _quantidade, _descricao) {
    resultado = false;
    $.ajax({
        dataType: 'json',
        type: 'POST',
        async: false,
        url: '/mercadoria/novo',
        data: {
            send: 'insert',
            nome: _nome,
            quantidade: _quantidade,
            tipo: _tipo,
            unidade: _unidade,
            descricao: _descricao
        },
        success: function (result) {
            if (result === true) {
                listarItens();
                resultado = true;
            } else {
                resultado = result;
            }

        },
        error: function () {
            alert('Erro ao realizar requisição Ajax');
        }
    });
    return resultado;
}

function selecionarItem(index) {

    $('.selectedItem').removeClass('selectedItem');
    $('#itensList li[value="' + index + '"]').addClass('selectedItem');

    $('#txtNome').val(mercadoriaList[index].model.nome);
    $('#valDescricao').text(mercadoriaList[index].model.descricao);
    $('#valQuantidade').text(mercadoriaList[index].model.quantidade);
    $('#valUnidade').text(mercadoriaList[index].model.unidade);
    TipoMercadoria.forEach(function (item) {
        if (item.codigo == mercadoriaList[index].model.tipo) {
            $('#valTipo').text(item.nome);
        }
    });
    listarMatch(mercadoriaList[index].model.codigo);
    $('#right').fadeIn('fast');
}

function removerItem(_codigo) {
    $.ajax({
        type: 'POST',
        url: '/mercadoria/remover',
        data: {
            codigo: _codigo
        },
        success: function (result) {
            $('#itensList > li[value="' + _codigo + '"] ').slideUp('fast');
            listarItens();
        },
        error: function () {
            alert('Erro ao realizar requisição Ajax');
        }
    })
}

//DOAR item

function doarItem(_index, _quantidade) {
    var comb = Combinacoes[_index];

    $.ajax({
        type: 'POST',
        data: {
            quantidade: _quantidade,
            usuario: comb.usuarioReceptor.codigo,
            mercadoria: comb.codigoMercadoria.codigo,
            anonima: 'yes'
        },
        url: '/doacoes/novo',
        success: function (result) {
            alert('Doação efetuada com sucesso');

        },
        error: function () {
            alert('Ajax Error');
        },
        complete: function () {
            listarItens();
        }

    })
}


/* --------- EVENTS ---------- */

$(document).ready(function () {
    //onLoad
    listarItens();
    loadTipoMercadoria();

    //document click evnt
    $(document).click(function (evt) {
        if (!$(evt.target).is('#tipoMercadoria')) {
            $('#tipos').hide();
        }
    });

    //blackcover click
    $('#blackcover').click(function (evt) {
        if ($('#adicionar').is(':visible')) {
            toggleAddItem();
        }
        if ($('#mensagem').is(':visible')) {
            toggleMensagem();
        }
        if ($('#frmNovaDoacao').is('visible')) {
            $('#frmNovaDoacao').fadeOut();
        }
    });

    //btnAdicionar evnt
    $('#btnAdicionar').click(function (evt) {
        toggleAddItem();
    });

    //btnVoltar evnt
    $('#btnVoltar').click(function (evt) {
        toggleAddItem();
    });

    /* ---Adicionar Mercadoria---- */

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

    // btnConcluir evt
    $('#btnConcluir').click(function (evt) {
        var nome = $('#add-nome').val();
        var tipo = $('#cdTipoMercadoria').val();
        var unidade = $('#unid').val();
        var quantidade = $('#nbrQuantidade').val();
        var descricao = $('#txtDesc').val();

        if (nome == null) {
            alert('Preencha o nome');
            return;
        }
        if (tipo == 0 || !$('#tipoMercadoria').hasClass('selected')) {
            alert('Selecione um tipo!');
            return;
        }
        if (unidade == null) {
            alert('Selecione a unidade!');
            return;
        }
        //save mercadoria
        if ((result = salvar(nome, tipo, unidade, quantidade, descricao)) === true) {
            toggleAddItem();
        } else {
            alert(result);
        }
    });

    //Selecionar item click evnt
    $('#itensList').on('click', 'li', function (evt) {
        if ($(evt.target).is('button')) {
            if ($(evt.target).hasClass('edit')) {

            } else {
                toggleMensagem();
            }
        }

        selecionarItem($(evt.target).closest('li').val());

    })

    //Excluir item evt
    $('#mensagem').on('click', '#nao', function (evt) {
        toggleMensagem();
    });

    $('#mensagem').on('click', '#sim', function (evt) {
        var index = $('.selectedItem').val();
        removerItem(mercadoriaList[index].model.codigo);
        toggleMensagem();
    });

    //DOAR item
    $('#matchList').on('click', 'li button', function () {
        $('#indexComb').val($(this).closest('li').val());
        var indexComb = $('#indexComb').val();
        $('#txtNomeDoa').val(Combinacoes[indexComb].codigoMercadoria.nome);
        $('#tipoMercadoriaDoa').val(Combinacoes[indexComb].codigoMercadoria.tipo);
        $('#unid').val(Combinacoes[indexComb].unidade);
        $('#blackcover').fadeIn('fast');
        $('#frmNovaDoacao').toggle();
    })

    //btnConcluirDoa
    $('#btnConcluirDoa').click(function () {
        var quantidade = $('#nbrQuantidadeDoa').val();
        var indexComb = $('#indexComb').val();
        doarItem(indexComb, quantidade);
        $('#blackcover').fadeOut('fast');
        $('#frmNovaDoacao').toggle();
    });

})
