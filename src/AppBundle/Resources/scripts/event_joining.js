(function(){
    $('#joinEvent').on('click',function(e){
        var id = $('#joinEvent').data('id');
        e.preventDefault();
        $.post({
            url:"/attend/"+id,
            error:function(err){
                console.error(err);
            },
            success:function(data){
                console.log(data);
            },
            complete:function(){

            }
        });
    })
}());

(function(){
    $('#leaveEvent').on('click',function(e){
        var id = $('#leaveEvent').data('id');
        e.preventDefault();
        $.post({
            url:"/unattend/"+id,
            error:function(err){
                console.error(err);
            },
            success:function(data){
                console.log(data);
            },
            complete:function(){

            }
        });
    })
}());
