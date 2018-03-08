/**
 * Created by kuke on 2016/4/28.
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

})