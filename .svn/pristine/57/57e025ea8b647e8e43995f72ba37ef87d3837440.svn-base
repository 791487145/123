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
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5"  name="group_id" value="{{ $user_active->group}}组{{ $user_active->num}}号" disabled="disabled">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 晋级：</p>
		<select name="u_g_r_id">
			<option value="0">暂不晋级</option>
			@foreach($user_game_rules as $user_game_rule)
				<option value="{{$user_game_rule->id}}" @if($user_active->competition == $user_game_rule->id) selected @endif>{{$user_game_rule->name}}</option>
			@endforeach
		</select>
		</p>
	</div>

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 比赛结果：</p>
		<select name="match_result">
			<option value="0" @if($user_active->winner == 0) selected @endif>暂不选择</option>
			<option value="2" @if($user_active->winner == $user_active->group_id) selected @endif>获胜</option>
			<option value="1" @if($user_active->winner == $user_active->group_b_id) selected @endif>失败</option>
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
