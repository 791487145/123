<div class="g-main g-recharge">
    <h4 class="cor-blue u-title">我要提现</h4>
    <form action="{!! url('finance/cashoutInfo') !!}" method="post" class="registerform">
        {!! csrf_field() !!}
        <input type="hidden" name="cashInfo" value="{!! $cashoutInfo !!}">
    <div class="space"></div>
    <div class="g-withdrawpass">
        <div class="well text-size14">我的资产：<b class="cor-orange text-size20">{!! $balance !!}</b>元</div>
    </div>
    <div class="space-20"></div>
    <div class="text-size14 g-withdrawmain cor-gray51">
        <div class="row"><span class="col-sm-2 text-right">账户信息：</span><div class="col-sm-8"><div class="space-6 visible-xs-block"></div>
                <p>
                    {!! $account_name !!}
                </p>
                <p class="cor-gray87">
                    @if($bank_name != 'alipay')
                        @if($bank_name == '光大银行')
                            <img src="{!! Theme::asset()->url('images/bank/gdyh.jpg') !!}" />
                        @elseif($bank_name == '华夏银行')
                            <img src="{!! Theme::asset()->url('images/bank/hxyh.jpg') !!}" />
                        @elseif($bank_name == '建设银行')
                            <img src="{!! Theme::asset()->url('images/bank/jsyh.jpg') !!}" />
                        @elseif($bank_name == '交通银行')
                            <img src="{!! Theme::asset()->url('images/bank/jtyh.jpg') !!}" />
                        @elseif($bank_name == '民生银行')
                            <img src="{!! Theme::asset()->url('images/bank/msyh.jpg') !!}" />
                        @elseif($bank_name == '农村信用社')
                            <img src="{!! Theme::asset()->url('images/bank/ncxys.jpg') !!}" />
                        @elseif($bank_name == '农业银行')
                            <img src="{!! Theme::asset()->url('images/bank/nyyh.jpg') !!}" />
                        @elseif($bank_name == '平安银行')
                            <img src="{!! Theme::asset()->url('images/bank/payh.jpg') !!}" />
                        @elseif($bank_name == '浦发银行')
                            <img src="{!! Theme::asset()->url('images/bank/pfyh.jpg') !!}" />
                        @elseif($bank_name == '兴业银行')
                            <img src="{!! Theme::asset()->url('images/bank/xyyh.jpg') !!}" />
                        @elseif($bank_name == '邮政储蓄')
                            <img src="{!! Theme::asset()->url('images/bank/yzcx.jpg') !!}" />
                        @elseif($bank_name == '招商银行')
                            <img src="{!! Theme::asset()->url('images/bank/zsyh.jpg') !!}" />
                        @elseif($bank_name == '中国银行')
                            <img src="{!! Theme::asset()->url('images/bank/zgyh.jpg') !!}" />
                        @endif
                    @else
                        <img src="{!! Theme::asset()->url('images/alibank.jpg') !!}" />
                    @endif

                    {!! CommonClass::starReplace($cashout_account, 3, 10) !!}
                </p>
            </div>
        </div>
        <div class="space-4"></div>
        <div class="row"><span class="col-sm-2 text-right">提现金额：</span><span class="col-sm-8"><span class="cor-orange">{!! $cash !!}</span> 元</span></div>
        <div class="space-6"></div>
        <div class="row"><span class="col-sm-2 text-right">服务费：</span><span class="col-sm-8">{!! $fees !!} 元 <i class="fa fa-question-circle cor-gray97"></i></span></div>
        <div class="space-6"></div>
        <div class="row"><span class="col-sm-2 text-right">到账金额：</span><span class="col-sm-8">{!! $cash-$fees !!} 元</span></div>
        <div class="space-12"></div>
        <div class="row"><span class="col-sm-2 text-right">支付密码：</span><div class="col-sm-8">
                <input type="password" name="alternate_password" datatype="*" nullmsg="请输入支付密码" />
                <a target="_blank" href="{!! url('user/payPassword') !!}">忘记密码？</a>
                @if($errors->first('alternate_password'))
                <span class="Validform_checktip Validform_wrong">{!! $errors->first('alternate_password') !!}</span>
                @endif
            </div>
        </div>
        <div class="space-20"></div>
        <div class="row"><div class="col-sm-offset-2">
                <a id="btn_sub" class="btn-big bg-blue bor-radius2" href="javascript:;">立即提现</a>
                <a href="{!! url('finance/cashout') !!}">返回修改</a>
            </div>
        </div>
    </div>
    </form>
    <div class="space-30"></div>
</div>

{!! Theme::asset()->container('specific-css')->usePath()->add('finance-recharge', 'css/usercenter/finance/finance-recharge.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('cashinfo-js', 'js/cashoutinfo.js') !!}