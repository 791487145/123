<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>邮件反馈</title>
</head>
<body style="background: #ffc65a;">
<div style="text-align:center;">
    <table width="650" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;">
        <tbody>
        <tr>
            <td>
                <div style="width:650px;text-align:left;font:12px/15px simsun;color:#000;background:#fff;">
                    <div style="background: url('{!! url('themes/default/assets/images/sign-emailbg.png') !!}') no-repeat;min-height: 474px;padding: 43px;">
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
                            <p>Hello，<span style="color: #ed8b31;">{!! $data['username'] !!}</span></p>

                            <p>欢迎加入@if(Theme::get('site_config')['site_name']){!! Theme::get('site_config')['site_name'] !!}
                                @else KPPW @endif,请在3小时内点击以下按钮完成邮箱验证：</p>
                            <a href="{!! url('user/verifyEmail/'. $data['validationInfo']) !!}"
                               style="display:block;width:177px;height: 45px;background: #2f55a0;color: #fff;text-align: center;line-height: 45px;border-radius: 2px;text-decoration: none">验证邮箱</a>

                            <p>也可以复制以下链接：</p>

                            <p>{!! url('user/verifyEmail/'. $data['validationInfo']) !!}</p>

                            <div style="margin: 45px 0;">
                                <p>如果您有任何问题，请联系我们，我们会尽快回复</p>
                            </div>
                            <p>Email:@if(Theme::get('site_config')['Email']){!! Theme::get('site_config')['Email'] !!}
                                @else admin@163.com @endif</p>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>