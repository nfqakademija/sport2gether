$(function () {
    var $findPassion = $(".btn-findPassion");

    $findPassion.on('click', function () {

        $('html, body').animate({
            scrollTop: $('#intro-newest').offset().top
        }, 500);
    });
});
// on touch screen replace background video with image
$(function() {
    /** global: navigator */
    var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;

    if ( supportsTouch ) {
        $('.video video').css('display', 'none');
        $('.video-fallback').css('display', 'block');
    } else {
        $('.video video').css('display', 'block');
        $('.video-fallback').css('display', 'none');
    }
});

$(function() {
    checkSize();

    $(window).resize(checkSize);

});

//Function to the css rule
function checkSize(){
    if (window.matchMedia('(max-width: 767px)').matches) {
        $('.transparent-header').css('position', 'relative');

        $('.topnavbar').css('backgroundColor', 'white');

        $('.header-logo').addClass('header-logo--black');
        $('.header-logo').removeClass('header-logo--white');

        $('.myEventLink').addClass('myEventLink--black');
        $('.myEventLink--black').removeClass('myEventLink');

        $('.navbar-nav').css('height', 'auto');
    } else if ($('.intro-header').html()) {
        $('.transparent-header').css('position', 'absolute');

        $('.topnavbar').css('backgroundColor', 'transparent');

        $('.header-logo').addClass('header-logo--white');
        $('.header-logo').removeClass('header-logo--black');

        $('.myEventLink--black').addClass('myEventLink');
        $('.myEventLink').removeClass('myEventLink--black');

    }
}

