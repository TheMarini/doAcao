/* GLOBAL VARS*/
TipoMercadoria = [];

/* FUNCTIONS */
function listarItens(){
    $.ajax({
        url: "mercadoria/listar",
        success: function(result){
            $('#itensList').html(result);
        },
        error: function(){
            alert('Erro ao realizar requisição Ajax');
        }

    });
}

function toggleAddItem(){
    if($('#adicionar').is(':hidden') ){
        $('#blackcover').fadeIn('fast');
        $('#adicionar').slideDown('fast');
    }else{
        $('#blackcover').fadeOut('fast');
        $('#adicionar').slideUp('fast');
    }
}

function loadTipoMercadoria(){
    $.ajax({
        dataType: 'json',
        url: "mercadoria/novo",
        success: function(result){
            TipoMercadoria = result;
            $('#tipos').empty();
            TipoMercadoria.forEach(function(tpmec){
                $('#tipos').append('<option value="'+tpmec.codigo+'">'+ tpmec.nome +'</option>');
            });

        },
        error: function(){
            alert('Erro ao realizar requisição Ajax');
        }
        
    });
}

function loadUnidade(){

}


/* EVENTS */

$(document).ready(function(){
    //onLoad
    listarItens();

    //blackcover click
    $('#blackcover').click(function (evt){
        toggleAddItem();
    });
    
    //btnAdicionar evnt
    $('#btnAdicionar').click(function(evt){
        toggleAddItem();
        loadTipoMercadoria();
    });

    //unid change evnt
    $("#tipoMercadoria").change(function(){
        cd = $(this).val();
        alert(cd);
        unidades = [];
        TipoMercadoria.forEach(function(item){
            if(item.codigo == cd){
                unidade = item.unidades[0];
            }
        });
        alert(unidades);
    });

    

})
