/**
 * Created by kuke on 2016/5/4.
 */
$(function(){

    var demo=$(".registerform").Validform({
        btnSubmit:"#btn_sub",
        tiptype:3,
        label:".label",
        showAllError:true,
        datatype:{

            "number":/^\d+(\.\d{1,2})?$/,

        },
    });

    $('.lbl-bank').on('click',function(){
        $('.lbl-bank').removeClass('lbl-active');
        $(this).addClass('lbl-active');
    });

    $('.g-recharge .cashier-alert').click(function(){
        $('.cashier-alert-cont').toggle(500);
    })

})