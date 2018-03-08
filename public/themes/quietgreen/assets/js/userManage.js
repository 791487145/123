jQuery(function($) {
		/**var oTable1 = 
	$('#sample-table-2')
	//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
	.dataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null,null, null, null,
		  { "bSortable": false }
		],
		"aaSorting": [],

		//,
		//"sScrollY": "200px",
		//"bPaginate": false,

		//"sScrollX": "100%",
		//"sScrollXInner": "120%",
		//"bScrollCollapse": true,
		//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
		//you may want to wrap the table inside a "div.dataTables_borderWrap" element

		//"iDisplayLength": 50
    } );

	var tableTools = new $.fn.dataTable.TableTools( oTable1, {
		"sSwfPath": "../../copy_csv_xls_pdf.swf",
        "buttons": [
            "copy",
            "csv",
            "xls",
			"pdf",
            "print"
        ]
    } );
    $( tableTools.fnContainer() ).insertBefore('#sample-table-2');
	*/
	$( "#datepicker" ).datepicker({
		showOtherMonths: true,
		selectOtherMonths: false,
		//isRTL:true,

		
		/*
		changeMonth: true,
		changeYear: true,
		
		showButtonPanel: true,
		beforeShow: function() {
			//change button colors
			var datepicker = $(this).datepicker( "widget" );
			setTimeout(function(){
				var buttons = datepicker.find('.ui-datepicker-buttonpane')
				.find('button');
				buttons.eq(0).addClass('btn btn-xs');
				buttons.eq(1).addClass('btn btn-xs btn-success');
				buttons.wrapInner('<span class="bigger-110" />');
			}, 0);
		}
*/
	});

	$(document).on('click', 'th input:checkbox' , function(){
		var that = this;
		$(this).closest('table').find('tr > td:first-child input:checkbox')
		.each(function(){
			this.checked = that.checked;
			$(this).closest('tr').toggleClass('selected');
		});
	});

	$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
	function tooltip_placement(context, source) {
		var $source = $(source);
		var $parent = $source.closest('table')
		var off1 = $parent.offset();
		var w1 = $parent.width();

		var off2 = $source.offset();
		//var w2 = $source.width();

		if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
		return 'left';
	}


	//时间选择器
	$('.input-daterange').datepicker({autoclose:true});

	//表单验证初始化
	var demo=$(".registerform").Validform({
	    tiptype:3,
	    label:".label",
	    showAllError:true,
		ajaxPost:false,
	    datatype:{
			"zh4-20":/^[\u4E00-\u9FA5\uf900-\ufa2d]{4,20}$/,
			"n16-19":/^\d{16,19}$/,
		},
	});
	demo.eq(0).config({
		ajaxurl:{
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		}
	});
	demo.eq(4).config({
		ajaxurl:{
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		}
	});
})


