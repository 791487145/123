  $("#focus_uid").click(
        function () {

            var focus_uid = $("#focus_uid").attr('focus_uid');

            var n = $("#focus_uid").text().trim();
            if(n == '加关注') {
                $.get('/bre/ajaxAdd', {'focus_uid': focus_uid}, function (data) {
                    if (data.code == 1) {
                        $("#focus_uid").attr('class', 'followed-me').html('<i class="glyphicon glyphicon-minus"></i>已关注');
                    }
                    if(data.code == 2){
                        alert('请先登录');
                    }
                });
            }
            if(n == "已关注") {
                $.get('/bre/ajaxDel', {'focus_uid': focus_uid}, function (data) {
                    if (data.code == 1) {
                        $("#focus_uid").attr('class', 'follow-me').html('<i class="glyphicon glyphicon-plus"></i>加关注');
                    }
                })
            }
        });



//联系我
$('#btn_primary').on('click',function(){
    var title = $('.title').val();
    var content = $('.content').val();
    var js_id = $('.js_id').val();
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
                location.reload();
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

