<h3 class="header smaller lighter blue mg-top12 mg-bottom20">编辑玩家信息</h3>


<form class="form-horizontal" role="form" action="" method="post">
	{!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">
	<input type="hidden" name="u_a_m_r_id" value="{{$user_active->u_g_m_r_id}}">
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 编号：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1" name="id"  class="col-xs-10 col-sm-5" value="{{ $user_active->id }}"  disabled="disabled">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 用户名：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" value="{{ $user_active->name }}" name="name" disabled="disabled">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 游戏昵称：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" value="{{ $user_active->game_name }}" name="game_name" disabled="disabled">
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 游戏区：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="game_server" value="{{ $user_active->game_server }}" disabled="disabled">
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 组号：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5"  name="group_id" value="{{ $user_active->group}}" disabled="disabled">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 对手：</p>
		<select name="ugmg_id">
			<option value="{{$user_active->group_b_id}}" selected>{{$user_active->group_b}}</option>
		</select>
		</p>
	</div>

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 比赛结果：</p>
		<select name="match_result">
			<option value="0" @if($user_active->win == 0) selected @endif>暂无结果</option>
			<option value="{{$user_active->group_id}}" @if($user_active->group_id == $user_active->win) selected @endif>获胜</option>
			@if($user_active->group_b_id != 0)
				<option value="{{$user_active->group_b_id}}" @if($user_active->group_b_id == $user_active->win) selected @endif>失败</option>
			@endif
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

{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
