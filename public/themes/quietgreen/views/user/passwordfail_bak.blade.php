<header>
    <div class="g-signlogin">
        <div class="container search-pd">
            <div class="row">
                <div class="col-xs-12 loginbrand">
                    <div class="pull-left p-space">
                        <a href="javascript:;"  class="pull-left hidden-480"><img src="{!! Theme::asset()->url('images/sign-logo.png') !!}" alt="kppw" class="img-responsive login-logo"></a>
                        <span class="text-size22 mg-left30 pull-left hidden-xs">找回密码</span>
                        <span class="text-size22 pull-left hidden-lg hidden-md hidden-sm visible-xs-block">找回密码</span>
                    </div>
                    <div class="pull-right login-welcome text-size14">
                        已有帐号？ 请<a href="{!! url('login') !!}" class="cor-blue">登录</a>
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
                                    <div class="col-lg-4 col-md-3 col-sm-2 col-xs-12 hidden-xs text-right">
                                        <img src="{!! Theme::asset()->url('images/sign-icon3.png') !!}" alt="">
                                    </div>
                                    <div class="col-xs-12 hidden-lg hidden-md hidden-sm visible-xs-block text-center">
                                        <img src="{!! Theme::asset()->url('images/sign-icon3.png') !!}" alt="">
                                    </div>
                                    <div class="col-lg-7 col-md-8 col-sm-9 text-left">
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
    </div>
</section>