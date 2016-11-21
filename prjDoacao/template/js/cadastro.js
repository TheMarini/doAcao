$(document).ready(function () { 
    $('#instituicao, #instituicao.p, #doador, #doador.p').click(function (ev) {
        $('#btnCadastrar').removeAttr('disabled');
        $('#doador, #instituicao').removeClass('selected');
        var target = $(ev.target);
        if(target.is('#doador') || target.is('#doador p')){
            $('#doador').addClass('selected');
            $('#txtCNPJ').slideUp();
            $('#tipo').val(0);
        }else{
            $('#instituicao').addClass('selected');
            $('#txtCNPJ').slideDown();
            $('#tipo').val(1);
        }
    });

    $('#btnCadastrar').click(function (ev) {
        return true;
    });
 })