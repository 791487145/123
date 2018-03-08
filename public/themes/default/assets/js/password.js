/**
 * Created by kuke on 2016/4/27.
 */
var passwordform = $(".passwordform").Validform({
    tiptype:4,
    label:".label",
    showAllError:true,
    datatype:{
        "e":/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
    },
});

passwordform.eq(0).config({
    ajaxurl:{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }
});
passwordform.eq(1).config({
    ajaxurl:{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }
});
var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数
function sendPhoneCode(){
    curCount = count;
    var mobile = $("input[name='mobile']").val();
    if (mobile){
        InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
        var token = $('#btnSendCode').attr('token');
        $.post('/password/mobilePasswordCode',{'_token':token,'mobile':mobile}, function(msg){
            if (msg.success){
                $("#btnSendCode").attr('disabled', true);
            }
        }, 'json');
    }

}

//timer处理函数
function SetRemainTime() {
    if (curCount == 0) {
        window.clearInterval(InterValObj);//停止计时器
        $("#btnSendCode").removeAttr("disabled");//启用按钮
        $("#btnSendCode").val("重新获取");
    }
    else {
        curCount--;
        console.log(curCount);
        $("#btnSendCode").val("重新获取(" + curCount + ")");
    }
}