<header>
    <div class="sign-logo">
        <a href="{!! CommonClass::homePage() !!}">
            @if(Theme::get('site_config')['site_logo_1'])
                <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" alt="kppw" class="img-responsive login-logo" onerror="onerrorImage('{{ Theme::asset()->url('images/mb1/logo1.png')}}',$(this))">
            @else
                <img src="{!! Theme::asset()->url('images/mb1/logo1.png') !!}" alt="kppw" class="img-responsive login-logo" >
            @endif
        </a>
    </div>
</header>
<section>
    <div class="sendemail-bg">
        <div class="sendmail-main password-main">
            <div class="clearfix password-head">
                <div class="pull-left text-size20 cor-gray4c">
                    通过邮箱找回
                </div>
                <a href="" class="pull-right cor-gray4c">
                    手机找回
                </a>
            </div>
            <div class="space-26"></div>
            <div class="password-wizard no-margin">
                <ul class="wizard-steps hidden-xs">
                    <li class="active">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">输入账号信息</span>
                    </li>
                    <li class="active validate">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">验证信息</span>
                    </li>
                    <li class="active reset">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">重置密码</span>
                    </li>

                    <li class="">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">完成</span>
                    </li>
                </ul>
            </div>
            <div class="space-26"></div>
            <form class="registerform form-horizontal" method="post" action="{!! url('password/reset') !!}">
                {!! csrf_field() !!}
                <input type="hidden" name="validation" value="{!! $validationInfo !!}">
                <div class="form-group sign-inputradiu" >
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right" for="userpassword">新密码</label>
                    <div class="col-xs-12 col-sm-8">
                        <div class="clearfix block step-validform login-form">
                            <input  class=" forminput  inputxt col-sm-7 col-xs-12"  type="password" name="password" placeholder="密码" datatype="*6-16" nullmsg="请输入密码" errormsg="密码长度为6-16位字符">
                            <div class="col-sm-5 Validform_checktip validform-base"></div>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>

                <div class="form-group sign-inputradiu">
                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">确认新密码</label>

                    <div class="col-xs-12 col-sm-8">
                        <div class="clearfix step-validform login-form">
                            <input class=" forminput  inputxt col-sm-7 col-xs-12" type="password" name="confirmPassword"  placeholder="确认密码" datatype="*" recheck="password" nullmsg="请输入确认密码" errormsg="两次密码不一致">
                            <div class="col-sm-5 Validform_checktip validform-base"></div>
                        </div>
                    </div>
                </div>
                <div class="space-14"></div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right"></label>

                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix">
                            <input type="submit"  class="password-btn bor-radius2 text-size16" value="确认">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-css', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('auth-js', 'js/resetpassword.js') !!}