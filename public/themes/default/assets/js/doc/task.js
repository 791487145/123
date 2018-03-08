$(function(){
    $('#demol .panel label').on('click',function(){
        $(this).find('input[type="radio"]').prop('checked',true);
        $('#bounty_money').text(0);
        $('#total-price').text(0);
    });
    // 隐藏可折叠元素
    $('#demol').collapse('toggle');


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
        $(this).css('background','#fff');
        $(this).find('.g-subshow').show();
    });
    $('.sub li').on('mouseout',function(){
        $(this).css('background','');
        $(this).find('.g-subshow').hide();
    });

    var demo=$("#form").Validform({
        ignoreHidden: true,
        tiptype:3,
        label:".label",
        showAllError:true,
        ajaxPost:false,
        postonce:true,
        dataType:{
            'positive':/^[1-9]\d*$/,
        },
        beforeSubmit:function(){
            var cate_id = $('#task_category').val();
            if(cate_id){
                $('#task_category').siblings('span').removeClass('Validform_wrong').addClass('Validform_right').html('').show();
            }else{
                $('#task_category').siblings('span').addClass('Validform_wrong').html('请选择需要做什么').show();
                return false;
            }

            var content = ue.getContent();
            $('#discription-edit').val(content);
            if(content){
                $('#discription-edit').siblings('span').removeClass('Validform_wrong').addClass('Validform_right').html('').show();
            }else {
                $('#discription-edit').siblings('span').addClass('Validform_wrong').html('需求详情不能为空').show();
                return false;
            }

            if($('.time_check').hasClass('Validform_wrong')){
                return false;
            }
            var type = $('#slutype').val();
            if(type==2){
                $('.preview').removeAttr('href');
            }else{
                $('.preservation').attr('disabled','disabled');
                $('.not_released').removeAttr('href');
            }
        }
    });
    //验证描述是否为空
    ue.addListener('blur',function(editor){
        var content = ue.getContent();
        $('#discription-edit').val(content);
        demo.check(false,'#discription-edit');
    });

    /**
     * 悬赏验证参数
     */
    $('#bounty').on('change',function(){
        demo.eq(0).config({
            ajaxurl:{
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    'param':$('#bounty').val(),
                    'begin_at':$('#begin_at').val()
                },
                success:function(data,obj){
                    if(data.status=='y')
                    {
                        $('#datepiker-deadline').val(data.deadline);
                        $('#delivery_deadline').val(data.deadline);
                        $('#datepiker-deadline').trigger('hide');
                    }
                }
            }
        });

    });
    $('#datepiker-begin').on('hide',function(){
        $('#datepiker-deadline').val('');
        $('#delivery_deadline').val('');
        demo.check(false,'#delivery_deadline');
    });
    $('#datepiker-deadline').on('hide',function(){
       /* demo.eq(0).config({
            ajaxurl:{
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    'param':$('#bounty').val(),
                    'begin_at':$('#begin_at').val(),
                    'delivery_deadline':$('#delivery_deadline').val()
                },
                success:function(data,obj){
                    if(data.status=='n'){
                        $('#datepiker-deadline').val('');
                        $('#delivery_deadline').val('');
                    }
                }
            }
        });
        demo.check(false,'#delivery_deadline');*/
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/task/checkdeadline',
            data: {
                'param':$('#bounty').val(),
                'begin_at':$('#begin_at').val(),
                'delivery_deadline':$('#delivery_deadline').val()
            },
            dataType:'json',
            success: function(data){
                if(data.status=='n'){
                    $('#datepiker-deadline').val('');
                    $('#delivery_deadline').val('');
                    $('.time_check').addClass('Validform_wrong').html(data.info).show();
                    return false;
                }else{
                    $('.time_check').removeClass('Validform_wrong').addClass('Validform_right').html('').show();
                }
            }
        });
    });


    /**
     * 招标验证截止时间
     */
    $('#datepiker-deadline1').on('hide',function(){
        /*demo.eq(0).config({
            ajaxurl:{
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    'begin_at':$('#begin_at1').val(),
                    'delivery_deadline':$('#delivery_deadline1').val()
                },
                success:function(data,obj){
                    if(data.status=='n'){
                        $('#datepiker-deadline').val('');
                        $('#delivery_deadline').val('');
                    }
                }
            }
        });
        demo.check(false,'#delivery_deadline1');
        */
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/task/checkDeadlineByBid',
            data: {
                'begin_at':$('#begin_at1').val(),
                'delivery_deadline':$('#delivery_deadline1').val()
            },
            dataType:'json',
            success: function(data){
                if(data.status=='n'){
                    $('#datepiker-deadline1').val('');
                    $('#delivery_deadline1').val('');
                    $('.time_check').addClass('Validform_wrong').html(data.info).show();
                    return false;
                }else{
                    $('.time_check').removeClass('Validform_wrong').addClass('Validform_right').html('').show();
                }
            }
        });
        demo.check(false,'#delivery_deadline1');

    });

    //插入模板的时候验证
    $('#insertTemplate').on('click',function(){
        demo.check(false,'#discription-edit');
        demo.check(false,'#form-input-readonly');
    });
    //替换任务类型
    $('.chooseCate').on('click',function(){
        var id = $(this).attr('cate-id');
        var url = $(this).attr('url');
        $('#model-close').trigger('click');
        $('#task_category').attr('value',id);
        $('#what-cate').attr('style','display:block');
        $(this).attr('class','z-bule');
        $(this).siblings('a').attr('class','');
        //看看别人怎么写的
        $('#seeothers').attr('href','/task?category='+id);
        demo.check(false,'#task_category');
        //请求模板
        $.get(url,{'id':id},function(data){
            if(data.id!='undefind'){
                $('#template-title').html(data.title);
                $('#template-content').html(data.content);

            }
        });
    });
    $('.chosen-select').chosen({
        max_selected_options:1,
        allow_single_deselect:true,
        no_results_text: "没有匹配结果",
    });
    $('.chosen-select').change(function(){
        var id = $(this).val();
        var url = '/task/getTemplate';
        $('#task_category').attr('value',$(this).val());
        demo.check(false,'#task_category');
        if(id!=null){
            //请求模板
            $.get(url,{'id':id},function(data){
                if(data.id!='undefind'){
                    $('#template-title').html(data.title);
                    $('#template-content').html(data.content);
                }
            });
        }else{
            $('#template-title').html('请先选择您需要做什么');
            $('#template-content').html('');
        }

    });
    $('.task-r .z-close').click(function(){
        $('.task-r .task-select').hide(500);
        $('.task-r .task-select1').show(1000);
        $('#task-select').remove();
        $('#task_category').val('');
        demo.check(false,'#task_category');
    });
    $('.clickDropdw').click(function(){
        if($('.showDropdw .Validform_checktip').html() != ''){
            $('.showDropdivdw').addClass('in');
            $('.showDropadw .fa').removeClass('fa-angle-double-right').addClass('fa-angle-double-down');
        }
    });

});

function sluSub(type){
    $('#slutype').attr('value',type);
    if(type==2){
        $('#form').attr('target','_blank').submit().attr('target','');
    }else{
        $('#form').submit();
    }

}

$(function(){
    //$('#edit').editable({
    //    inlineMode: false,
    //    alwaysBlank: true,
    //});        //编辑器
//编辑器类容提交
$("#subTask").click(function(){
    $('#discription-edit').val($("#editor1").html())
});

$('#morecate').on('click',function(){
        $('#myModal').modal({
            keyboard: true
        })
    });
    $('#example').on('click',function(){
        $('#myexample').modal({
            keyboard: true
        })
    });
    $('.area-limit').on('click',function(){
        var index = $(this).index();
        $(this).removeClass('bar-txt');
        $(this).siblings('a').addClass('bar-txt');
        var value = $('#area_check').val();
        if(index==2){
            $('#area_select').show();
            $('#region-limit').attr('value',value);
        }else{
            $('#area_select').hide();
            $('#region-limit').attr('value',0);
        }
    });
    var swf = $('#fileUpdate').attr('url');
    var token = $('#form').find("input[name='_token']").val();

    //切换任务模式
    $('.model').on('click',function(){
        var index = $(this).attr('type');
        $(this).children('p').attr('class','mission-tit');
        $(this).children('p').find('i').attr('class','fa fa-check');
        $(this).siblings().children('p').attr('class','mission-xs');
        $(this).siblings().children('p').find('i').attr('class','fa fa-circle-o');
        $('#task-type').attr('value',index);
    });

    //计算总价等
    $('#bounty').on('change',function(){
        var value = $(this).val();
        var bounty = $('#bounty_money').html();
        $('#bounty_money').html(value);
        var total = $('#total-price').html();
        //重新计算
            //计算服务费用
        var service = parseFloat(total)-parseFloat(bounty);
        $('#total-price').html(parseFloat(value)+service);
    });
    //服务价格加入
    var checked_number = 0;
    $('.taskservice').on('change',function(){
        var checked = $(this).prop('checked');
        var index = $(this).attr('value');
        var price = $(this).attr('price');
        var total = $('#total-price').html();

        //加入
        if(checked){
            $('#total-price').html(parseFloat(total)+parseFloat(price));
            $('#service-box').show();
            $('#service-'+index).attr('style','');
            if($(this).next('span').html()=='顶'){
                $(this).next('span').addClass('z-sp2');
            }
            if($(this).next('span').html()=='急'){
                $(this).next('span').addClass('z-sp3');
            }
            if($(this).next('span').html()=='索'){
                $(this).next('span').addClass('z-sp2');
            }
            if($(this).next('span').html()=='件'){
                $(this).next('span').addClass('z-sp3');
            }
            //判断当前所有的服务全部选中
            checked_number++;
            if($('.taskservice').length==checked_number)
            {
                $('#taskservice_all').prop('checked',true);
            }
        }else{
            $('#total-price').html(parseFloat(total)-parseFloat(price));
            //$('#service-box').hide();
            $('#service-'+index).attr('style','display:none');
            $(this).next('span').removeClass('z-sp2').removeClass('z-sp3');
            $('#taskservice_all').prop('checked','');
            checked_number+=-1;
        }
    });
    //服务全选
    $('#taskservice_all').on('change',function(){
        var checked = $(this).prop('checked');
        if(checked){
            $('.taskservice').each(function(){
                var checked = $(this).prop('checked');
                var index = $(this).attr('value');
                var price = $(this).attr('price');
                var total = $('#total-price').html();
                if(!checked){
                    $(this).prop('checked',true);
                    $('#total-price').html(parseFloat(total)+parseFloat(price));
                    $('#service-box').show();
                    $('#service-'+index).attr('style','');
                    if($(this).next('span').html()=='顶'){
                        $(this).next('span').addClass('z-sp2');
                    }
                    if($(this).next('span').html()=='急'){
                        $(this).next('span').addClass('z-sp3');
                    }
                }
            });
        }else{
            $('.taskservice').each(function(){
                var checked = $(this).prop('checked');
                var index = $(this).attr('value');
                var price = $(this).attr('price');
                var total = $('#total-price').html();
                if(checked){
                    $(this).prop('checked','');
                    $('#total-price').html(parseFloat(total)-parseFloat(price));
                    //$('#service-box').hide();
                    $('#service-'+index).attr('style','display:none');
                    if($(this).next('span').html()=='顶'){
                        $(this).next('span').removeClass('z-sp2');
                    }
                    if($(this).next('span').html()=='急'){
                        $(this).next('span').removeClass('z-sp3');
                    }
                }

            });
        }

    });
});

/**
 * 省级切换
 * @param obj
 */
function checkprovince(obj){
    var id = obj.value;
    $.get('/task/ajaxcity',{'id':id},function(data){
        var html = '';
        var area = '';
        for(var i in data.province){
            html+= "<option value=\""+data.province[i].id+"\">"+data.province[i].name+"<\/option>";
        }
        for(var s in data.area){
            area+= "<option value=\""+data.area[s].id+"\">"+data.area[s].name+"<\/option>";
        }
        $('#province_check').html(html);
        $('#area_check').html(area);
        $('#region-limit').attr('value',data.area[0].id);
    });
}
/**
 * 市级切换
 * @param obj
 */
function checkcity(obj){
    var id = obj.value;
    $.get('/task/ajaxarea',{'id':id},function(data){
        var html = '';
        for(var i in data){
            html += "<option value=\""+data[i].id+"\">"+data[i].name+"<\/option>";
        }
        $('#area_check').html(html);
        $('#region-limit').attr('value',data[0].id);
    });
}

/**
 * 地区限制数据替换
 * @param obj
 */
function arealimit(obj){
    $('#region-limit').attr('value',obj.value);
}


function chooseCate(obj)
{
    var id = obj.attr('cate-id');
    var url = obj.attr('url');
    $('#model-close').trigger('click');
    $('#task_category').attr('value',id);
    $('#what-cate').attr('style','display:block');
    obj.attr('class','z-bule');
    obj.siblings('a').attr('class','');
    demo.check(false,'#delivery_deadline');
    //请求模板
    $.get(url,{'id':id},function(data){
        if(data.id!='undefind'){
            $('#template-title').html(data.title);
            $('#template-content').html(data.content);
        }
    });

}
//插入模板
function insert_example()
{
    var html = $("div.active").find('h4').html();
    var content = $("div.active").find('div').html();

    //插入标题
    $('#form-input-readonly').val(html);
    //插入模板类容
    //$('#editor1').html(content);
    ue.setContent(content,false);
    $('#discription-edit').val(content);
    //关闭模态窗口
    $('.close').trigger('click');
}
//时间验证
function beginAt(obj)
{
    var begin_at = obj.val();
    $('#begin_at').val(begin_at);
    $('.begin_at').val(begin_at);
}
function deadline(obj)
{
    var deadline = obj.val();
    $('#delivery_deadline').val(deadline);
    $('.delivery_deadline').val(deadline);
}



