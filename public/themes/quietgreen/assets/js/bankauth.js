/**
 * Created by kuke on 2016/4/27.
 */
var demo=$(".registerform").Validform({
    tiptype:3,
    label:".label",
    showAllError:true,
    datatype:{
        "zh4-20":/^[\u4E00-\u9FA5\uf900-\ufa2d]{4,20}$/,
        "n16-19":/^\d{16,19}$/,
    },
});