//选择支付方式
function changePayType(obj){
    var payType = $(obj).val();
    var task_id = $('input[name="task_id"]').val();
    if(payType == 4){
        $("#payTypeAppend").show();
        var pay_type_append = $("input[name=pay_type_append]").val();
        var payTypeAppend = pay_type_append.split(":");
        if(payTypeAppend[0]){
            $.get('/task/ajaxPaySection',{type:payType,task_id:task_id,pay_type_append:payTypeAppend},function(data){
                if(data.status == 'success'){
                    $(".pay-section-list").html('').html(data.html);
                }
            });
        }
    }else{
        $("#payTypeAppend").hide();
        $.get('/task/ajaxPaySection',{type:payType,task_id:task_id},function(data){
            if(data.status == 'success'){
                $(".pay-section-list").html('').html(data.html);
            }
        });
    }
}


//自定义支付方式
function getAppendInput(obj){
    var task_id = $('input[name="task_id"]').val();
    var pay_type_append = $(obj).val();
    var message = checkPayTypeAppend(pay_type_append);
    if(message){
        alert(message);return false;
    }
    pay_type_append = formatePayTypeAppend(pay_type_append);
    $.get("/task/ajaxPaySection",{type:4,task_id:task_id,pay_type_append:pay_type_append},function(data){
        if(data.status == 'success'){
            $(".pay-section-list").html('').html(data.html);
        }
    })
}



//检测自定义输入的比例
function checkPayTypeAppend(pay_type_append){
    var payTypeAppend;
    var message = '';
    payTypeAppend = formatePayTypeAppend(pay_type_append);
    var num = 0;
    if(payTypeAppend.length > 4){
        message = "最多支持4个阶段的支付比例";
    }
    for(var i=0;i<payTypeAppend.length;i++){
        num += parseInt(payTypeAppend[i]);
    }
    if(num != 100){
        message = '自定义比例总和应为100';
    }

    return message;
}

//格式化参数
function formatePayTypeAppend(pay_type_append)
{
    var payTypeAppend = [];
    //以英文半角:来区分
    if(pay_type_append.split("：").length == 1){
        payTypeAppend = pay_type_append.split(":");
    }else{
        payTypeAppend = pay_type_append.split("：");
    }
    //以中文半角：来区分
    if(pay_type_append.split(":").length == 1){
        payTypeAppend = pay_type_append.split("：");
    }else{
        payTypeAppend = pay_type_append.split(":");
    }
    return payTypeAppend;
}

