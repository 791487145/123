<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{!! Theme::get('title') !!}</title>
    <meta name="keywords" content="{!! Theme::get('keywords') !!}">
    <meta name="description" content="{!! Theme::get('description') !!}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if(isset(Theme::get('basis_config')['css_adaptive']) && Theme::get('basis_config')['css_adaptive'] == 1)
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    @else
        <meta name="viewport" content="initial-scale=0.1">
    @endif
    <meta property="qc:admins" content="232452016063535256654" />
    <meta property="wb:webmaster" content="19a842dd7cc33de3" />
    <link rel="shortcut icon" href="{{ Theme::asset()->url('images/favicon.ico') }}" />
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="/themes/default/assets/plugins/bootstrap/css/bootstrap.min.css">
    {!! Theme::asset()->container('specific-css')->styles() !!}
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/dropzone.css">
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/chosen.css" />
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/datepicker.css"/>
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/ace.min.css">
    <link rel="stylesheet" href="/themes/default/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/themes/default/assets/css/main.css">
    <link rel="stylesheet" href="/themes/default/assets/css/header.css">
    <link rel="stylesheet" href="/themes/default/assets/css/footer.css">
    {!! Theme::asset()->container('custom-css')->styles() !!}
    <link rel="stylesheet" href="/themes/default/assets/css/employ/employ.css"/>
    <link rel="stylesheet" href="/themes/default/assets/css/{!! Theme::get('color') !!}/style.css">
    <link rel="stylesheet" href="/themes/default/assets/css/{!! Theme::get('color') !!}/style2.css">
    <!--编辑器-->
    <script src="/themes/default/assets/plugins/ace/js/ace-extra.min.js"></script>
<body>

<header>
    {!! Theme::partial('employheader') !!}
</header>
<nav>
    {!! Theme::partial('employnav') !!}
</nav>
<section>
    <div class="container">
        <div class="row">
            {!! Theme::content() !!}
        </div>
    </div>
</section>

<footer>
    {!! Theme::partial('footer') !!}
</footer>

<script src="/themes/default/assets/plugins/jquery/jquery.min.js"></script>
<script src="/themes/default/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/themes/default/assets/plugins/ace/js/ace-elements.min.js"></script>
<script src="/themes/default/assets/plugins/ace/js/ace.min.js"></script>
<script src="/themes/default/assets/js/common.js"></script>

{!! Theme::widget('popup')->render() !!}
{!! Theme::asset()->container('specific-js')->scripts() !!}
{!! Theme::asset()->container('custom-js')->scripts() !!}




</body>
</html>