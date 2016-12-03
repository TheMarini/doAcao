/* -- when main doc is ready --*/
$('document').ready(function () {

    /*First post together to header*/
    var altura = parseInt($('header').height()) + parseInt($('header').css('padding')) + parseInt($('header').css('padding')) + parseInt($('#conquistas').css('height')) + parseInt($('svg').css('padding')) + parseInt($('#first-post').css('height')) + parseInt($('#first-post').css('margin-bottom'));

    $('#newsfeed').css('height', altura);

    /*Expand aside*/
    var AlturaOriginal = parseInt($('.stat-container').css('height'));
    var AlturaReduzida = AlturaOriginal - 67;

    $('.stat-container').css('height', AlturaReduzida);

    $('.stat-container').click(function () {
        $(this).css('height', AlturaOriginal);
        $(this).css('border-bottom', '2px solid gray');
    });

    $('.stat-container').mouseover(function () {
        $(this).css('height', AlturaOriginal);
        $(this).css('border-bottom', '2px solid gray');
    });

    $('.stat-container').mouseout(function () {
        $(this).css('height', AlturaReduzida);
        $(this).css('border-bottom', 'none');
    });
});
