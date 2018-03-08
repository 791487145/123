$(function(){
    $('.change_ids').on('change',function(){
        var id = $(this).attr('name');
        var value = $('#change-ids').val();
        if(value==''){
            $('#change-ids').val(id);
        }else{
            var value_array = value.split(',');
            if(value_array.indexOf(id) == -1){
                $('#change-ids').val(value+','+id);
            }
        }
    });
    $('.change_sys_help').on('change',function(){
        $.get('/manage/ajaxUpdateSys',function(data){

        });
    })
    //获取编辑器的内容加入到隐藏域中，便于提交
    $('#onsubmit').on('click',function(){
        $('#description').val($('#editor1').html());
    })

})

//添加规则
function addrule()
{
    var str = "<tr><td><input type=\"text\" name=\"money[]\" value=\"\"> 元以上　<\/td><td><input type=\"text\" name=\"day[]\" value=\"\"> 天　<\/td><td><a href=\"javascript:void(0);\" class=\"addrule\"  onclick=\"addrule()\">添加规则<\/a> <a href=\"javascript:void(0);\" class=\"removerule\" onclick=\"removerule($(this))\">删除规则<\/a><\/td><\/tr><tr><td><div class=\"space-4\"><\/div><\/td><\/tr>";
    $('#add-rule').append(str);
}
//删除规则
function removerule(obj)
{
    obj.parent().parent().next('tr').remove();
    obj.parent().parent().remove();
}
//编辑器
jQuery(function($){

    function showErrorAlert (reason, detail) {
        var msg='';
        if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
        else {
            //console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
    }

    //$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

    //but we want to change a few buttons colors for the third style
    $('#editor1').ace_wysiwyg({
        toolbar:
            [
                'font',
                null,
                'fontSize',
                null,
                {name:'bold', className:'btn-info'},
                {name:'italic', className:'btn-info'},
                {name:'strikethrough', className:'btn-info'},
                {name:'underline', className:'btn-info'},
                null,
                {name:'insertunorderedlist', className:'btn-success'},
                {name:'insertorderedlist', className:'btn-success'},
                {name:'outdent', className:'btn-purple'},
                {name:'indent', className:'btn-purple'},
                null,
                {name:'justifyleft', className:'btn-primary'},
                {name:'justifycenter', className:'btn-primary'},
                {name:'justifyright', className:'btn-primary'},
                {name:'justifyfull', className:'btn-inverse'},
                null,
                {name:'createLink', className:'btn-pink'},
                {name:'unlink', className:'btn-pink'},
                null,
                {name:'insertImage', className:'btn-success'},
                null,
                'foreColor',
                null,
                {name:'undo', className:'btn-grey'},
                {name:'redo', className:'btn-grey'}
            ],
        'wysiwyg': {
            fileUploadError: showErrorAlert
        }
    }).prev().addClass('wysiwyg-style2');


    /**
     //make the editor have all the available height
     $(window).on('resize.editor', function() {
		var offset = $('#editor1').parent().offset();
		var winHeight =  $(this).height();

		$('#editor1').css({'height':winHeight - offset.top - 10, 'max-height': 'none'});
	}).triggerHandler('resize.editor');
     */

    $('[data-toggle="buttons"] .btn').on('click', function(e){
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        var toolbar = $('#editor1').prev().get(0);
        if(which >= 1 && which <= 4) {
            toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
            if(which == 1) $(toolbar).addClass('wysiwyg-style1');
            else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
            if(which == 4) {
                $(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
            } else $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
        }
    });




    //RESIZE IMAGE

    //Add Image Resize Functionality to Chrome and Safari
    //webkit browsers don't have image resize functionality when content is editable
    //so let's add something using jQuery UI resizable
    //another option would be opening a dialog for user to enter dimensions.
    if ( typeof jQuery.ui !== 'undefined' && ace.vars['webkit'] ) {

        var lastResizableImg = null;
        function destroyResizable() {
            if(lastResizableImg == null) return;
            lastResizableImg.resizable( "destroy" );
            lastResizableImg.removeData('resizable');
            lastResizableImg = null;
        }

        var enableImageResize = function() {
            $('.wysiwyg-editor')
                .on('mousedown', function(e) {
                    var target = $(e.target);
                    if( e.target instanceof HTMLImageElement ) {
                        if( !target.data('resizable') ) {
                            target.resizable({
                                aspectRatio: e.target.width / e.target.height,
                            });
                            target.data('resizable', true);

                            if( lastResizableImg != null ) {
                                //disable previous resizable image
                                lastResizableImg.resizable( "destroy" );
                                lastResizableImg.removeData('resizable');
                            }
                            lastResizableImg = target;
                        }
                    }
                })
                .on('click', function(e) {
                    if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
                        destroyResizable();
                    }
                })
                .on('keydown', function() {
                    destroyResizable();
                });
        }

        enableImageResize();

        /**
         //or we can load the jQuery UI dynamically only if needed
         if (typeof jQuery.ui !== 'undefined') enableImageResize();
         else {//load jQuery UI if not loaded
			$.getScript($path_assets+"/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
				enableImageResize()
			});
		}
         */
    }


});