/**
 * Created by kuke on 2016/4/27.
 */
var demo=$(".registerform").Validform({
    tiptype:3,
    label:".label",
    showAllError:true,
});


demo.addRule([
    {
        ele:".inputxt:eq(0)",
        datatype:"*6-15"
    },
    {
        ele:".inputxt:eq(1)",
        datatype:"*",
        recheck:"password"
    }]);