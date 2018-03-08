$(".push-goods-soon").click(function(){
	var value = $("#type").val();
	var uid = $(".push-goods-soon").attr("rel");
	$.get('/bre/changeUrl',{'type':value,'uid':uid},function(data){
		location.href= data;
	})
})
