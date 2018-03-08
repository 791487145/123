<div class="g-main g-recharge">
    <h4 class="cor-blue u-title">提现信息</h4>
    <div class="space-30"></div>
    <div class="g-withdrawhint">
        <h4>提现申请已提交，等待平台处理！</h4>
        <div class="space-12"></div>
        <p>如果银行信息填写错误，导致提现错误，请立即<a href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}" target="_blank">联系客服</a></p>
        <div class="space-12"></div>
        <p><a href="{!! url('finance/cashout') !!}">继续提现</a><a href="{!! url('finance/list?type=cashout') !!}">查看提现记录</a><a href="{!! url('user/index') !!}">返回我的主页</a></p>
    </div>
    <div class="space-32"></div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('recharge-css', 'css/usercenter/finance/finance-recharge.css') !!}