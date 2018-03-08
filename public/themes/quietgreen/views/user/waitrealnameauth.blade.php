<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">实名认证</h4>
    <div class="space-30"></div>
    <div class="text-center g-bankhint1 g-bankhint">
        <img src="{!! Theme::asset()->url('images/withdrawhint.png') !!}"><b>
            很高兴认识您，我们会尽快完成认证！</b>
        <p class="text-size14"><a class="text-under" href="/task">去任务大厅逛逛</a></p>
    </div>
    <div class="space-20"></div>
    <div class="space-10"></div>
    <div class="cor-gray51 text-size14">您的身份信息</div>
    <div class="space-10"></div>
    <div class="text-size14 cor-gray51 pdl54">真实姓名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="inlineblock cor-gray97">{!! $realname !!} <span class="u-failureicon">未认证</span></span></div>
    <div class="space-10"></div>
    <div class="text-size14 cor-gray51 pdl54">证件号码：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="inlineblock cor-gray97">{!! $card_number !!}</span></div>
    <div class="space-10"></div>
    <div class="text-size14 cor-gray51 pdl54">证件图片：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="inlineblock cor-gray97">已做隐私处理，不显示具体内容。</span></div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}