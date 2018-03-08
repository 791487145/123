$(function() {
	//取消收藏某一店铺
	$('.myshop-btn-cencel').on('click',function(){
		var id = $(this).attr('data-id');
		var shop_name = $(this).attr('data-values');
		$('#shop_name').text(shop_name);
		$('#shop_id').val(id);
	});
	$('#win-bid').on('click',function(){
		var id = $('#shop_id').val();
		var title = $('#title').val();
		$.ajax({
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/user/cancelCollect',
			data: {id:id},
			dataType:'json',
			success: function(data){
				if(data.code == 1){
					if(title){
						location.href='/user/myCollectShop?shop_name='+title;
					}else{
						location.href='/user/myCollectShop';
					}
				}else{
					$.gritter.add({
						text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
						class_name: 'gritter-info gritter-center'
					});
				}
			}
		});
	});

});