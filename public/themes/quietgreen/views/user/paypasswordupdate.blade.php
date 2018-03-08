<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">重置支付密码</h4>
    <div class="space-20"></div>
    <div class="text-size14 cor-orange">
        <p><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 支付密码变更：在进行操作同时，请牢记自己的新支付密码，支付密码将用于涉及到资金流确认时使用。<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如：提现、付款等【用户的初始支付密码与用户密码相同】
        </p>
        <p></p>
    </div>
    <div class="space-20"></div>
    <div class="col-xs-12">
        <form class="registerform form-horizontal row" role="form" action="{{ URL('user/payPasswordUpdate') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group mg-margin">
                <label class="col-sm-2 control-label no-padding-right s-safetywrp2" for="form-field-2"> 新支付密码 </label>
                <div class="col-sm-5">
                    <span>
                        <input type="password" id="form-field-2" placeholder="设置新密码" class="col-xs-10 col-sm-12 inputxt" plugin="passwordStrength" name="password" nullmsg="请输入您的新密码" datatype="*6-12" errormsg="请输入6-12个字符，支持英文、数字">

                    </span>
                    <span>
                          <div class="Validform_checktip col-sm-12 vilidform-wrp1 registerform-form"></div>
                    </span>
                </div>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="passwordStrength col-xs-10 col-sm-12 vilidform-passwordlength">安全等级： <span>低</span><span>中</span><span class="last">高</span></div>
                    </div>
                </div>
            </div>

            <div class="hr hr-dotted hr18 " style="margin-top: 0; margin-bottom: 22px"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right s-safetywrp2" for="form-field-3"> 确认支付密码 </label>

                <div class="col-sm-5">
                    <span>
                         <input type="password" id="form-field-3" placeholder="确认新密码" name="confirmPassword" class="col-xs-10 col-sm-12 inputxt" recheck="password"  nullmsg="请再次输入您的新密码" datatype="*6-18" errormsg="两次输入的密码不一致！">
                    </span>
                    <span>
                        <div class="Validform_checktip col-sm-12 vilidform-wrp1">　</div>
                    </span>
                   </div>　　

            </div>
            <div class="space-18"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right s-safetywrp2" for="form-field-2"> </label>

                <div class="col-sm-10">
                    <button class="btn btn-primary btn-big bg-blue bor-radius2 btn-imp " type="submit">确认</button>
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
{!! Theme::asset()->container('specific-js')->usepath()->add('passwordStrength','plugins/jquery/validform/plugins/passwordStrength/passwordStrength-min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('paypassword','js/doc/paypasswordupdate.js') !!}