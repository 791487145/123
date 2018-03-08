jQuery(function($) {
    $('.send_email').on('click',function(){
        var email = $(this).siblings().val();
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/manage/config/sendEmail',
            data: {email:email},
            dataType:'json',
            success: function(data){
                if(data.code == 1){
                    $.gritter.add({
                        //            title: '消息提示：',
                        text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                        class_name: 'gritter-info gritter-center'
                    });
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

})