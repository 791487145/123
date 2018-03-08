/**
 * Created by Administrator on 2016/10/18 0018.
 */
$(function(){
    $('#reward').bind('keyup',function(){
        var money=$('#money').find('span').html();
        var balance=$(this).val();
        if(parseFloat(balance)>parseFloat(money)){
            $(this).val(parseFloat(money));
        }
    });
    /*
    $("#reward").bind("keyup",function() {
        var tmptxt=$(this).val();
        $(this).val(tmptxt.replace(/\D|^0/g,''));
    }).bind("paste",function(){

        var tmptxt=$(this).val();
        $(this).val(tmptxt.replace(/\D|^0/g,''));
    }).css("ime-mode", "disabled");*/

    var demo=$("#question_form").Validform({
        tiptype:3,
        label:".label",
        showAllError:true,
        /*ajaxPost:false,*/
        dataType:{
            'positive':/^[1-9]\d*$/,
        },
    });
})
/*
function rewar(){
    var balance=$('#reward').val();
    var questionuid=$("input[name='questionuid']").val();
    var password=$("input[name='password']").val();
    var answeruid=$("input[name='answeruid']").val();
    var questionid=$("input[name='questionid']").val();
    var answerid=$("input[name='answerid']").val();
    if(!balance){
        balance='false';
    }
    if(!password){
        password='false';
    }
    window.location.href="/question/rewar/"+answerid+'/'+questionid+'/'+questionuid+'/'+answeruid+'/'+password+'/'+balance;
}*/