{{--<div class="space-2 pay-api"></div>
<div class="page-header">
    <h1>
        支付接口配置
    </h1>
</div> <!--  /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">支付接口配置</h3>
<form class="form-horizontal alipay-edit" role="form" method="post" action="{!! url('manage/thirdPayEdit') !!}">

    <div class="g-backrealdetails clearfix bor-border">
        <!-- PAGE CONTENT BEGINS -->

            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{!! $data['id'] !!}">
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">接口名称：</p>

                <p class="col-sm-10">
                    <span class=" col-xs-12 col-sm-12 alipy-edit-show">
                        <span class="middle">{!! $data['title'] !!}</span>
                    </span>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">接口描述：</p>

                <p class="col-sm-10">
                    <span class=" col-xs-12 col-sm-12 alipy-edit-show">
                        <span class="middle">{!! $data['desc'] !!}</span>
                    </span>
                </p>
            </div>


            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">是否启用：</p>

                <p class="col-sm-10">
                    <span class="col-xs-2 col-sm-2">
                      <input type="radio" id="form-field-1" name="rule[status]" @if($data['rule']['status'] == 0)checked="checked"@endif value="0">
                      关闭
                    </span>
                   <span class="col-xs-2 col-sm-2">
                     <input type="radio" id="form-field-1" name="rule[status]" @if($data['rule']['status'] == 1)checked="checked"@endif value="1">
                     开启
                   </span>

                </p>
            </div>

            @if($data['alias'] == 'wechatpay')
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">公众号APPID：</p>

                <p class="col-sm-10">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="rule[appId]" value="@if(isset($data['rule']['appId'])){!! $data['rule']['appId'] !!}@endif">
                    <span class="help-inline col-xs-12 col-sm-8">
                        <button type="button" class="btn btn-white radius-6">获取PID,KEY</button>
                    </span>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">公众号appsecret：</p>

                <p class="col-sm-10">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="rule[appKey]" value="@if(isset($data['rule']['appKey'])){!! $data['rule']['appKey'] !!}@endif">
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">商户号：</p>

                <p class="col-sm-10">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="rule[mchId]" value="@if(isset($data['rule']['mchId'])){!! $data['rule']['mchId'] !!}@endif">
                </p>
            </div>

            @elseif($data['alias'] == 'alipay')
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">支付宝帐号：</p>

                <p class="col-sm-10">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="rule[sellerEmail]" value="@if(isset($data['rule']['sellerEmail'])){!! $data['rule']['sellerEmail'] !!}@endif">
                    <span class="help-inline col-xs-12 col-sm-8">
                        <button type="button" class="btn btn-white radius-6">获取PID,KEY</button>
                    </span>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">合作者身份(PID)：</label>

                <div class="col-sm-10">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="rule[partner]" value="@if(isset($data['rule']['partner'])){!! $data['rule']['partner'] !!}@endif">
                </div>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">安全效验码(Key)：</p>

                <p class="col-sm-10">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="rule[key]" value="@if(isset($data['rule']['key'])){!! $data['rule']['key'] !!}@endif">
                </p>
            </div>

            @elseif($data['alias'] == 'unionpay')
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">商户号：</p>

                <p class="col-sm-10">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="rule[merId]" value="@if(isset($data['rule']['merId'])){!! $data['rule']['merId'] !!}@endif">
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-right" for="form-field-1">交易密码：</p>

                <p class="col-sm-10">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-4" name="rule[certPassword]" value="@if(isset($data['rule']['certPassword'])){!! $data['rule']['certPassword'] !!}@endif">
                </p>
            </div>
            @endif

        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <div class="col-md-10"><button type="submit" class="btn btn-primary btn-sm">提交</button></div>
                </div>
            </div>
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->

</form>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}