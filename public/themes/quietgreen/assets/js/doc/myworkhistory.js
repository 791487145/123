$(function(){
    $('.accordion-toggle').on('click',function(){
        if($(this).find('.fa').hasClass('fa-angle-down')){
            $('.accordion-toggle .pull-right').removeClass('fa-angle-down');
            $('.accordion-toggle .pull-right').addClass('fa-angle-right');
            return;
        }
        if($(this).find('.fa').hasClass('fa-angle-right')){
            $('.accordion-toggle .pull-right').removeClass('fa-angle-down');
            $('.accordion-toggle .pull-right').addClass('fa-angle-right');
            $(this).find('.pull-right').removeClass('fa-angle-right');
            $(this).find('.pull-right').addClass('fa-angle-down');
            return;
        }
    });
    $('.foc').on('mouseover',function(){
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
    $('.foc').on('mouseout',function(){
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
    $(".g-message").find("input:first").click(function(){
        if(this.checked){
            $(".g-message input").prop('checked','true');
        }else{
            $(".g-message input").prop('checked','');
        }
    });


});