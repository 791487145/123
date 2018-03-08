<header>
    <div class="sign-logo">
        <a href="{!! CommonClass::homePage() !!}">
            @if(Theme::get('site_config')['site_logo_1'])
                <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" alt="kppw" class="img-responsive login-logo" onerror="onerrorImage('{{ Theme::asset()->url('images/logo.png')}}',$(this))">
            @else
                <img src="{!! Theme::asset()->url('images/logo.png') !!}" alt="kppw" class="img-responsive login-logo">
            @endif
        </a>
    </div>
</header>
<section>
    <div class="sign-main-bg register-main-bg">
        <div class="register-main">
            <div class="sign-main-head register-main-head">
                <ul class="clearfix">
                    <li class="col-sm-6 col-xs-6 text-center active"><a href="#email" class="text-size16" data-toggle="tab">邮箱注册</a></li>
                    <li class="col-sm-6 col-xs-6 text-center"><a href="#phone" class="text-size16" data-toggle="tab">手机注册</a></li>
                </ul>
            </div>
            <div class="sign-main-content tab-content">
                <div id="email" class="tab-pane fade active in">
                    <form class="login-form registerform"  method="post" action="{!! url('register') !!}" >
                        {!! csrf_field() !!}
                        <input type="hidden" name="from_uid" value="{!! $from_uid !!}">
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input class="form-control inputxt bor-radius2"  type="text"  name="username" id="username" placeholder="用户名" ajaxurl="{!! url('checkUserName') !!}" datatype="*4-15" nullmsg="请输入用户名" errormsg="用户名长度为4到15位字符" value="{{old('username')}}">
                                <i class="sign-main-userico"></i>
                                <span class="Validform_checktip validform-login-form login-validform-static">
                                    <span class="login-red"></span>
                                </span>

                            </span>
                        </label>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input class="form-control inputxt bor-radius2" type="email"  name="email" placeholder="邮箱" ajaxurl="{!! url('checkEmail') !!}" datatype="e" nullmsg="请输入邮箱帐号" errormsg="邮箱地址格式不对！" value="{{old('email')}}">
                                 <i class="ace-icon fa  fa-envelope cor-grayD3"></i>
                                <span class="Validform_checktip validform-login-form"></span>
                            </span>
                        </label>
                        <label class="block clearfix label-bottom">
                            <span class="block input-icon input-icon-right login-error_wrong Validform-wrong-red Validform-wrong-red-height">
                                <input class="form-control inputxt bor-radius2"  type="password" name="password" placeholder="密码" datatype="*6-16" nullmsg="请输入密码" errormsg="密码长度为6-16位字符" >
                                <i class="sign-main-passico"></i>
                                <span class="Validform_checktip validform-login-form login-validform-static">
                                    <span class="login-red"></span>
                                </span>

                            </span>
                        </label>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input  class="form-control inputxt bor-radius2" type="password" name="confirmPassword" placeholder="确认密码" datatype="*" recheck="password" nullmsg="请输入确认密码" errormsg="两次密码不一致">
                                <i class="sign-main-passico"></i>
                                <span class="Validform_checktip validform-login-form"></span>
                            </span>
                        </label>
                        <div class="space-10"></div>
                        <div>
                            <button type="submit" class="btn-green bor-radius2 text-size16">
                                注册
                            </button>
                        </div>
                    <div class="space-8"></div>
                    <div class="clearfix">
                        <label class="pull-left register-checkbox sign-checklabel">
                            @if(!empty($agree))
                            <input type="checkbox" class="ace" name="agree" checked="checked" datatype="*" nullmsg="请先阅读并同意">
                            <span class="sign-check text-size12">已阅读并同意 <a class="text-under cor-green" target="_blank" href="/bre/agree/register">《{!! $agree->name !!}》</a></span>
                            <span class="Validform_checktip validform-login-form"></span>
                            @endif
                        </label>
                        <a href="{!! url('login') !!}" class="pull-right cor-green">有账号</a>
                    </div>
                    </form>
                    <div class="space-16"></div>
                </div>
                <div id="phone" class="tab-pane fade">
                    <form class="login-form registerform" method="post" action="{!! url('register/phone') !!}" >
                        {!! csrf_field() !!}
                        <input type="hidden" name="from_uid" value="{!! $from_uid !!}">
                        <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control inputxt bor-radius2" placeholder="用户名" name="username"id="username" placeholder="用户名" ajaxurl="{!! url('checkUserName') !!}" datatype="*4-15" nullmsg="请输入用户名" errormsg="用户名长度为4到15位字符" value="{{old('username')}}">
                            <i class="sign-main-userico"></i>
                            <span class="Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red"></span>
                            </span>
                        </span>
                        </label>

                        <!-- 拖拽滑块验证 -->
                        <div class="space-12"></div>
                        <span class="block input-icon input-icon-right" style="width:100%;">
                            <div id="embed-captcha" data-info="1"></div>
                            <p id="wait" class="show">正在加载验证码......</p>
                            <p id="notice" class="hide">请先完成验证</p>
                        </span>

                        <div class="space-12"></div>
                        <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control inputxt bor-radius2" placeholder="手机号" name="mobile" id="mobile" placeholder="常用手机号码" ajaxurl="{!! url('checkMobile') !!}" datatype="m" nullmsg="请输入手机号" errormsg="手机号格式错误！" value="{{old('mobile')}}">
                            <i class="sign-main-userico"></i>
                            <span class="mobile_check Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red"></span>
                            </span>
                        </span>
                        </label>
                        <div>
                            <input class="inputxt register-inputcode bor-radius2" name="code" type="text" placeholder="短信验证码"  nullmsg="请输入验证码" datatype="*" id="form-field-3" value="">
                            <input class="btn btn-white btn-primary register-code" type="button" token="{{csrf_token()}}" onclick="sendRegisterCode()"  value="获取验证码" id="sendMobileCode">
                            <span class="Validform_checktip block validform-login-form {{ ($errors->first('code'))?'Validform_wrong':'' }}">{!! $errors->first('code') !!}</span>
                        </div>
                        <div class="space-10"></div>
                        </label>
                        <label class="block clearfix label-bottom">
                        <span class="block input-icon input-icon-right login-error_wrong Validform-wrong-red Validform-wrong-red-height">
                            <input class="form-control inputxt bor-radius2" type="password"  name="password" placeholder="密码" datatype="*6-16" nullmsg="请输入密码" errormsg="密码长度为6-16位字符" autocomplete="off" disableautocomplete>
                            <i class="sign-main-passico"></i>
                            <span class="Validform_checktip validform-login-form login-validform-static">
                                <span class="login-red"></span>
                            </span>
                        </span>
                        </label>
                        <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input class="form-control inputxt bor-radius2" type="password"  name="confirm_password" placeholder="确认密码" datatype="*" recheck="password" nullmsg="请输入确认密码" errormsg="两次密码不一致">
                            <i class="sign-main-passico"></i>
                            <span class="Validform_checktip validform-login-form"></span>
                        </span>
                        </label>
                        <div class="space-10"></div>
                        <div>
                            <button type="submit" class="btn-green bor-radius2 text-size16">
                                注册
                            </button>
                        </div>
                    </form>
                    <div class="space-8"></div>
                    <div class="clearfix">
                        <label class="pull-left register-checkbox sign-checklabel">
                            <input type="checkbox" class="ace" name="agree" checked="checked" datatype="*" nullmsg="请先阅读并同意">
                            <span class="sign-check text-size12">已阅读并同意 <a class="text-under cor-green" target="_blank" href="/bre/agree/register">《{!! $agree->name !!}》</a></span>
                            <span class="Validform_checktip validform-login-form"></span>
                        </label>
                        <a href="{!! url('login') !!}" class="pull-right cor-green">有账号</a>
                    </div>
                    <div class="space-16"></div>
                </div>
            </div>
        </div>
    </div>
</section>
{!! Theme::asset()->container('custom-js')->usepath()->add('main-js', 'plugins/bootstrap/js/bootstrap.min.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

        <!-- 拖拽验证 -->
{!! Theme::asset()->container('specific-js')->usepath()->add('register', 'js/user/gt.js') !!}

{!! Theme::asset()->container('custom-js')->usePath()->add('custom-validform-js', 'js/auth.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('payphoneword','js/doc/payphoneword.js') !!}

