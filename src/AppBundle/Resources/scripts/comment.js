(function(){
    $('#commentSubmit').on('click',function(e){
        var comment = $('#comment').val();
        var id = $('#eventId').val();
        e.preventDefault();
        if(comment) {
            $.post({
                url: "/addComment/" + id,
                data: comment,
                error: function (err) {
                    console.error(err);
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


