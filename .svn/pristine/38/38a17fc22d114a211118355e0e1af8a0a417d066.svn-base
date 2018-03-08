<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">支付绑定</h4>
    <div class="space-16"></div>
    <div class="alert g-alertreal clearfix" role="alert">
        <i class="fa fa-lightbulb-o pull-left"></i>
        <span class="text-size12">友情提示：以下账户信息以您提交的信息为准，非本站金融体系，请妥善填写，如出现信息误差，自行负责。如对支付认证有任何疑问，请直接
            <a class="text-under" href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}" target="_blank">联系客服</a>。</span>
    </div>
    <ul class="approvelist">
        <li class="clearfix">
            <div class="pull-left">
                <div class="pull-left"><img src="{!! Theme::asset()->url('images/bankpay.jpg') !!}"></div>
                <div class="pull-left approveinfo"><span class="text-size14">银行卡绑定</span><p class="hidden-xs">平台会向银行卡打入一定的金额，输入该金额进行绑定</p></div>
            </div>
            @if($bankAuth > 0)
            <div class="pull-right g-realexamine"><a class="text-under" href="{!! url('user/bankAuthList') !!}">查看绑定</a></div>
            @else
            <div class="pull-right approvebtn"><a href="{!! url('user/bankAuth') !!}" class="btn btn-warning">立即绑定</a></div>
            @endif
        </li>
        <li class="clearfix">
            <div class="pull-left">
                <div class="pull-left"><img src="{!! Theme::asset()->url('images/alipay.jpg') !!}"></div>
                <div class="pull-left approveinfo"><span class="text-size14">支付宝绑定</span><p class="hidden-xs">支付宝认证会在一个工作日内完成</p></div>
            </div>
            @if($alipayAuth > 0)
                <div class="pull-right g-realexamine"><a class="text-under" href="{!! url('user/alipayAuthList') !!}">查看绑定</a></div>
            @else
                <div class="pull-right approvebtn"><a href="{!! url('user/alipayAuth') !!}" class="btn btn-warning">立即绑定</a></div>
            @endif
        </li>
    </ul>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::widget('avatar')->render() !!}