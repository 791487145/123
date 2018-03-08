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
                    通过邮箱找回
                </div>
                <a href="{{url('password/mobile')}}" class="pull-right cor-gray4c">
                    手机找回
                </a>
            </div>
            <div class="space-26"></div>
            <div class="password-wizard no-margin">
                <ul class="wizard-steps hidden-xs">
                    <li class="active">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">输入手机号</span>
                    </li>
                    <li class="active validate">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">验证信息</span>
                    </li>
                    {{--active reset--}}
                    <li class="">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">重置密码</span>
                    </li>
                    {{--active success--}}
                    <li class="">
                        <span class="step"><span class="password-stepbor"></span></span>
                        <span class="title">完成</span>
                    </li>
                </ul>
            </div>
            <div class="space-32"></div>
            <div class="space-10"></div>
            <div class="text-center cor-gray4c">
                <img class="sendmail-img" src="{!! Theme::asset()->url('images/sign/sendmail-img.png')!!}" alt="">
                <div class="space-4"></div>
                <div class="text-size22 cor-gray4c">验证邮件发送成功</div>
                <div class="space-10"></div>
                <p class="text-size14 cor-gray4c">我们已向 <a href="javascript:viewMail('{!! $emailType !!}');void(0)" class="cor-green">{!! $email !!}</a> 发送了验证邮件，请点击邮件中的链接完成邮箱验证</p>
                <a class="btn-green sendmail-btn bor-radius2" href="javascript:viewMail('{!! $emailType !!}');void(0)">登录邮箱验证</a>
                <div class="space-4"></div>
                <div class="text-size12 cor-gray80">未收到邮件？<a class="cor-green" id="reSendEmail" href="javascript:reSendEmail('{!! Crypt::encrypt($email) !!}');void(0)" >重新发送</a></div>
            </div>
            <div class="space-10"></div>
        </div>
    </div>
</section>

{!! Theme::asset()->container('custom-js')->usePath()->add('active', 'js/active.js') !!}