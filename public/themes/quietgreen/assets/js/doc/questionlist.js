
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

function firstCate(obj)
{
    var id = obj.val();
    if(id!=0)
    {
        $.get('/manage/ajaxCategory/'+id,function(data){
            html = "<option value=\"0\">全部<\/option>";
            if(data.errCode==1)
            {
                $.gritter.add({
                    text: '<div><span class="text-center"><h5>' + data.errMsg + '</h5></span></div>',
                    class_name: 'gritter-info gritter-center'
                });
            }else{
                for(var i=0 in data)
                {
                    html += "<option value=\""+data[i].id+"\">"+data[i].name+"<\/option>";
                }
                $('#second_category').html(html);
            }
        },'json')
    }

}

