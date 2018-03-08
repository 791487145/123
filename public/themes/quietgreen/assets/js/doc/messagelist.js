jQuery(function($) {
	//是否开启
	$('.is_open').on('click',function(){
		var id = $(this).parents('td').siblings('.id').attr('data-id');
		var value = $(this).val();
		console.log(value);
		location.href = '/manage/changeStatus/'+id+'/1/'+value;
	});
	//站内短信
	$('.is_on_site').on('click',function(){
		var id = $(this).parents('td').siblings('.id').attr('data-id');
		var value;
		if($(this).is(':checked')) {
			value = 1;
		} else{
			value = 0;
		}
		location.href = '/manage/changeStatus/'+id+'/2/'+value;
	});
	//发送邮件
	$('.is_send_email').on('click',function(){
		var id = $(this).parents('td').siblings('.id').attr('data-id');
		var value;
		if($(this).is(':checked')) {
			value = 1;
		} else{
			value = 0;
		}
		location.href = '/manage/changeStatus/'+id+'/3/'+value;
	});

});