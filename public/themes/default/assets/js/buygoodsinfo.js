
$('#spinner3').ace_spinner({
    value:1,
    min:0,
    max:100,
    step:1,
    on_sides: true,
    icon_up:'ace-icon fa fa-plus smaller-75',
    icon_down:'ace-icon fa fa-minus smaller-75',
    btn_up_class:'btn-white' ,
    btn_down_class:'btn-white'}).on('change', function(){
    //alert(this.value)
    var value = this.value;
    var cash = $('#cash').attr('data-values');
    var pay = parseFloat(value*cash).toFixed(2);
    var html = '￥'+pay;
    $('.pay_num').text(html);
    $('.pay_num').attr('data-values',pay);
});

$(function(){
    /**
     * 生成订单
     */
    $('#create_order').on('click',function(){
        var goods_id = $('#goods_id').val();
        var title = $('#title').attr('data-values');
        var pay_cash = $('.pay_num').attr('data-values');
        console.log(title);
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/shop/postOrder',
            data: {goods_id:goods_id,title:title,pay_cash:pay_cash},
            dataType:'json',
            success: function(data){
                if(data.code == 1){
                    location.href = '/shop/pay/'+data.data;
                }else{
                    $.gritter.add({
                        text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                        class_name: 'gritter-info gritter-center'
                    });
                }
            }
        });
    });
});




