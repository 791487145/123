<link rel="stylesheet" type="text/css" href="{{ asset('uploadify/uploadify.css') }}">

<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加赛制信息</h3>


<form class="form-horizontal" role="form" action="add" enctype="multipart/form-data" method="post">
	{!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">
		<input type="hidden" name="pid" value="{{$pid}}">
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 赛制名称：</p>
		<p class="col-sm-4">
			<input type="text" placeholder="长度为1-6位" id="form-field-1" name="name"  class="col-xs-10 col-sm-5" value="">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 排序：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1" name="sort"  class="col-xs-10 col-sm-5" value="0">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 所属项目：</p>
			<select name="category">
				<option value="1" selected>王者荣耀</option>
			</select>
		</p>
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
{{--{!! Theme::widget('editor')->render() !!}--}}
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







