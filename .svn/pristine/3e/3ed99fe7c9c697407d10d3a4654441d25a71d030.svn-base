
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
                        <span class="text-size22 mg-left30 pull-left hidden-xs">欢迎注册</span>
                        <span class="text-size22 pull-left hidden-lg hidden-md hidden-sm visible-xs-block">欢迎注册</span>
                    </div>
                    <div class="pull-right login-welcome text-size14">
                        已有帐号？ 请<a href="{!! url('login') !!}" class="cor-blue text-under">登录</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="sectionall">
    <div class="container">
        <div class="row">
            <div class="g-signmain clearfix g-signmain-container">
                <div class="col-lg-7 col-md-7 hidden-sm hidden-xs l-loginImg">
                    @if(count($ad))
                        <a href="{!! $ad[0]['ad_url'] !!}"><img src="{!! URL($ad[0]['ad_file']) !!}" class="img-responsive" alt=""></a>
                    @else
                    <img src="{!! Theme::asset()->url('images/login-bg.png') !!}" class="img-responsive" alt="">
                    @endif
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 login-box-container">
                    <div class="login-box">
                        <div class="widget-body bor-radius2">
                            <div class="widget-main loginmain bor-radius2 loginmain-container">
                                <div class="space-6"></div>
                                <h4 class=" lighter bigger text-left mg-margin" >账号注册</h4>
                                <hr class="bor-grayD5">
                                <form class="registerform" action="{!! url('register') !!}" method="post">
                                    {!! csrf_field() !!}
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control inputxt" name="username" id="username" placeholder="用户名" ajaxurl="{!! url('checkUserName') !!}" datatype="*4-15" nullmsg="请输入用户名" errormsg="用户名长度为4到15位字符">
                                            <i class="ace-icon fa fa-user cor-grayD3"></i>
                                            <span class="Validform_checktip validform-login-form"></span>
                                        </span>
                                    </label>
                                    <div class="space-10"></div>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="email" class="form-control inputxt" name="email" placeholder="邮箱" ajaxurl="{!! url('checkEmail') !!}" datatype="e" nullmsg="请输入邮箱帐号" errormsg="邮箱地址格式不对！">
                                             <i class="ace-icon fa  fa-envelope cor-grayD3"></i>
                                            <span class="Validform_checktip validform-login-form"></span>
                                        </span>
                                    </label>
                                    <div class="space-10"></div>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control inputxt" name="password" placeholder="密码" datatype="*6-16" nullmsg="请输入密码" errormsg="密码长度为6-16位字符">
                                            <i class="ace-icon fa fa-lock cor-grayD3"></i>
                                            <span class="Validform_checktip validform-login-form"></span>
                                        </span>
                                    </label>
                                    <div class="space-10"></div>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control inputxt" name="confirmPassword" placeholder="确认密码" datatype="*" recheck="password" nullmsg="请输入确认密码" errormsg="两次密码不一致">
                                            <i class="ace-icon fa fa-lock cor-grayD3"></i>
                                            <span class="Validform_checktip validform-login-form"></span>
                                        </span>
                                    </label>
                                    {{--<div class="space-10"></div>
                                    <div class="clearfix text-size12 login-Validform_right">
                                        <label class="inline cor-gray87">
                                            <input type="checkbox" class="ace" name="agree" checked="checked" datatype="*" nullmsg="请先阅读并同意">
                                            <span class="lbl text-muted text-size12">&nbsp;&nbsp;&nbsp;我已阅读并同意 <a class="text-under" href="/bre/agree/register">《KPPW注册协议》</a></span>
                                            <span class="Validform_checktip validform-login-form"></span>
                                        </label>
                                    </div>--}}
                                    <div class="space-10"></div>
                                    <div>
                                        <button  class=" btn btn-block btn-primary allbtn " type="submit">
                                            立即注册
                                        </button>
                                    </div>
                                    <div class="space-4"></div>
                                    <div class="clearfix text-size12 login-Validform_right">
                                        <label class="inline cor-gray87">
                                            @if(!empty($agree))
                                            <input type="checkbox" class="ace" name="agree" checked="checked" datatype="*" nullmsg="请先阅读并同意">
                                            <span class="lbl text-muted text-size12">&nbsp;&nbsp;&nbsp;我已阅读并同意 <a class="text-under" target="_blank" href="/bre/agree/register">《{!! $agree->name !!}》</a></span>
                                            <span class="Validform_checktip validform-login-form"></span>
                                            @endif
                                        </label>
                                    </div>
                                </form>
                            </div><!-- /widget-main -->
                        </div><!-- /widget-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('custom-validform-js', 'js/auth.js') !!}