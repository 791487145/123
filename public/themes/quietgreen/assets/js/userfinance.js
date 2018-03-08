/**
 * Created by kuke on 2016/5/6.
 */

$('.input-daterange').datepicker({autoclose:true});


var financeExport = function(){
    var start = $("input[name = 'start']").val();
    var end = $("input[name = 'end']").val();
    var param = 'start=' + dateToTimestamp(start) + '&end=' + dateToTimestamp(end);
    var url = document.domain + '/manage/financeListExport/' + escape(param);
    window.open('http://' + url);
}

var userFinanceExport = function(){
    var start = $("input[name = 'start']").val();
    var end = $("input[name = 'end']").val();
    var username = $("input[name = 'username']").val();
    var action = $("#action").val();
    var param = 'start=' + dateToTimestamp(start) + '&end=' + dateToTimestamp(end) + '&uid=' + uid + '&username=' + username + '&order=' + order + '&by=' + by + '&action=' + action;
    var url = document.domain + '/manage/userFinanceListExport/' + escape(param);
    window.open('http://' + url);
}

function dateToTimestamp(date)
{
    return new Date(date).getTime()
}