/**
 * Created by kuke on 2016/4/28.
 */
$(function(){
    $('.g-realcardjs').on('mouseover',function(){
        $(this).find('.g-realcardhide').css('display','block');
        $(this).find('.g-realcardwrap').css('opacity','0.2');
    });
    $('.g-realcardjs').on('mouseout',function(){
        $(this).find('.g-realcardhide').css('display','none');
        $(this).find('.g-realcardwrap').css('opacity','1');
    });

    $('.auth').on('click', function(){
        var authId = $(this).attr('data-auth-id');
        var action = $(this).text();
        var card = $(this).attr('data-card');
        $(".action").text(action);
        $("#card").text(card);
        $("#authId").val(authId);
    });

});