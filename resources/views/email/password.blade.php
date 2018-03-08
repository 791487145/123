<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>忘记密码邮件格式</title>
</head>
<body style="font-family: 'Microsoft YaHei UI'">
{{--<table width="650" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;">--}}
    {{--<tbody>--}}
        {{--<tr>--}}
            {{--<td>--}}
                {{--<div style="width:450px; height: 340px; margin: 50px auto; border: 1px solid #999; padding: 10px 30px;">--}}
                    {{--<h1 class="text-center">重置密码</h1>--}}
                    {{--<p >验证你的邮箱并重置模拟的密码</p>--}}
                    {{--<a href="{!! url('resetValidation/' . $data['validationInfo']) !!}" class="btn btn-primary btn-lg btn-block">点击验证</a>--}}
                    {{--<br>--}}
                    {{--<p>如果点击上面的按钮没有效果，请复制下面的链接到浏览器上访问：<br>{!! url('resetValidation/' . $data['validationInfo']) !!}<br>（该链接12小时内有效，12小时后需要重新验证，如若不是您发送的邮件，请检查您的账号）</p>--}}
                    {{--<hr>--}}
                    {{--<p>非常感谢您查收kppw团队的邮件</p>--}}
                {{--</div>--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--</tbody>--}}
{{--</table>--}}
<div style="text-align:center;">
    <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;">
        <tbody>
        <tr>
            <td>
                <div style="width:600px;text-align:left;font:12px/15px simsun;color:#000;background:#fff;">
                    <div style="width:450px; margin: 50px auto; border: 1px solid #999; padding: 10px 30px;">
                        <h1 class="text-center">重置密码</h1>
                        <p >验证你的邮箱并重置模拟的密码</p>
                        <a href="{!! url('resetValidation/' . $data['validationInfo']) !!}" class="btn btn-primary btn-lg btn-block">点击验证</a>
                        <br>
                        <p>如果点击上面的按钮没有效果，请复制下面的链接到浏览器上访问：<br>{!! url('resetValidation/' . $data['validationInfo']) !!}<br>（该链接12小时内有效，12小时后需要重新验证，如若不是您发送的邮件，请检查您的账号）</p>
                        <hr>
                        <p>非常感谢您查收@if(Theme::get('site_config')['site_name']){!! Theme::get('site_config')['site_name'] !!}
                            @else KPPW @endif团队的邮件</p>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
