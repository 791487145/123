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
        <div class="sendmail-main text-center">
            <div class="space-10"></div>
            <img class="" src="{!! Theme::asset()->url('images/mb1/success.png') !!}" alt="">
            <div class="space-10"></div>
            <div class="text-size22 cor-gray4c">注册成功</div>
            <div class="space"></div>
            <p class="text-size14">页面将在<span id="show">5</span>秒后自动跳转到<a href="{!! CommonClass::homePage() !!}" class="cor-green">首页</a></p>
            <div class="space-30"></div><div class="space-20"></div>
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