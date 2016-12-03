/* FUNCTIONS */
function showSubMenu(seletor){
    $('.content').fadeOut('fast');
    $('.contentOpen').removeClass('contentOpen');
    $(seletor).fadeIn('fast');
}


/* EVENTS */

$('document').ready(function(){

    $(document).click(function(evt){
        if(!$(evt.target).parents().hasClass('contentContainer')){
            $('.content').fadeOut('fast');
            $('.contentOpen').removeClass('contentOpen');
        }
    })

    $('#btnMsg').click(function(evt){
        if($('#msg').is(':hidden')){
            showSubMenu('#msg');
            $(this).addClass('contentOpen');
        }else{
            $('#msg').fadeOut('fast');
             $(this).removeClass('contentOpen');
        }
    });

    $('#btnNotify').click(function(evt){
        if($('#notify').is(':hidden')){
            showSubMenu('#notify');
            $(this).addClass('contentOpen');
        }else{
            $('#notify').fadeOut('fast');
             $(this).removeClass('contentOpen');
        }
    });

    $('#btnUser').click(function(evt){
        if($('#user-options').is(':hidden')){
            showSubMenu('#user-options');
            $(this).addClass('contentOpen');
        }else{
            $('#user-options').fadeOut('fast');
             $(this).removeClass('contentOpen');
        }
    });

    
});