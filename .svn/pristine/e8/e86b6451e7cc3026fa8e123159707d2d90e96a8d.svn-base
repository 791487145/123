$(function(){
    //删除成功案例
    $('.delete').on('click',function(){
        var id = $(this).attr('data-values');
        $('#success_case_id').val(id);
    });
    $('#delete_success').on('click',function(){
        var id =  $('#success_case_id').val();
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/ajaxDeleteSuccess',
            data: {id:id},
            dataType:'json',
            success: function(data){
                if(data.code == 1){
                    //$.gritter.add({
                    //    //            title: '消息提示：',
                    //    text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                    //    class_name: 'gritter-info gritter-center'
                    //});
                    window.location.reload();
                }else{
                    $.gritter.add({
                        //            title: '消息提示：',
                        text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                        class_name: 'gritter-info gritter-center'
                    });
                }
            }
        });
    });

});
