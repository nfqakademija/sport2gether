(function(){
    $('#commentSubmit').on('click',function(e){
        var data = $('#myform').serialize();
        var comment = $('#comment').val();
        var id = $('#eventId').val();
        e.preventDefault();
        if(comment) {
            $.post({
                url: "/addComment/" + id,
                data: data,
                error: function (err) {
                    if(err.status==400){
                        $('.js-verify').removeClass('hidden');
                    };
                },
                success: function () {
                    location.reload();
                },
                complete: function () {

                }
            });
        }
        else {
            $('#comment').focus();
        }
    })
}());
function enableButton(){
    document.getElementById('commentSubmit').removeAttribute('disabled');
}
(function(){
    $(".js-comment").keyup(function() {
        var maxLen = $(this).attr('maxlength');
        var currentLen = $(this).val().length;
        if (maxLen == currentLen)
        {
            $('.js-toomany').removeClass('hidden');
        }
    });
}())


