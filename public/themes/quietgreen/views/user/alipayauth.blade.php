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
                <li data-target="#step2">
                    <span class="step">2</span>
                    <span class="title">打款中</span>
                </li>
                <li data-target="#step3">
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
    <form class="registerform" method="post" action="{!! url('user/alipayAuth') !!}">
        {!! csrf_field() !!}
        <ul class="xstxtleft">
            <li><div class="row task-casehid">
                <div class="space-10"></div>
                <div class="col-sm-3 col-xs-4 col-lg-2 text-right h5">支付宝姓名</div>
                <div class="col-md-9"><input type="text" name="alipayName" class="col-sm-4 col-xs-12 inputxt" datatype="zh2-4" nullmsg="请输入支付宝姓名！" errormsg="请输入2到4位中文字符"  />
                    <span class="Validform_checktip vilid-wrprg"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 须使用以"法定代表人名称"为银行开户名</span>
                </div>
            </div>
            </li>
            <li><div class="row task-casehid">
                <div class="space-10"></div>
                <div class="col-sm-3 col-xs-4 col-lg-2 text-right h5">支付宝账户</div>
                <div class="col-md-9"><input type="text" class="inputxt col-sm-4 col-xs-12" nullmsg="请输入支付宝账户！" datatype="ali" name="alipayAccount" /><span class="Validform_checktip vilid-wrprg"></span></div>
            </div>
            </li>
            <li><div class="row task-casehid">
                <div class="space-10"></div>
                <div class="col-sm-3 col-xs-4 col-lg-2 text-right h5">确认支付宝账户</div>
                <div class="col-md-9"><input type="text" class="inputxt col-sm-4 col-xs-12" datatype="ali" nullmsg="请确认支付宝账户！" recheck="alipayAccount" name="confirmAlipayAccount" /><span class="Validform_checktip vilid-wrprg"></span></div>
            </div>
            </li>
        </ul>

        <div class="space-20"></div>
        <div class="text-center"><a id="btn_sub" class="btn-big bg-blue bor-radius2 hov-blue1b btn-imp" href="">立即申请</a></div></form>
</div>

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('alipayauth-js', 'js/alipayauth.js') !!}
