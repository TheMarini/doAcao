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

function loadUnidade(){

}


/* EVENTS */

$(document).ready(function(){
    //onLoad
    listarItens();

    //document click evnt
    $(document).click(function(evt){
        if(!$(evt.target).is('#tipoMercadoria')){
            $('#tipos').hide();
        }
    });

    //blackcover click
    $('#blackcover').click(function (evt){
        toggleAddItem();
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

    

})
