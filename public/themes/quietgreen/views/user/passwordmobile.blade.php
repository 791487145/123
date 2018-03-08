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
                    通过手机找回
                </div>
                <a class="pull-right cor-gray4c" href="{{url('password/email')}}">
                    邮箱找回
                </a>
            </div>
            <div class="space-26"></div>
            <div class="password-wizard">
                <ul class="wizard-steps hidden-xs">
                    <li class="active">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">输入手机号</span>
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
            <form class="passwordform form-horizontal" method="post" action="{!! url('password/mobile') !!}">
                {!! csrf_field() !!}
                <div class="form-group step-validform sign-inputradiu" >
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right">手机号 </label>
                    <div class="col-xs-12 col-lg-8 col-md-9 col-sm-10">
                        <div class="clearfix login-form">
                            <input type="text" name="mobile" id="form-field-2" class=" forminput inputxt col-sm-7 col-xs-12" placeholder="输入注册手机号"  datatype="m" value="" nullmsg="请输入注册手机号" errormsg="手机号格式不对！">
                            <div class="col-sm-5 mobile_check Validform_checktip validform-base"><span class="password-email"></span></div>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>

                <!-- 滑块验证 -->
                <div class="form-group step-validform" >
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right" for="email"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div class="col-xs-12 col-lg-8 col-md-9 col-sm-10">
                                                <span class="block input-icon input-icon-right" style="width:100%;">
                                                <div id="embed-captcha" data-info="1"></div>
                                                <p id="wait" class="show">正在加载验证码......</p>
                                                <p id="notice" class="hide">请先完成验证</p>
                                                </span>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="form-group step-validform sign-inputradiu">
                    <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right">验证码 </label>

                    <div class="col-xs-12 col-sm-7">
                        <div class="clearfix task-casebghid login-form">
                            <input type="text"  id="form-field-3" name="code" class="col-xs-12 col-sm-5 inputxt" placeholder="输入验证码" datatype="*" nullmsg="请输入验证码">
                            <div class="space-8 col-xs-12 visible-xs-block"></div><span class="hidden-xs">&nbsp;&nbsp;</span>
                            <input type="button" token="{{csrf_token()}}" class="register-code" onclick="sendPasswordCode()" value="获取验证码" id="sendMobileCode">

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

        <!-- 拖拽验证 -->
{!! Theme::asset()->container('specific-js')->usepath()->add('gt', 'js/user/gt.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('huakuaiyanzheng', 'js/user/huakuaiyanzheng.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('payphoneword','js/doc/payphoneword.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('main-js', 'js/main.js') !!}