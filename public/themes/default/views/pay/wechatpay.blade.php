
{!! Theme::asset()->container('custom-css')->usePath()->add('recharge', 'css/usercenter/finance/finance-recharge.css') !!}

<div class="g-main g-recharge">
    <h4 class="cor-blue u-title">收银台</h4>
    <div class="space"></div>
    <div role="alert" class="alert alert-warning alert-dismissible">
        您要充值的金额为：<b>{!! $cash !!}</b> 元
    </div>
    <div class="space-30"></div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="g-code col-md-4">
            <div class="g-codeimg">{!! $img !!}</div>
            <div class="space-8"></div>
            <div class="g-codeinfo">
                <p>请使用微信扫一扫</p>
                <p>扫描二维码支付</p>
            </div>
        </div>
       {{-- <div class="col-md-1"></div>--}}
        <div class="g-codephone col-md-5 center"><img src="{!! Theme::asset()->url('images/codephone.jpg') !!}" /></div>
    </div>
    <div class="space-32"></div>
</div>