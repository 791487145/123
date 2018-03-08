<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加战队信息</h3>

<form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
	{!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">

		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务标题：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="长度为1-6位" id="form-field-1" name="team_name"  class="col-xs-10 col-sm-5" value="{{$task_water->title}}">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务描述：</p>
			<p class="col-sm-4">
				<textarea name="desc" cols="20">{{$task_water->desc}}</textarea>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务类型：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="长度为1-6位" id="form-field-1" name="team_name"  class="col-xs-10 col-sm-5" value="{{$task_water->task_cate_name}}" readonly>
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 学校限定：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="长度为1-6位" id="form-field-1" name="team_name"  class="col-xs-10 col-sm-5" value="{{$task_water->region_limit}}">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务赏金：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="长度为1-6位" id="form-field-1" name="team_name"  class="col-xs-10 col-sm-5" value="{{$task_water->bounty}}">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务限制等级：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="长度为1-6位" id="form-field-1" name="team_name"  class="col-xs-10 col-sm-5" value="{{$task_water->user_grade}}">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 任务展示时间：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="长度为1-6位" id="form-field-1" name="team_name"  class="col-xs-10 col-sm-5" value="{{$task_water->publicity_at}}">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>

		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 发布人名字：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="长度为1-6位" id="form-field-1" name="team_name"  class="col-xs-10 col-sm-5" value="{{$task_water->username}}">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 发布人电话：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="长度为1-6位" id="form-field-1" name="team_name"  class="col-xs-10 col-sm-5" value="{{$task_water->phone}}">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 发布人头像：</p>
			<p class="col-sm-4">
				<img src = "{{env('ZFY_WEB')}}/{{$task_water->avatar}}" style="height: 50px ; width: 50px;">
			</p>
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







