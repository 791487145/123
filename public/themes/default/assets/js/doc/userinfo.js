$(function(){
    //$(".registerform").Validform();  //就这一行代码！;

    var demo=$(".registerform").Validform({
        tiptype:3,
        label:".label",
        showAllError:true,
        ajaxPost:false
    });



})
/**
 * 省级切换
 * @param obj
 */
function checkprovince(obj){
    var id = obj.value;
    $.get('/user/ajaxcity',{'id':id},function(data){
        var html = '';
        var area = '';
        for(var i in data.province){
            html+= "<option value=\""+data.province[i].id+"\">"+data.province[i].name+"<\/option>";
        }
        for(var s in data.area){
            area+= "<option value=\""+data.area[s].id+"\">"+data.area[s].name+"<\/option>";
        }
        $('#province_check').html(html);
        $('#area_check').html(area);
    });
}
/**
 * 市级切换
 * @param obj
 */
function checkcity(obj){
    var id = obj.value;
    $.get('/user/ajaxarea',{'id':id},function(data){
        var html = '';
        for(var i in data){
            html += "<option value=\""+data[i].id+"\">"+data[i].name+"<\/option>";
        }
        $('#area_check').html(html);
    });
}