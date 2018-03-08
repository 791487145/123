/*jQuery(".g-lkroll").slide({mainCell:".bd ul",autoPlay:true,effect:"leftMarquee",vis:6,interTime:50,trigger:"click"});*/
jQuery(".g-lkroll").slide({

        titCell:".hd ul",
        mainCell:".bd ul",
        autoPage:true,
        effect:"left",
        vis:6

});
jQuery(".txtMarquee-top").slide({

        mainCell:".bd ul",
        autoPlay:true,
        effect:"topMarquee",
        vis:5,
        interTime:50

});

$(function(){
    $(".slide-one").mouseover(function(){
        $("#myCarousel").carousel(0);
        //$("#myCarousel").carousel('pause');
    });
    $(".slide-two").mouseover(function(){
        $("#myCarousel").carousel(1);
        //$("#myCarousel").carousel('pause');
    });
    $(".slide-three").mouseover(function(){
        $("#myCarousel1").carousel(0);
        //$("#myCarousel1").carousel('pause');
    });
    $(".slide-four").mouseover(function(){
        $("#myCarousel1").carousel(1);
        //$("#myCarousel1").carousel('pause');
    });
    $(".slide-five").mouseover(function(){
        $("#myCarousel2").carousel(0);
        //$("#myCarousel2").carousel('pause');
    });
    $(".slide-six").mouseover(function(){
        $("#myCarousel2").carousel(1);
        //$("#myCarousel2").carousel('pause');
    });
    $(".slide-seven").mouseover(function(){
        $("#myCarousel3").carousel(0);
        //$("#myCarousel3").carousel('pause');
    });
    $(".slide-eighth").mouseover(function(){
        $("#myCarousel3").carousel(1);
        //$("#myCarousel3").carousel('pause');
    });

    var isTouch=('ontouchstart' in window);
    if(isTouch){
        $(".carousel").on('touchstart', function(e){
            var that=$(this);
            var touch = e.originalEvent.changedTouches[0];
            var startX = touch.pageX;
            var startY = touch.pageY;
            $(document).on('touchmove',function(e){
                touch = e.originalEvent.touches[0] ||e.originalEvent.changedTouches[0];
                var endX=touch.pageX - startX;
                var endY=touch.pageY - startY;
                if(Math.abs(endY)<Math.abs(endX)){
                    if(endX > 10){
                        $(this).off('touchmove');
                        that.carousel('prev');
                    }else if (endX < -10){
                        $(this).off('touchmove');
                        that.carousel('next');
                    }
                    return false;
                }
            });
        });
        $(document).on('touchend',function(){
            $(this).off('touchmove');
        });
    }

});

<!--根据图片主色作为父元素背景色-->
$(document).ready(function(){
    $.adaptiveBackground.run()
});