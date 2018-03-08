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
    {!! Theme::asset()->usepath()->add('bootstrap','plugins/bootstrap/css/bootstrap.min.css') !!}
    {!! Theme::asset()->usepath()->add('jquery','plugins/jquery/jquery.min.js') !!}
    {!! Theme::asset()->usepath()->add('bootstrap','plugins/bootstrap/js/bootstrap.min.js') !!}
    {!! Theme::asset()->usepath()->add('font-awesome','plugins/ace/css/font-awesome.min.css') !!}
    {!! Theme::asset()->usepath()->add('ace-fonts','plugins/ace/css/ace-fonts.css') !!}
    {!! Theme::asset()->usepath()->add('ace','plugins/ace/css/ace.min.css') !!}
    {!! Theme::asset()->usepath()->add('ace-part2','plugins/ace/css/ace-part2.min.css') !!}
    {!! Theme::asset()->usepath()->add('ace-rtl','plugins/ace/css/ace-rtl.min.css') !!}
    {!! Theme::asset()->usepath()->add('managejs','js/managelogin.js') !!}
    {!! Theme::asset()->styles() !!}
    {!! Theme::asset()->scripts() !!}
    {!! Theme::asset()->container('custom-css')->styles() !!}
</head>
<body class="login-layout">

{!! Theme::content() !!}

</body>
</html>