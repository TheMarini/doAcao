/* -- when main doc is ready --*/
$('document').ready(function () {
    var altura = parseInt($('header').height()) + parseInt($('header').css('padding')) +  parseInt($('header').css('padding')) + parseInt($('#conquistas').css('height')) + parseInt($('svg').css('padding')) + parseInt($('#first-post').css('height')) + parseInt($('#first-post').css('margin-bottom'));

    $('#newsfeed').css('height', altura);
    
    $('.stat-container').click(function(){
        $(this).css('height','200px');
    });
});
