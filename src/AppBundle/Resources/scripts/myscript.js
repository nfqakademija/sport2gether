// $(function () {
//     $(".btn-findPassion").on('click',function (e) {
//
//     });
// });


$(function () {
    var $findPassion = $(".btn-findPassion");

    $findPassion.on('click', function () {
        console.log('works');

        $('html body').animate({
            scrollTop: $('#intro-newest').offset().top
        }, 500);
    });
});