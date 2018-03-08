$(function(){
    //$(window).scroll(function () {
    //    var scrollTop = $(document).scrollTop();
    //    $('.header-top').css('top',scrollTop + "px");
    //    if ($(window).scrollTop() >= $('section').offset().top) {
    //        $('.header-top').css('display','block');
    //    }else{
    //        $('.header-top').css('display','none');
    //    }
    //});
    $('.g-taskmaintime').on('click',function(){
        if($(this).find('.fa').prop('class') == 'fa fa-long-arrow-down'){
            $(this).find('.fa').prop('class','fa fa-long-arrow-up');
            return;
        }else{
            $(this).find('.fa').prop('class','fa fa-long-arrow-down');
            return;
        }
    });
    var demo=$(".registerform").Validform({
        tiptype:3,
        label:".label",
        showAllError:true,
        ajaxPost:false
    });
    var allow = 0;
    $('.u-collect').on('click',function(){
        var collect = $(this);
        var task_id = $(this).attr('data-id');
        var type = $(this).attr('data-values');
        if(task_id && type && allow==0){
            allow=1;
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/task/collectionTask',
                data: {task_id:task_id,type:type},
                dataType:'json',
                success: function(data){
                    if(data.code == 1){
                       if(type == 1){
                           $.gritter.add({
                               //            title: '消息提示：',
                               text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                               class_name: 'gritter-info gritter-center'
                           });
                           collect.attr('data-values',2);
                           collect.attr('style','color: rgb(255, 168, 30);');
                       }else{
                           $.gritter.add({
                               //            title: '消息提示：',
                               text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                               class_name: 'gritter-info gritter-center'
                           });
                           collect.attr('data-values',1);
                           collect.attr('style','');
                       }
                    }else{
                        $.gritter.add({
                            //            title: '消息提示：',
                            text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                            class_name: 'gritter-info gritter-center'
                        });
                    }
                    allow=0;
                }
            });
        }
    });
});