
$(function(){


});
function changeGoodsStatus(obj){
    var type = $(obj).attr('data-values');
    var id = $(obj).parent('div').attr('data-id');
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/manage/changeServiceStatus',
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

$('.check_failure').on('click',function(){
    var id = $(this).parent('div').attr('data-id');
    $('#delete_id').attr('data-id',id);

});
$('#check_failure').on('click',function(){
    var id = $('#delete_id').attr('data-id');
    var reason = $('#reason').val();
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/manage/checkServiceDeny',
        data: {id:id,reason:reason},
        dataType:'json',
        success: function(data){
            if(data.code == 1){
                $('#reason').val();
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

/**
 * 行业切换
 */
$('#cate_first').on('click',function(){
    var id = $(this).val();
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/manage/ajaxGetSecondCate',
        data: {id:id},
        dataType:'json',
        success: function(data){
            var cate = '';
            for(var i in data.cate){
                cate+= "<option value=\""+data.cate[i].id+"\">"+data.cate[i].name+"<\/option>";
            }
            $('#cate_id').html(cate);

        }
    });
});


