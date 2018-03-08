{{--<div class="well">
	<h4 >编辑普通用户资料</h4>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">编辑普通用户资料</h3>

<form class="form-horizontal registerform" role="form" action="{!! url('manage/userEdit') !!}" method="post">
    {!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">
		<input type="hidden" name="uid" value="{!! $info['id'] !!}">
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 用户名：</p>
			<p class="col-sm-4">
				<input type="text" disabled="disabled" id="form-field-1" class="col-xs-10 col-sm-5" value="{!! $info['name'] !!}">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 真实姓名：</p>
			<p class="col-sm-4">
				<input type="text" name="realname" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['realname'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 手机号码：</p>
			<p class="col-sm-4">
				<input type="text" name="mobile" id="form-field-1"   class="col-xs-10 col-sm-5" value="{!! $info['mobile'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> QQ号码：</p>
			<p class="col-sm-4">
				<input type="text" name="qq" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['qq'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 电子邮箱：</p>
			<p class="col-sm-4">
				<input type="text" name="email" id="form-field-1"  class="col-xs-10 col-sm-5" datatype="e" value="{!! $info['email'] !!}">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p  class="col-sm-1 control-label no-padding-left">所在地：</p>
			<div class="col-sm-5">
				<div class="row">
					<p class="col-sm-6">
						<select name="province" id="province" class="form-control validform-select Validform_error" onchange="getZone(this.value, 'city');">
							<option value="">请选择省份</option>
							@foreach($province as $item)
								<option @if($info['province'] == $item['id'])selected="selected"@endif value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
							@endforeach
						</select>
					</p>
					<p class="col-sm-6">
						<select class="form-control  validform-select" name="city" id="city" onchange="getZone(this.value, 'area');">
							@if(empty($city))
							<option value="">请选择城市</option>
							@else
							<option selected="selected" value="{!! $info['city'] !!}">{!! $city !!}</option>
							@endif
						</select>
					</p>
				</div>
			</div>

			<div class="col-sm-3">
				<select class="form-control  validform-select" name="area" id="area">
					@if(empty($area))
						<option value="">请选择区域</option>
					@else
						<option selected="selected" value="{!! $info['area'] !!}">{!! $area !!}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 出生日期：</p>
			<div class="col-sm-4">
				<p class="input-group input-group-sm col-xs-10 col-sm-5">
					<input type="text" id="datepicker" class="form-control hasDatepicker">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-calendar"></i>
					</span>
				</p>
			</div>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 密&nbsp;&nbsp;码：</p>
			<p class="col-sm-5">
				<input type="password" id="form-field-1"  class="col-xs-10 col-sm-5" name="password" datatype="*">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i>（提示：更改此密码不会修改用户的支付密码）</span>
			</p>
		</div>
		{{--<div class="form-group text-center">
				<label class="col-sm-1 control-label no-padding-left" for="form-field-1"></label>
				<div class="col-sm-3 text-left">
					　<button class="btn btn-primary btn-sm">提交</button>
				</div>
		</div>--}}
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
		<div class="space col-xs-12"></div>
		<div class="col-xs-12">
			<div class="col-md-1 text-right"></div>
			<div class="col-md-10"><a href="">上一项</a>　　<a href="">下一项</a></div>
		</div>
		<div class="col-xs-12 space">

		</div>
	</div>
</form>

{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userManage-js', 'js/userManage.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('main-js', 'js/main.js') !!}
