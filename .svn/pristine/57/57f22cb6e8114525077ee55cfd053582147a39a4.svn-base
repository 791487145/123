$(function() {

    //  布局  侧栏高度同等
    var leftheight = $(".focuside").height();
    var rightheight = $(".g-side2").height();
    if($(".nodel").length == 0){
        if(document.body.scrollWidth > 991){
            if(leftheight > rightheight ) {
                $(".g-side2").height(leftheight-2);
            }
            else {
                $(".focuside").height(rightheight-2);
            };
        }
    }else{
        if(document.body.scrollWidth > 1199){
            if(leftheight > rightheight ) {
                $(".g-side2").height(leftheight-2);
            }
            else {
                $(".focuside").height(rightheight-2);
            }
        }
    }

    //倒计时
    function timer()
    {
        var delivery_deadline = $('.timer-check').attr('delivery_deadline');

        var timestamp2 = Date.parse(new Date(delivery_deadline));
        var ts = timestamp2- (new Date());//计算剩余的毫秒数
        var dd = parseInt(ts / 1000 / 60 / 60 / 24, 10);//计算剩余的天数
        var hh = parseInt(ts / 1000 / 60 / 60 % 24, 10);//计算剩余的小时数
        var mm = parseInt(ts / 1000 / 60 % 60, 10);//计算剩余的分钟数
        var ss = parseInt(ts / 1000 % 60, 10);//计算剩余的秒数
        var timer = dd + "天" + hh + "时" + mm + "分" + ss + "秒";
        $('.timer-check').html(timer);
    }
    if($('.timer-check').length){
        setInterval(timer,1000);
    }

    //top
    $(window).on('scroll',function(){
        var st = $(document).scrollTop();
        if( st>0 ){
            if( $('#main-container').length != 0  ){
                var w = $(window).width(),mw = $('#main-container').width();
                if( (w-mw)/2 > 70 )
                    $('#go-top').css({'left':(w-mw)/2+mw+20});
                else{
                    $('#go-top').css({'left':'auto'});
                }
            }
            $('#go-top').fadeIn(function(){
                $(this).removeClass('dn');
            });
        }else{
            $('#go-top').fadeOut(function(){
                $(this).addClass('dn');
            });
        }
    });
    $('#go-top .go').on('click',function(){
        $('html,body').animate({'scrollTop':0},500);
    });
    $("#go-top .uc-2vm ").bind('mouseenter',function(){
        $('#go-top .u-pop').show();
    });
    $("#go-top .uc-2vm ").bind('mouseleave',function(){
        $('#go-top .u-pop').hide();
    });
    $("#go-top .feedback ").bind('mouseenter',function(){
        $('#go-top .dnd').show();
    });
    $("#go-top .feedback ").bind('mouseleave',function(){
        $('#go-top .dnd').hide();
    });
    //底部关注我们效果
    $('.foc,.foc-bg').on('mouseover',function(){

        //$('.foc-ewm').stop().fadeIn();
        $(this).timer;
        clearInterval($(this).timer);
        var This = $(this);
        var num= 0;
        var martop;
        This.timer = setInterval(function(){
            num-=2;
            martop = num +"px";
            This.find('a').css('marginTop',martop);
            if(num == -42) clearInterval(This.timer);
        },10);
    });
    $('.foc,.foc-wx').on('mouseout',function(){
        //$('.foc-ewm').stop().fadeOut();
        clearInterval($(this).timer);
        var This = $(this);
        var num= -42;
        var martop;
        This.timer = setInterval(function(){
            num+=2;
            martop = num +"px";
            This.find('a').css('marginTop',martop);
            if(num == 0) clearInterval(This.timer);
        },10);
    });
    if($('input').attr('placeholder')!=''){
        var placedf;
        $('input').on('focus',function(){
            placedf = $(this).attr('placeholder');
            $(this).attr('placeholder','');
        });
        $('input').on('blur',function(){
            $(this).attr('placeholder',placedf);
        });
    }

    //导航菜单
    /*if($('.g-navList-wrap').length>0){
        var wrapnum = 0;
        $('.g-navList-wrap').find('a').each(function(){
            wrapnum+=$(this).width();
        });
        console.log(parseInt($('.g-navList-wrap a').css('marginLeft')));
        $('.g-navList-wrap').css('width',wrapnum+10+parseInt($('.g-navList-wrap a').css('marginLeft'))*$('.g-navList-wrap a').length +'px');
    }*/
});

//onerror加载默认图片
function onerrorImage(url,obj)
{
    obj.attr('src',url);
}

//sidebar
$('.g-sdb .s-slidebar').on('click',function(){
    var gSbd = $('.g-sdb .s-slidebar,.g-sdb .s-slidecenter');
    gSbd.toggleClass('g-sdb-active');
})
if($('.g-sdb .s-slidebar').length > 0){
    var slidebarTop = $('.g-sdb .s-slidebar').offset().top;
}
$(window).on('scroll',function(){
    if($(document).scrollTop() >= slidebarTop){
        $('.g-sdb .s-slidebar,.g-sdb .s-slidecenter').css('position','fixed');
        $('.g-sdb .s-slidebar').css('top','0');
        $('.g-sdb .s-slidecenter').css('top','43px');
    }else{
        $('.g-sdb .s-slidebar,.g-sdb .s-slidecenter').css('position','');
        $('.g-sdb .s-slidebar').css('top','');
        $('.g-sdb .s-slidecenter').css('top','');
    }
});

//任务大厅-任务筛选
$('.task-type .show-next').on('click',function(){

    if ($(this).hasClass('fa-angle-down')){

        $(this).addClass('fa-angle-up')
               .removeClass('fa-angle-down');

        $('.service-type').show();
    }else {

        $(this).addClass('fa-angle-down')
               .removeClass('fa-angle-up');

        $('.service-type').hide();
    }

});
$('.task-area .show-next').on('click',function(){

    if ($(this).hasClass('fa-angle-down')){

        $(this).addClass('fa-angle-up')
               .removeClass('fa-angle-down');

        $('.service-area').show();

    }else {

        $(this).addClass('fa-angle-down')
               .removeClass('fa-angle-up');

        $('.service-area').hide();
    }

});

//服务商-分类
$('.serivce-type .show-next').on('click',function(){

    if ($(this).hasClass('fa-angle-down')){

        $(this).addClass('fa-angle-up')
               .removeClass('fa-angle-down');

        $('.serivcelist-type').show();

    }else {
        $(this).addClass('fa-angle-down')
               .removeClass('fa-angle-up');

        $('.serivcelist-type').hide();
    }

});
//成功案例-分类
$('.success-task .show-next').on('click',function(){

    if ($(this).hasClass('fa-angle-down')){
        $(this).addClass('fa-angle-up')
               .removeClass('fa-angle-down');

        $('.success-area').show();

    }else {

        $(this).addClass('fa-angle-down')
               .removeClass('fa-angle-up');

        $('.success-area').hide();

    }

});
//top nav
var divHoverLeft = 0;
var aWidth = 0;

$(document).ready(function () {
    var hWidth;
    var hLeft;
    if($('.div-hover').length > 0){
        if($('.header-show').length > 0) {
            $('.header-show').show();
            hWidth = $('.hActive .topborbtm').width();
            hLeft = GetthisLeft($(".hActive")) + 18;
            $('.header-show').hide();
        }else{
            hWidth = $('.hActive .topborbtm').width();
            hLeft = GetthisLeft($(".hActive")) + 18;
        }
        $('.div-hover').css('width',hWidth);
        $('.div-hover').css('left',hLeft);
    }
    $(".topborbtm").on({
        'mouseenter': function () {
            SetDivHoverWidthAndLeft(this);
            $(".div-hover").stop().animate({ width: aWidth-36, left: divHoverLeft+18 }, 150);
        }
    });
    $(".topborbtm").on({
        'mouseleave': function (event) {
            $(".div-hover").stop().animate({ width: hWidth, left: hLeft }, 150);
        }
    });
});
function SetDivHoverWidthAndLeft(element) {
    divHoverLeft = GetLeft(element);
    aWidth = GetWidth(element);
}
function GetWidth(ele) {
    return $(ele).parent().width();
}
function GetLeft(element) {
    var menuList = $(element).parent().prevAll();
    var left = 0;
    $.each(menuList, function (index, ele) {
        left += $(ele).width();
    });
    return left;
}
function GetthisLeft(element) {
    var menuList = $(element).prevAll();
    var left = 0;
    $.each(menuList, function (index, ele) {
        left += $(ele).width();
    });
    return left;
}


$('.search-btn-select').on('click', function(e) {
    var $target = $(e.target);
    var $toggle = $('.search-btn-toggle').text($target.text());
    $target.is('li a') && $toggle;
});


function switchSearch(obj)
{
    var url = $(obj).attr('url');
	var name = $(obj).text();

    $(obj).closest('form').attr('action', url);
	$(obj).closest('ul').parents().find("a:firstChild").text(name);
}

/*二维码提示*/

function focWx(obj,id)
{
    obj.hover(function(){
        id.stop().fadeToggle();
    })
}
var oWx = $('.foc-wx');
var aEwm = $('.foc-ewm');
focWx(oWx,aEwm);
/*$('.foc-wx').hover(function(){
    $('.foc-ewm').stop().fadeToggle();
})*/

/*左下角提示*/
function closes(obj,el)
{
    obj.click(function(){
        el.fadeOut()
    })
}
var oCloses = $('.closes');
var aCopy = $('.g-copyright');
closes(oCloses,aCopy);
/*$(function(){
    $('.closes').click(function(){
        $('.g-copyright').fadeOut()
    })
})*/

/*employ交付*/
function gzInfoDom(obj,id,el)
{
    el.hide();
    if( el.length != 0 )
    {
        obj.on('click',function(){
            el.addClass(id);
            el.show();
        })
    }
}
var oMainShow = $('.gzinfo-mainshow');
var oShowBtn = $('.gzinfo-showbtn');
gzInfoDom(oShowBtn,'gzinfo-mainact',oMainShow);
/*$(function(){
    var mainShow = $('.gzinfo-mainshow');
    mainShow.hide();
    if(mainShow.length != 0){
        $('.gzinfo-showbtn').on('click',function(){
            mainShow.addClass('gzinfo-mainact');
            mainShow.show();
        });
    }
});*/


/*回答首页*/
function hov(obj){
    $(obj).hover(function(){
        $(this).find('.question-scheme ').children('.hovdisplay').hide();
    },function(){
        $(this).find('.question-scheme ').children('.hovdisplay').show();
    })
}
var tr = $('.question-table .table-hover>tbody>tr');
hov(tr);