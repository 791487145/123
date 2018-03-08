<header>
    <div class="g-signlogin">
        <div class="container search-pd">
            <div class="row">
                <div class="col-md-3 loginbrand">
                    <div class="row">
                        <a href="{!! CommonClass::homePage() !!}">
                            {{--<img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" alt="kppw" class="img-responsive">--}}
                            @if(Theme::get('site_config')['site_logo_1'])
                                <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" alt="kppw" class="img-responsive login-logo">
                            @else
                                <img src="{!! Theme::asset()->url('images/sign-logo.png') !!}" alt="kppw" class="img-responsive login-logo">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-md-9 loginpd">
                    <div class="row">
                        <div class=" col-sm-6 ">
                            <span class="text-size22">欢迎注册</span>
                        </div>
                        <div class=" col-sm-6 login-welcome text-right">
                            <div class="row">
                                已有帐号？ 请<a href="{!! url('login') !!}" class="cor-blue">登录</a>
                            </div>
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
            <div class="g-signmain clearfix">
                <div class="widget-main loginmain">
                    <div class="step-content row-fluid position-relative" id="step-container">
                        <div class=" findmain g-findmain">
                            <div class="clearfix">
                                <div class="col-sm-5 text-right">
                                    <img src="{!! Theme::asset()->url('images/sign-icon3.png') !!}" alt="">
                                </div>
                                <div class="col-sm-6 text-left">
                                    <p class="text-size24">验证失败!</p>
                                    <p class="cor-gray51 text-size14">验证链接已经过期</p>
                                    <p class="text-size14">请重新<a class="cor-blue167" href="javascript:;">发送邮件</a>或者<a class="cor-blue167" href="{!! url('register') !!}">重新注册</a></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- /widget-main -->
        </div>
    </div>
</section>