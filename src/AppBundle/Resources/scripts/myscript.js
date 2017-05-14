$(function () {
    var $findPassion = $(".btn-findPassion");

    $findPassion.on('click', function () {
        console.log('works');

        $('html body').animate({
            scrollTop: $('#intro-newest').offset().top
        }, 500);
    });
});

$(function() {
    var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;

    if ( supportsTouch ) {
        $('.video video').css('display', 'none');
        $('.video-fallback').css('display', 'block');
    } else {
        $('.video-fallback').css('display', 'none');
    }
});