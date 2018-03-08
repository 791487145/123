function getReInfo(obj){	
	var type = $(obj).val();
	switch(type){
		case 'service':
		case 'successcase':
		case 'article':
		case 'task':
		case 'shop':
		case 'work':
		case 'server':
			var url = '/advertisement/getReInfo';
			$.get(url,{type:type},function(data){
				if(data){
					$('.chosen-select').chosen({allow_single_deselect:true,max_selected_options:1});
					$('#form-field-select-4').html(data);
					$(".chosen-select").trigger("chosen:updated");
				}
				});
			break;
		default:
		$('.chosen-select').chosen({allow_single_deselect:true,max_selected_options:1});
		$('#form-field-select-4').html('');
		$(".chosen-select").trigger("chosen:updated");
		
	}
}

jQuery(function($) {
	$('#id-disable-check').on('click', function() {
            var inp = $('#form-input-readonly').get(0);
            if(inp.hasAttribute('disabled')) {
                inp.setAttribute('readonly' , 'true');
                inp.removeAttribute('disabled');
                inp.value="This text field is readonly!";
            }
            else {
                inp.setAttribute('disabled' , 'disabled');
                inp.removeAttribute('readonly');
                inp.value="This text field is disabled!";
            }
        });

		$('.chosen-select').chosen({allow_single_deselect:true,max_selected_options:1});
        
        //resize the chosen on window resize

        $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select').each(function() {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            }).trigger('resize.chosen');


        $('#chosen-multiple-style').on('click', function(e){
            var target = $(e.target).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
            else $('#form-field-select-4').removeClass('tag-input-style');
        });


        $('[data-rel=tooltip]').tooltip({container:'body'});
        $('[data-rel=popover]').popover({container:'body'});
})

jQuery(function($) {
     //初始化绑定change事件
     $(".chosen-select").chosen({no_results_text: "没有匹配结果"}).change(function(){
         $('#recommend_id').val($(this).val());
		 var id = $(this).val();
		 var type = $("select[name='type']").val();
		 var domain = $('#domain').val();
		 console.log(domain);
		 switch(type){
			case 'service':
				var middleUrl = '/bre/serviceCaseList/';
				break;
			case 'successcase':
				var middleUrl = '/task/successDetail/';
				break;
			case 'article':
				var middleUrl = '/article/';
				break;
			case 'task':
				var middleUrl = '/task/';
				break;
			case 'shop':
				var middleUrl = '/shop/';
				break;
			case 'work':
				var middleUrl = '/shop/buyGoods/';
				break;
			case 'server':
				var middleUrl = '/shop/buyservice/';
				break;
			default:
			var middleUrl = '';
		
		}
		if(domain && middleUrl && id){
			var url = domain+middleUrl+id;
			$("input[name='url']").val(url);
		}
		else{
			var url = '';
			$("input[name='url']").val(url);
		}
     });

	//不同推荐位置建议不同图片尺寸
	var recommend_code = $('.position_id option:selected').attr('data-values');
	var html = getPicHtml(recommend_code);
	if(html){
		$('.recommend_type').siblings('label').html(html);
	}
	$('.position_id').change(function(){
		var recommend_code = $('.position_id option:selected').attr('data-values');
		var html = getPicHtml(recommend_code);
		if(html){
			$('.recommend_type').siblings('label').html(html);
		}

	});

	function getPicHtml(recommend_position){
		switch(recommend_position){
			case 'HOME_MIDDLE':
				var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
						'位于首页推荐服务商，图片尺寸建议大小为230px*235px</span>';
				break;
			case 'HOME_MIDDLE_BOTTOM':
				var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
						'位于首页成功案例，图片尺寸建议大小为285px*200px</span>';
				break;
			case 'HOME_BOTTOM':
				var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
						'位于首页资讯，最新推荐图片尺寸建议大小为387px*340px，其余尺寸为158px*158px</span>';
				break;
			case 'HOME_MIDDLE_SHOP':
				var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
						'位于首页店铺，图片尺寸建议大小为231px*235px</span>';
				break;
			case 'HOME_MIDDLE_WORK':
				var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
						'位于首页作品，图片尺寸建议大小为285px*285px</span>';
				break;
			case 'HOME_MIDDLE_SERVICE':
				var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
						'位于首页服务，图片尺寸建议大小为285px*285px</span>';
				break;

			default:
				var html = '<span class="cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>' +
						'其余位置，图片尺寸适中即可</span>';
		}
		return html;
	}
 });