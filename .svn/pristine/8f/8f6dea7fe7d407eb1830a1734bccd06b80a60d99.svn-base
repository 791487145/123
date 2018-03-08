$(function(){
    var navHtml = '';
    for(var i in nav){
        if (nav[i].status == 1){
            navHtml += "<label id='" + nav[i].id + "'><input type='checkbox' name='nav[" + nav[i].id +  "]' class='drag-tabinp' value='" + nav[i].name + "' checked>" +
                "<span class='drag-tabspan'>" + nav[i].name + "</span><input type='hidden' name='navt[" + nav[i].id +  "]' value='" + nav[i].name + "'>" +
                "</label>";
        } else {
            navHtml += "<label id='" + nav[i].id + "'><input type='checkbox' name='nav[" + nav[i].id +  "]' value='" + nav[i].name + "' class='drag-tabinp'>" +
                "<span class='drag-tabspan'>" + nav[i].name + "</span><input type='hidden' name='navt[" + nav[i].id +  "]' value='" + nav[i].name + "'>" +
                "</label>";
        }
    }
    $(".drag-tab").html(navHtml);
    dray_tabedit($('.drag-tabspan'));
});




jQuery(function($){

    var url = $('#dropzone-bar').attr('url');
    Dropzone.autoDiscover = false;
    var attatchment_allow = 1;
    try {
        var myDropzone = new Dropzone("#dropzone-bar" , {
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize:  uploadRule.size, // MB
            maxFiles: 6,
            dictMaxFilesExceeded:'你最多能上传六张图片',
            dictFileTooBig:'你上传的文件过大',
            addRemoveLinks : true,
            dictRemoveFile:'删除文件',
            dictCancelUpload:'取消上传',
            hiddenInputContainer:"<input type='hidden'  name='file_id[]' value='1'/>",
            acceptedFiles:extensions,
            dictDefaultMessage :
                '  <i class="upload-icon ace-icon fa fa-cloud-upload fa-3x"></i><br>\
               最多上传'+6+'张，建议图片宽度1920px，高度不超过500px'
            ,
            dictResponseError: 'Error while uploading file!',
            //change the previewTemplate to use Bootstrap progress bars
            init: function() {
                //this.emit("initimage", initimage);
                this.on("success", function(file,data) {
                    file.file_id = data.id;//赋值file_id便于删除操作
                    var html = "<input type='hidden'  name='banner[]' id='file-"+data.id+"' value='"+data.id+"'/>"
                    $('#banner').append(html);
                    /*$('#dropzone').children().last('div').children('a').attr('file-id',data.id);
                     $('#dropzone').children().find('div.dz-success').children('a').on('click',function(){
                     var index = $(this).parent().index();
                     });*/
                    myDropzone.options.maxFiles--;
                });
                this.on("removedfile", function(file) {
                    var delete_url = $('#dropzone-bar').attr('deleteurl');
                    //只有当文件上传成功之后才能发出删除请求
                    if(file.file_id!=undefined){
                        $.get(delete_url,{'id':file.file_id},function(data){
                            myDropzone.options.maxFiles++;
                        });
                    }
                });

            }
        });
        for(var i in initBanner){
            var mockFile = {name: ""+initBanner[i].name+"", accepted:true, size:initBanner[i].size*1024,file_id:initBanner[i].id};
            myDropzone.emit("addedfile", mockFile);
            myDropzone.emit("thumbnail", mockFile, initBanner[i].url);
            /* myDropzone.createThumbnailFromUrl(file, imageUrl, callback, crossOrigin);*/
            myDropzone.emit("complete", mockFile);
        }
        var existingFileCount = countBanner;
        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
    } catch(e) {
        alert('Dropzone.js does not support older browsers!');
    }

});

jQuery(function($){

    var url = $('#dropzone-main').attr('url');
    Dropzone.autoDiscover = false;
    var attatchment_allow = 1;
    try {
        var myDropzone = new Dropzone("#dropzone-main" , {
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize:  uploadRule.size, // MB
            maxFiles: 1,
            dictMaxFilesExceeded:'你最多能上传一张图片',
            dictFileTooBig:'你上传的文件过大',
            addRemoveLinks : true,
            dictRemoveFile:'删除文件',
            dictCancelUpload:'取消上传',
            hiddenInputContainer:"<input type='hidden'  name='file_id[]' value='1'/>",
            acceptedFiles:extensions,
            dictDefaultMessage :
            '  <i class="upload-icon ace-icon fa fa-cloud-upload fa-3x"></i><br>\
           最多上传'+1+'张，建议图片宽度1920px，高度不超过600px'
            ,
            dictResponseError: 'Error while uploading file!',
            //change the previewTemplate to use Bootstrap progress bars
            init: function() {
                this.emit("initimage", initimage);
                this.on("success", function(file,data) {
                    file.file_id = data.id;//赋值file_id便于删除操作
                    var html = "<input type='hidden'  name='centralAD[]' id='file-"+data.id+"' value='"+data.id+"'/>"
                    $('#centralAD').append(html);
                    /*$('#dropzone').children().last('div').children('a').attr('file-id',data.id);
                     $('#dropzone').children().find('div.dz-success').children('a').on('click',function(){
                     var index = $(this).parent().index();
                     });*/
                    myDropzone.options.maxFiles--;
                });
                this.on("removedfile", function(file) {
                    var delete_url = $('#dropzone-main').attr('deleteurl');
                    //只有当文件上传成功之后才能发出删除请求
                    if(file.file_id!=undefined){

                        $.get(delete_url,{'id':file.file_id},function(data){
                            myDropzone.options.maxFiles++;
                        });
                    }
                });

            }
        });
        for(var i in initCentral){
            var mockFile = {name: ""+initCentral[i].name+"", accepted:true, size:initCentral[i].size*1024,file_id:initCentral[i].id};
            myDropzone.emit("addedfile", mockFile);
            myDropzone.emit("thumbnail", mockFile, initCentral[i].url);
           /* myDropzone.createThumbnailFromUrl(file, imageUrl, callback, crossOrigin);*/
            myDropzone.emit("complete", mockFile);
        }
        var existingFileCount = countCentral;
        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
    } catch(e) {
        alert('Dropzone.js does not support older browsers!');
    }

});

jQuery(function($){

    var url = $('#dropzone-foot').attr('url');
    Dropzone.autoDiscover = false;
    var attatchment_allow = 1;
    try {
        var myDropzone = new Dropzone("#dropzone-foot" , {
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize:  uploadRule.size, // MB
            maxFiles: 1,
            dictMaxFilesExceeded:'你最多能上传一张图片',
            dictFileTooBig:'你上传的文件过大',
            addRemoveLinks : true,
            dictRemoveFile:'删除文件',
            dictCancelUpload:'取消上传',
            hiddenInputContainer:"<input type='hidden'  name='file_id[]' value='1'/>",
            acceptedFiles:extensions,
            dictDefaultMessage :
            '  <i class="upload-icon ace-icon fa fa-cloud-upload fa-3x"></i><br>\
           最多上传'+1+'张，建议图片宽度1920px，高度不超过600px'
            ,
            dictResponseError: 'Error while uploading file!',
            //change the previewTemplate to use Bootstrap progress bars
            init: function() {
                //this.emit("initimage", initimage);
                this.on("success", function(file,data) {
                    file.file_id = data.id;//赋值file_id便于删除操作
                    var html = "<input type='hidden'  name='footerAD[]' id='file-"+data.id+"' value='"+data.id+"'/>"
                    $('#footerAD').append(html);
                    /*$('#dropzone').children().last('div').children('a').attr('file-id',data.id);
                     $('#dropzone').children().find('div.dz-success').children('a').on('click',function(){
                     var index = $(this).parent().index();
                     });*/
                    myDropzone.options.maxFiles--;
                });
                this.on("removedfile", function(file) {
                    var delete_url = $('#dropzone-foot').attr('deleteurl');
                    //只有当文件上传成功之后才能发出删除请求
                    if(file.file_id!=undefined){

                        $.get(delete_url,{'id':file.file_id},function(data){
                            myDropzone.options.maxFiles++;
                        });
                    }
                });

            }
        });
        for(var i in initFooter){
            var mockFile = {name: ""+initFooter[i].name+"", accepted:true, size:initFooter[i].size*1024,file_id:initFooter[i].id};
            myDropzone.emit("addedfile", mockFile);
            myDropzone.emit("thumbnail", mockFile, initFooter[i].url);
            /* myDropzone.createThumbnailFromUrl(file, imageUrl, callback, crossOrigin);*/
            myDropzone.emit("complete", mockFile);
        }
        var existingFileCount = countFooter;
        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
    } catch(e) {
        alert('Dropzone.js does not support older browsers!');
    }

});


function dray_tabedit(ele){
    ele.on('dblclick',function(){
        if($(this).find('input').length){
            return;
        }
        var tbins = $(this);
        var oldval = $(this).text();

        var tabinp = $('<input>',{
            type:'text',
            value:oldval,
            class:'draginp'
        }).appendTo($(this));
        tabinp.focus();
        tabinp.on('blur',function(){
            if($(this).val()){
                tbins.html($(this).val());
                tbins.next().val($(this).val());
            }else{
                tbins.html(oldval);
            }
        });
    });
}
if($('.drag-tabspan').length){
    /*dray_tabedit($('.drag-tabspan'));*/
    $( ".drag-tab" ).sortable({
        cursor: "move",
        delay:"100",
        items :"label",
        revert: true,                       //释放时，增加动画
        update : function(event, ui){       //更新排序之后
            //alert($(this).sortable("toArray"));
        }
    });
}