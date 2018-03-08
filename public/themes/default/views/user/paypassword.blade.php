<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">修改支付密码</h4>
    <div class="space-20"></div>
    <div class="text-size14 cor-orange">
        <p class="alertpdl"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 支付密码变更：在进行操作同时，请牢记自己的新支付密码，支付密码将用于涉及到资金流确认时使用。<br>
            如：提现、付款等【用户的初始支付密码与用户密码相同】
        </p>
        <p></p>
    </div>
    <div class="space-20"></div>
    <div class="col-xs-12">
        <form class="registerform form-horizontal row paypassword-form" role="form" action="{{ URL('user/validate') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group nomarb">
                <label class="col-sm-2 control-label no-padding-right s-safetywrp3" for="form-field-2"> 电子邮箱&nbsp;&nbsp;</label>
                <div class="col-sm-10 task-casebghid">
                    <input type="text" id="form-field-2" value="{!! old('email') !!}" placeholder="请输入您的电子邮箱" class="col-xs-12 col-sm-5 inputxt" name="email" nullmsg="请输入您的电子邮箱" token="{{ csrf_token() }}" datatype="e" errormsg="邮箱地址格式不对！">
                    <input type="button" class="btn btn-sm cor-gray51 c-btntime" value="发送验证码" id="btnSendCode">
                    <div class="Validform_checktip vilidform-wrp1"></div>
                </div>
            </div>

            <div class="hr hr-dotted hr18 nomart"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right s-safetywrp3" for="form-field-3"> 验证码&nbsp;&nbsp;</label>

                <div class="col-sm-7 task-casebghid">
                    <input type="text" id="form-field-3" value="{!! old('code') !!}" placeholder="请输入验证码" name="code" class="col-xs-12 col-sm-3 inputxt" datatype="*" nullmsg="请输入验证码">
                    <div class="paypassword-tit Validform_checktip vilid-wrprg col-sm-12 validform-base {{ ($errors->first('code'))?'Validform_wrong':'' }}">{!! $errors->first('code') !!}</div>
                </div>
            </div>
            <div class="space-20"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right s-safetywrp3" for="form-field-2"> </label>

                <div class="col-sm-10 center768">
                    <button type="submit" class=" btn btn-primary btn-big btn-blue bor-radius2 btn-sm btn-imp" href="">下一步</button>
                </div>
            </div>
        </form>
    </div>
    <div class="space-20"></div>
</div>
{!! Theme::asset()->container('specific-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('safety','css/usercenter/safety/safety-layout.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-style','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('paypassword','js/doc/paypassword.js') !!}
{!! Theme::widget('popup')->render() !!}
{!! Theme::widget('avatar')->render() !!}