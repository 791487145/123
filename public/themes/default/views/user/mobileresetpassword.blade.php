<header>
    <div class="g-signlogin">
        <div class="container search-pd">
            <div class="row">
                <div class="col-xs-12 loginbrand">
                    <div class="pull-left p-space">
                        <a href="{!! CommonClass::homePage() !!}" class="pull-left hidden-480">
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
                        <a href="{!! url('login') !!}" class="cor-blue">登录</a>
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
                        <h4 class="s-logintit">通过手机找回 <a class="text-size12 pull-right cor-gray3a phoneicoem" href="{{url('password/email')}}">邮箱找回</a></h4>
                        <div class="space hidden-xs"></div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div id="fuelux-wizard" class="row-fluid" data-target="#step-container">
                                    <ul class="wizard-steps hidden-xs phonepass">
                                        <li data-target="#step1" class="active">
                                            <span class="step">1</span>
                                            <span class="title ">输入手机号</span>
                                        </li>

                                        <li data-target="#step2" class="active">
                                            <span class="step">2</span>
                                            <span class="title">重置密码</span>
                                        </li>

                                        <li data-target="#step3">
                                            <span class="step">3</span>
                                            <span class="title">完成</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="step-content row-fluid position-relative" id="step-container">
                                    <div class="space"></div>
                                    <form class="registerform form-horizontal " method="post" action="{!! url('password/mobileReset') !!}">
                                        {!! csrf_field() !!}
                                        <div class="form-group" >
                                            <label class="control-label col-xs-12 col-sm-4 no-padding-right" for="userpassword">新密码</label>
                                            <div class="col-xs-12 col-sm-8">
                                                <div class="clearfix block step-validform">
                                                    <input type="password" name="password"  class=" forminput  inputxt col-sm-5 col-xs-12" placeholder="请输入密码"  nullmsg="请输入密码" errormsg="密码长度为6到18位字符">
                                                    <div class="col-sm-5 Validform_checktip validform-base"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-2"></div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 no-padding-right" for="userpassword2">确认新密码</label>

                                            <div class="col-xs-12 col-sm-8">
                                                <div class="clearfix block step-validform">
                                                    <input type="password" name="confirmPassword" class=" forminput  inputxt col-sm-5 col-xs-12" placeholder="请确认新密码" nullmsg="请确认新密码" errormsg="两次密码不一致">
                                                    <div class="col-sm-5 Validform_checktip validform-base"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 no-padding-right"></label>

                                            <div class="col-xs-12 col-sm-7">
                                                <div class="clearfix">
                                                    <button type="submit" class="btn btn-sm btn-primary allbtn col-sm-2 bor-radius2" > 确认 </button>
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
{!! Theme::asset()->container('custom-js')->usePath()->add('auth-js', 'js/resetpassword.js') !!}