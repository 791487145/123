
jQuery(function($){
    var url = $('#dropzone').attr('url');
    Dropzone.autoDiscover = false;
    var attatchment_allow = 1;
    try {
        var myDropzone = new Dropzone("#dropzone" , {
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize:  uploadRule.size, // MB
            maxFiles: maxFiles,
            dictMaxFilesExceeded:'你最多能上传'+maxFiles+'个文件',
            dictFileTooBig:'你上传的文件过大',
            addRemoveLinks : true,
            dictRemoveFile:'删除文件',
            dictCancelUpload:'取消上传',
            hiddenInputContainer:"<input type='hidden'  name='file_id[]' value='1'/>",
            acceptedFiles:extensions,
            dictDefaultMessage :
                '  <i class="upload-icon ace-icon fa fa-cloud-upload fa-3x"></i><br>\
               最多可添加'+maxFiles+'个附件，每个大小不超过'+uploadRule.size+'MB'
            ,
            dictResponseError: 'Error while uploading file!',
            //change the previewTemplate to use Bootstrap progress bars
            init: function() {
                //this.emit("initimage", initimage);
                this.on("success", function(file,data) {
                    file.file_id = data.id;//赋值file_id便于删除操作
                    var html = "<input type='hidden'  name='file_id[]' id='file-"+data.id+"' value='"+data.id+"'/>"
                    $('#file_update').append(html);
                    /*$('#dropzone').children().last('div').children('a').attr('file-id',data.id);
                     $('#dropzone').children().find('div.dz-success').children('a').on('click',function(){
                     var index = $(this).parent().index();
                     });*/
                });
                this.on("removedfile", function(file) {
                    var delete_url = $('#dropzone').attr('deleteurl');
                    //只有当文件上传成功之后才能发出删除请求
                    if(file.file_id!=undefined){
                        $.get(delete_url,{'id':file.file_id},function(data){

                        });
                    }
                });

            }
        });
        for(var i in initimage){
            var mockFile = {name: ""+initimage[i].name+"", accepted:true, size:initimage[i].size*1024,file_id:initimage[i].id,};
            myDropzone.emit("addedfile", mockFile);
        }
    } catch(e) {
        alert('Dropzone.js does not support older browsers!');
    }

});