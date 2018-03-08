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
    <div class="sendemail-bg">
        <div class="sendmail-main password-main">
            <div class="clearfix password-head">
                <div class="pull-left text-size20 cor-gray4c">
                    通过手机找回
                </div>
                <a class="pull-right cor-gray4c">
                    邮箱找回
                </a>
            </div>
            <div class="space-26"></div>
            <div class="password-wizard">
                <ul class="wizard-steps hidden-xs">
                    <li class="active">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">输入手机号</span>
                    </li>

                    <li class="active reset">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">重置密码</span>
                    </li>

                    <li class="active success">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">完成</span>
                    </li>
                </ul>
            </div>
            <div class="space-32"></div>
            <div class="space-10"></div>
            <div class="text-center cor-gray4c">
                <img class="" src="{!! Theme::asset()->url('images/mb1/success.png') !!}" alt="">
                <div class="space-10"></div>
                <p class="text-size22">密码重置成功</p>
                <p class="text-size14">页面将在<span id="show"></span>秒后自动跳转到<a href="{{ URL('/login') }}" class="cor-green">登录</a></p>
            </div>
            <div class="space-10"></div>
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