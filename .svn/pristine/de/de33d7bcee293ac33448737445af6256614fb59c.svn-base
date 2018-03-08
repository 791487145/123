$(function(){
    //old
    $("#addpic").change(function(){
        var filepath= $("#back").val();
        if ($.trim(filepath) == "") {
            return false;
        }
        var extStart=filepath.lastIndexOf(".");
        var ext=filepath.substring(extStart,filepath.length).toUpperCase();
        if(ext!=".BMP"&&ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
            return false;
        }
        $.ajax({
            url: '/shop/ajaxUpdatePic',
            type: 'POST',
            cache: false,
            data: new FormData($('#uploadpic')[0]),
            processData: false,
            contentType: false,
            success:function(data){
                $('#backgroud-img').attr('src',data.domain+'/'+data.path).attr('name',data.path);
            }
        }).done(function(res) {
        }).fail(function(res) {});
    })

    $("#changeBack").click(function(){
        var picsrc = $('#backgroud-img').attr("name");
        var src = $('#backgroud-img').attr("src");

        $('#backgroud-img2').attr('src',src);
        $.get('/shop/ajaxUpdateBack',{'src':picsrc},function(data){
            
        });
    })


    $('#gritter-center').on(ace.click_event, function(e){
		var shop_status = $(this).attr('shop_status');
		if(shop_status == 1){
			$('#myModalclose').modal('toggle');
            e.preventDefault();
		}else if(shop_status == 2){
			switchStatus($(this));
            e.preventDefault();
		}
    });

    $('#changeBackshop').on(ace.click_event, function(){
		switchStatus($(this));
    });

});
function switchStatus(obj)
{

    var shopId = obj.attr('shop_id');
	var shopStatus = obj.attr('shop_status');

    $.get('/shop/ajaxUpdateShop',{'id':shopId},function(data){
		if(data.code == 1){
			if(shopStatus == 1){
				$.gritter.add({
					title: '',
					text: '<div class="cor-gray51 text-size14 text-center">店铺已关闭</div>',
					class_name: 'gritter-info gritter-center'
				});
			}
			else if(shopStatus == 2){
				$.gritter.add({
					title: '',
					text: '<div class="cor-gray51 text-size14 text-center">店铺已开张，可以添加商品哦</div>',
					class_name: 'gritter-info gritter-center'
				});
			}
			location.reload();
		}
		else{
			$.gritter.add({
					title: '',
					text: '<div class="cor-gray51 text-size14 text-center">'+data.message+'</div>',
					class_name: 'gritter-info gritter-center'
				});
		}
    });
}
function delback(obj)
{
    var shopId = obj.attr('shop_id');
    $.get('/shop/ajaxDelPic',{'id':shopId},function(data){
        //$('#backgroud-img').attr('src',data.domain+'/themes/default/assets/images/personal_back.png');
        //$('#backgroud-img2').attr('src',data.domain+'/themes/default/assets/images/personal_back.png');
        location.reload();
    });
}
