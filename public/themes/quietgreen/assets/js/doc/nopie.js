

/*$('.usernopd-aircle').hover(function(){
	
	$('.foc-hov').toggle();
	
});*/
$(function(){
    $(".g-reletaskhd .g-releasechart").on('click',function(){

        $('.g-reletaskhd .g-releasehide').toggle();
        $('.g-reletaskhd .g-releasehidea').toggle();
    });
//onerror加载默认图片
    function onerrorImage(url,obj)
    {
        obj.attr('src',url);
    }

    $('.delete_goods').on('click',function(){
        var id = $(this).parent('p').attr('data-id');
        $('#goods_id').val(id);
    });
    $('#btn_primary').on('click',function(){
        var id = $('#goods_id').val();
        var type = 5;
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/changeGoodsStatus',
            data: {id:id,type:type},
            dataType:'json',
            success: function(data){
                if(data.code == 1){
                    location.reload();
                }else{
                    $.gritter.add({
                        text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                        class_name: 'gritter-info gritter-center'
                    });
                }
            }
        });
    });
    //切换地址
    $('.deleteService').on('click',function(){
        var url = $(this).attr('url');
        $('#btn_links').attr('url',url);
    });
    $('#btn_links').on('click',function(){
        var url = $(this).attr('url');
        window.location.href = url;
    })
})

//改变商品状态
function changeGoodsStatus(obj){
    var type = $(obj).attr('data-values');
    var id = $(obj).parent('p').attr('data-id');
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/user/changeGoodsStatus',
        data: {id:id,type:type},
        dataType:'json',
        success: function(data){
            if(data.code == 1){
                location.reload();
            }else{
                $.gritter.add({
                    text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                    class_name: 'gritter-info gritter-center'
                });
            }
        }
    });
}




