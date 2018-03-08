<!DOCTYPE html>
<html  class="no-js" lang="">
<head>
    <title>{!! Theme::get('title') !!}</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @if(isset(Theme::get('basis_config')['css_adaptive']) && Theme::get('basis_config')['css_adaptive'] == 1)
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    @else
        <meta name="viewport" content="initial-scale=0.1">
    @endif
    <meta name="keywords" content="{!! Theme::get('keywords') !!}">
    <meta name="description" content="{!! Theme::get('description') !!}">
    <link rel="shortcut icon" href="{{ Theme::asset()->url('images/favicon.ico') }}" />
    <link rel="stylesheet" href="/themes/default/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/themes/default/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/themes/default/assets/css/install/install.css">
</head>
<body>
<header>
    <div class="header">
        <a href="#"><img src="{!! Theme::asset()->url('images/install/logo.png') !!}" alt="logo"></a><h2>安装向导</h2>
    </div>
</header>


{!! Theme::content() !!}

</body>
</html>