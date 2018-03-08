/**
 * Created by kuke on 2016/4/22.
 */
<!--提示-->
$(function () { $("[data-toggle='tooltip']").tooltip(); });

//弹出框
$('.memberdiv').on('mouseenter', function(){
    var $this = $(this);
    var $parent = $this.closest('#user-profile-2');

    var off1 = $parent.offset();
    var w1 = $parent.width();

    var off2 = $this.offset();
    var w2 = $this.width();

    var place = 'left';
    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';

    $this.find('.popover').removeClass('right left').addClass(place);
});
/**
 * 充值表单验证
 */
var cashVal = $("input[name='cash']").val();
$(".cashform").Validform({
    btnSubmit:"#btn_sub",
    tiptype:4,
    showAllError:true,
    ajaxPost:true,
    datatype:{
        'cashValid':function(gets,obj,curform,regxp){
            var decimal = parseInt($("input[name='cash']").attr("data-recharge-min"));
                parseInt(gets);
            if(gets<decimal) {
                return false;
            }else{
                return  true;
            }
        },

    },
    callback:function(data){
        if (data.code == 200){
            window.open(data.data.url);
            $('#myModal').modal({
                keyboard: true
            });
            $("#verifyOrder").attr('data-url', '/finance/verifyOrder/' + data.data.orderCode);
        } else if (data.code == 201){
            $("#cashtips").find(".Validform_checktip").replaceWith("<span class='Validform_checktip Validform_wrong'>" + data.message + "</span>");
        }
    }
});
/**
 * 验证订单状态
 */
$("#verifyOrder").on('click',function(){
    var url = $(this).attr('data-url');
    $.get(url, function(data){
        if (data.message == 'success'){
            window.location.href = data.data.url;
        }
    }, 'json');
});

function copyUrl(){
    if($('.extendbtn input').val() != ''){
        $('.extendbtn input').select();
        document.execCommand('Copy');
        $.gritter.add({
            text: '<span class="text-size14">复制成功！</span>',
            class_name: 'gritter-info gritter-center'
        });
    }else{
        $.gritter.add({
            text: '<span class="text-size14">复制失败！复制的内容不能为空！</span>',
            class_name: 'gritter-info gritter-center'
        });
    }
}