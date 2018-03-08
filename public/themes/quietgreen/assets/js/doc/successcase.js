$(function(){
    $('.task-r .z-close').click(function(){
        $('.task-r .task-select').hide(500);
        $('.task-r .task-select1').show(1000);
        $('#task-select').remove();
        $('#task_category').val('');
    });

    var demo=$("#success-case").Validform({
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

});
jQuery(function($) {
    $('.chosen-select').chosen({
        max_selected_options:1,
        allow_single_deselect:true,
        no_results_text: "没有匹配结果",
    });
    $('.chosen-select').change(function(){
        var id = $(this).val();
        $('#task_category').attr('value',$(this).val());
    });
    //resize the chosen on window resize

    //文件上传插件
    $('#id-input-file-3').ace_file_input({
        style:'well',
        btn_choose:'上传封面',
        btn_change:null,
        no_icon:false,
        droppable:true,
        thumbnail:'small'//large | fit
    }).on('change', function(){
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });

    $('.default').val("请选择分类");

});

//替换任务类型
function chooseCate(obj) {
    var id = obj.attr('cate-id');
    $('#model-close').trigger('click');
    $('#task_category').attr('value', id);
    $('#what-cate').attr('style', 'display:block');
    obj.attr('class', 'z-bule');
    obj.siblings('a').attr('class', '');
    demo.check('#task_category',false);
}
