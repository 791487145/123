<div class="g-main g-recharge cashiergray-box">
    <h4 class="cor-blue u-title">我要充值</h4>
    <div class="space"></div>
    <form action="{!! url('finance/cash') !!}" method="post" class="cashform">
        {!! csrf_field() !!}
    <div class="well z-active text-size14 clearfix cashiergray-bg">
        <div class="space-2"></div>
        <div class="cor-gray51">我的资产：<b class="cor-orange text-size20">{!! $balance !!}</b> 元</div>
        <div class="space-4"></div>
        <div id="user-profile-2" class="profile-users">
            <div class="memberdiv">
                <div class="cor-gray51 position-relative" id="cashtips">充值金额：
                    <span class="inlineblock">
                        <input type="text" class="bor-radius2" name="cash" datatype="cashValid" data-recharge-min="{!! $recharge_min !!}"  nullmsg="请输入充值金额" errormsg="充值金额不小于{!! $recharge_min !!}元"/> 元&nbsp;&nbsp;&nbsp;</span>
                    <div class="popover">
                        <div class="arrow"></div>
                        <div class="popover-content cor-gray51"> 我们会在您提交后处理您的充值。</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-2"></div>
    </div>
    <div class="space-22"></div>
    <div class="text-size16 m-radio cash-bankImg">
        <span>选择支付方式：</span>
        <div class="space-6 visiable-xs-block"></div>
        <div class="inlineblock">
            <div class="space-4"></div>
        @if($payConfig['alipay']['status'])
        <label class="clearfix inline">
            <input type="radio" name="pay_type" class="ace" checked="checked" value="alipay"/>
            <span class="lbl">
                <span class="u-radioali text-center">
                     <img src="{!! Theme::asset()->url('images/radioali.jpg') !!}" alt="">
                </span>
            </span>
        </label>
        @endif
        @if($payConfig['wechatpay']['status'])
        <label class="clearfix inline">
            <input type="radio" name="pay_type" class="ace" value="wechat"/>
            <span class="lbl">
                <span class="u-radiowx text-center">
                    <img src="{!! Theme::asset()->url('images/radiowx.jpg') !!}" alt="">
                </span>
            </span>
        </label>
        @endif
        {{--@if($payConfig['unionpay']['status'])
        <label class="clearfix inline">
            <input type="radio" name="pay_type" class="ace" value="unionbank"/>
            <span class="lbl">
                <span class="u-radiopay text-center">
                    <img src="{!! Theme::asset()->url('images/radiopay.jpg') !!}" alt="">
                </span>
            </span>
        </label>
        @endif--}}
        </div>
    </div>
    <div class="space-20"></div>
    <div class="text-center clearfix">
        <span>
        <a id="btn_sub" class="btn-big bg-blue bor-radius2 hov-blue1b btn-imp">确认充值</a>
        {!! $errors->first('pay_type') !!}
        </span>
    </div>
    <div class="space-20"></div>
    </form>
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header widget-header-flat">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" >&times;</span></button>
                    <b class="modal-title" id="myModalLabel">
                        充值提示：
                    </b>
                </div>
                <div class="modal-body text-center">
                    <h4><i class="fa fa-exclamation-circle"></i><b>请在打开的页面上完成付款！</b></h4>
                    <p class="cor-gray97 text-size14">付款完成前请不要关闭此窗口</p>
                    <div class="space-10"></div>
                    <div class="u-modal-btn"><a id="verifyOrder" data-dismiss="modal" class="btn-big bg-blue bor-radius2">已完成付款</a> <a target="_blank" href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}">支付遇到问题</a></div>
                    <div class="space-6"></div>
                    <a class="u-modal-link" href="javascript:history.back()">返回选择其他支付方式></a>
                    <div class="space-14"></div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
</div>

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-js','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('recharge-css','css/usercenter/finance/finance-recharge.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('usercenter-js','js/usercenter.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-css','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}


