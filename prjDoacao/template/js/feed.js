$('document').ready(function () {
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
