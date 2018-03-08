
{{--<div class="page-header pay-api">--}}
    {{--<ul class="nav nav-pills nav-justified">--}}
        {{--<li role="presentation" class="active"><a href="{!! url('manage/payConfig') !!}" title="">支付配置</a></li>--}}
        {{--<li role="presentation"><a href="{!! url('manage/thirdPay') !!}" title="">第三方支付平台接口</a></li>--}}
    {{--</ul>--}}
{{--</div>--}}

<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="{!! url('manage/payConfig') !!}" title="">支付配置</a>
            </li>
            <li class="">
                <a href="{!! url('manage/thirdPay') !!}" title="">第三方支付平台接口</a>
            </li>
        </ul>
    </div>
</div>
<!--  /.page-header -->
<form class="form-horizontal" role="form" method="post" action="{!! url('manage/payConfig') !!}">
    {!! csrf_field() !!}
    <div class="g-backrealdetails clearfix bor-border interface">
        <!-- PAGE CONTENT BEGINS -->
            <div class="space-8 col-xs-12"></div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">用户最小充值金额</label>
                <div class="col-sm-9">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="cash[recharge_min]"
                           value="@if(isset($data['recharge_min'])){!! $data['recharge_min'] !!}@endif">
                    <span class="help-inline col-xs-12 col-sm-8">
                        <span class="middle">（单位：元）</span>
                    </span>
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">用户最小提现金额</label>
                <div class="col-sm-9">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="cash[withdraw_min]"
                            value="@if(isset($data['withdraw_min'])){!! $data['withdraw_min'] !!}@endif">
                    <span class="help-inline col-xs-12 col-sm-8">
                        <span class="middle">（单位：元）</span>
                    </span>
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">用户当天提现最大金额</label>
                <div class="col-sm-9">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="cash[withdraw_max]"
                           value="@if(isset($data['withdraw_max'])){!! $data['withdraw_max'] !!}@endif">
                    <span class="help-inline col-xs-12 col-sm-8">
                        <span class="middle">（单位：元）</span>
                    </span>
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">单笔资费</label>
                <div class="col-sm-9">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="cash[per_charge]"
                           value="@if(isset($data['per_charge'])){!! $data['per_charge'] !!}@endif">
                    <span class="help-inline col-xs-12 col-sm-8">
                        <span class="middle">（用户提现单笔收费比率%）</span>
                    </span>
                </div>
            </div>
            <div class="form-group interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">单笔最低收费</label>
                <div class="col-sm-9">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="cash[per_low]"
                           value="@if(isset($data['per_low'])){!! $data['per_low'] !!}@endif">
                    <span class="help-inline col-xs-12 col-sm-8">
                        <span class="middle">（用户提现单笔收费最低金额。少于200的提现以此为收费标准）</span>
                    </span>
                </div>
            </div>
            <div class=" interface-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">单笔最高收费</label>
                <div class="col-sm-9">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="cash[per_high]" value="@if(isset($data['per_high'])){!! $data['per_high'] !!}@endif">
                    <span class="help-inline col-xs-12 col-sm-8">
                        <span class="middle">（单位：元）</span>
                    </span>
                </div>
            </div>

        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                </div>
            </div>
        </div>
</div>
</form>

{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}