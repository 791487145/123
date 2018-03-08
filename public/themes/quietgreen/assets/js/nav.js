//导航
$('.g-taskclassdown').on('click',function(){

    if($('.g-taskclassify').css('height') == '180px'){

        $('.g-taskclassify').css('height','auto');
        $('.g-taskclassdown i').attr('class','fa fa-angle-double-up');

    }else{

        $('.g-taskclassify').css('height','180px');
        $('.g-taskclassdown i').attr('class','fa fa-angle-double-down');
        return;

    }
});
$(window).scroll(function () {

    var scrollTop = $(document).scrollTop();

    if ($(window).scrollTop() >= $('section').offset().top) {

        $('.header-top').css('display','block');

    }else{

        $('.header-top').css('display','none');

    }
    if($('.navbar-collapse').hasClass('in')){
        $('.navbar-collapse').removeClass('in');
    }
});

$('.g-taskmaintime').on('click',function(){

    if($(this).find('.fa').prop('class') == 'fa fa-long-arrow-down'){

        $(this).find('.fa').prop('class','fa fa-long-arrow-up');
        return;

    }else{

        $(this).find('.fa').prop('class','fa fa-long-arrow-down');
        return;

    }
});
$('.sub li').on('mouseover',function(){

    $(this).css('background','rgba(255,255,255,.97)');
    $(this).find('.g-subshow').show();

});
$('.sub li').on('mouseout',function(){

    $(this).css('background','');
    $(this).find('.g-subshow').hide();

})


$('.g-taskclassdown').on('click',function(){

    if($('.g-taskclassify').css('height') == '180px'){

        $('.g-taskclassify').css('height','auto');
        $('.g-taskclassdown i').attr('class','fa fa-angle-double-up');
        return;

    }else{

        $('.g-taskclassify').css('height','180px');
        $('.g-taskclassdown i').attr('class','fa fa-angle-double-down');
        return;

    }
});
$('.sub li').on('mouseover',function(){
    $(this).css('background','rgba(255,255,255,0.9)');
    $(this).find('.g-subshow').show();
});
$('.sub li').on('mouseout',function(){
    $(this).css('background','');
    $(this).find('.g-subshow').hide();
});
$('.g-taskbarli').on('mouseover',function(){
    $(this).find('.g-taskbardown1').css('display','block');
});
$('.g-taskbarli').on('mouseout',function(){
    $(this).find('.g-taskbardown1').css('display','none');
});

$('.g-taskbarli').on('mouseover',function(){
    $(this).addClass('g-taskbaract');
});
$('.g-taskbarli').on('mouseout',function(){
    $(this).removeClass('g-taskbaract');
});


//header搜索框
//function searchBtntoggle(){
//    var index = 0;
//    var a = new Array();
//    var searchBtnSelect = $('.search-btn-select li');
//
//    searchBtnSelect.each(function(){
//
//        $(this).click(function(){
//            a[$(this).text()] = $(this).attr('value')
//        })
//
//    })
//}
$('.search-btn-select').on('click', function(e) {
    var $target = $(e.target);
    var $toggle = $('.search-btn-toggle').text($target.text());
    $target.is('li a') && $toggle;
});
