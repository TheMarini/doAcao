/* -- when main doc is ready --*/
$('document').ready(function () {


    /*First post together to header*/
    var altura = parseInt($('header').height()) + parseInt($('header').css('padding')) + parseInt($('header').css('padding')) + parseInt($('#conquistas').css('height')) + parseInt($('svg').css('padding')) + parseInt($('#first-post').css('height')) + parseInt($('#first-post').css('margin-bottom'));

    $('#newsfeed').css('height', altura);

    /*Expand aside*/
    var aside_orig = parseInt($('.stat-container').css('height'));
    var aside_redu = aside_orig - 140;

    $('.stat-container').css('height', aside_redu);

    $('.stat-container').click(function () {
        $(this).css('height', aside_orig);
        $(this).css('border-bottom', '2px solid gray');
    });

    $('.stat-container').mouseover(function () {
        $(this).css('height', aside_orig);
        $(this).css('border-bottom', '2px solid gray');
    });

    $('.stat-container').mouseout(function () {
        $(this).css('height', aside_redu);
        $(this).css('border-bottom', 'none');
    });

    /*Opacity post-img*/
    $('.post-img').mouseover(function () {
        $(this).find('.autor').css('opacity', 1);
        $(this).find('.time').css('opacity', 1);
    });

    $('.post-img').mouseout(function () {
        $(this).find('.autor').css('opacity', 0.2);
        $(this).find('.time').css('opacity', 0.2);
    });
});
