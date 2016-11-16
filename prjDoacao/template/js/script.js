smoothScroll.init({
    selector: 'a', // Selector for links (must be a class, ID, data attribute, or element tag)
    selectorHeader: null, // Selector for fixed headers (must be a valid CSS selector) [optional]
    speed: 900, // Integer. How fast to complete the scroll in milliseconds
    easing: 'easeOutCubic', // Easing pattern to use
    offset: 0, // Integer. How far to offset the scrolling anchor location in pixels
    callback: function (anchor, toggle) {} // Function to run after scrolling
});

window.onscroll = function () {
    var $valScrollBody = document.body.scrollTop ? document.body.scrollTop : document.documentElement.scrollTop;

    if ($valScrollBody >= 500) {
        document.getElementById("Menu").style.backgroundColor = "cadetblue";
        document.getElementById("home").style.borderRadius = "0px";
    } else {
        document.getElementById("Menu").style.backgroundColor = " transparent";
        document.getElementById("home").style.borderRadius = "50px";
    }

    //if ($nav.offsetTop - $valScrollBody <= 0) {}
}

function popup() {
    document.getElementById("form").style.marginTop = "0px";
    document.getElementById("txtEmail").focus();
}

function txtFocus(opc, nome) {
    document.getElementById(nome).style.transition = "0.5s";
    switch (opc) {
    case 0:
        document.getElementById(nome).style.backgroundColor = "whitesmoke";
        document.getElementById("form-cadastrar").style.marginTop = "10px";
        break;

    case 1:
        document.getElementById(nome).style.backgroundColor = "white";
        document.getElementById("form-cadastrar").style.marginTop = "0px";
        break;
    }
}

$(function () {

    var $window = $(window); //Window object

    var scrollTime = 1; //Scroll time
    var scrollDistance = 200; //Distance. Use smaller value for shorter scroll and greater value for longer scroll

    $window.on("mousewheel DOMMouseScroll", function (event) {

        event.preventDefault();

        var delta = event.originalEvent.wheelDelta / 120 || -event.originalEvent.detail / 3;
        var scrollTop = $window.scrollTop();
        var finalScroll = scrollTop - parseInt(delta * scrollDistance);

        TweenMax.to($window, scrollTime, {
            scrollTo: {
                y: finalScroll,
                autoKill: true
            },
            ease: Power1.easeOut, //For more easing functions see http://api.greensock.com/js/com/greensock/easing/package-detail.html
            autoKill: true,
            overwrite: 20
        });

    });

});

/*
$(document).ready(function () {
    var page = $('#body'); // set to the main content of the page   
    $(window).mousewheel(function (event, delta, deltaX, deltaY) {
        if (delta < 0) page.scrollTop(page.scrollTop() + 65);
        else if (delta > 0) page.scrollTop(page.scrollTop() - 65);
        return false;
    })
});
*/