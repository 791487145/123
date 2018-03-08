
var dateArr = JSON.parse($("#dateArr").attr('data-data'));
//获取横坐标日期
function getTicket(start, step){
    var ticket = new Array();
    for (i = 0; i < 7; i ++){
        ticket[i] = [start, dateArr[i]];
        start += step;
    }
    return ticket;
}
/**
 * Created by admin on 2016/5/26.
 */
//报表
//    收支表
$(function(){
    var finance = JSON.parse($("#finance").attr('data-data'));
    //数据
    var d1 = finance.in;
    var d2 = finance.out;
    var ticket = getTicket(2, 3);


    //定义样式
    var sales_charts = $('#budget-charts').css({'width':'100%' , 'height':'220px'});
    var options =  {

        hoverable: true,
        shadowSize: 0,
        series: {
            steps: { show: true },
            bars: { show: true, },
            shadowSize: 5,
            highlightColor: { color: [ "red", "red" ] }

        },
        //横坐标的样式
        xaxis: {
            ticks: ticket,
            tickLength: 0,
        },
        //竖坐标的样式
        yaxis: {

            min: 0,
            tickDecimals: 2

        },
        grid: {
            // 是否显示格子
            show: true,
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#CCC',
            clickable: true,
            hoverable: true,
        }};
    $.plot("#budget-charts", [
            { label: "收入（元）", data: d1,color: "#488c13" },
            { label: "支出（元）", data: d2,color: "#ff9500"}
        ],options
    );

    // 节点提示
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 10,
            left: x + 10,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#dfeffc',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    // 绑定提示事件
    $("#budget-charts").bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();
                var y = item.datapoint[1].toFixed(0);

                var tip = "展现量：";
                showTooltip(item.pageX, item.pageY,tip+y);
            }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
})
//    财务盈利表
$(function(){
    var finance = JSON.parse($("#finance").attr('data-data'));
    //数据
    var d1 = finance.task;
    var d2 = finance.tool;
    var ticket = getTicket(2, 3);
    //定义样式
    var sales_charts = $('#profit-charts').css({'width':'100%' , 'height':'220px'});
    var options =  {

        hoverable: true,
        shadowSize: 0,
        series: {

            steps: { show: true },
            bars: { show: true, },
            shadowSize: 5,
            highlightColor: { color: [ "red", "red" ] }

        },
        //横坐标的样式
        xaxis: {
            ticks: ticket,
            tickLength: 0,
        },
        //竖坐标的样式
        yaxis: {

            min: 0,
            tickDecimals: 2

        },
        grid: {
            // 是否显示格子
            show: true,
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#CCC',
            clickable: true,
            hoverable: true,
        }};
    $.plot("#profit-charts", [
            { label: "发布任务（元）", data: d1,color: "#ff9500"},
            { label: "增值服务（元）", data: d2,color: "#0f90da"}
        ],options
    );

    // 节点提示
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 10,
            left: x + 10,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#dfeffc',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    // 绑定提示事件
    $("#profit-charts").bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();
                var y = item.datapoint[1].toFixed(0);

                var tip = "展现量：";
                showTooltip(item.pageX, item.pageY,tip+y);
            }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
})
//    充值表
$(function(){
    var broken = JSON.parse($("#broken").attr('data-data'));
    //数据
    var d1 = broken.cash;
    var ticket = getTicket(0, 1);
    //定义样式
    var sales_charts = $('#sales-charts1').css({'width':'100%' , 'height':'220px'});
    var options =  {

        hoverable: true,
        shadowSize: 0,
        series: {

            lines: { show: true },
            points: { show: true },
            shadowSize: 5,
            highlightColor: { color: [ "red", "red" ] }

        },
        //横坐标的样式
        xaxis: {

            ticks: ticket,
            tickLength: 0,

        },
        //竖坐标的样式
        yaxis: {

            min: 0,
            tickDecimals: 2

        },
        grid: {
            // 是否显示格子
            show: true,
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#CCC',
            clickable: true,
            hoverable: true,
        }};
    $.plot("#sales-charts1", [ { label: "", data: d1,color: "#ee7951" } ],options);

    // 节点提示
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 10,
            left: x + 10,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#dfeffc',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    // 绑定提示事件
    $("#sales-charts1").bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();
                var y = item.datapoint[1].toFixed(0);

                var tip = "展现量：";
                showTooltip(item.pageX, item.pageY,tip+y);
            }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
})
//    提现表
$(function(){
    var broken = JSON.parse($("#broken").attr('data-data'));
    //数据
    var d1 = broken.out;
    var ticket = getTicket(0, 1);
    //定义样式
    var sales_charts = $('#sales-charts2').css({'width':'100%' , 'height':'220px'});
    var options =  {

        hoverable: true,
        shadowSize: 0,
        series: {
            show: true,
            lines: { show: true },
            points: { show: true },
            shadowSize: 5,
            highlightColor: { color: [ "red", "red" ] }

        },
        //横坐标的样式
        xaxis: {

            ticks: ticket,
            tickLength: 0,

        },
        //竖坐标的样式
        yaxis: {

            min: 0,
            tickDecimals: 2

        },
        grid: {
            // 是否显示格子
            show: true,
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#CCC',
            clickable: true,
            hoverable: true,
        }};
    $.plot("#sales-charts2", [ { label: "", data: d1,color: "#ee7951" } ],options);

    // 节点提示
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 10,
            left: x + 10,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#dfeffc',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    // 绑定提示事件
    $("#sales-charts2").bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();
                var y = item.datapoint[1].toFixed(0);

                var tip = "展现量：";
                showTooltip(item.pageX, item.pageY,tip+y);
            }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
})
//    任务收益表
$(function(){
    var broken = JSON.parse($("#broken").attr('data-data'));
    //数据
    var d1 = broken.task;
    var ticket = getTicket(0, 1);
    //定义样式
    var sales_charts = $('#sales-charts3').css({'width':'100%' , 'height':'220px'});
    var options =  {

        hoverable: true,
        shadowSize: 0,
        series: {

            lines: { show: true },
            points: { show: true },
            shadowSize: 5,
            highlightColor: { color: [ "red", "red" ] }

        },
        //横坐标的样式
        xaxis: {

            ticks: ticket,
            tickLength: 0,

        },
        //竖坐标的样式
        yaxis: {

            min: 0,
            tickDecimals: 2

        },
        grid: {
            // 是否显示格子
            show: true,
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#CCC',
            clickable: true,
            hoverable: true,
        }};
    $.plot("#sales-charts3", [ { label: "", data: d1,color: "#ee7951" } ],options);

    // 节点提示
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 10,
            left: x + 10,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#dfeffc',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    // 绑定提示事件
    $("#sales-charts3").bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();
                var y = item.datapoint[1].toFixed(0);

                var tip = "展现量：";
                showTooltip(item.pageX, item.pageY,tip+y);
            }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
})
//    增值收益表
$(function(){
    var broken = JSON.parse($("#broken").attr('data-data'));
    //数据
    var d1 = broken.tool;
    var ticket = getTicket(0, 1);
    //定义样式
    var sales_charts = $('#sales-charts4').css({'width':'100%' , 'height':'220px'});
    var options =  {

        hoverable: true,
        shadowSize: 0,
        series: {
            show: true,
            lines: { show: true },
            points: { show: true },
            shadowSize: 5,
            highlightColor: { color: [ "red", "red" ] }

        },
        //横坐标的样式
        xaxis: {

            ticks: ticket,
            tickLength: 0,

        },
        //竖坐标的样式
        yaxis: {

            min: 0,
            tickDecimals: 2

        },
        grid: {
            // 是否显示格子
            show: true,
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#CCC',
            clickable: true,
            hoverable: true,
        }};
    $.plot("#sales-charts4", [ { label: "", data: d1,color: "#ee7951" } ],options);

    // 节点提示
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 10,
            left: x + 10,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#dfeffc',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    // 绑定提示事件
    $("#sales-charts4").bind("plothover", function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#tooltip").remove();
                var y = item.datapoint[1].toFixed(0);

                var tip = "展现量：";
                showTooltip(item.pageX, item.pageY,tip+y);
            }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
})
