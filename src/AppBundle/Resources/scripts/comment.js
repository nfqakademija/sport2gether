(function(){
    $('#commentSubmit').on('click',function(e){
        var comment = $('#comment').val();
        var id = $('#eventId').val();
        e.preventDefault();
        $.post({
            url:"/addComment/"+id,
            data: comment,
            error:function(err){
                console.error(err);
            },
            success:function(data){
                console.log(comment);
            },
            complete:function(){
                $("#myform")[0].reset();
            }
        });
    })
}());


