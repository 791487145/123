<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加图片</h3>

<form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
	<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
	<div class="g-backrealdetails clearfix bor-border">


	<div class="reason lineB mb-6">
		<dl>
			<dt>添加图片：</dt>
			<dd>
				<div class="fileResult" style="min-height:70px;">
					<span class="fileUpload">
						<label><input type="file" name="files[]" id="image_upload" accept="image/jpg,image/jpeg,image/png,image/gif" multiple/></label>
					</span>
				</div>
			</dd>
		</dl>
	</div>
	<div class="col-xs-12">
		<div class="clearfix row bg-backf5 padding20 mg-margin12">
			<div class="col-xs-12">
				<div class="col-md-1 text-right"></div>
				<div class="col-md-10">
					<button class="btn btn-primary btn-sm" type="submit">提交</button>
				</div>
			</div>
		</div>
	</div>
	</div>
</form>

{!! Theme::widget('popup')->render() !!}

{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('chosen', 'plugins/ace/css/chosen.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('style','css/blue/style.css') !!}

{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('chosen','plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('backstage', 'js/doc/successcase.js') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}




{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
<script type="text/javascript" src="{{asset('uploadify/pict.js')}}"></script>
<script>
	$(function(){
		var _upFile=document.getElementById("image_upload");
		_upFile.addEventListener("change",function(){

			var result = $(this).parents(".fileResult");
			var spanLen = $(this).parents(".fileResult").children("span").length;
			if (_upFile.files.length === 0) {
				alert("请选择图片");
				return; }
			var length = _upFile.files.length;
			if(length + spanLen > 6){
				alert("最多只能上传五张");
				return false;
			}

			for(i=0;i<length;i++){
				var oFile = _upFile.files[i];
				if(!new RegExp("(jpg|jpeg|png|gif)+","gi").test(oFile.type)){
					alert("照片上传：文件类型必须是JPG、JPEG、PNG");
					return false;
				}
				var _token = $("#_token").val();
				var reader = new FileReader();
				reader.onload = function(e) {

					var base64Img= e.target.result;
					var _ir=ImageResizer({
						resizeMode:"auto"
						,dataSource:base64Img
						,dataSourceType:"base64"
						,maxWidth:1200 //允许的最大宽度
						,maxHeight:600 //允许的最大高度。
						,onTmpImgGenerate:function(img){

						}
						,success:function(resizeImgBase64,canvas){
							$.post('/manage/imageUpload',{imgOne:resizeImgBase64,_token:_token},function(data){
								$(".fileResult").prepend('<span class="img">' +
										'<img src="{{env('ZFY_WEB')}}/' + data +'" style="width: 50px;height: 50px">' +
										'<input class="image" type="hidden" name="image[]" value="' + data +'">' +
										'<i class="delete"></i>' +
										'</span>');
								$(".fileResult .img").click(function(){
									$(this).remove();
									$(".fileUpload").show();
								});
							})
						}
						,debug:false
					});
				};
				reader.readAsDataURL(oFile);
			}
			if(length + spanLen == 6){
				$(".fileUpload").hide();
			}
		},false);
	});

</script>





