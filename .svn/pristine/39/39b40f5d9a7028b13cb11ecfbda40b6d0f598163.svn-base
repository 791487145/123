<header>
    <div class="g-signlogin">
        <div class="container search-pd">
            <div class="row">
                <div class="col-xs-12 loginbrand">
                    <div class="pull-left p-space">
                        <a href="{!! CommonClass::homePage() !!}" class="pull-left hidden-480">
                            {{--<img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" alt="kppw" class="img-responsive">--}}
                            @if(Theme::get('site_config')['site_logo_1'])
                                <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" alt="kppw" class="img-responsive">
                            @else
                                <img src="{!! Theme::asset()->url('images/sign-logo.png') !!}" alt="kppw" class="img-responsive">
                            @endif
                        </a>
                        <span class="text-size22 mg-left30 pull-left hidden-xs">欢迎注册</span>
                        <span class="text-size22 pull-left hidden-lg hidden-md hidden-sm visible-xs-block">欢迎注册</span>
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
                                    <div class="col-lg-5 col-md-4 col-sm-3 text-right u-activasuccess">
                                        <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="">
                                    </div>
                                    <div class="col-lg-6 col-md-8 col-sm-9 text-left u-activasuccess">
                                        <p class="text-size24">恭喜您注册成功</p>
                                        <p class="cor-gray51 text-size14">页面将在<span id="show"></span>秒后自动跳转到<a class="text-under" href="{!! CommonClass::homePage() !!}">首页</a></p>
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

<script type="text/javascript">
    var t=5;//设定跳转的时间
    setInterval("refer()",1000); //启动1秒定时
    function refer(){
        if(t==0){
            window.location.href="/"; //#设定跳转的链接地址
        }
        if(t>0) {
            document.getElementById('show').innerHTML = "" + t + ""; // 显示倒计时

        }
        t--; // 计数器递减
    }
</script>
