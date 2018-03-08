<!DOCTYPE html>
<html>
<head>
    <title>{!! Theme::get('title') !!}</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="keywords" content="{!! Theme::get('keywords') !!}">
    <meta name="description" content="{!! Theme::get('description') !!}">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=0">--}}
    @if(isset(Theme::get('basis_config')['css_adaptive']) && Theme::get('basis_config')['css_adaptive'] == 1)
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    @else
        <meta name="viewport" content="initial-scale=0.1">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ Theme::asset()->url('images/favicon.ico') }}" />
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/jquery.gritter.css">
    {!! Theme::asset()->container('specific-css')->styles() !!}
    <!-- text fonts -->
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/ace-fonts.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/ace.min.css" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/ace-skins.min.css" />
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/themes/default/assets/plugins/ace/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->
    {!! Theme::asset()->container('custom-css')->styles() !!}
    <!-- ace settings handler -->
    <script src="/themes/default/assets/plugins/ace/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="/themes/default/assets/plugins/ace/js/html5shiv.min.js"></script>
    <script src="/themes/default/assets/plugins/ace/js/respond.min.js"></script>
    <![endif]-->
    <!--[if !IE]>-->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='/themes/default/assets/plugins/ace/js/jquery.min.js'>"+"<"+"/script>");
    </script>

<!--[endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='/themes/default/assets/plugins/ace/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
</head>
<body class="no-skin">

<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        {!! Theme::partial('manageheader') !!}
    </div><!-- /.navbar-container -->
</div>

<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <!-- #section:basics/sidebar -->
    <div id="sidebar" class="sidebar responsive">
        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            {!! Theme::partial('manageshortcut') !!}
        </div>

        <ul class="nav nav-list">
            {!! Theme::partial('managesidebar') !!}
        </ul>

        <!-- #section:basics/sidebar.layout.minimize -->
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
        <!-- /section:basics/sidebar.layout.minimize -->
        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
    </div>
    <!-- /section:basics/sidebar -->
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
            <ul class="breadcrumb">
                @foreach(Theme::get('menu_data') as $v)
                    @if(!empty($v['_child']))
                        <li>
                            <i class="ace-icon fa fa-tasks home-icon"></i>
                            <a href="{{ $v['route'] }}">{{ $v['name'] }}</a>
                        </li>
                        @foreach($v['_child'] as $value)
                            @if(!empty($value['_child']))
                            <li>
                                <a href="{{ $value['route'] }}">{{ $value['name'] }}</a>
                            </li>
                            @foreach($value['_child'] as $menu)
                            <li class="active">{{ $menu['name'] }}</li>
                            @endforeach
                            @else
                            <li class="active">{{ $value['name'] }}</li>
                            @endif
                        @endforeach
                    @else
                        <li class="active">{{ $v['name'] }}</li>
                    @endif
                @endforeach
            </ul>
            <!-- /.breadcrumb -->
            <!-- #section:basics/content.searchbox -->
            <div class="nav-search" id="nav-search">
                {!! Theme::partial('managesearch') !!}
            </div><!-- /.nav-search -->
            <!-- /section:basics/content.searchbox -->
         </div>
        <!-- /section:basics/content.breadcrumbs -->

        <div class="page-content">
            <!-- #section:settings.box -->
            <div class="ace-settings-container" id="ace-settings-container">
                {!! Theme::partial('managesetting') !!}
            </div>
            <!-- /.ace-settings-container -->
            <div class="page-content-area">
                {!! Theme::content() !!}
            </div><!-- /.page-content-area -->
        </div><!-- /.page-content -->

    </div><!-- /.main-content -->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
    <div class="footer">
        <div class="footer-inner">
            <!-- #section:basics/footer -->
            <div class="footer-content" style="z-index:-2">
						<span class="bigger-120">
							{!! config('kppw.kppw_powered_by') !!}{!! config('kppw.kppw_version') !!}
                            {!! Theme::get('site_config')['copyright'] !!}{!! Theme::get('site_config')['record_number'] !!}
						</span>

                {{--&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
                                <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                            </a>

							<a href="#">
                                <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                            </a>

							<a href="#">
                                <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                            </a>
						</span>--}}
            </div>

            <!-- /section:basics/footer -->
        </div>
    </div>
</div><!-- /.main-container -->

<!-- basic scripts -->


<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='/themes/default/assets_bak/plugins/ace/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="/themes/default/assets/plugins/ace/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="/themes/default/assets/plugins/ace/js/jquery.gritter.min.js"></script>
{!! Theme::asset()->container('specific-js')->scripts() !!}
<!-- ace scripts -->
<script src="/themes/default/assets/plugins/ace/js/ace-elements.min.js"></script>
<script src="/themes/default/assets/plugins/ace/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
{!! Theme::widget('admintips')->render() !!}
{!! Theme::asset()->container('custom-js')->scripts() !!}
</body>
</html>