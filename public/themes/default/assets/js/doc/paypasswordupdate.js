$(function(){
    //$(".registerform").Validform();  //就这一行代码！;

    var demo = $(".registerform").Validform({
        tiptype:2,
        usePlugin:{
            passwordstrength:{
                minLen:6,
                maxLen:18
            }
        }
    });

})