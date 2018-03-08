  $("#shop_id").click(
        function () {

            var shop_id = $("#shop_id").attr('shop_id');
			
			$.get('/shop/ajaxAdd', {'shop_id': shop_id}, function (data) {
				if (data.code == 1) {
					location.reload();
				}
			});
        });



//��ϵ��
$('#contactMe').on('click',function(){
    var content = $('#content').val();
    var js_id = $('.js_id').val();
    $.ajax({
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/bre/contactMe',
        data: {content:content,js_id:js_id},
        dataType:'json',
        success: function(data){
            if(data.code == 1){
                location.reload();
            }else{
                $.gritter.add({
                    //            title: '��Ϣ��ʾ��',
                    text: '<div><span class="text-center"><h5>' + data.msg + '</h5></span></div>',
                    class_name: 'gritter-info gritter-center'
                });
            }
        }
    });
 });

var oLeftSidebar = $('.nedds-sidebar-left').height();
var oRightnedds = $('.needs-rights').height();
  if( oRightnedds < oLeftSidebar ){
      $('.needs-rights').css('height',oLeftSidebar+'px');
  }

