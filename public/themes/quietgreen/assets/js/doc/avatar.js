//用户头像上传
jQuery(function($) {
    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
        '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';
    //text editable
    $('#username')
        .editable({
            type: 'text',
            name: 'username'
        });
    // *** editable avatar *** //
    try {//ie8 throws some harmless exceptions, so let's catch'em
        try {
            document.createElement('IMG').appendChild(document.createElement('B'));
        } catch(e) {
            Image.prototype.appendChild = function(el){}
        }
        var last_gritter
        $('#avatar').editable({
            type: 'image',
            name: 'avatar',
            value: null,
            image: {
                btn_choose: '更换头像',
                droppable: true,
                maxSize: 110000,//~100Kb
                name: 'avatar',//put the field name here as well, will be used inside the custom plugin
                on_error : function(error_type) {//on_error function will be called when the selected file has a problem
                    if(last_gritter) $.gritter.remove(last_gritter);
                    if(error_type == 1) {//file format error
                        last_gritter = $.gritter.add({
                            title: '请上传图片',
                            text: '请上传jpg|gif|png格式的图片!',
                            class_name: 'gritter-error gritter-center'
                        });
                    } else if(error_type == 2) {//file size rror
                        last_gritter = $.gritter.add({
                            text: '用户头像大小不能超过 110Kb!',
                            class_name: 'gritter-error gritter-center'
                        });
                    }
                    else {//other error

                    }
                },
                on_success : function() {
                    $.gritter.removeAll();
                }
            },
            url: function(params) {
                var deferred = new $.Deferred;
                var token = $('meta[name="csrf-token"]').attr('content');
                var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();

                if(!value || value.length == 0) {
                    deferred.resolve();
                    return deferred.promise();
                }
                var deferred_switch = 0;
                setTimeout(function(){
                    if("FileReader" in window) {
                        var thumb = $('#avatar').next().find('img').data('thumb');
                    }
                    var input = "<input type='hidden' name='_token' value='"+token+"' />";
                    $('.editableform').append(input);
                    $.ajax({
                        type:'post',
                        url:'/user/ajaxAvatar',
                        data: new FormData($('.editableform')[0]),
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                            if(data.code==200){
                                var url = data.data.path;
                                var message = data.message;
                                $('#avatar').get(0).src = thumb;
                                if(thumb) $('.head-uploade-after').attr('src',thumb);
                                deferred.resolve({'status':'OK'});
                            }else{
                                var message = '更换头像失败！';
                                deferred.resolve();
                            }
                            last_gritter = $.gritter.add({
                                text:message ,
                                class_name: 'gritter-info gritter-center'
                            });
                            //$('.head-uploade-after').attr('src',url);
                        }
                    });
                    if(last_gritter) $.gritter.remove(last_gritter);
                } , parseInt(Math.random() * 800 + 800));

                return deferred.promise();
            },
            success: function(response, newValue) {

            }
        })
    }catch(e) {}
});