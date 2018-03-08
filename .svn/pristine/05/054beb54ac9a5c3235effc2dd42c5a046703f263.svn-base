
var maxDay = JSON.parse($("#maxDay").attr('data-data'));
var broken = JSON.parse($("#broken").attr('data-data'));
var dateArr = JSON.parse($("#dateArr").attr('data-data'));
//获取横坐标日期
function getTicket(start, step){
    var ticket = new Array();
    for (i = 0; i < maxDay; i ++){
        ticket[i] = [start, dateArr[i]];
        start += step;
    }
    return ticket;
}
//    图
jQuery(function($) {


    $('.sparkline.sparklineBar-blue').each(function(){
        var $box = $(this).closest('.infobox');
        var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
        $(this).sparkline('html',
            {
                tagValuesAttribute:'data-values',
                type: 'bar',
                barColor: '#4fb9f0' ,
                chartRangeMin:$(this).data('min') || 0
            });
    });
    $('.sparkline.sparklineLine-gray').each(function(){
        var $box = $(this).closest('.infobox');
        var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
        $(this).sparkline('html',
            {
                tagValuesAttribute:'data-values',
                type: 'line',
                lineColor: '#787878' ,
                width:'100%',
                chartRangeMin:$(this).data('min') || 0,
                FillColour: '#cccccc'
            });
    });
    $('.sparkline.sparklineBar-red').each(function(){
        var $box = $(this).closest('.infobox');
        var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
        $(this).sparkline('html',
            {
                tagValuesAttribute:'data-values',
                type: 'bar',
                barColor: '#ba1e20' ,
                width:'100%',
                chartRangeMin:$(this).data('min') || 0,
                FillColour: '#cccccc'
            });
    });
    $('.sparkline.sparklineLine-green').each(function(){
        var $box = $(this).closest('.infobox');
        var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
        $(this).sparkline('html',
            {
                tagValuesAttribute:'data-values',
                type: 'line',
                lineColor: '#787878' ,
                width:'100%',
                chartRangeMin:$(this).data('min') || 0,
                FillColour: '#ccc',
                SpotColour:false,
                MinSpotColour:false,
                MaxSpotColour:false
            });
    });

    //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
    //but sometimes it brings up errors with normal resize event handlers


});
//        任务统计
$(function(){
    $.resize.throttleWindow = false;
    var d1 = [];
    for (var i = 0; i < maxDay; i++) {
        d1.push([i, broken.task.failTask[i]]);
    }

    var d2 = [];
    for (var i = 0; i < maxDay; i++) {
        d2.push([i, broken.task.successTask[i]]);
    }

    var tick = getTicket(0, 1);

    var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'325px'});
    $.plot("#sales-charts", [
        { label: "失败的任务", data: d1,color:'#ee7951' },
        { label: "成功的任务", data: d2 ,color:'#4fb9f0'},
    ], {
        hoverable: true,
        shadowSize: 0,
        series: {
            lines: { show: true },
            points: { show: true }
        },
        xaxis: {
            ticks: tick,
            tickLength: 0
        },
        yaxis: {
            min: 0,
            tickDecimals: 0
        },
        grid: {
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#CCC',
            clickable: true,
            hoverable: true,
        }
    });

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
    $("#sales-charts").bind("plothover", function (event, pos, item) {
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

//        用户统计
$(function(){
    $.resize.throttleWindow = false;

    var d1 = [];
    for (var i = 0; i < maxDay; i ++) {
        d1.push([i, broken.user[i]]);
    }
    var tick = getTicket(0, 1);
    var sales_charts = $('#sales-charts1').css({'width':'100%' , 'height':'325px'});
    $.plot("#sales-charts1", [
        { label: "注册用户量", data: d1,color:'#ee7951' }
    ], {
        hoverable: true,
        shadowSize: 0,
        series: {
            lines: { show: true },
            points: { show: true }
        },
        xaxis: {
            ticks: tick,
            tickLength: 0
        },
        yaxis: {
            min: 0,
            tickDecimals: 0
        },
        grid: {
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#CCC',
            clickable: true,
            hoverable: true,
        }
    });

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

//        财务统计
$(function(){
    $.resize.throttleWindow = false;

    var d1 = [];
    for (var i = 0; i < maxDay; i ++) {
        d1.push([i, broken.finance.out[i]]);
    }

    var d2 = [];
    for (var i = 0; i < maxDay; i ++) {
        d2.push([i, broken.finance.in[i]]);
    }


    var tick = getTicket(0, 1);
    var sales_charts = $('#sales-charts2').css({'width':'100%' , 'height':'325px'});
    $.plot("#sales-charts2", [
        { label: "提现", data: d1,color:'#ee7951' },
        { label: "充值", data: d2 ,color:'#4fb9f0'},
    ], {
        hoverable: true,
        shadowSize: 0,
        series: {
            lines: { show: true },
            points: { show: true }
        },
        xaxis: {
            ticks: tick,
            tickLength: 0
        },
        yaxis: {
            min: 0,
            tickDecimals: 2
        },
        grid: {
            backgroundColor: { colors: [ "#fff", "#fff" ] },
            borderWidth: 1,
            borderColor:'#CCC',
            clickable: true,
            hoverable: true,
        }
    });

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