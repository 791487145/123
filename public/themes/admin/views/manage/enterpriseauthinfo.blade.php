
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">企业认证详细信息</h3>
<div class="g-backrealdetails clearfix bor-border">
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">企业名称：</p>
        <p class="col-md-11">{!! $enterprise->company_name !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">所属行业：</p>
        <p class="col-md-11">{!! $enterprise->cate_parent_name !!}&nbsp;&nbsp;{!! $enterprise->cate_name !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">员工人数：</p>
        <p class="col-md-11">{!! $enterprise->employee_num !!}人</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">营业执照：</p>
        <p class="col-md-11">{!! $enterprise->business_license !!}</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">经营年限：</p>
        <p class="col-md-11">{!! date('Y-m-d',strtotime($enterprise->begin_at)) !!}~<span>至今</span></p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">公司网址：</p>
        <p class="col-md-11">{!! $enterprise->website !!}</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">经营地址：</p>
        <p class="col-md-11">
            {!! $enterprise->province_name !!}&nbsp;&nbsp;
            {!! $enterprise->city_name !!}&nbsp;&nbsp;
            {!! $enterprise->area_name !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {!! $enterprise->address !!}
        </p>
    </div>

    @if(!empty($enterprise->attachement))
        <div class="realname-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">相关资质：</p>
            <p class="col-md-10">
                @foreach($enterprise->attachement as $key => $value)
                <img src="{!! url($value['url']) !!}">
                @endforeach
            </p>
        </div>
    @endif

    @if($enterprise_status == 0)
    <div class="col-xs-12">
        <div class="space-8"></div>
        <p class="col-md-10 col-md-offset-1">
            <a href="{!! url('/manage/enterpriseAuthHandle/'. $enterprise->id. '/pass') !!}" class="btn btn-primary">审核通过</a>
            <a href="{!! url('/manage/enterpriseAuthHandle/'. $enterprise->id. '/deny') !!}" class="btn btn-primary">审核失败</a>
        </p>
    </div>
    @endif

    <div class="col-xs-12">
        <div class="space-8"></div>
        <p class="col-md-10 col-md-offset-1">
            @if(!empty($pre_id))
                <a href="/manage/enterpriseAuth/{!! $pre_id !!}">上一项</a>
            @endif
                <a href="/manage/enterpriseAuthList">返回列表</a>
            @if(!empty($next_id))
                <a href="/manage/enterpriseAuth/{!! $next_id !!}">下一项</a>
            @endif
        </p>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}