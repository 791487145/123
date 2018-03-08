
window.onload = function(){
    //var demo=$(".registerform").Validform({
    //    tiptype:3,
    //    label:".label",
    //    showAllError:true,
    //    ajaxPost:false
    //});


};
$(".paypassword-form").Validform({
    tiptype:3,
    label:".label",
    showAllError:true,
    ajaxPost:false
});

var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数

function sendMessage(email) {
    curCount = count;
    //设置button效果，开始计时
    $("#btnSendCode").attr("disabled", "true");
    $("#btnSendCode").val("" + curCount + "s后重新发送");
    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
    var token = $('#form-field-2').attr('token');
    $.post('/user/sendEmail',{'_token':token,'email':email},function(data){
        if(data.errCode==1){
            $('#btnSendCode').next('span').attr('class','Validform_checktip Validform_right');
            $('#btnSendCode').next('span').html('邮件发送成功！');
        }else{
            $('#btnSendCode').next('span').attr('class','Validform_checktip Validform_wrong');
            $('#btnSendCode').next('span').html(data.errMsg);
        }
    });
}

//timer处理函数
function SetRemainTime() {
    if (curCount == 0) {
        window.clearInterval(InterValObj);//停止计时器
        $("#btnSendCode").removeAttr("disabled");//启用按钮
        $("#btnSendCode").val("重新发送验证码");
    }
    else {
        curCount--;
        $("#btnSendCode").val("" + curCount + "s后重新发送");
    }
}
//发送验证码
$('#btnSendCode').click(function()
{
    var email = $('#form-field-2').val();
    var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    if(myreg.test(email))
    {
        var token = $('#form-field-2').attr('token');
        $.post('/user/checkEmail',{'_token':token,'email':email},function(data){
            if(data.errCode==1){
                sendMessage(email);
            }else{
                $('#btnSendCode').next('div').attr('class','Validform_checktip Validform_wrong');
                $('#btnSendCode').next('div').html(data.errMsg);
            }
        });

    }
});

window.onload = function(){
    $.get('/user/checkInterVal',function(data){
        if(data.errCode==1){//继续计时
            curCount = data.interValTime;
            //设置button效果，开始计时
            $("#btnSendCode").attr("disabled", "true");
            $("#btnSendCode").val("" + curCount + "s后重新发送");
            InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
        }else if(data.errCode==3){
            $("#btnSendCode").removeAttr("disabled");//启用按钮
            $("#btnSendCode").val("发送验证码");
        }else{
            $("#btnSendCode").removeAttr("disabled");//启用按钮
            $("#btnSendCode").val("重新发送验证码");
        }
    });
};


