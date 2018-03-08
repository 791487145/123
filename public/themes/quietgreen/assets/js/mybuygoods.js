$(function(){
    $('#function-star1').raty({
        number: 5,//多少个星星设置
        score: 5,//初始值是设置
        targetType: 'number',//类型选择，number是数字值，hint，是设置的数组值
        path      : '/themes/default/assets/images',
        cancelOff : 'cancel-off-big.png',
        cancelOn  : 'cancel-on-big.png',
        size      : 24,
        starHalf  : 'star-half-big.png',
        starOff   : 'star-off-big.png',
        starOn    : 'star-on-big.png',
        target    : false,                  //显示数目（id）
        cancel    : false,
        targetKeep: true,
        precision : false,//是否包含小数
        click: function(score, evt) {
            $('#speed-score').val(score);
            //alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);
        }
    });
    $('#function-star2').raty({
        number: 5,//多少个星星设置
        score: 5,//初始值是设置
        targetType: 'number',//类型选择，number是数字值，hint，是设置的数组值
        path      : '/themes/default/assets/images',
        cancelOff : 'cancel-off-big.png',
        cancelOn  : 'cancel-on-big.png',
        size      : 24,
        starHalf  : 'star-half-big.png',
        starOff   : 'star-off-big.png',
        starOn    : 'star-on-big.png',
        target    : false,                  //显示数目（id）
        cancel    : false,
        targetKeep: true,
        precision : false,//是否包含小数
        click: function(score, evt) {
            $('#quality-score').val(score);
            //alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);
        }
    });
    $('#function-star3').raty({
        number: 5,//多少个星星设置
        score: 5,//初始值是设置
        targetType: 'number',//类型选择，number是数字值，hint，是设置的数组值
        path      : '/themes/default/assets/images',
        cancelOff : 'cancel-off-big.png',
        cancelOn  : 'cancel-on-big.png',
        size      : 24,
        starHalf  : 'star-half-big.png',
        starOff   : 'star-off-big.png',
        starOn    : 'star-on-big.png',
        target    : false,                  //显示数目（id）
        cancel    : false,
        targetKeep: true,
        precision : false,//是否包含小数
        click: function(score, evt) {
            $('#attitude-score').val(score);
            //alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);
        }
    });

});




//确认源文件
$('.confirm_doc').on('click',function(){
    var id = $(this).parent('p').attr('data-id');
    $('#order_id').val(id);
});

//维权申请
$('.apply_rights').on('click',function(){
    var id = $(this).parent('p').attr('data-id');
    $('#goods_order_id').val(id);
});

//评价
$('.comment_goods').on('click',function(){
    var goods_id = $(this).attr('data-values');
    $('#goods_id').val(goods_id);
});