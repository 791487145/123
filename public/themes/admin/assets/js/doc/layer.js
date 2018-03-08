
$(function() {
    //弹出失败消息
    if (success == 1 || error == 1) {
        $.gritter.add({
        //            title: '消息提示：',
            text: '<div><span class="text-center"><h5>' + message + '</h5></span></div>',
            class_name: 'gritter-info gritter-center'
        });
    }
})
