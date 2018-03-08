
<header>
    <div class="g-signlogin">
        <div class="container search-pd">
            <div class="row">
                <div class="col-xs-12 loginbrand">
                    <div class="pull-left p-space">
{{--
<a href="javascript:;" class="pull-left hidden-480"><img src="{!! Theme::asset()->url('images/sign-logo.png') !!}" alt="kppw" class="img-responsive"></a>
--}}

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
                        <a href="javscript:;" class="cor-blue">登录</a>
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
                        <div class="space-20 hidden-xs"></div>
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

                                        <li data-target="#step3" class="active">
                                            <span class="step">3</span>
                                            <span class="title">完成</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="step-content row-fluid position-relative" id="step-container">
                                    <div class="space"></div>
                                    <div class="clearfix">
                                        <div class="col-lg-5 col-md-4 col-sm-3 hidden-xs text-right">
                                            <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="">
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-9 hidden-xs text-left">
                                            <p class="text-size24">恭喜您，密码设置成功!</p>
                                            <p class="cor-gray51 text-size14">页面将在<span id="show"></span>秒后自动跳转到<a href="{!! url('login') !!}" class="cor-blue167">登录</a></p>
                                        </div>
                                        <div class="hidden-lg hidden-md hidden-sm text-center hidden-xs">
                                            <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="">
                                        </div>
                                        <div class="hidden-lg hidden-md hidden-sm text-center visible-xs-block">
                                            <p class="text-size24">恭喜您，密码设置成功!</p>
                                            <p class="cor-gray51 text-size14">页面将在<span id="show"></span>秒后自动跳转到<a href="{!! url('login') !!}" class="cor-blue167">登录</a></p>
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

<script type="text/javascript">
    var t=5;//设定跳转的时间
    setInterval("refer()",1000); //启动1秒定时
    function refer(){
        if(t==1){
            location="{!! url('login') !!}"; //#设定跳转的链接地址
        }
        document.getElementById('show').innerHTML=""+t+""; // 显示倒计时
        t--; // 计数器递减
    }
</script>
