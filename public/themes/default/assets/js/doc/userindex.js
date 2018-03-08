jQuery(function($) {
    $('.dialogs,.comments').ace_scroll({
        size: 325
    });
});
$(function(){
    var userMargintop = 0;
    $('.g-usersideleft').on('click',function(){
        if($('.g-userimglist ul').css('marginTop').replace('px', '') == 0){
            return;
        }else{
            userMargintop+=204;
            var userNum = userMargintop + 'px';
            $('.g-userimglist ul').css('marginTop',userNum);
            return;
        }
    });
    $('.g-usersideright').on('click',function(){
        if((-parseInt($('.g-userimglist ul').css('marginTop')))+204 >= parseInt($('.g-userimglist ul').css('height'))){
            return;
        }else{
            userMargintop-=204;
            var userNum = userMargintop + 'px';
            $('.g-userimglist ul').css('marginTop',userNum);
            return;
        }
    });
});
