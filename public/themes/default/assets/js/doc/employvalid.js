$(function()
{
    var demo=$(".registerform").Validform({
        tiptype:3,
        showAllError:true,
        datatype:{

        },
        ajaxPost:false,
    });
    demo.eq(0).config({
        ajaxurl:{
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        }
    });
    demo.check(false);
    $('#focus_uid').on('click',function()
    {
        var focus_uid = $("#focus_uid").attr('focus_uid');

        var n = $("#focus_uid").text().trim();
        if(n == '加关注') {
            $.get('/bre/ajaxAdd', {'focus_uid': focus_uid}, function (data) {
                if (data.code == 1) {
                    $("#focus_uid").attr('class', 'followed-me').html('已关注');
                }
                if(data.code == 2){
                    alert('请先登录');
                }
            });
        }
        if(n == "已关注") {
            $.get('/bre/ajaxDel', {'focus_uid': focus_uid}, function (data) {
                if (data.code == 1) {
                    $("#focus_uid").attr('class', 'follow-me').html('加关注');
                }
            })
        }
    });
    $('#editor1').on('blur',function()
    {
        demo.check(false,'#discription-edit');
    });

    $('#datepiker-begin').on('hide',function()
    {
        demo.check(false,'#datepiker-begin');
    });
    $('#exampleInputName2').on('change',function(){
        demo.eq(0).config({
            ajaxurl:{
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:{
                    'param':$('#exampleInputName2').val()
                }
            }
        });
    });
    //在提交的时候验证
    $('#formsubmit').on('click',function(){
        demo.eq(0).config({
            ajaxurl:{
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:{
                    'param':$('#exampleInputName2').val()
                }
            }
        });
    });

    //验证描述是否为空
    ue.addListener('blur',function(editor){
        var content = ue.getContent();
        $('#discription-edit').val(content);
        demo.check(false,'#discription-edit');
    });
});

$('#datepiker-begin').datepicker({
    autoclose: true,
    startDate: '+1d',
    language:'zh-CN',
});



//联系雇主
$('#contactMe').on('click',function(){
    var title = $('.title').val();
    var content = $('.content').val();
    var js_id = $('#contactMeId').val();
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/bre/contactMe',
        data: {title:title,content:content,js_id:js_id},
        dataType:'json',
        success: function(data){
            if(data.code == 1){
                $('#contactMeCancel').trigger('click');
                $.gritter.add({
                    //            title: '消息提示：',
                    text: '<div><span class="text-center"><h5>' + '消息发送成功！' + '</h5></span></div>',
                    class_name: 'gritter-info gritter-center'
                });
            }else{
                $('#contactMeCancel').trigger('click');
                $.gritter.add({
                    //            title: '消息提示：',
                    text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                    class_name: 'gritter-info gritter-center'
                });
            }
        }
    });
});

$('.contactHe').on('click',function(){
    var js_id = $(this).attr('data-values');
    $('#contactHeId').val(js_id);
});

function winBid(obj)
{
    var id = obj.attr('taget_id');
    var url = $('#'+id).attr('url');
    window.location = url;
}

