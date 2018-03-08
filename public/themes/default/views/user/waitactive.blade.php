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
            <div class="col-xs-12">
                <div class="g-signmain clearfix">
                    <div class="widget-main loginmain">
                        <div class="step-content row-fluid position-relative" id="step-container">
                            <div class=" findmain g-findmain">
                                <div class="clearfix">
                                    <div class="col-lg-4 col-md-3 col-sm-3 text-right hidden-xs">
                                        <img src="{!! Theme::asset()->url('images/sign-icon2.png') !!}" alt="">
                                    </div>
                                    <div class="hidden-lg hidden-md hidden-sm text-center hidden-xs">
                                        <img src="{!! Theme::asset()->url('images/sign-icon2.png') !!}" alt="">
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-sm-9 text-left">
                                        <p class="text-size24">验证邮件发送成功！</p>
                                        <p class="cor-gray51">我们已向 <a class="cor-blue167 text-under" href="javascript:viewMail('{!! $emailType !!}');void(0)">{!! $email !!}</a> 发送了验证邮件，请点击邮件中的链接完成邮箱验证</p>
                                        <p class="cor-gray97">未收到邮件？</p>
                                        <p class="cor-gray97">　　·　试试检查垃圾邮件、订阅邮件目录</p>
                                        <input type="hidden" id="reEmail" value="{!! Crypt::encrypt($email) !!}">
                                        <p class="cor-gray97">　　·　若长时间未收到邮件，<a id="reset" class="cor-blue167 text-under">重新发送</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /widget-main -->
            </div>
        </div>
    </div>
</section>

{!! Theme::asset()->container('specific-js')->usePath()->add('cookie', 'plugins/jquery/cookies.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('active', 'js/active.js') !!}