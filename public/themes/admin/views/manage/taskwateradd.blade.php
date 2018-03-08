<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加任务信息</h3>

<form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
	{!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border" style="width: 90% ; height: 1000px">

		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务标题：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="长度为1-6位" id="form-field-1" name="title"  class="col-xs-10 col-sm-5" value="">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务描述：</p>
			<p class="col-sm-4">
				<textarea name="desc" cols="40"></textarea>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 学校限定：</p>
			<p class="col-sm-4">
				<select name="region_limit_num" id="myselect">
					<option value="">请选择</option>
					<option value="1">是</option>
					<option value="0">否</option>
				</select>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12 school">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 请选择学校：</p>
			<p class="col-sm-4">
				<select name="region_limit">
					@foreach($school as $v)
						<option value="{{$v->id}}">{{$v->name}}</option>
					@endforeach
				</select>
			</p>
		</div>

		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务赏金：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="最小为1" id="form-field-1" name="bounty"  class="col-xs-10 col-sm-5" value="">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务限制等级：</p>
			<p class="col-sm-4">
				<select name="user_grade">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
				</select>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务展示时间：</p>
			<p class="col-sm-4">
				<select name="publicity_at">
					<option value="24">24小时</option>
					<option value="48">48小时</option>
					<option value="72">72小时</option>
				</select>
			</p>
		</div>

		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 发布人名字：</p>
			<p class="col-sm-4">
				<input type="text" id="form-field-1" name="username"  class="col-xs-10 col-sm-5" value="">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 发布人电话：</p>
			<p class="col-sm-4">
				<input type="text" id="form-field-1" name="phone"  class="col-xs-10 col-sm-5" value="">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12" style="height: 270px ; width: 100%; border: 1px solid #ddd">
			<div style="height: 20px ; width: 100%; border: 1px solid #ddd">头像：</div>
			<div style="height: 180px ; width: 100%; border: 1px solid #ddd" id="demoContent"></div>
			<div style="height: 70px ; width: 100%">
				<ul class="page" id="page"></ul>
			</div>
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
@foreach($image as $k=>$v)
	<input type="hidden" value="{{$k}}-{{$v}}" class="image">
@endforeach

<script>
	$(".school").hide();
	$("#myselect").change(function(){
		var opt=$("#myselect").val();
		if(opt == 1){
			$(".school").show();
		}else{
			$(".school").hide();
		}
	});
</script>

{!! Theme::widget('popup')->render() !!}

<link href="{{asset('uploadify/page.css')}}" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="{{asset('uploadify/page.js')}}"></script>

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

<script>
	var image = $(".image");
	var images = [];

	for(i = 0;i<image.length;i++){
		var a = image[i].defaultValue;
		images.push(a);
	}

	datas = images;
	var options={
		"id":"page",//显示页码的元素
		"data":datas,//显示数据
		"maxshowpageitem":3,//最多显示的页码个数
		"pagelistcount":9,//每页显示数据个数
		"callBack":function(result){
			var cHtml="";
			for(var i=0;i<result.length;i++){
				var arr = result[i].split('-');

				cHtml+="<div style='height: 50px ; width: 30%;float:left; border: 1px solid #ddd'>" +
							"<input type='radio' name='image' value='"+arr[1]+"'>" +
							"<img src = '{{env('ZFY_WEB')}}/"+arr[1]+"' style='height: 50px ; width: 50px'>" +
						"</div>";
			}

			$("#demoContent").html(cHtml);//将数据增加到页面中
		}
	};
	page.init(datas.length,1,options);
</script>






