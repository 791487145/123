$(function(){
	//点击头像 取消头像border 隐藏 图标
	$('.u-img').click(function(){
		//关闭第一阶段导航
		$('.u-img').removeClass('u-img-interactive-before');
		$('.u-img').addClass('u-img-interactive-after');

		$('.set-password-interactive').css("display","none");

		//打开第二阶段导航
		$('.password-interactive').addClass('password-interactive-before');
	});
	//点击关闭按钮
	$('.close-set-password-interactive').click(function(){
		/*$('.u-img').removeClass('u-img-interactive-before');
		$('.u-img').addClass('u-img-interactive-after');

		$('.set-password-interactive').css("display","none");*/

		$.ajax({
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/user/updateTips',
			data: {},
			dataType:'json',
			success: function(data){
				if(data.code == 1){
					$('.u-img').removeClass('u-img-interactive-before');
					$('.u-img').addClass('u-img-interactive-after');

					$('.set-password-interactive').css("display","none");
				}else{
					$.gritter.add({
						//            title: '消息提示：',
						text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
						class_name: 'gritter-info gritter-center'
					});
				}
			}
		});

	});
	
	$("#service").click(function(){
		$("[role = 'search']").prop('action','/bre/service');
	})
	$("#task").click(function(){
		$("[role = 'search']").prop('action','/task');
	})
});