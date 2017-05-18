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
                success: function (data) {
                    location.reload();
                },
                complete: function () {
                    $("#myform")[0].reset();
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


