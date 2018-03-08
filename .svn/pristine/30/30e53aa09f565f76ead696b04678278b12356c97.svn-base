
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
                    var area = '';
                    for(var i in data.area){
                        area+= "<option value=\""+data.area[i].id+"\">"+data.area[i].name+"<\/option>";
                    }
                    $('#area').html(area);

                }
            });
        }else{
            var html = '<option value="">-请选择市-</option>';
            $('#city').html(html);
            var area = '<option value="">-请选择区-</option>';
            $('#area').html(area);
        }

    });

    /**
     * 市级切换
     */
    $('#city').on('click',function(){
        var id = $(this).val();
        if(id){
            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/user/ajaxGetArea',
                data: {id:id},
                dataType:'json',
                success: function(data){
                    var area = '';
                    for(var i in data.area){
                        area+= "<option value=\""+data.area[i].id+"\">"+data.area[i].name+"<\/option>";
                    }
                    $('#area').html(area);

                }
            });
        }else{
            var area = '<option value="">-请选择区-</option>';
            $('#area').html(area);
        }

    });

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
                    $('#cate_second').html(cate);

                }
            });
        }else{
            var cate = '<option value="">-行业子类-</option>';
            $('#cate_second').html(cate);
        }

    });

    var demo=$("#enterprise").Validform({
        tiptype:3,
        label:".label",
        //showAllError:true,
        ajaxPost:false,
        dataType:{
            'positive':/^[1-9]\d*$/,
        },
        beforeSubmit:function(curform){
                if ($("#file_update input").length > 0){
                    if($('#file_error span').length > 0){
                        $('#file_error').html('');
                    }
                    return true;
                }else{
                    $('#file_error').html('<span class="Validform_checktip Validform_wrong">请上传相关资质!</span>');
                    return false;
                }
        }
    });
    $('#datepiker-begin').on('hide',function()
    {
        demo.check(false,'#datepiker-begin');
    });



});







