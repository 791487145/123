function ajaxMyTask(obj)
{
    $.get(obj.attr('url'),function(data)
    {
        var html = '';
        for(var i=0;i<data.my_tasks.length;i++)
        {
            if(i!=0) {
               html += "<li class=\"g-reletimeper\"><div class=\"g-reletimebor\"><span>"+data.my_tasks[i].times.taskaxis_year+"<\/span>"+data.my_tasks[i].times.taskaxis_month+"月<\/div><\/li>" ;
            }

            for(var s in data.my_tasks[i].datas) {
                html += "<li class=\"row\"><div class=\"col-md-10 g-userborbtm\"><\/div><div class=\"g-reletimeli\"><b>"+data.my_tasks[i].datas[s].task_axis_time+"" +
                "<\/b><span><i><\/i><\/span><\/div><div class=\"col-md-1\"><img src=\""+data.domain+'/'+data.my_tasks[i].datas[s].avatar+"\" onerror=\""+data.domain+'/'+data.my_tasks[i].datas[s].avatar+",$(this))\"><\/div>" +
                "<div class=\"col-md-11\"><div class=\"col-md-9\"><div class=\"text-size14 cor-gray51\"><span class=\"cor-orange\">￥"+data.my_tasks[i].datas[s].bounty+"<\/span> " +
                "<a href=\"#\">"+data.my_tasks[i].datas[s].title+"<\/a> | "+data.my_tasks[i].datas[s].status_text+"<\/div><div class=\"space-4\"><\/div><p class=\"cor-gray87\"><i class=\"ace-icon fa fa-user bigger-110\"><\/i>"+data.my_tasks[i].datas[s].nickname+"" +
                "<i class=\"fa fa-eye\"><\/i> "+data.my_tasks[i].datas[s].view_count+"人浏览/"+data.my_tasks[i].datas[s].delivery_count+"人投稿 <i class=\"fa fa-clock-o\"><\/i> " +
                ""+data.my_tasks[i].datas[s].task_axis_endat+"天前 <i class=\"fa fa-unlock-alt\"><\/i>" ;
                if(data.my_tasks[i].datas[s].bounty_status==1)
                {
                    html += "已托管赏金<\/p>" ;
                }else
                {
                    html += "待托管赏金<\/p>" ;
                }

                html += "<div class=\"space-4\"><\/div><p class=\"cor-gray51\">"+data.my_tasks[i].datas[s].desc+"<\/p><div class=\"g-userlabel\"><a href=\"#\">"+data.my_tasks[i].datas[s].cate_name+"<\/a>" +
                "<a href=\"#\">湖北武汉<\/a><\/div><\/div><div class=\"col-md-3 text-right\"><a class=\"btn-big bg-blue bor-radius2\" href=\"/task/"+data.my_tasks[i].datas[s].id+"\">查看<\/a><\/div><\/div><\/li>";

            }
        }
        $('#task_axis').html(html);
        if(data.pagesize>data.total_num)
        {
            $('#next_page').remove();
        }
    })
}