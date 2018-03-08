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
    <meta name="keywords" content="{!! Theme::get('keywords') !!}">
    <meta name="description" content="{!! Theme::get('description') !!}">
    {!! Theme::asset()->usepath()->add('main','css/main.css') !!}
    {!! Theme::asset()->usepath()->add('bootstrap','css/bootstrap.min.css') !!}
    {!! Theme::asset()->usepath()->add('jquery','js/jquery.min.js') !!}
    {!! Theme::asset()->usepath()->add('bootstrap','js/bootstrap.min.js') !!}
    {!! Theme::asset()->usepath()->add('modernnizr','js/modernizr-2.8.3.min.js') !!}
    {!! Theme::asset()->styles() !!}
    {!! Theme::asset()->scripts() !!}
    {!! Theme::asset()->container('custom-css')->styles() !!}
</head>
<body>
<div class="container">
{!! Theme::partial('header') !!}

<div class="sign-main-container">
    {!! Theme::content() !!}
</div>

</div>
{!! Theme::partial('footer') !!}

{!! Theme::asset()->container('footer')->scripts() !!}
</body>
</html>