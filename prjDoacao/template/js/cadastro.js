$(document).ready(function () {
    //Choose user type event 
    $('#instituicao, #instituicao.p, #doador, #doador.p').click(function (ev) {
        $('#btnCadastrar').removeAttr('disabled');
        $('#doador, #instituicao').removeClass('selected');
        var target = $(ev.target);
        if(target.is('#doador') || target.is('#doador p')){
            $('#doador').addClass('selected');
            $('#txtCNPJ').slideUp();
            $('#tipo').val(1);
        }else{
            $('#instituicao').addClass('selected');
            $('#txtCNPJ').slideDown();
            $('#tipo').val(2);
        }
    });

    //receive and select value
    if($('#tipo').val() == "1"){
        $('#doador').click();
    }
    if($('#tipo').val() == "2"){
        $('#instituicao').click();
    }
    
    //btnCadastrar event click
    $('#btnCadastrar').click(function (ev) {
        return true;
    });


 })