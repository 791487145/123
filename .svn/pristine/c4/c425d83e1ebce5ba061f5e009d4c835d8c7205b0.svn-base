jQuery(function($) {
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
