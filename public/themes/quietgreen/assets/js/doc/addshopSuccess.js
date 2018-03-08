
$(function(){

    /**
     * 行业切换
     */
    $('#cate_first').on('click',function(){
        var id = $(this).val();
        if(id){
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/user/ajaxGetSecondCate',
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
        }else{
            var cate = '<option value="">-行业子类-</option>';
            $('#cate_id').html(cate);

        }

    });


    var demo=$("#shopSuccess").Validform({
        tiptype:3,
        label:".label",
        showAllError:true,
        ajaxPost:false,
        dataType:{
            'positive':/^[1-9]\d*$/,
        },
    });
    //验证描述是否为空
    ue.addListener('blur',function(editor){
        var content = ue.getContent();
        $('#discription-edit').val(content);
        demo.check(false,'#discription-edit');
    });

    $('.tijiao_anli').on('click',function(editor){
        var content = ue.getContent();
        $('#discription-edit').val(content);
        demo.check(false,'#discription-edit');
    });

});







