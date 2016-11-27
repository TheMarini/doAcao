/* -- ACTIONS -- */
function popupLogin(){
     $('body').css('overflow-y', 'auto');
     $('#blackcover').detach();
     $('#form-login').hide();
}
/* -- when main doc is ready --*/
$('document').ready(function (){

    //Login button event click
    $('#login').click(function(){
        $('body').append('<div id="blackcover" onclick="popupLogin()"></div>');
        $('body').css('overflow-y', 'hidden');
        $('#form-login').css('top', $('body').scrollTop());
        $('#form-login').show();   
    });

});