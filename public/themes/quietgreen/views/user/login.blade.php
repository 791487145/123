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
    <div class="sign-main-bg">
        <div class="sign-main">
            <div class="sign-main-head">
                账号密码登录
            </div>
            <div class="sign-main-content">
                <form class="login-form" method="post" action="{!! url('login') !!}" >
                    {{ csrf_field() }}
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control inputxt bor-radius2" placeholder="用户名/邮箱/手机号" name="username" value="{!! old('username') !!}" nullmsg="请输入您的账号" datatype="*" errormsg="请输入您的账号">
                            <i class="sign-main-userico"></i>
                            <span class="Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red">{!! $errors->first('username') !!}</span>
                            </span>

                        </span>
                    </label>

                    <label class="block clearfix label-bottom">
                        <span class="block input-icon input-icon-right login-error_wrong Validform-wrong-red Validform-wrong-red-height">
                            <input type="password" class="form-control inputxt bor-radius2" placeholder="密码" name="password" nullmsg="请输入您的密码" datatype="*6-16" errormsg="请输入6-12个字符，支持英文、数字" autocomplete="off" disableautocomplete>

                            <i class="sign-main-passico"></i>
                            <span class="Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red">{!! $errors->first('password') !!}</span>
                            </span>

                        </span>
                    </label>
                    @if(!empty($errors->first('password')) || !empty($errors->first('code')))
                        <div class="clearfix codeImg">
                            <label class="inline pull-left">
                                <input type="text" class="form-control" placeholder="验证码" name="code">

                                <div class="error_wrong">{!! $errors->first('code') !!}</div>
                            </label>
                            <img src="{!! $code !!}" alt="" class="pull-right" onclick="flushCode(this)">
                        </div>
                    @endif
                    <div class="clearfix">
                        <label class="sign-checklabel">
                            <input type="checkbox" class="ace" name="remember">
                            <span class="sign-check text-size12">记住密码</span>
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="btn-green bor-radius2 text-size16">
                            登录
                        </button>
                    </div>
                </form>
                <div class="space-6"></div>
                <div class="clearfix">
                    <a href="{!! url('register') !!}" class="pull-left cor-green">免费注册</a>
                    <a href="{!! url('password/email') !!}" class="pull-right cor-green">忘记密码？</a>
                </div>
                <div class="space"></div>
                <div class="text-center cor-gray52">第三方登录</div>
                <div class="sign-three-wrap">
                    <div class="sign-three">
                        <ul class="clearfix">
                            @if(isset($oauth['qq_api']['status']))
                                <li class="col-sm-4">
                                    <a href="{!! url('oauth/qq') !!}" class="sign-qq cor-gray52 text-under">QQ</a>
                                </li>
                            @endif
                            @if(isset($oauth['sina_api']['status']))
                                <li class="col-sm-4 text-center">
                                    <a href="{!! url('oauth/weibo') !!}" class="sign-wx cor-gray52 text-under">微信</a>
                                </li>
                            @endif
                            @if(isset($oauth['wechat_api']['status']))
                                <li class="col-sm-4 text-right">
                                    <a href="{!! url('oauth/weixinweb') !!}" class="sign-wb cor-gray52 text-under">微博</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="space-6"></div>
            </div>
            <div class="text-center sign-main-icon"><i class="fa fa-bars"></i></div>
        </div>
    </div>
</section>
{!! Theme::asset()->container('custom-js')->usepath()->add('main-js', 'js/main.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-style','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}