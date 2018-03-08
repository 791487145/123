<h3 class="header smaller lighter blue mg-top12 mg-bottom20">编辑玩家信息</h3>


<form class="form-horizontal" role="form" action="" method="post">
	{!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">

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
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" value="{{ $user_active->game_name }}" name="game_name">
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 游戏区：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="game_server" value="{{ $user_active->game_server }}">
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 状态：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5"  name="group_id" value="{{ $user_active->group}}" disabled="disabled">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>
	@if($user_active->group_id != 0)
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 状态：</p>
			<select name="report_status">
				<option value="0" @if($user_active->group_b_id == 0) selected @endif>轮空</option>
				@foreach($user_game_match_results as $game_match_result)
					<option value="{{$game_match_result->id}}" @if($user_active->group_b_id == $game_match_result->id) selected @endif>{{$game_match_result->group}}组{{$game_match_result->num}}号</option>
				@endforeach
			</select>
			</p>
		</div>
	@endif
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
