
$(function(){
    $('.answerlist-btn').on('click',function(){
        var adoptid=$(this).find("input[name='adoptid']").val();
        var questionid=$("input[name='questionid']").val();
        $('#btn_primary').on('click',function(){
            window.location.href="adopt/"+adoptid+'/'+questionid;
        });
    });
    $('.answerlist-clickup').on('mouseover',function(){
        $(this).find('.answerlist-addnum').html($(this).ans_addnumtxt);
        $(this).find('.answerlist-addzan').css('display','inline-block');
        $(this).find('.answerlist-addnum').css('display','none');

    }).on('mouseout',function(){
        $(this).find('.answerlist-addnum').html($(this).ans_addnum);
        $(this).find('.answerlist-addzan').css('display','none');
        $(this).find('.answerlist-addnum').css('display','inline-block');
    }).on('click',function(){
        var status = $(this).attr('status');
        if(status==0) {
            var num = $(this).find('.answerlist-addnum').html();
            var uid = $("input[name='uid']").val();
            var questionid = $("input[name='questionid']").val();
            var answerid = $(this).find("input[name='answerid']").val();
            var status = $(this).attr('status');
            $.get('addpraise/' + num + '/' + uid + '/' + answerid + '/' + questionid, function (msg) {
            }, 'json')
        }
        if(status==0){
            $(this).find('.answerlist-add').addClass('answerlist-addup');
            $(this).find('.answerlist-addnum').html(parseInt($(this).find('.answerlist-addnum').html())+1);
            $(this).find('.answerlist-addzan').html('已赞');
            $(this).find('.answerlist-addnum').html($(this).ans_addnumtxt);
            $(this).off('click');
        }
    });
    $('.answerlist-clickups').on('mouseover',function(){
        var status = $(this).attr('status');
        if(status==0) {
            $(this).find('.answerlist-addnum').html($(this).ans_addnumtxt);

            $(this).find('.answerlist-addzan').css('display','inline-block');
            $(this).find('.answerlist-addnum').css('display','none');
        }
    }).on('mouseout',function(){
        var status = $(this).attr('status');
        if(status==0) {
            $(this).find('.answerlist-addnum').html($(this).ans_addnum);
            $(this).find('.answerlist-addzan').css('display', 'none');
            $(this).find('.answerlist-addnum').css('display', 'inline-block');
        }
    }).on('click',function(){
        var status = $(this).attr('status');
        if(status==0) {
            $(this).find('.answerlist-add').addClass('answerlist-addup');
            $(this).find('.answerlist-addnum').html(parseInt($(this).find('.answerlist-addnum').html())+1);
            $(this).find('.answerlist-addzan').html('去打赏');
            $(this).find('.answerlist-addnum').html($(this).ans_addnumtxt);
            $(this).off('click');
        }
    });
});

/*function clickUp(obj,el,aClass,add,addUp,txt){
 $(obj).on('mouseover',function(){
 $(this).find(el).html($(this).ans_addnumtxt);
 $(this).find(aClass).css('display','inline-block');
 $(this).find(el).css('display','none');
 }).on('mouseout',function(){
 $(this).find(el).html($(this).ans_addnum);
 $(this).find(aClass).css('display','none');
 $(this).find(el).css('display','inline-block');
 }).on('click',function(){
 $(this).find(add).addClass(addUp);
 $(this).find(el).html( parseInt($(this).find(el).html()) + 1 );
 $(this).find(aClass).html(txt);
 $(this).find(el).html($(this).ans_addnumtxt);
 $(this).off('click');
 })
 }

 clickUp('.answerlist-clickups','.answerlist-addnum','.answerlist-addzan','.answerlist-add','answerlist-addup','已打赏');
 clickUp('.answerlist-clickup','.answerlist-addnum','.answerlist-addzan','.answerlist-add','answerlist-addup','已赞');*/

var uid=$("input[name='uid']").val();
var answeruid= $("input[name='answeruid']").val();
if(uid==answeruid){
    $('.answerlist-clickup').off('click');
}

/*  var uid=$("input[name='uid']").val();
 var answeruid= $("input[name='answeruid']").val();
 if(uid==answeruid){
 $('.answerlist-clickup').off('click');
 }*/

