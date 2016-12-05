/* -- ACTIONS -- */
function popupLogin(){
     $('body').css('overflow-y', 'auto');
     $('#form-login').css('max-height', '0');
     $('#blackcover').detach();
}
/* -- when main doc is ready --*/
$('document').ready(function (){

    //Login button event click
    $('#btnUser').click(function(){
        $('body').append('<div id="blackcover" onclick="popupLogin()" hidden></div>');
        $('#blackcover').fadeIn();
        $('body').css('overflow-y', 'hidden');
        $('#form-login').css('top', $('body').scrollTop());
        $('#form-login').css('max-height', '1000px');   
    });

   
});