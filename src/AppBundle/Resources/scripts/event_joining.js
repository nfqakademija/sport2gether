(function(){
    $('#joinEvent').on('click',function(e){
        var url = $('#joinEvent').data('url');
        e.preventDefault();
        $.post({
            url: url,
            error:function(err){
                console.error(err);
            },
            success:function(){
                location.reload();
            },
            complete:function(){

            }
        });
    })
}());

(function(){
    $('#leaveEvent').on('click',function(e){
        var url = $('#leaveEvent').data('url');
        e.preventDefault();
        $.post({
            url: url,
            error:function(err){
                console.error(err);
            },
            success:function(){
                location.reload();
            },
            complete:function(){

            }
        });
    })
}());
