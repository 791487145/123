function firstCate(obj)
{
    var id = obj.val();
    if(id!=0)
    {
        $.get('/manage/ajaxCategory/'+id,function(data){
            html = "";
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