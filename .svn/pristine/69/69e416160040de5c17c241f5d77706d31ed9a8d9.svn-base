jQuery(function($) {

        $('#id-input-file-3').ace_file_input({
            style:'well',
            btn_choose:'上传图片',
            btn_change:null,
            no_icon:false,
            droppable:true,
            thumbnail:'small'//large | fit
            //,icon_remove:null//set null, to hide remove/reset button
            /**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
            /**,before_remove : function() {
						return true;
					}*/
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

        $('#spinner3').ace_spinner({
            value:0,
            min:0,
            max:100,
            step:1,
            on_sides: true,
            icon_up:'ace-icon fa fa-plus smaller-75',
            icon_down:'ace-icon fa fa-minus smaller-75',
            btn_up_class:'btn-success' ,
            btn_down_class:'btn-danger'
        });


        $('#date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
        $('#date-timepicker2').datetimepicker().next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

   });
