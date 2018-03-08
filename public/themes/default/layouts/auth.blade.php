<!DOCTYPE html>
<html  class="no-js" lang="">
<head>
    <title>{!! Theme::get('title') !!}</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">--}}
    @if(isset(Theme::get('basis_config')['css_adaptive']) && Theme::get('basis_config')['css_adaptive'] == 1)
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    @else
        <meta name="viewport" content="initial-scale=0.1">
    @endif
    <link rel="shortcut icon" href="{{ Theme::asset()->url('images/favicon.ico') }}" />
    <meta property="qc:admins" content="232452016063535256654" />
    <meta name="keywords" content="{!! Theme::get('keywords') !!}">
    <meta name="description" content="{!! Theme::get('description') !!}">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link rel="stylesheet" href="/themes/default/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/ace.min.css">
    <link rel="stylesheet" href="/themes/default/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/themes/default/assets/css/main.css">
    <link rel="stylesheet" href="/themes/default/assets/css/header.css">
    <link rel="stylesheet" href="/themes/default/assets/css/footer.css">
    <link rel="stylesheet" href="/themes/default/assets/css/sign/sign.css">
    <link rel="stylesheet" href="/themes/default/assets/css/{!! Theme::get('color') !!}/style.css">
    {!! Theme::asset()->container('specific-css')->styles() !!}
    {!! Theme::asset()->container('custom-css')->styles() !!}

</head>
<body>

{!! Theme::content() !!}

<footer>
    {!! Theme::partial('footer') !!}
</footer>

<script type="text/javascript" src="/themes/default/assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/themes/default/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/themes/default/assets/js/common.js"></script>


{!! Theme::asset()->container('specific-js')->scripts() !!}
{!! Theme::asset()->container('custom-js')->scripts() !!}

</body>
</html>