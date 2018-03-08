<h3 class="header smaller lighter blue mg-top12 mg-bottom20">学生认证详细信息</h3>
<div class="g-backrealdetails clearfix bor-border">
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">真实姓名：</p>
        <p class="col-md-11">{!! $education->realname !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">学生证号：</p>
        <p class="col-md-11">{!! CommonClass::starReplace($education->student_number, 4, 10) !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">学生证照：</p>
        <p class="col-md-11"><img src="{!! url($education->student_id_card) !!}"></p>
    </div>

    @if($education->status == 1)
    <div class="col-xs-12">
    	<div class="clearfix row bg-backf5 padding20 mg-margin12">
    		<div class="col-xs-12">
    			<div class="col-md-1 text-right"></div>
	    		<div class="col-md-10"><a href="{!! url('/manage/educationAuthHandle/'. $education->id. '/pass') !!}" class="btn btn-primary btn-sm">审核通过</a></div>
    		</div>
    	</div>
    </div>
    @endif
    	
    </div>
</div>


{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}