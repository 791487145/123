
$(function(){

    /**
     * 省级切换
     */
    $('#province').on('click',function(){
        var id = $(this).val();
        if(id){
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/user/ajaxGetCity',
                data: {id:id},
                dataType:'json',
                success: function(data){
                    var html = '';
                    for(var i in data.province){
                        html+= "<option value=\""+data.province[i].id+"\">"+data.province[i].name+"<\/option>";
                    }
                    $('#city').html(html);
                }
            });
        }else{
            var html = '<option value="" >-请选择市-</option>';
            $('#city').html(html);
        }

    });

    var demo=$("#shop_info").Validform({
        tiptype:3,
        label:".label",
        showAllError:true,
        ajaxPost:false,
        dataType:{
            'positive':/^[1-9]\d*$/,
        },
    });

});







