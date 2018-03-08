<header>
    <div class="sign-logo">
        <a href="{!! CommonClass::homePage() !!}">
            @if(Theme::get('site_config')['site_logo_1'])
                <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" alt="kppw" onerror="onerrorImage('{{ Theme::asset()->url('images/sign-logo.png')}}',$(this))">
            @else
                <img src="{!! Theme::asset()->url('images/logo.png') !!}" alt="kppw" onerror="onerrorImage('{{ Theme::asset()->url('images/sign-logo.png')}}',$(this))">
            @endif
        </a>
    </div>
</header>
<section>
    <div class="sendemail-bg">
        <div class="sendmail-main text-center">
            <img class="sendmail-img" src="{{ Theme::asset()->url('images/sign/sendmail-img.png') }}" alt="">
            <div class="space-4"></div>
            <div class="text-size22 cor-gray4c">验证邮件发送成功</div>
            <div class="space-10"></div>
            <p class="text-size14 cor-gray4c">我们已向 <span class="cor-green">{!! $email !!}</span> 发送了验证邮件，请点击邮件中的链接完成邮箱验证</p>
            <a class="btn-green sendmail-btn bor-radius2" href="javascript:viewMail('{!! $emailType !!}');void(0)">登录邮箱验证</a>
            <div class="space-4"></div>
            <input type="hidden" id="reEmail" value="{!! Crypt::encrypt($email) !!}">
            <div class="text-size12 cor-gray80">未收到邮件？<a class="cor-green"  id="reset">重新发送</a></div>
        </div>
    </div>
</section>
{!! Theme::asset()->container('specific-js')->usePath()->add('cookie', 'plugins/jquery/cookies.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('active', 'js/active.js') !!}