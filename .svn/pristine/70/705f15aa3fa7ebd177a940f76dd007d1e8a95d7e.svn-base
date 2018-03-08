<header>
    <div class="g-signlogin">
        <div class="container search-pd">
            <div class="row">
                <div class="col-xs-12 loginbrand">
                    <div class="pull-left p-space">
                        <a href="{!! CommonClass::homePage() !!}" class="pull-left hidden-480">
{{--<img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" alt="kppw" class="img-responsive">--}}

                            @if(Theme::get('site_config')['site_logo_1'])
                                <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" alt="kppw" class="img-responsive login-logo">
                            @else
                                <img src="{!! Theme::asset()->url('images/sign-logo.png') !!}" alt="kppw" class="img-responsive login-logo">
                            @endif
                        </a>
                        <span class="text-size22 mg-left30 pull-left hidden-xs">找回密码</span>
                        <span class="text-size22 pull-left hidden-lg hidden-md hidden-sm visible-xs-block">找回密码</span>
                    </div>
                    <div class="pull-right login-welcome text-size14">
                        <a href="{!! url('login') !!}"  class="cor-blue">登录</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="sectionall">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="g-signmain clearfix">
                <div class="loginmain">
                    <div class="space"></div>
                    <h4 class="s-logintit">通过邮箱找回<a class="text-size12 pull-right cor-gray3a phoneicoem" href="{{url('password/mobile')}}">手机找回</a></h4>
                    <div class="space-20 hidden-xs"></div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <div id="fuelux-wizard" class="row-fluid" data-target="#step-container">
                                <ul class="wizard-steps hidden-xs">
                                    <li data-target="#step1" class="active">
                                        <span class="step">1</span>
                                        <span class="title ">输入账号信息</span>
                                    </li>

                                    <li data-target="#step2">
                                        <span class="step">2</span>
                                        <span class="title">验证信息</span>
                                    </li>

                                    <li data-target="#step3">
                                        <span class="step">3</span>
                                        <span class="title">重置密码</span>
                                    </li>

                                    <li data-target="#step4">
                                        <span class="step">4</span>
                                        <span class="title">完成</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="step-content row-fluid position-relative" id="step-container">
                                <div class="space"></div>
                                <form class="passwordform form-horizontal" method="post" action="{!! url('password/email') !!}">
                                    {!! csrf_field() !!}
                                    <div class="form-group step-validform" >
                                        <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right" for="email">邮箱 </label>
                                        <div class="col-xs-12 col-lg-8 col-md-9 col-sm-10">
                                            <div class="clearfix block ">
                                                <input type="text" name="email" id="email" class=" forminput  inputxt col-sm-5 col-xs-12"
                                                       placeholder="请出入您的邮箱" datatype="e" ajaxurl="{!! url('password/checkEmail') !!}"
                                                       nullmsg="请输入您的邮箱" errormsg="邮箱地址格式不对！">
                                                <div class="col-sm-5 Validform_checktip validform-base"><span class="password-email">请输入您的邮箱</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-2"></div>

                                    <div class="form-group step-validform">
                                        <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right" for="password2">验证码 </label>

                                        <div class="col-xs-12 col-sm-7">
                                            <div class="clearfix block">
                                                <input type="text"  id="code" name="code" class="col-xs-12 col-sm-3 inputxt forminput-code" placeholder="请输入验证码" datatype="s" ajaxurl="{!! url('password/checkCode') !!}" nullmsg="请输入验证码">
                                                <div class="space-8 col-xs-12 visible-xs-block"></div>
                                                 <img src="{!! $code !!}" id="codeimg" onclick="flushCode(this)" > </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-2 col-lg-4 col-md-3 no-padding-right"></label>

                                        <div class="col-xs-12 col-sm-7">
                                            <div class="clearfix">
                                                <input type="submit"  class="btn btn-sm btn-primary allbtn form-btn col-sm-2 bor-radius2" value="下一步">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="space-20"></div>
                            <div class="space-32"></div>
                            <div class="space-32"></div>
                        </div>
                    </div><!-- /widget-main -->
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
</section>

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-css', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('auth-js', 'js/password.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('main-js', 'js/main.js') !!}
