{{--<div class="space-2"></div>
<div class="page-header">
    <h1>
        银行认证详细信息
    </h1>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">银行认证详细信息</h3>
<div class="g-backrealdetails clearfix bor-border">
    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">用户昵称：</p>
        <p class="col-md-11">{!! $bank->username !!}</p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">真实姓名：</p>
        <p class="col-md-11">{!! $bank->realname !!}</p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">支付类型：</p>
        <p class="col-md-11">线下支付</p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">银行名称：</p>
        <p class="col-md-11">{!! $bank->bank_name !!}</p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">开户银行：</p>
        <p class="col-md-11">{!! $bank->deposit_name !!}</p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">银行账号：</p>
        <p class="col-md-11">{!! $bank->bank_account !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">打款金额：</p>
        @if($bank->status == 0)
            <form class="registerform" action="{!! url('manage/bankAuthPay') !!}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="authId" value="{!! $bank->id !!}">
                <p class="col-md-11">
                    <input class="inputxt" type="text" name="pay_to_user_cash" datatype="number" errormsg="请输入正确的金额" nullmsg="输入金额" />元 </p>
                <p class="col-md-offset-1 col-md-11"><button id="btn_sub" class="btn btn-sm btn-primary ">给用户打款</button></p>
            </form>
        @else
            <p class="col-md-11">￥{!! $bank->pay_to_user_cash !!}元</p>
        @endif
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">收款金额：</p>
        <p class="col-md-11">￥{!! $bank->user_get_cash !!}元</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">有效期：</p>
        <p class="col-md-11">终身有效</p>
    </div>
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('validform-js', 'js/bankauthpay.js') !!}