<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">企业认证</h4>
    <div class="space-30"></div>
    <div class="text-center g-bankhint1 g-bankhint">
        <img src="{!! Theme::asset()->url('images/withdrawhint.png') !!}"><b>
            很高兴您的入驻，我们会尽快完成认证！</b>
        <p class="text-size14">返回 <a class="text-under" href="/user/shop">店铺设置</a></p>
    </div>
    <div class="space-20"></div>
    <div class="space-10"></div>
    <div class="cor-gray51 text-size14">您的企业信息</div>
    <div class="space-10"></div>
    <div class="text-size14 cor-gray51 pdl54">公司名称：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="inlineblock cor-gray97">{!! $company_info->company_name !!} <span class="u-failureicon">未认证</span></span></div>
    <div class="space-10"></div>
    <div class="text-size14 cor-gray51 pdl54">所属行业：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="inlineblock cor-gray97">{!! $cate_name !!}</span></div>
    <div class="space-10"></div>
    <div class="text-size14 cor-gray51 pdl54">证件图片：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="inlineblock cor-gray97">已做隐私处理，不显示具体内容。</span></div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}