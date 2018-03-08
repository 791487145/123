<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加战队信息</h3>

<form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
	{!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 战队名称：</p>
		<p class="col-sm-4">
			<input type="text" placeholder="长度为1-6位" id="form-field-1" name="team_name"  class="col-xs-10 col-sm-5" value="{{$user_active_team->team_name}}">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<label class="col-sm-1 control-label no-padding-right" for="form-field-1"><strong>战队LOGO</strong>  </label>
		<div class="col-sm-4">
			<div class="memberdiv pull-left">
				<div class="position-relative">
					<img src = "{{env('ZFY_WEB')}}/{{$user_active_team->logo}}" alt="暂无图片" height="100px" width="100px">
				</div>
			</div>
		</div>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<label class="col-sm-1 control-label no-padding-right" for="form-field-1"><strong>上传LOGO</strong>  </label>
		<div class="col-sm-4">
			<div class="memberdiv pull-left">
				<div class="position-relative">
					<input type="file" id="id-input-file-3" name="pic" />
				</div>
			</div>
		</div>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1">队长昵称：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" value="{{$user_active_team->captain_name}}" name="captain_name">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 战队人数：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="remark" value="5" readonly>
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 状态：</p>
			<select name="report_status">
				<option value="0" @if($user_active_team->report_status == 0) selected @endif>未报名</option>
				<option value="1" @if($user_active_team->report_status == 1) selected @endif>已报名</option>
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







