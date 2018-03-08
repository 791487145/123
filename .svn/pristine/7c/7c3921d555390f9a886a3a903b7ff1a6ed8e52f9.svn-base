/*显示*/
function fade(){
    var oState = $('.oheader .issue .state');
    var oLogin = $('.oheader .issue .state .login');
    oState.hover(function()
    {
        oLogin.stop().fadeToggle();
    })
}
fade();

/*筛选*/
function dropdowns(obj,val){

    obj.hover(function(){

        $(this).children('.dropdown-menu').stop().slideToggle(300);
        $(this).find('b').toggleClass('active');

    });

    val.click(function(e){

        var _this=$(this).parent().parent().siblings('.dropdown-toggle').children('span');
        var txt = $(this).attr('data-value');

        _this.text(txt);
        obj.removeClass("open");
        e.stopPropagation();

    });

}
var oDorpdown = $(".dropdown-down");
var oTxt = $(".dropdown-down ul li a");
dropdowns(oDorpdown,oTxt);


function clickToggle(obj,elm){
/*
    $(obj).on('click',function(){
        $(this).siblings(elm).fadeToggle();
    });*/
    $(obj).click(function(){
        $(this).siblings(elm).stop().fadeToggle();
    });

}
clickToggle('.hovbtn','.dropdown-menu');
clickToggle('a.dropdown-toggle','.dropdown-menu');
clickToggle('.fom-search input','.dropdown-menu');
