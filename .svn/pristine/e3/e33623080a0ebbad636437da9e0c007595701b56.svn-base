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
    //ajax评论
    $('.pagination').find('li').find('a').on('click',function(){
        var url = $(this).attr('href');
        $.get(url,function(data){
            $('#ajaxcomments').html(data);

        });
        return false;
    })
    //ajax评论
    var switchs = 1;
    $('.ajaxchangetype').on('click',function(){
        $('.ajaxchangetype').attr("disabled","disabled");
        ajaxComment(switchs,$(this));
    })
    function ajaxComment(switchs,obj)
    {
        var url = obj.attr('url');
        if(switchs==1) {
            switchs = 0;
            $.get(url, function (data) {
                $('#ajaxcomments').html(data);
                var switchs = 1;
            });
        }
    }
    $("#shop_id").on('click',function () {
        var shop_id = $("#shop_id").attr('shop_id');
        $.get('/shop/ajaxAdd', {'shop_id': shop_id}, function (data) {
            if (data.code == 1) {
                location.reload();
            }
        });
        return false;
    });
    $('#contactMe').on('click',function(){
        var content = $('#content').val();
        var js_id = $('.js_id').val();
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/bre/contactMe',
            data: {content:content,js_id:js_id},
            dataType:'json',
            success: function(data){
                if(data.code == 1){
                    location.reload();
                }else{
                    $.gritter.add({
                        //            title: '��Ϣ��ʾ��',
                        text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                        class_name: 'gritter-info gritter-center'
                    });
                }
            }
        });
    });
})
$(function(){
    $("#limit").keyup(function(){
        var curLength=$("#limit").val().length;
        if(curLength>100)
        {
            var num=$("#limit").val().substr(0,100);
            $("#limit").val(num);
//                alert("超过字数限制，多出的字将被截断！" );
        }
        else
        {
            $("#textCount").text(100-curLength);
        }
    });


})
$('#spinner3').ace_spinner({value:0,min:0,max:100,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus smaller-75', icon_down:'ace-icon fa fa-minus smaller-75', btn_up_class:'btn-white' , btn_down_class:'btn-white'}).on('change', function(){
    //alert(this.value)
});




    /**
     * 获取评论列表
     * @param id 商品id
     * @param page 当前页数
     * @param type 评价类型
     */
    function getCommentList(id,page,type){
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/shop/ajaxGetGoodsComment',
            data: {id:id,page:page,type:type},
            dataType:'json',
            success: function(data){
                if(data.code == 1){
                    var html = '';
                    $.each(data.data.comment_list.data, function(i,n) {

                        switch(n.type){
                            case 0:
                                var str =  '<i class="evaluate-flowers"></i>'+
                                    '<span class="good-evaluate">好评</span>';
                                break;
                            case 1:
                                var str = '<i class="evaluate-flowers evaluate-flowersin"></i>'+
                                    '<span class="good-evaluate">中评</span>';
                                break;
                            case 2:
                                var str = '<i class="evaluate-flowers evaluate-flowersno"></i>'+
                                    '<span class="good-evaluate">差评</span>';
                                break;
                            default:
                                var str =  '<i class="evaluate-flowers"></i>'+
                                    '<span class="good-evaluate">好评</span>';
                        }
                        html = html+' <li class="personal-evaluate-list-item">'+
                            '<div class="personal-case-evaluate-words">'+
                            '<div class="g-valugood pull-left buygoods-Img-left">'+
                            '<img class="img-responsive" src="' + data.domain+'/'+ n.avatar +'" onerror="" alt="...">'+
                            '</div>'+
                            '<h5>'+
                            '<a href="">'+ n.name +'</a>'+
                            '</h5>'+
                            '<p>评价：'+ n.comment_desc+'</p>'+
                            '</div>'+
                            '<div class="personal-case-evaluate-person-time pull-right">'+
                            '<div class="z-hov text-right">'+ str +
                            parseFloat((n.speed_score+ n.quality_score + n.attitude_score)/3).toFixed(1)+'分'+
                            '<i class="u-evaico"></i>'+
                            '<div class="u-recordstar b-border">'+
                            '<div>'+
                            '工作速度：'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<a class="cor-orange mg-left">'+ n.speed_score +'分 </a>'+
                            ' - 速度很快'+
                            '</div>'+
                            '<div class="space-8"></div>'+
                            '<div>'+
                            '工作质量：'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<a class="cor-orange mg-left">'+ n.quality_score +'分 </a>'+
                            '- 质量很快'+
                            '</div>'+
                            '<div class="space-8"></div>'+
                            '<div>'+
                            '工作态度：'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<span class="rec-active"></span>'+
                            '<a class="cor-orange mg-left">'+ n.attitude_score+'分 </a>'+
                            '- 态度很好'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '<p>'+
                        '<span>评价于：'+ n.created_at+'</span></p>'+
                        '</div>'+
                        '</li>';
                    });
                    $('#comment_list').html(html);
                    var pre = '';
                    if(data.data.comment_list.prev_page_url != null){
                         pre = '<li class="prev"  onClick="prevClick(this)">' +
                            '<a href="javascript:;" data-values="'+ parseInt(data.data.comment_list.current_page-1) +'">'+
                            '<i class="fa fa-angle-double-left"></i></a>'+
                            '</li>';
                    }
                    var next = '';
                    if(data.data.comment_list.next_page_url != null){
                         next = '<li class="next" onClick="prevClick(this)">' +
                            '<a href="javascript:;" data-values="'+ parseInt(data.data.comment_list.current_page+1) +'">'+
                            '<i class="fa fa-angle-double-right"></i></a>'+
                            '</li>';
                    }
                    var current = '';
                    if(data.data.comment_list.last_page>1){
                        for(i=1;i<=data.data.comment_list.last_page;i++){
                            var dis = 'other_page';
                            if(i==data.data.comment_list.current_page){
                                 dis = 'active disabled';
                            }
                            currentw = '<li class="'+ dis +'" onClick="prevClick(this)">'+
                                '<a href="javascript:;" data-values="'+i+'">'+i+'</a>'+
                                '</li>';
                            current+= currentw;
                        }
                    }

                    $('#page_list').html(pre+current+next);
                }
            }
        });
    }
    //下一页
    $('.next').on('click',function(){
        var page = $(this).children('a').attr('data-values');
        var id = $(this).parent('ul').attr('data-id');
        var type = $("input[name='comment_type']:checked").val();
        getCommentList(id,page,type);
    });
    //上一页
    $('.pre').on('click',function(){
        var page = $(this).children('a').attr('data-values');
        var id = $(this).parent('ul').attr('data-id');
        var type = $("input[name='comment_type']:checked").val();
        getCommentList(id,page,type);
    });


    $('.other_page').on('click',function(){
        var page = $(this).children('a').attr('data-values');
        var id = $(this).parent('ul').attr('data-id');
        var type = $("input[name='comment_type']:checked").val();
        getCommentList(id,page,type);
    });



function prevClick(obj){
    var page = $(obj).children('a').attr('data-values');
    var id = $(obj).parent('ul').attr('data-id');
    var type = $("input[name='comment_type']:checked").val();
    getCommentList(id,page,type);
}

function typeClick(obj){
    var id = $('#shop_id').val();
    var page = 1;
    var type = $("input[name='comment_type']:checked").val();
    getCommentList(id,page,type);
}



