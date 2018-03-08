/**
 * Created by Administrator on 2016/10/10 0010.
 */


$(function(){
    $('#pid').change(
        function(){
           var i= $('#pid').val();
           $.get('child/' + i, function(msg){
               $('#child').children('option').remove();
                  for(var a=0;a<msg.length;a++){
                        $('#child').append("<option value="+msg[a].id+">"+msg[a].name+"</option>");
                  }
               },'json'
           )
        }
    )
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

/*获得字符串实际长度*/
/*var GetLength = function() {
    var realLength = 0, len = str.length, charCode = -1;
    for( var i = 0; i<len; i++ ) {
        charCode = str.charCodeAt[i];
        if( charCode >= 0 && charCode<= 128 ) realLength += 1;
        else ralLength += 2;
    }
    return realLength;
}
/!*截取字符串*!/
function cutstr( str,len ) {
    var str_length = 0;
    var str_len = 0;
    str_cut = new String();
    str_len = str.length;
    for( var i = 0; i<str_len;i++ ){
        a = str.charAt(i);
        str_length++;
        if( escape(e).length > 4 ){
            str_length++;
        }
        str_cut = str_cut.concat(a);
        if( str_length >= len ){
            str_cut = str_cut.concat('...');
            return str_cut;
        }
    }
    if( str_lentgh <len ){
        return str;
    }
}

$(function(){
    $('textarea').bind('keyup',function() {
        if( GetLength($(this).val()) > 200 ) {
            console.log($(this).val(cutstr($(this).val(),200)))
        }
    })
})*/

function cutstr(obj,str,max,min) {
    //$('button').attr('disabled',true);
    $(obj).keyup(function(){
        var content_len = $(this).val().length;
        //$(str).text(max - content_len);
        if( content_len > max ){
            var num = $(obj).val().substr(0,max);
            $(obj).val(num);
            //$('button').attr('disabled',true);
        }else{
            $(str).text(0 + content_len);
            //$(str).text(max - content_len);
            //$('button').attr('disabled',false);
        }
    })
}
cutstr('#txtarea','#result','200','5');



