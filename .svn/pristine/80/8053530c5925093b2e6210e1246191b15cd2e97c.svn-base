<div class="g-main g-recharge">
    <h4 class="cor-blue u-title">我要提现</h4>
    <div class="space"></div>
    <form method="post" action="{!! url('finance/cashout') !!}" class="registerform">
        {!! csrf_field() !!}
    <div class="well z-active text-size14 clearfix cashier cashiergray">
        <div class="space-2"></div>
        <div class="cor-gray51">我的资产：<b class="cor-orange text-size20">{!! $balance !!}</b> 元</div>
        <div class="space-4"></div>
        <div id="user-profile-2" class="profile-users">
            <div class="memberdiv">
                <div class="cor-gray51 position-relative memberdiv-validform">
                    <label class="">提现金额：</label>
                    <input type="text"  name="cash" class="inputxt" datatype="number" nullmsg="输入金额" errormsg="请输入正确的金额" value="{!! old('cash') !!}" />
                    @if($errors->first('cash'))
                    <span class="Validform_checktip Validform_right Validform_wrong">{!! $errors->first('cash') !!}</span>
                    @endif
                    @if($errors->first('cashout_account'))
                        <span class="Validform_checktip Validform_right Validform_wrong">{!! $errors->first('cashout_account') !!}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="space-2"></div>
    </div>
    <div class="text-size16 m-radio">
        {{--<div class="alert alert-warning cashier cashier-alert cashierred">--}}
        <div class="alert alert-warning cashier cashier-alert cashierred">
        {{--<div class="alert alert-warning cashier cashier-alert cashierred">--}}
            <i class="fa fa-lightbulb-o"></i>
                <span>
                    银行提现手续费扣取标准 <i class="fa fa-question-circle"></i>
                </span>
            <div class="cashier-alert-cont">
                <div class="space-4"></div>
                <p>A. 200元以下（含200元） 单笔收费{!! $cashRule['per_low'] !!}元</p>
                <p>B. 200元以上 单笔收费{!! $cashRule['per_charge'] !!}%, 最高收费{!! $cashRule['per_high'] !!}元</p>
                <p>C. 单次最低提现金额{!! $cashRule['withdraw_min'] !!}元</p>
                <p>D. 最高提现最大金额{!! $cashRule['withdraw_max'] !!}元</p>
            </div>
        </div>
        @if($alipayAccount->count() == 0 && $bankAccount->count() == 0)
            <div class="text-center g-bankhint">
                <img src="/themes/default/assets/images/withdrawhint.png"><b class="inlineblock">您还未进行支付绑定！</b>
            </div>
            <div class="space-20"></div>
            <div class="text-center clearfix">
                <a href="{!! url('user/paylist') !!}" class="btn-big bg-blue bor-radius2">去绑定</a>
            </div>
        @else
            @if($alipayAccount->count())
            <div class="space-26"></div>
            <div>
                <h6 class="text-size16">第三方支付：</h6>
                <div class="space-10"></div>

                    @foreach($alipayAccount as $item)
                <label class="clearfix inline">
                    <input type="radio" name="cashout_account" class="ace" checked="checked" value="{!! $item->alipay_account !!}"/>
                    <span class="lbl ">
                        <span  class="lbl-bank">
                            <div class="u-radioali s-packbor text-center">
                                <img src="{!! Theme::asset()->url('images/radioali.jpg') !!}" alt="" width="96" height="35">
                            </div>
                            <div class="text-center clearfix">{!! CommonClass::starReplace($item->alipay_account,3,4) !!}</div>
                        </span>
                    </span>
                </label>
                    @endforeach
            </div>
            @endif
            {{--<div class="space"></div>--}}
            @if($bankAccount->count())
            <div>
                <h6 class="text-size16">网上银行：</h6>
                <div class="space-10"></div>
                    @foreach($bankAccount as $item)
                <label class="clearfix inline">
                    <input type="radio" name="cashout_account" class="ace" value="{!! $item->bank_account !!}"/>
                    <span class="lbl ">
                        <span  class="lbl-bank">
                            <div class="s-packbor s-bank1 text-center">
                                @if($item->bank_name == '光大银行')
                                    <img src="{!! Theme::asset()->url('images/bank/gdyh.jpg') !!}" />
                                @elseif($item->bank_name == '华夏银行')
                                    <img src="{!! Theme::asset()->url('images/bank/hxyh.jpg') !!}" />
                                @elseif($item->bank_name == '建设银行')
                                    <img src="{!! Theme::asset()->url('images/bank/jsyh.jpg') !!}" />
                                @elseif($item->bank_name == '交通银行')
                                    <img src="{!! Theme::asset()->url('images/bank/jtyh.jpg') !!}" />
                                @elseif($item->bank_name == '民生银行')
                                    <img src="{!! Theme::asset()->url('images/bank/msyh.jpg') !!}" />
                                @elseif($item->bank_name == '农村信用社')
                                    <img src="{!! Theme::asset()->url('images/bank/ncxys.jpg') !!}" />
                                @elseif($item->bank_name == '农业银行')
                                    <img src="{!! Theme::asset()->url('images/bank/nyyh.jpg') !!}" />
                                @elseif($item->bank_name == '平安银行')
                                    <img src="{!! Theme::asset()->url('images/bank/payh.jpg') !!}" />
                                @elseif($item->bank_name == '浦发银行')
                                    <img src="{!! Theme::asset()->url('images/bank/pfyh.jpg') !!}" />
                                @elseif($item->bank_name == '兴业银行')
                                    <img src="{!! Theme::asset()->url('images/bank/xyyh.jpg') !!}" />
                                @elseif($item->bank_name == '邮政储蓄')
                                    <img src="{!! Theme::asset()->url('images/bank/yzcx.jpg') !!}" />
                                @elseif($item->bank_name == '招商银行')
                                    <img src="{!! Theme::asset()->url('images/bank/zsyh.jpg') !!}" />
                                @elseif($item->bank_name == '中国银行')
                                    <img src="{!! Theme::asset()->url('images/bank/zgyh.jpg') !!}" />
                                @endif
                            </div>
                            <div class="text-center clearfix">{!! CommonClass::starReplace($item->bank_account, -5) !!}</div>
                        </span>
                    </span>
                </label>
                    @endforeach
            </div>
            @endif

    </div>
    <div class="space"></div>
        @if($bankAccount->count() > 8)
    <div class="s-">
        <a href="javascript:;" class="cor-blue text-size14"  data-toggle="collapse" data-target="#demo">显示更多银行</a>
    </div>
    <div class="space"></div>
    <div class="text-size16 m-radio collapse" id="demo" >
        <div>
            @foreach($bankAccount as $k=>$item)
                @if($k > 8)
            <label class="clearfix inline">
                <input type="radio" name="cashout_account" class="ace" value="{!! $item->bank_account !!}"/>
                <span class="lbl ">
                    <span  class="lbl-bank">
                        <div class="s-packbor s-bank1 text-center">
                            @if($item->bank_name == '光大银行')
                                <img src="{!! Theme::asset()->url('images/bank/gdyh.jpg') !!}" />
                            @elseif($item->bank_name == '华夏银行')
                                <img src="{!! Theme::asset()->url('images/bank/hxyh.jpg') !!}" />
                            @elseif($item->bank_name == '建设银行')
                                <img src="{!! Theme::asset()->url('images/bank/jsyh.jpg') !!}" />
                            @elseif($item->bank_name == '交通银行')
                                <img src="{!! Theme::asset()->url('images/bank/jtyh.jpg') !!}" />
                            @elseif($item->bank_name == '民生银行')
                                <img src="{!! Theme::asset()->url('images/bank/msyh.jpg') !!}" />
                            @elseif($item->bank_name == '农村信用社')
                                <img src="{!! Theme::asset()->url('images/bank/ncxys.jpg') !!}" />
                            @elseif($item->bank_name == '农业银行')
                                <img src="{!! Theme::asset()->url('images/bank/nyyh.jpg') !!}" />
                            @elseif($item->bank_name == '平安银行')
                                <img src="{!! Theme::asset()->url('images/bank/payh.jpg') !!}" />
                            @elseif($item->bank_name == '浦发银行')
                                <img src="{!! Theme::asset()->url('images/bank/pfyh.jpg') !!}" />
                            @elseif($item->bank_name == '兴业银行')
                                <img src="{!! Theme::asset()->url('images/bank/xyyh.jpg') !!}" />
                            @elseif($item->bank_name == '邮政储蓄')
                                <img src="{!! Theme::asset()->url('images/bank/yzcx.jpg') !!}" />
                            @elseif($item->bank_name == '招商银行')
                                <img src="{!! Theme::asset()->url('images/bank/zsyh.jpg') !!}" />
                            @elseif($item->bank_name == '中国银行')
                                <img src="{!! Theme::asset()->url('images/bank/zgyh.jpg') !!}" />
                            @endif
                        </div>
                        <div class="text-center clearfix">{!! $item->realname !!}       {!! CommonClass::starReplace($item->bank_account, -5) !!}</div>
                    </span>
                </span>
            </label>
                @endif
            @endforeach
        </div>
    </div>
        @endif
        <div class="space-20"></div>
        <div class="text-center clearfix">
            <a class="btn-big bg-blue bor-radius2 hov-blue1b btn-imp" id="btn_sub">下一步</a>
            <a href="/finance/list" class="btn-big">返回</a>
        </div>
        <div class="space-20"></div>
        @endif
    </form>

</div>

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('recharge-css', 'css/usercenter/finance/finance-recharge.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('cashout-js', 'js/cashout.js') !!}