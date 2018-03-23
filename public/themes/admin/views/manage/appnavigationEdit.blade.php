<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加菜单</h3>


<form class="form-horizontal" role="form" action="" method="post">
	{!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 菜单名：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1" name="name"  class="col-xs-10 col-sm-5" value="{{$app_navigation->name}}">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 路由：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" value="{{$app_navigation->url}}" name="url">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 排序：</p>
		<p class="col-sm-4">
			<input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" value="{{$app_navigation->sort}}" name="sort">
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
