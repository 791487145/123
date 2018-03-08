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
                <a class="pull-right cor-gray4c" href="{{url('password/mobile')}}">
                    手机找回
                </a>
            </div>
            <div class="space-26"></div>
            <div class="password-wizard no-margin">
                <ul class="wizard-steps hidden-xs">
                    <li class="active">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">输入邮箱</span>
                    </li>
                    <li class="">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">验证信息</span>
                    </li>

                    <li class="">
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
            <form class="passwordform form-horizontal" method="post" action="{!! url('password/email') !!}">
                {!! csrf_field() !!}
                <div class="form-group step-validform sign-inputradiu" >
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right" for="email">邮箱 </label>
                    <div class="col-xs-12 col-lg-8 col-md-9 col-sm-10">
                        <div class="clearfix block login-form">
                            <input class="forminput  inputxt col-sm-7 col-xs-12" type="text" name="email" id="email"  placeholder="请出入您的邮箱" datatype="e" ajaxurl="{!! url('password/checkEmail') !!}" nullmsg="请输入您的邮箱" errormsg="邮箱地址格式不对！">
                            <div class="col-sm-5 Validform_checktip validform-base"><span class="password-email"></span></div>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="form-group step-validform sign-inputradiu">
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right">验证码 </label>
                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix block login-form">
                            <input class="col-xs-12 col-sm-5 inputxt forminput-code" type="text"  id="code" name="code"  placeholder="请输入验证码" datatype="s" ajaxurl="{!! url('password/checkCode') !!}" nullmsg="请输入验证码">
                            <div class="space-8 col-xs-12 visible-xs-block"></div>
                            <img class="register-codeimg" src="{!! $code !!}" id="codeimg" onclick="flushCode(this)" > </span>
                        </div>
                    </div>
                </div>
                <div class="space-14"></div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right"></label>

                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix">
                            <input type="submit"  class="password-btn bor-radius2 text-size16" value="下一步">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-css', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('auth-js', 'js/password.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('main-js', 'js/main.js') !!}