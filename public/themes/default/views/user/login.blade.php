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
                            <span class="text-size22 mg-left30 pull-left hidden-xs">欢迎登录</span>
                            <span class="text-size22 pull-left hidden-lg hidden-md hidden-sm visible-xs-block">欢迎登录</span>
                        </div>
                        <div class="pull-right login-welcome">
                            <a href="{!! url('register') !!}" class="cor-blue text-under">注册</a>
                        </div>
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
                            <div class="widget-main loginmain loginmain-container">
                                <div class="space-6"></div>
                                <h4 class=" lighter bigger text-left mg-margin" >帐号登录</h4>
                                <hr class="bor-grayD5">
                                <form class="login-form" method="post" action="{!! url('login') !!}" >
                                    {!! csrf_field() !!}
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control inputxt" placeholder="用户名/邮箱/手机号" name="username" value="{!! old('username') !!}" nullmsg="请输入您的账号" datatype="*" errormsg="请输入您的账号">
                                            <i class="ace-icon fa fa-user cor-grayD3"></i>
                                            <span class="Validform_checktip validform-login-form login-validform-static">
                                                <span class="login-red">{!! $errors->first('username') !!}</span>
                                            </span>

                                        </span>
                                    </label>
                                    {{--<div class="space-12"></div>--}}
                                    <label class="block clearfix label-bottom">
                                        <span class="block input-icon input-icon-right login-error_wrong Validform-wrong-red Validform-wrong-red-height">
                                            <input type="password" class="form-control inputxt" placeholder="密码" name="password" nullmsg="请输入您的密码" datatype="*6-16" errormsg="请输入6-12个字符，支持英文、数字" autocomplete="off" disableautocomplete>

                                            <i class="ace-icon fa fa-lock cor-grayD3"></i>
                                            <span class="Validform_checktip validform-login-form login-validform-static">
                                                <span class="login-red">{!! $errors->first('password') !!}</span>
                                            </span>

                                        </span>
                                    </label>
                                    @if(!empty($errors->first('password')) || !empty($errors->first('code')))
                                    <div class="clearfix codeImg">
                                        <label class="inline pull-left">
                                            <input type="text" class="form-control form-input-code" placeholder="验证码" name="code">

                                            <div class="error_wrong">{!! $errors->first('code') !!}</div>
                                        </label>
                                        <img src="{!! $code !!}" alt="" class="pull-right" onclick="flushCode(this)">
                                    </div>
                                    @endif
                                    <div class="clearfix">
                                        <label class="inline">
                                            <input type="checkbox" class="ace" name="remember">
                                            <span class="lbl cor-gray87 hov-blue">&nbsp;&nbsp;&nbsp;记住密码</span>
                                        </label>
                                    </div>
                                    <div class="space-4"></div>
                                    <div>
                                        <button type="submit" class=" btn btn-block btn-primary allbtn bg-blue">
                                            立即登录
                                        </button>
                                    </div>
                                    <div class="space-6"></div>
                                    <div class="clearfix">
                                        <a href="{!! url('register') !!}" class="pull-left cor-blue text-under">免费注册</a>
                                        <a href="{!! url('password/email') !!}" class="pull-right cor-blue text-under">忘记密码？</a>
                                    </div>
                                    <div class="space-6"></div>
                                    <div class="text-center cor-gray97">
                                        <span class="s-loginline"></span>&nbsp;&nbsp;&nbsp; 可使用以下账号直接登录 &nbsp;&nbsp;&nbsp;<span class="s-loginline"></span>
                                    </div>
                                    <div class="space-6"></div>
                                    <div class="clearfix">
                                        <ul class="list-inline clearfix social-login text-center mg-margin">
                                            @if(isset($oauth['qq_api']['status']))
                                                <li>
                                                    <a href="{!! url('oauth/qq') !!}">
                                                        <i class="fa fa-qq text-danger s-bgqq"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(isset($oauth['sina_api']['status']))
                                                <li>
                                                    <a href="{!! url('oauth/weibo') !!}">
                                                        <i class="fa fa-weibo text-danger s-bgqq s-bgweibo"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(isset($oauth['wechat_api']['status']))
                                                <li>
                                                    <a href="{!! url('oauth/weixinweb') !!}">
                                                        <i class="fa fa-weixin text-blue s-bgqq s-bgweixin"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
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
{!! Theme::asset()->container('custom-js')->usePath()->add('main-js', 'js/main.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-style','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
