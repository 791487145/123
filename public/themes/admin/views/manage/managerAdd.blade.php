
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加系统用户资料</h3>


<form class="form-horizontal clearfix registerform" role="form" action="managerAdd" method="post">
	{!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 用户名：</p>
			<p class="col-sm-4">
				<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="username" ajaxurl="{!! url('manage/checkManageName') !!}" datatype="*4-15" nullmsg="请输入用户名" errormsg="用户名长度为4到15位字符">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 真实姓名：</p>
			<p class="col-sm-4">
				<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="realname">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 手机号码：</p>
			<p class="col-sm-4">
				<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="telephone">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> QQ号码：</p>
			<p class="col-sm-4">
				<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="QQ">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 电子邮箱：</p>
			<p class="col-sm-4">
				<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="email" ajaxurl="{!! url('manage/checkManageEmail') !!}" datatype="e" nullmsg="请输入邮箱帐号" errormsg="邮箱地址格式不对！">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 出生日期：</p>
			<div class="col-sm-4">
				<p class="input-group input-daterange input-group-sm col-xs-10 col-sm-5">
					<input type="text" class="input-sm form-control hasDatepicker" name="birth">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-calendar"></i>
					</span>
				</p>
			</div>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 密码：</p>
			<p class="col-sm-5">
				<input type="password" id="form-field-1"  class="col-xs-10 col-sm-5" name="password" datatype="*6-16">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i>（提示：更改此密码不会修改用户的支付密码）</span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 用户组：</p>
			<p class="col-sm-4">
				<select name="role_id">
					@foreach($roles as $v)
						<option value="{{ $v['id'] }}" >{{ $v->display_name }}</option>
					@endforeach()
				</select>
				{{--@foreach($roles as $v)--}}

						{{--<span class="help-inline power-list">--}}
																	{{--<label class="middle">--}}
																		{{--<input class="ace" type="checkbox" id="id-disable-check1" name="id[]" value = "{{ $v->id }}">--}}
																		{{--<span class="lbl">{{ $v['display_name'] }}</span>--}}
																	{{--</label>--}}
																{{--</span>--}}

				{{--@endforeach()--}}
			</p>
		</div>
		{{--<div class="form-group text-center">
				<label class="col-sm-1 control-label no-padding-left" for="form-field-1"></label>
				<div class="col-sm-3 text-center">
					<button class="btn btn-primary" type="submit">提交</button>
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
