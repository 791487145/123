/**
 * Created by admin on 2016/5/24.
 */

    //or change it into a date range picker date-picker 时间
$('.input-daterange').datepicker({autoclose:true});


var rechargeExport = function(){
    var start = $("input[name = 'start']").val();
    var end = $("input[name = 'end']").val();
    var type = $("#type").val();
    var param = 'start=' + start + '&end=' + end + '&type=' + type;
    var url = document.domain + '/manage/financeRechargeExport/' + param;
    window.open('http://' + url);
}

var financeWithdrawExport = function(){
    var start = $("input[name = 'start']").val();
    var end = $("input[name = 'end']").val();
    var type = $("#type").val();
    var param = 'start=' + start + '&end=' + end + '&type=' + type;
    var url = document.domain + '/manage/financeWithdrawExport/' + param;
    window.open('http://' + url);
}