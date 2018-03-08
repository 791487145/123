<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">支付宝绑定</h4>
    <div class="space"></div>
    <div class="form-group hidden-xs">
        <div data-target="#step-container" class="row-fluid" id="fuelux-wizard">
            <ul class="wizard-steps">
                <li class="active" data-target="#step1">
                    <span class="step">1</span>
                    <span class="title">填写信息</span>
                </li>
                <li class="active" data-target="#step2">
                    <span class="step">2</span>
                    <span class="title">打款中</span>
                </li>
                <li class="active" data-target="#step3">
                    <span class="step">3</span>
                    <span class="title">填写打入卡内金额</span>
                </li>
                <li data-target="#step4">
                    <span class="step">4</span>
                    <span class="title">认证成功</span>
                </li>
            </ul>
        </div>
    </div>
    <form class="registerform" method="post" action="{!! url('user/verifyAlipayAuthCash') !!}">
        {!! csrf_field() !!}
        <input type="hidden" name="alipayAuthId" value="{!! Crypt::encrypt($alipayAuthInfo['id']) !!}">
        <div class="space-30"></div>
        <div class="text-center g-bankhint">
            <img src="{!! Theme::asset()->url('images/withdrawhint.png') !!}" /><b>已经向您的账户中支付了一笔款项，请输入正确的打款金额！</b>
            <div class="space-10"></div>
            <p class="cor-gray51">打款金额： <input class="inputxt" type="text" name="cash" datatype="number" errormsg="请输入正确的金额格式" nullmsg="输入金额" /></p>
        </div>
        <div class="space-20"></div>
        <div class="space-10"></div>
        <div class="cor-gray51 text-size14">您的支付宝信息</div>
        <div class="space-10"></div>
        <div class="row text-size14 hidden-md hidden-sm hidden-xs">
            <div class="col-sm-3 col-xs-6 col-lg-2 text-right  cor-gray51">申请时间：</div>
            <div class="col-md-8 cor-gray97">{!! $alipayAuthInfo['created_at'] !!}</div>
        </div>
        <div class="text-size14 hidden-lg">
            <div class="cor-gray51">
                申请时间：　<span class="cor-gray97">{!! $alipayAuthInfo['created_at'] !!}</span>
            </div>
        </div>
        <div class="space-10"></div>
        <div class="row text-size14 hidden-md hidden-sm hidden-xs">
            <div class="col-sm-3 col-xs-6 col-lg-2 text-right cor-gray51">支付宝姓名：</div>
            <div class="col-md-8 cor-gray97">{!! CommonClass::starReplace($alipayAuthInfo['alipay_name'], 3) !!}</div>
        </div>
        <div class="text-size14 hidden-lg">
            <div class="cor-gray51">
                支付宝姓名：　<span class="cor-gray97">{!! CommonClass::starReplace($alipayAuthInfo['alipay_name'], 3) !!}</span>
            </div>
        </div>
        <div class="space-10"></div>
        <div class="row text-size14 hidden-md hidden-sm hidden-xs">
            <div class="col-sm-3 col-xs-6 col-lg-2 text-right cor-gray51">支付宝账户：</div>
            <div class="col-md-8 cor-gray97">{!! CommonClass::starReplace($alipayAuthInfo['alipay_account'], 4, 4) !!}</div>
        </div>
        <div class="text-size14 hidden-lg">
            <div class="cor-gray51">
                支付宝账户：　<span class="cor-gray97">{!! CommonClass::starReplace($alipayAuthInfo['alipay_account'], 4, 4) !!}</span>
            </div>
        </div>
        <div class="space-20"></div>
        <div class="text-center"><a id="btn_sub" class="btn-big bg-blue bor-radius2 text-size14" href="">确定</a></div>
    </form>
</div>

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('alipayauthcash-js', 'js/alipayauthcash.js') !!}