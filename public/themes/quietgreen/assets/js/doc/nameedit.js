function changeName(obj){	
		var name = $(obj).val();
		var id = $(obj).attr('rel');
		var url = "/advertisement/nameUpdate";
		$.get(url,{id:id,name:name},function(data){
			if(data['status'] == 'success'){
				return true;
			}else{
				location.href='/advertisement/recommendList';
			}
		});
	}