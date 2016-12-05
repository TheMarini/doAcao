/* GLOBAL VARS*/
TipoMercadoria = [];
Mercadorias = [];
Combinacoes = [];

/* FUNCTIONS */
function listarItens(){
    $.ajax({
        url: "/mercadoria/listar",
        success: function(result){
            $('#itensList').html(result);
            selecionarItem($('#itensList > li:first-child'));
        },
        error: function(){
            alert('Erro ao realizar requisição Ajax');
        }

    });
}

function listarMatch(codigo){
    $.ajax({
        dataType: 'json',
        type: 'GET',
        url:'mercadoria/listarCombinacoes/'+codigo,
        data: {cd: codigo},
        success: function(result){
            Combinacoes = result;
        },
        error: function(){
            alert('Erro ao efetuar Ajax');
        },
        complete: function(){
            $('#matchList').empty();
            if(Combinacoes == ""){
                $('#matchList').append('<span class="msg show">Nenhuma instituição interessada!</span>');
                return;
            }

            index = 0;
            Combinacoes.forEach(function(comb) {
                var item = '<li value="'+index+'">';
                   item += '<h3>'+comb.usuarioReceptor.nome+'</h3>';
                   item += '<dd id="valLocal">'+comb.usuarioReceptor.cep+'</dd>';
                   item +=  '<div class="controls"><a href="'+BASE_URL+'usuario/perfil/'+ comb.usuarioReceptor.codigo+'">Ver Perfil</a><button class="btn">Doar</a></div></li>';
                
                $('#matchList').append(item); 
                item++;
            });


        }
    })
}

function toggleAddItem(){
    if($('#adicionar').is(':hidden') ){
        $('#blackcover').fadeIn('fast');
        $('#adicionar').slideDown('fast');
        $('#add-nome').val("");
        $('#tipoMercadoria').val("");
        $('#tipoMercadoria').removeClass("selected");
        $('#cdTipoMercadoria').val(-1);
        $('#unid').empty();
        $('#nbrQuantidade').val("1");
        $('#txtDesc').val("");
    }else{
        $('#blackcover').fadeOut('fast');
        $('#adicionar').slideUp('fast');
    }
}

function toggleMensagem(){
    if($('#mensagem').is(':hidden')){
        $('#blackcover').fadeIn('fast');
        $('#mensagem').fadeIn();
    }else{
        $('#blackcover').fadeOut('fast');
        $('#mensagem').fadeOut('fast');
    }
}

function loadTipoMercadoria(){
    $.ajax({
        dataType: 'json',
        url: "/mercadoria/novo",
        success: function(result){
            TipoMercadoria = result;
        },
        error: function(){
            alert('Erro ao realizar requisição Ajax');
        }
        
    });
}

function searchTipoMercadoria(termo = ""){
    $('#tipos').empty();
    if(termo != ""){
        var rgxp = new RegExp(termo, "g");
        TipoMercadoria.forEach(function(item){
            if(item.nome.match(rgxp)){
                $('#tipos').append('<li value="'+item.codigo+'">'+item.nome+'</li>');
            }
            
        });
        return;
    }

    TipoMercadoria.forEach(function(item){
       $('#tipos').append('<li value="'+item.codigo+'">'+item.nome+'</li>');  
    });
}

function salvar(_nome, _tipo, _unidade, _quantidade, _descricao){
    resultado = false;
    $.ajax({
        dataType: 'json',
        type: 'POST',
        async: false,
        url: '/mercadoria/novo',
        data: {send: 'insert', nome: _nome, quantidade: _quantidade, tipo: _tipo, unidade: _unidade, descricao: _descricao},
        success: function(result){
            if(result === true){
                listarItens();
                resultado = true;
            }else{
                resultado = result;
            }

        },
        error: function () {
            alert('Erro ao realizar requisição Ajax');
        }
    });
    return resultado;
}

function selecionarItem(target){
    if($(target).is('li')){
        $('.selectedItem').removeClass('selectedItem');
        $(target).addClass('selectedItem');
        var cd = $(target).val();
        
        $.ajax({
            url: '/mercadoria/item/'+cd,
            dataType: 'json',
            success: function(result){
                $('#txtNome').val(result.nome);
                TipoMercadoria.forEach(function(item){
                    if(item.codigo == result.tipo){
                        $('#valTipo').text(item.nome);
                    }
                });
                $('#valDescricao').text(result.descricao);
                $('#valQuantidade').text(result.quantidade);
                $('#valUnidade').text(result.unidade);
                listarMatch(cd);
            },
            error: function () {
                alert('Erro ao realizar requisição Ajax');
            },
            complete: function(){
                $('#right').fadeIn('fast');
            }
        });
        
    }else{
        $('#right').fadeOut('fast');
    }
}

function removerItem(_codigo){
    $.ajax({
        type: 'POST',
        url: '/mercadoria/remover',
        data: {codigo: _codigo},
        success: function(result){
            $('#itensList > li[value="'+_codigo+'"] ').slideUp('fast');
            listarItens();
        },
        error:function () {
            alert('Erro ao realizar requisição Ajax');
        }
    })
}

//DOAR item

function doarItem(_index, _quantidade){
    var comb = Combinacoes[_index];

    $.ajax({
        type: 'POST',
        data: {quantidade: _quantidade, usuario: comb.usuarioReceptor.codigo, mercadoria: comb.codigoMercadoria.codigo, anonima: 'yes'},
        url: '/doacoes/novo',
        success: function(result){
            alert(result);
        },
        error: function () {
            alert('Ajax Error');
          }
    })
}


/* EVENTS */

$(document).ready(function(){
    //onLoad
    listarItens();
    loadTipoMercadoria();

    //document click evnt
    $(document).click(function(evt){
        if(!$(evt.target).is('#tipoMercadoria')){
            $('#tipos').hide();
        }
    });

    //blackcover click
    $('#blackcover').click(function (evt){
        if($('#adicionar').is(':visible')){
            toggleAddItem();
        }
        if($('#mensagem').is(':visible')){
            toggleMensagem();
        }
    });

    //btnAdicionar evnt
    $('#btnAdicionar').click(function(evt){
        toggleAddItem();
        loadTipoMercadoria();
    });

    //btnVoltar evnt
    $('#btnVoltar').click(function(evt){
        toggleAddItem();
    });

    /* ---Adicionar Mercadoria---- */

    //tipo de mercadoria keydown event
    $('#tipoMercadoria').keyup(function(evt){
        if(!(evt.which == 37 || evt.which == 38 || evt.which == 39 || evt.which == 40)){ 
            $(this).removeClass('selected');
            searchTipoMercadoria($(this).val());
            $('#tipos').show();
        }        
    });
    //seleciona a opcao
    $(document).on('click','#tipos > li' ,function(evt){
        $('#tipoMercadoria').val($(this).html());
        $('#tipoMercadoria').addClass('selected');
        $('#cdTipoMercadoria').val($(this).val());
        $('#tipos').hide();
        $("#tipoMercadoria").trigger('change');
    });

    //unid change evnt
    $("#tipoMercadoria").change(function(){
        cd = $('#cdTipoMercadoria').val();
        unidades = [];
        TipoMercadoria.forEach(function(item){
            if(item.codigo == cd){
                unidades = item.unidades;
            }
        })
        $("#unid").empty();
        unidades.forEach(function(un){
            $("#unid").append('<option value="' + un +'">'+ un +'</option>');
        })

    });

    // btnConcluir evt
    $('#btnConcluir').click(function(evt){
        var nome = $('#add-nome').val();
        var tipo = $('#cdTipoMercadoria').val();
        var unidade = $('#unid').val();
        var quantidade = $('#nbrQuantidade').val();
        var descricao = $('#txtDesc').val();

        if(nome == null){
            alert('Preencha o nome');
            return;
        }
        if(tipo == 0 || !$('#tipoMercadoria').hasClass('selected')){
            alert('Selecione um tipo!');
            return;
        }
        if(unidade == null){
            alert('Selecione a unidade!');
            return;    
        }
        //save mercadoria
        if((result = salvar(nome, tipo, unidade, quantidade, descricao)) === true){
            toggleAddItem();
        }else{
            alert(result);
        }
    });

    //Selecionar item click evnt
    $('#itensList').on('click', 'li', function(evt){
            if($(evt.target).is('button')){
                if($(evt.target).hasClass('edit')){

                }else{
                    toggleMensagem();
                }
            }
            selecionarItem($(evt.target).closest('li'));
            
        
    })

    //Excluir item evt
    $('#mensagem').on('click', '#nao', function(evt){
        toggleMensagem();
    });

    $('#mensagem').on('click', '#sim', function(evt){
        var cd = $('.selectedItem').val();
        removerItem(cd);
        toggleMensagem();
    });

    //DOAR item
    $('#matchList').on('click', 'li button', function(){
        $('#indexComb').val($(this).closest('li').val());
        $('#frmNovaDoacao').toggle();        
    })

    //btnConcluirDoa
    $('#btnConcluirDoa').click(function(){
        var quantidade = $('#nbrQuantidadeDoa').val();
        var indexComb = $('#indexComb').val();

        doarItem(indexComb, quantidade);
    });    

})
