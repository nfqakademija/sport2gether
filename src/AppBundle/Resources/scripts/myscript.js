$('#btnRM').click(function(){
    $('#readmore').animate({height:'322px'}, 500);
});
$('#btnRL').click(function(){
	$('#readmore').animate({height:'0px'}, 500);
});
$('#btnRM2').click(function(){
    $('#readmore2').animate({height:'322px'}, 500);
});
$('#btnRL2').click(function(){
	$('#readmore2').animate({height:'0px'}, 500);
});

$(function () {
  $("#mydd a").on('click',function (e) {
  	e.preventDefault();
    $("#dropdownMenu1").html($(this).html() + ' <span class="downicon"></span>');
  });
});

$(function () {
  $("#mydd2 a").on('click',function (e) {
  	e.preventDefault();
    $("#dropdownMenu2").html($(this).html() + ' <span class="downicon"></span>');
  });
});
$(function () {
  $("#mydd3 a").on('click',function (e) {
  	e.preventDefault();
    $("#dropdownMenu3").html($(this).html() + ' <span class="downicon"></span>');
  });
});

$( document ).ready( function() {
        $(".button-collapse").sideNav();
    }
);