{{--<div class="cmt tabbable">
    <ul class="nav nav-tabs banktab">
        <li class="active">
            <a href=".bankpaytab" data-toggle="tab">银行卡认证</a>
        </li>
        <li>
            <a href=".alipaytab" data-toggle="tab">支付宝认证</a>
        </li>
        <li>
            <a href=".wxpaytab" data-toggle="tab">微信支付认证</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="bankpaytab tab-pane active">
            <div class="form-group">
                <div data-target="#step-container" class="row-fluid" id="fuelux-wizard">
                    <ul class="wizard-steps">
                        <li class="active" data-target="#step1">
                            <span class="step">1</span>
                            <span class="title">填写信息</span>
                        </li>
                        <li @if(in_array($authInfo['status'], array(0,1,2,3,4))) class="active" @endif data-target="#step2">
                            <span class="step">2</span>
                            <span class="title">审核资料</span>
                        </li>
                        <li @if(in_array($authInfo['status'], array(1,2,3,4))) class="active" @endif data-target="#step3">
                            <span class="step">3</span>
                            <span class="title">打款中</span>
                        </li>
                        <li @if(in_array($authInfo['status'], array(2,3,4))) class="active" @endif data-target="#step4">
                            <span class="step">4</span>
                            <span class="title">填写打入卡内金额</span>
                        </li>
                        <li @if($authInfo['status'] == 3 || $authInfo['status'] == 4) class="active" @endif data-target="#step5">
                            <span class="step">5</span>
                            <span class="title">认证完成</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <div class="alert alert-warning text-center" role="alert">
                    <h4><span class="fa-stack text-success"><i class="fa fa-check-circle fa-stack-2x"></i></span> 恭喜您认证成功！</h4>
                    <p>现在您可以享受更多服务</p>
                </div>
                <div class="form-group column-fee">
                    <b>您的银行信息：</b>
                    <hr>
                    <p>申请时间：{!! $authInfo['created_at'] !!}</p>
                    <p>银行开户名：{!! $authInfo['deposit_name'] !!}</p>
                    <p>开户银行：{!! $authInfo['bank_name'] !!}</p>
                    <p>开户行地区：{!! $authInfo['districtname'] !!}</p>
                    <p>银行卡号：{!! CommonClass::starReplace($authInfo['bank_account'], 4, 10) !!}</p>
                </div>
                <div class="text-center">
                    <br>
                    <a class="blue" href="javascript:;"><i class="glyphicon glyphicon-share-alt"></i> 返回</a>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>--}}

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
                    <span class="title">认证成功</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="space-30"></div>
    <div class="text-center g-bankhint">
        <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" /><b>恭喜，您已经通过了绑定认证！</b>
        <p class="cor-gray97">现在可以享受更多服务</p>
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