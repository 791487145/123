/**
 * Created by R on 2016/10/28.
 */
$(function(){
    $('.g-payvipwrap').eq(0).css('display','block');
    var indexkey;
    $('.g-payvip li').on('mouseover',function(){
        $('.g-payvipwrap').css('display','none');
        $('.g-payvip li').removeClass('active');
        $(this).toggleClass('active');
        indexkey = $(this).index();
        $('.g-payvipwrap').eq(indexkey).css('display','block');
    });

    $('.g-payvipwrap').on('mouseover',function(){
        parenthis = $(this);
        $(this).find('.payvipradio').on('click',function(){
            parenthis.find('.totalvip').text($(this).text() + parenthis.find('.tota lname').text());
            parenthis.find('.totalvipnum').text($(this).attr('num'));
        });
    });
})