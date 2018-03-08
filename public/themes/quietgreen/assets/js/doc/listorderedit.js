jQuery(function($) {
	
	$(".allcheck").click(function(){
		if($(".checkbox").prop("checked") == true){
			$(".checkbox").removeAttr("checked");
		}
		else{
			$(".checkbox").prop("checked",'checked');
		}
	})

})
function changeSort(obj){
		var sort = $(obj).val();
		var id = $(obj).attr('rel');
		var url = "/manage/listorderUpdate";
		$.get(url,{id:id,sort:sort},function(data){
			if(data['status'] == 'success'){
				return true;
			}else{
				location.href='/manage/hotwordsList';
			}
		});
}