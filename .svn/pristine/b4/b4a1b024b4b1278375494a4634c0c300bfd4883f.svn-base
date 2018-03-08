<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>邮件反馈</title>
</head>
<body style="">
<div style="text-align:center;background-color: #ffc65a;padding: 30px;font-family: '微软雅黑'">
    <table width="650" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;"><tbody><tr><td>
                <div style="width:650px;text-align:left;font:12px/15px simsun;color:#000;">
                    <img src="{!! $data['domain'] !!}"  alt="..." style="margin: 0; padding: 0;display: block;border-radius: 3px 3px 0 0;">
                    <div style="min-height: 462px;padding: 43px;background:#fff;" >
                        <div style="text-align: center;margin: 12px 0 50px 0">
                            <a href="javascript:;">
                                @if(Theme::get('site_config')['site_logo_1'])
                                    <img src="{!! $message->embed(url(Theme::get('site_config')['site_logo_1']))!!}" alt="">
                                @else
                                    <img src="{!! url('themes/default/assets/images/sign-logo.png') !!}" alt="">
                                @endif
                            </a>
                        </div>
                        <div style="font-size: 14px;color: #515151;">
                            <p>Hello，<span style="color: #ed8b31;">{{ $data['username'] }}</span></p>
                            <p>您本次修改支付密码的验证码为：<span style="color: #ed8b31;">{{ $data['code'] }}</span></p>
                            <p>本验证码5分钟内有效。</p>
                            <div style="margin: 45px 0;">
                                <p>非常感谢您查收@if(Theme::get('site_config')['site_name']){!! Theme::get('site_config')['site_name'] !!}
                                    @else KPPW @endif团队的邮件</p>
                                <p>如果您有任何问题，请联系我们，我们会尽快回复</p>
                            </div>
                            <p>Email:Email:@if(Theme::get('site_config')['Email']){!! Theme::get('site_config')['Email'] !!}
                                @else admin@163.com @endif</p>
                        </div>
                    </div>
                    <img src="{{ $data['domain'] }}" alt="..." style="margin: 0; padding: 0;display: block;border-radius: 0 0 3px 3px;">
                </div>
            </td></tr></tbody></table>
</div>
</body>
</html>
<script>
    alert(1);
</script>