function removeFocus(id)
{
    $.get('/user/userFocusDelete/'+id,function(data){
        if(data.errCode==1){
            $('#focus-remove-'+data.id).remove();
            $('.modal-backdrop').hide();
        }
    });

}

function notFocus(obj)
{
    var id = obj.attr('uid');
    $.get('/user/userNotFocus/'+id,function(data){
        if(data.errCode==1){
            obj.html('关注他');
        }else if(data.errCode==0)
        {
            $.gritter.add({
                text: '<div><span class="text-center"><h5>' + '操作失败' + '</h5></span></div>',
                class_name: 'gritter-info gritter-center'
            });
        }
    });
}
function doFocus(obj)
{
    var id = obj.attr('uid');
    var type = obj.attr('type');
    if(type==1){
        $.get('/bre/ajaxAdd',{'focus_uid': id},function(data){
            if(data.code==1){
                obj.html('取消关注');
                obj.attr('type',2);
            }
        });
    }else if(type==2)
    {
        $.get('/user/userNotFocus/'+id,function(data){
            if(data.errCode==1){
                obj.html('关注他');
                obj.attr('type',1);
            }else if(data.errCode==0)
            {
                $.gritter.add({
                    text: '<div><span class="text-center"><h5>' + '操作失败' + '</h5></span></div>',
                    class_name: 'gritter-info gritter-center'
                });
            }
        });
    }

}
