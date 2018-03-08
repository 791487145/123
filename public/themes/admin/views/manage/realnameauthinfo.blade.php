{{--<div class="space-2"></div>
<div class="page-header">
    <h1>
        实名认证详细信息
    </h1>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">实名认证详细信息</h3>
<div class="g-backrealdetails clearfix bor-border">
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">真实姓名：</p>
        <p class="col-md-11">{!! $realname->realname !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">身份证号：</p>
        <p class="col-md-11">{!! CommonClass::starReplace($realname->card_number, 4, 10) !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">证件正面：</p>
        <p class="col-md-11"><img src="{!! url($realname->card_front_side) !!}"></p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">证件反面：</p>
        <p class="col-md-11"><img src="{!! url($realname->card_back_dside) !!}"></p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">示范照片：</p>
        <p class="col-md-10"><img src="{!! url($realname->validation_img) !!}"></p>
    </div>
    {{--<div class="realname-bottom clearfix col-xs-12">
        <label class="col-md-1 text-right">项目时间：</label>
        <p class="col-md-10"><input type="text">～<input type="text"></p>
    </div>--}}
    @if($realname->status == 0)
    <div class="col-xs-12">
    	<div class="clearfix row bg-backf5 padding20 mg-margin12">
    		<div class="col-xs-12">
    			<div class="col-md-1 text-right"></div>
	    		<div class="col-md-10"><a href="{!! url('/manage/realnameAuthHandle/'. $realname->id. '/pass') !!}" class="btn btn-primary btn-sm">审核通过</a></div>
	
    		</div>
    	</div>
    </div>
    @endif

    	
    </div>
</div>


{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}