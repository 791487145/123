<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">银行卡绑定</h4>
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
                <li class="active" data-target="#step4">
                    <span class="step">4</span>
                    <span class="title">认证失败</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="space-30"></div>
    <div class="text-center g-bankhint">
        <img src="{!! Theme::asset()->url('images/sign-icon3.png') !!}" /><b>很遗憾，绑定失败！</b>
        <div class="space-4"></div>
        <p class="cor-gray97 g-bankhintpd text-size14">请查看打款金额是否正确或者<a class="text-under" href="{!! url('user/bankAuth') !!}">重新绑定</a>！</p>
    </div>
    <div class="space-20"></div>
    <div class="space-10"></div>
    <div class="cor-gray51 text-size14">您的银行卡信息</div>
    <div class="space-10"></div>
    <div class="row text-size14 hidden-md hidden-sm hidden-xs">
        <div class="col-sm-3 col-xs-6 col-lg-2 text-right  cor-gray51">申请时间：</div>
        <div class="col-md-8 cor-gray97 row">{!! $authInfo['created_at'] !!}</div>
    </div>
    <div class="text-size14 hidden-lg cor-gray51">申请时间： <span class="cor-gray97">{!! $authInfo['created_at'] !!}</span>
    </div>
    <div class="space-10"></div>
    <div class="row text-size14 hidden-md hidden-sm hidden-xs">
        <div class="col-sm-3 col-xs-6 col-lg-2 text-right cor-gray51">银行开户名：</div>
        <div class="col-md-8 cor-gray97 row">{!! $authInfo['deposit_name'] !!}</div>
    </div>
    <div class="text-size14 hidden-lg cor-gray51">银行开户名： <span
                class="cor-gray97">{!! $authInfo['deposit_name'] !!}</span></div>
    <div class="space-10"></div>
    <div class="row text-size14 hidden-md hidden-sm hidden-xs">
        <div class="col-sm-3 col-xs-6 col-lg-2 text-right cor-gray51">开户银行：</div>
        <div class="col-md-8 cor-gray97 row">{!! $authInfo['bank_name'] !!}</div>
    </div>
    <div class="text-size14 hidden-lg cor-gray51">开户银行： <span class="cor-gray97">{!! $authInfo['bank_name'] !!}</span>
    </div>
    <div class="space-10"></div>
    <div class="row text-size14 hidden-md hidden-sm hidden-xs">
        <div class="col-sm-3 col-xs-6 col-lg-2 text-right cor-gray51">开户行地区：</div>
        <div class="col-md-8 cor-gray97 row">{!! $authInfo['districtname'] !!}</div>
    </div>
    <div class="text-size14 hidden-lg cor-gray51">开户行地区： <span
                class="cor-gray97">{!! $authInfo['districtname'] !!}</span></div>
    <div class="space-10"></div>
    <div class="row text-size14 hidden-md hidden-sm hidden-xs">
        <div class="col-sm-3 col-xs-6 col-lg-2 text-right cor-gray51">银行卡号：</div>
        <div class="col-md-8 cor-gray97 row">{!! CommonClass::starReplace($authInfo['bank_account'], 4, 10) !!}</div>
    </div>
    <div class="text-size14 hidden-lg cor-gray51">银行卡号： <span
                class="cor-gray97">{!! CommonClass::starReplace($authInfo['bank_account'], 4, 10) !!}</span></div>
</div>