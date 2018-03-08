<header>
    <div class="g-signlogin">
        <div class="container search-pd">
            <div class="row">
                <div class="col-xs-12 loginbrand">
                    <div class="pull-left p-space">
                        {{--<a href="javascript:;" class="pull-left hidden-480"><img src="{!! Theme::asset()->url('images/sign-logo.png') !!}" alt="kppw" class="img-responsive"></a>--}}
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
                    <div class="pull-right login-welcome">
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
                        <h4 class="s-logintit">通过邮箱找回</h4>
                        <div class="space-20 hidden-xs"></div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div id="fuelux-wizard" class="row-fluid" data-target="#step-container">
                                    <ul class="wizard-steps hidden-xs">
                                        <li data-target="#step1" class="active">
                                            <span class="step">1</span>
                                            <span class="title ">输入账号信息</span>
                                        </li>

                                        <li data-target="#step2" class="active">
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
                                    <div class="clearfix">
                                        <div class="col-lg-4 col-md-3 col-sm-2 col-xs-12 hidden-xs text-right">
                                            <img src="{!! Theme::asset()->url('images/sign-icon2.png') !!}" alt="">
                                        </div>
                                        <div class="col-xs-12 hidden-lg hidden-md hidden-sm hidden-xs text-center">
                                            <img src="{!! Theme::asset()->url('images/sign-icon2.png') !!}" alt="">
                                        </div>
                                        <div class="col-lg-8 col-md-9 col-sm-10 col-xs-12 text-left">
                                            <p class="text-size24">验证邮件发送成功！</p>
                                            <p class="cor-gray51 text-size14">我们已向 <a href="javascript:viewMail('{!! $emailType !!}');void(0)" class="cor-blue167">{!! $email !!}</a> 发送了验证邮件，请点击邮件中的链接完成邮箱验证</p>
                                            <p class="cor-gray97">未收到邮件？</p>
                                            <p class="cor-gray97">　　·　试试检查垃圾邮件、订阅邮件目录</p>
                                            <p class="cor-gray97">　　·　若长时间未收到邮件，可<a id="reSendEmail" href="javascript:reSendEmail('{!! Crypt::encrypt($email) !!}');void(0)" class="cor-blue167">重新发送</a></p>
                                        </div>
                                    </div>
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
</section>

{!! Theme::asset()->container('custom-js')->usePath()->add('active', 'js/active.js') !!}