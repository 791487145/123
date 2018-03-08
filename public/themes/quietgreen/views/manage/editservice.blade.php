
<!-- /section:basics/navbar.layout -->
{{--<div class="main-container" id="main-container">
    <!-- /section:basics/sidebar -->
	<div class="main-content">--}}
	    <!-- #section:basics/content.breadcrumbs -->
	    {{--<div class="breadcrumbs" id="breadcrumbs">--}}
	        {{--<script type="text/javascript">--}}
	            {{--try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}--}}
	        {{--</script>--}}
	
	        {{--<ul class="breadcrumb">--}}
	            {{--<li class="">--}}
	                {{--<i class="ace-icon fa fa-tasks home-icon"></i>--}}
	                {{--<a href="/manage/serviceList">增值工具</a>--}}
	            {{--</li>--}}
	            {{--<li class="">--}}
	                {{--<a href="/manage/serviceList">增值工具管理</a>--}}
	            {{--</li>--}}
	            {{--<li class="active">增值工具编辑</li>--}}
	        {{--</ul><!-- /.breadcrumb -->--}}
	        {{--<!-- /section:basics/content.searchbox -->--}}
	    {{--</div>--}}
	
	    <!-- /section:basics/content.breadcrumbs -->

<h3 class="header smaller lighter blue mg-top12 mg-bottom20">增值工具编辑</h3>
{{--<h3 class="header smaller lighter blue">增值工具编辑</h3>--}}
{{--<div class="widget-header widget-header-flat">
<h5 class="widget-title">增值工具编辑</h5>
</div>--}}



<form action="/manage/postEditService" method="post">
		{{ csrf_field() }}
		<input type="hidden" value="{{ $serviceInfo['id'] }}" name="id" />
	<div class="g-backrealdetails clearfix bor-border">

		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-xs-1 text-right">工具名称：</p>
			<p class="text-left col-xs-10">
			   <input type="text" name="title" id="title" value="{{$serviceInfo['title']}}">
				{{ $errors->first('title') }}
				<input type="hidden" name="id" value="{{$serviceInfo['id']}}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-xs-1 text-right">服务费用：</p>
			<p class="text-left col-xs-10">
				<input type="text" name="price" id="price" value="{{$serviceInfo['price']}}">
				<span class="red">{{ $errors->first('price') }}</span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-xs-1 text-right">工具说明：</p>
			<p class="text-left col-xs-10">
				<textarea rows="5" cols="35" name="description">{{$serviceInfo['description']}}</textarea>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-xs-1 text-right">是否启用：</p>
			<p class=" col-xs-10">
				<label class="">
					<input type="radio"  name="status" value="1" @if($serviceInfo['status'] == 1)checked="checked"@endif/>
					<span class="lbl"></span>是
					<input type="radio" name="status" value="2" @if($serviceInfo['status'] == 2)checked="checked"@endif/>
					<span class="lbl"></span>否
				</label>
			</p>
		</div>

		<div class="col-xs-12">
			<div class="clearfix row bg-backf5 padding20 mg-margin12">
				<div class="col-xs-12">
					<div class="col-md-1 text-right"></div>
					<div class="col-md-10">
						<button class="btn btn-primary" type="submit">提交</button>  <a href="{{ URL('manage/serviceList') }}">返回</a>
					</div>
				</div>
			</div>
		</div>
		<div class="space col-xs-12"></div>
		{{--<div class="col-xs-12">
			<div class="col-md-1 text-right"></div>
			<div class="col-md-10"><a href="">上一项</a>　　<a href="">下一项</a></div>
		</div>--}}
		<div class="col-xs-12 space">

		</div>
		{{--<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="no-border"></p>
			<p class="text-left no-border">
				<button class="btn btn-primary btn-sm" type="submit">提交</button>
			</p>
		</div>--}}

	</div>
	</form>

<!-- basic scripts -->
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}