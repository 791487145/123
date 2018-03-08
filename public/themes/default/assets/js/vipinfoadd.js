
$(document).ready(function(){
    $(".aStar").click(function() {
            $(".aStop").toggle();
			if($("#status").is(':checked') == false){
				$("#status").attr("value","1");
			}else{
				$("#status").attr("value","");
				if($("#is_recommend").is(':checked') == true){
					$("#is_recommend").removeAttr('checked');
					$("#is_recommend").attr('value',"");
				}
			}
    });
	$(".aStop").click(function() {
			if($("#is_recommend").is(':checked') == true){
				$("#is_recommend").attr("value","1");
			}else{
				$("#is_recommend").attr("value","");
			}
    });
})