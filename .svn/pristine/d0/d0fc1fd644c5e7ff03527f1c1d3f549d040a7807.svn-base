/**
 * Created by kuke on 2016/4/26.
 */


$(function(){
    var time = 60;//初始倒计时
    //获取cookie保存的倒计时时间戳
    var cookieTime = Cookies.get('cookieTime');
    //当前时间
    var ctime = getCurrTime();
    var wait = time;

    if(cookieTime != undefined){
        if(cookieTime - ctime>0){
            //剩余时间
            wait = cookieTime - ctime;
            timeCountDown(document.getElementById('reset'),wait);
        }
    }

})

/**
 *	o 倒计时元素
 *	time 倒计时时间
 */
function timeCountDown(o,time){
    if(time > 0){

        if(!Cookies.get('cookieTime')){
            Cookies.set('cookieTime', getCurrTime()+time, { expires: time });
        }

        o.setAttribute("disabled", true);
        o.innerHTML =  time + "秒后重新发送";
        time--;
        setTimeout(function(){
            timeCountDown(o,time);
        }, 1000);
    }else{
        o.removeAttribute("disabled");
        o.innerHTML = "发送邮件";
    }
}
//获取当前时间戳
function getCurrTime(){
    var now = new Date(); //获取系统日期，即Sat Jul 29 08:24:48 UTC+0800 2006
    return Math.ceil(now.getTime()/1000);
}

function viewMail(type){
    var url = 'http://mail.'+type+'';
    window.open(url);
}

function reSendEmail(email){
    $.get('/password/reSendEmail/' + email, function(msg){
        if (msg.message == 'success'){
            $("#reSendEmail").css('color', "#ccc").unbind('click');
        }
    }, 'json')
}

$("#reset").on('click', function(){

    var email = $("#reEmail").val();
    var time=60;

    //timeCountDown(this,time);
    $.get('/user/reSendEmailAuth/' + email,function(data){
    });
})