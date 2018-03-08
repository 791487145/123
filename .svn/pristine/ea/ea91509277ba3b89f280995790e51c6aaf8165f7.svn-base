$(function(){
    //old
    $("#addpic").change(function(){
        var filepath= $("#back").val();
        if ($.trim(filepath) == "") {
            alert("请选择图片！");
            return false;
        }
        var extStart=filepath.lastIndexOf(".");
        var ext=filepath.substring(extStart,filepath.length).toUpperCase();
        if(ext!=".BMP"&&ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
            alert("图片限于bmp,png,gif,jpeg,jpg格式");
            return false;
        }
        $.ajax({
            url: '/user/ajaxUpdatePic',
            type: 'POST',
            cache: false,
            data: new FormData($('#uploadpic')[0]),
            processData: false,
            contentType: false,
            success:function(data){
                $('#backgroud-img').attr('src',data.domain+'/'+data.path).attr('name',data.path);
            }
        }).done(function(res) {
        }).fail(function(res) {});
    })

    $("#changeBack").click(function(){
        var picsrc = $('#backgroud-img').attr("name");
        var src = $('#backgroud-img').attr("src");

        $('#backgroud-img2').attr('src',src);
        $.get('/user/ajaxUpdateBack',{'src':picsrc},function(data){
            //alert(data.domain+'/'+data.path);
            //$('#backgroud-img2').attr('src',data.domain+'/'+data.path);
        });
    })


    $("#subTask").click(function(){
        $("#discription-edit").val($("#editor1").html());
    })

    if($("#success-case").length>0){
    var demo=$("#success-case").Validform({
        tiptype:3,
        label:".label",
        showAllError:true,
        ajaxPost:false,
        dataType:{
            'positive':/^[1-9]\d*$/,
        },
    });
    }
    $('#editor1').on('blur',function()
    {
        demo.check(false,'#discription-edit');
    });
    $('#bounty').on('change',function(){
        demo.eq(0).config({
            ajaxurl:{
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:{
                    'param':$('#bounty').val()
                }
            }
        });

    });
    $('#datepiker-begin').on('hide',function(){
        $('#datepiker-deadline').val('');
        $('#delivery_deadline').val('');
        demo.check(false,'#delivery_deadline');
    })
    $('#datepiker-deadline').on('hide',function(){
        demo.eq(0).config({
            ajaxurl:{
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:{
                    'param':$('#bounty').val(),
                    'begin_at':$('#begin_at').val(),
                    'delivery_deadline':$('#delivery_deadline').val(),
                },
                success:function(data,obj){
                    if(data.status=='n'){
                        $('#datepiker-deadline').val('');
                        $('#delivery_deadline').val('');
                    }
                }
            }
        });
        demo.check(false,'#delivery_deadline');
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
    if($(".chosen-select").length>0) {
        $('.chosen-select').chosen({
            max_selected_options: 1,
            allow_single_deselect: true,
            no_results_text: "没有匹配结果",
        })
        $('.chosen-select').change(function () {
            var id = $(this).val();
            var url = '/task/getTemplate';
            $('#task_category').attr('value', $(this).val());
            demo.check(false, '#task_category');
            if (id != null) {
                //请求模板
                $.get(url, {'id': id}, function (data) {
                    if (data.id != 'undefind') {
                        $('#template-title').html(data.title);
                        $('#template-content').html(data.content);
                    }
                });
            } else {
                $('#template-title').html('请先选择您需要做什么');
                $('#template-content').html('');
            }

        });
    }



});
function switchStatus(obj)
{

    var uid = obj.attr('user_id');

    $.get('/user/ajaxUpdateCase',{'id':uid},function(data){
        location.reload();
    });
}
function delback(obj)
{
    var uid = obj.attr('user_id');
    $.get('/user/ajaxDelPic',{'id':uid},function(data){
        //$('#backgroud-img').attr('src',data.domain+'/themes/default/assets/images/personal_back.png');
        //$('#backgroud-img2').attr('src',data.domain+'/themes/default/assets/images/personal_back.png');
        location.reload();
    });
}
/*
$(function(){
    $('#id-input-file-9').ace_file_input({
        style:'well',
        btn_choose:'上传封面',
        btn_change:null,
        no_icon:'g-userimgupzm',
        droppable:true,
        thumbnail:'small'//large | fit
        //,icon_remove:null//set null, to hide remove/reset button
        /!**,before_change:function(files, dropped) {
                        //Check an example below
                        //or examples/file-upload.html
                        return true;
                    }*!/
        /!**,before_remove : function() {
                        return true;
                    }*!/
        ,
        preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }

    }).on('change', function(){
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });
});*/
