$(function(){
    $('.delete-successCase').on('click',function(){
        var id = $(this).attr('data-id');
        $('#SuccessCase_id').val(id);
    });
    //删除某一案例
    $('#delete_success').on('click',function(){
        //获取删除id
        var id = $('#SuccessCase_id').val();
        var title = $('#title').val();
        if(id){
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/user/deleteShopSuccess',
                data: {id:id},
                dataType:'json',
                success: function(data){
                    if(data.code == 1){
                        /*var caseClass = '.case'+$('#SuccessCase_id').val();
                        $(caseClass).remove();
                        $('#SuccessCase_id').val();
                        $('#myModal').modal('hide');*/
                        if(title){
                            location.href='/user/myShopSuccessCase?title='+title;
                        }else {
                            location.href='/user/myShopSuccessCase';
                        }

                    }else{
                        $.gritter.add({
                            text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                            class_name: 'gritter-info gritter-center'
                        });
                    }
                }
            });
        }

    });
});

