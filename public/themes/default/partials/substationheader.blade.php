<div class="g-headertop ">
    <div class="container clearfix">
        <div class="row">
            @if(Auth::check())
                <div class="col-xs-12 col-left col-right">
                    <div class="pull-left p-space">
                        @if(Theme::get('site_config')['site_name'])
                            {!! Theme::get('site_config')['site_name'] !!}
                        @else
                            客客专业威客建站系统
                        @endif
                        <span class="address-wrap">&nbsp;<i class="fa fa-map-marker text-size16 cor-blue2f"></i>
                            @if(Session::get('substation_name')){!! Session::get('substation_name') !!}@else 全国 @endif
                            <a class="cor-blue2f" data-toggle="modal" href="#address">[切换]</a></span>
                        &nbsp;&nbsp;&nbsp;&nbsp;HI~ <a href="/user/index">{!! Auth::User()->name !!}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/user/messageList/1"><i class="fa fa-envelope-o"></i> 消息@if(Theme::get('message_count') > 0)({!! Theme::get('message_count') !!})@endif</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{!! url('logout') !!}">退出</a>
                    </div>
                    <div class="pull-right">
                        <ul class="pull-left g-taskbarlist hidden-sm hidden-xs">
                            <li class="pull-left g-taskbarli"><a class="g-taskbar1 g-taskbarbor" href="/user/myTasksList">我是雇主 <i
                                            class="fa fa-caret-down"></i></a>
                                <div class="g-taskbardown1">
                                    <div><a class="cor-blue2f" href="/task/create">发布任务</a></div>
                                    <div><a class="cor-blue2f" href="/user/myTasksList">我发布的任务<span class="red">@if(Theme::get('my_task') > 0){!! Theme::get('my_task') !!} @endif</span></a></div>
                                </div>
                            </li>
                            <li class="pull-left g-taskbarli"><a class="g-taskbar2 g-taskbarbor" href="/user/acceptTasksList">我是威客 <i class="fa fa-caret-down"></i></a>
                                <div class="g-taskbardown1">
                                    <div><a class="cor-blue2f" href="/user/switchUrl">我的店铺</a></div>
                                    <div><a class="cor-blue2f" href="/user/myTask">我的任务<span class="red">@if(Theme::get('my_focus_task') > 0){!! Theme::get('my_focus_task') !!} @endif</span></a></div>
                                </div>
                            </li>
                            <li class="pull-left"><a class="g-taskbarbor" @if(!empty(Theme::get('help_center')))href="/article/aboutUs/{!! Theme::get('help_center') !!}"@endif>帮助中心</a></li>
                            <li class="pull-left g-taskbarli"><a class="g-nomdright g-taskbarbor" href="javascript:;">分类导航 <i
                                            class="fa fa-caret-down"></i></a>
                                <div class="g-taskbardown1">
                                    @if(!empty(Theme::get('task_cate')))
                                        @foreach(Theme::get('task_cate') as $k => $v)
                                            @if(isset($v['pid']) && $v['pid'] == 0)
                                                <div><a class="cor-blue2f" href="/task?category={!! $v['id'] !!}">{!! $v['name'] !!}</a></div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="col-xs-12 col-left col-right">
                    <div class="pull-left">
                        @if(Theme::get('site_config')['site_name'] )
                            {!! Theme::get('site_config')['site_name'] !!}
                        @else
                            客客专业威客建站系统
                        @endif
                        <span class="address-wrap">&nbsp;<i class="fa fa-map-marker text-size16 cor-blue2f"></i>
                            @if(Session::get('substation_name')){!! Session::get('substation_name') !!}@else 全国 @endif
                            <a class="cor-blue2f" data-toggle="modal" href="#address">[切换]</a></span>
                    </div>
                    <div class="pull-right">
                        <div class="pull-left">HI~</a>请 [<a href="{!! url('login') !!}">登录</a>] [<a href="{!! url('register') !!}">免费注册</a>]</div>
                        <ul class="pull-left g-taskbarlist hidden-sm hidden-xs">
                            <li class="pull-left g-taskbarli"><a class="g-taskbar1 g-taskbarbor" href="/user/myTasksList">我是雇主 <i
                                            class="fa fa-caret-down"></i></a>
                                <div class="g-taskbardown1">
                                    <div><a class="cor-blue2f" href="/task/create">发布任务</a></div>
                                    <div><a class="cor-blue2f" href="/user/myTasksList">我发布的任务<span class="red">@if(Theme::get('my_task') > 0 ){!! Theme::get('my_task') !!} @endif</span></a></div>
                                </div>
                            </li>
                            <li class="pull-left g-taskbarli"><a class="g-taskbar2 g-taskbarbor" href="/user/acceptTasksList">我是威客 <i class="fa fa-caret-down"></i></a>
                                <div class="g-taskbardown1">
                                    <div><a class="cor-blue2f" href="/user/switchUrl">我的空间</a></div>
                                    <div><a class="cor-blue2f" href="/user/myTask">我的任务<span class="red">@if(Theme::get('my_focus_task') > 0){!! Theme::get('my_focus_task') !!} @endif</span></a></div>
                                </div>
                            </li>
                            <li class="pull-left"><a class="g-taskbarbor" @if(!empty(Theme::get('help_center')))href="/article/aboutUs/{!! Theme::get('help_center') !!}"@endif>帮助中心</a></li>
                            <li class="pull-left g-taskbarli"><a class="g-nomdright g-taskbarbor" href="javascript:;">分类导航 <i
                                            class="fa fa-caret-down"></i></a>
                                <div class="g-taskbardown1">
                                    @if(!empty(Theme::get('task_cate')))
                                        @foreach(Theme::get('task_cate') as $k => $v)
                                            @if(isset($v['pid']) && $v['pid'] == 0)
                                                <div><a class="cor-blue2f" href="/task?category={!! $v['id'] !!}">{!! $v['name'] !!}</a></div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade modaladdress" id="address" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialogadd" role="document">
        <div class="modal-content modal-addresswrap">
            <button class="close" aria-label="Close" data-dismiss="modal" type="button">
                <img src="{!! Theme::asset()->url('images/addressclose.png') !!}">
            </button>
            <div class="modal-address">
                <div class="modal-addresshd clearfix">
                    <h4 class="pull-left">城市</h4>
                    <span class="pull-right address-wrap">
                        <i class="fa fa-map-marker text-size16 cor-blue2f"></i>
                        @if(Session::get('substation_name')){!! Session::get('substation_name') !!}@else 全国 @endif
                    </span>
                </div>
                <ul class="modal-addressmain row">
                    @if(Theme::get('substation'))
                        @foreach(Theme::get('substation') as $item)
                            <li class="col-sm-4 col-xs-4"><a href="/substation/{!! $item['district_id'] !!}">{!! $item['name'] !!}站</a>
                        @endforeach
                    @endif
                </ul>
                <div class="space-4"></div>
                <p>更多城市正在开通，请耐心等待~</p>
            </div>
        </div>
    </div>
</div>
<div class="g-taskhead">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-left col-right">
                <div class="col-lg-3 col-md-6 col-sm-6 hidden-xs">
                    <div class="row">
                        <a href="{!! CommonClass::homePage() !!}">
                            @if(Theme::get('site_config')['site_logo_1'])
                                <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}" class="img-responsive wrap-side-img">
                            @else
                                <img src="{!! Theme::asset()->url('images/sign-logo.png') !!}" class="img-responsive wrap-side-img">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 hidden-sm visible-xs-block">
                    <div class="text-center">
                        @if(Theme::get('site_config')['site_logo_1'])
                            <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}">
                        @else
                            <img src="{!! Theme::asset()->url('images/sign-logo.png') !!}">
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
                    <div class="g-tasksearch row">
                        <form action="@if(Theme::get('now_menu')=='/bre/service')/bre/service @else/task @endif" method="get" class="switchSearch" />
                        <div class="btn-group search-aBtn" role="group">
                            <a href="javascript:;" type="button" class="btn btn-default dropdown-toggle search-btn-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Theme::get('now_menu')=='/bre/service')找服务商@else找任务@endif

                            </a>
                            <span class="fa fa-angle-down"></span>
                            <ul class="dropdown-menu search-btn-select" aria-labelledby="dLabel">
                                <li value="1">
                                    <a href="javascript:void(0)" url="/task" onclick="switchSearch(this)">找任务</a>
                                </li>
                                <li value="2">
                                    <a href="javascript:void(0)" url="/bre/service" onclick="switchSearch(this)">找服务商</a>
                                </li>
                            </ul>
                        </div>
                        <i class="fa fa-search"></i>
                        <input type="text" class="input-boxshaw" name="keywords" placeholder="输入关键词" value="@if(!empty(request('keywords'))){!! request('keywords') !!}@endif"/>
                        <button type="submit">搜索</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 claerfix hidden-sm hidden-xs hidden-md">
                    <div class="row">
                        <div class="g-taskhdbg1">实名认证</div>
                        <div class="g-taskhdbg2">担保交易</div>
                        <div class="g-taskhdbg3">全额退款</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-top header-show">
    <div class="container clearfix">
        <div class="row">
            <div class="col-xs-12 col-left col-right">
                <nav class="navbar bg-blue navbar-default hov-nav" role="navigation">
                    <div class="navbar-header pull-left g-logo hidden-xs">
                        <a href="{!! CommonClass::homePage() !!}" class="g-logo hidden-xs hidden-sm">
                            @if(Theme::get('site_config')['site_logo_2'])
                                <img src="{!! url(Theme::get('site_config')['site_logo_2'])!!}" alt="kppw" width="200">
                            @else
                                <img src="{!! Theme::asset()->url('images/logo.png') !!}" alt="kppw" width="200">
                            @endif
                        </a>

                        <span class="hov-showdrop"><i class="fa fa-reorder cussor-pointer hidden-xs h-hovheader text-size14"></i>

                        <ul class="sub nav-dex text-left hov-list">
                            @forelse(Theme::get('task_cate') as $k => $v)
                                @if(isset($v['pid']) && $v['pid'] == 0 && $k < 5)
                                    <li>
                                        <div class="u-navitem">
                                            <h4>
                                                <a href="/task?category={!! $v['id'] !!}" class="text-size14 cor-white">
                                                    {!! $v['name'] !!}
                                                </a>
                                            </h4>
                                            @forelse($v['child_task_cate'] as $m => $n)
                                                @if($m < 3)
                                                    <a href="/task?category={!! $n['id'] !!}" class="u-tit">
                                                        {!! $n['name'] !!}
                                                    </a>
                                                @endif
                                            @empty
                                            @endforelse
                                        </div>
                                        @if(!empty($v['child_task_cate']) && is_array($v['child_task_cate']))
                                            <div class="g-subshow">
                                                <div>{!! $v['name'] !!}</div>
                                                <p>
                                                    @foreach($v['child_task_cate'] as $key => $val)
                                                        <a href="/task?category={!! $val['id'] !!}">{!! $val['name'] !!}</a>&nbsp;&nbsp;|&nbsp;
                                                    @endforeach
                                                </p>
                                            </div>
                                        @endif
                                    </li>
                                @endif
                            @empty
                            @endforelse

                        </ul>
                        </span>
                    </div>
                    <div class="collapse navbar-collapse pull-right g-nav pd-left0" id="example-navbar-collapse">
                        <div class="div-hover hidden-xs"></div>
                        <ul class="nav navbar-nav overhide">
                            @if(!empty(Theme::get('nav_list')))
                                @if(count(Theme::get('nav_list')) > 4)
                                    @for($i=1;$i<5;$i++)
                                        <li @if(Theme::get('nav_list')[$i-1]['link_url'] == $_SERVER['REQUEST_URI']) class="hActive" @endif>
                                            <a class="text-center" href="{!! Theme::get('nav_list')[$i-1]['link_url'] !!}"
                                               @if(Theme::get('nav_list')[$i-1]['is_new_window'] == 1)target="_blank" @endif >
                                                {!! Theme::get('nav_list')[$i-1]['title'] !!}
                                            </a>
                                        </li>
                                    @endfor
                                    <li class="new-homehead">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            更多   <b class="caret"></b>
                                        </a>
                                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close50 z-navactive">
                                            @for($i=5;$i<count(Theme::get('nav_list'))+1;$i++)
                                                <li @if(Theme::get('nav_list')[$i-1]['link_url'] == $_SERVER['REQUEST_URI']) class="hActive" @endif>
                                                    <a class="text-center" href="{!! Theme::get('nav_list')[$i-1]['link_url'] !!}"
                                                       @if(Theme::get('nav_list')[$i-1]['is_new_window'] == 1)target="_blank" @endif >
                                                        {!! Theme::get('nav_list')[$i-1]['title'] !!}
                                                    </a>
                                                </li>
                                            @endfor
                                        </ul>
                                    </li>
                                @else
                                    @foreach(Theme::get('nav_list') as $m => $n)
                                        @if($n['is_show'] == 1)
                                            <li @if($n['link_url'] == $_SERVER['REQUEST_URI']) class="hActive" @endif>
                                                <a class="text-center" href="{!! $n['link_url'] !!}" @if($n['is_new_window'] == 1)target="_blank" @endif >
                                                    {!! $n['title'] !!}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            @else
                                <li @if(CommonClass::homePage() == $_SERVER['REQUEST_URI']) class="hActive"@endif><a  class="topborbtm" href="{!! CommonClass::homePage() !!}" >首页</a></li>
                                <li @if('/task' == $_SERVER['REQUEST_URI']) class="hActive" @endif><a class="topborbtm" href="/task">任务大厅</a></li>
                                <li @if('/bre/service' == $_SERVER['REQUEST_URI']) class="hActive" @endif><a class="topborbtm" href="/bre/service">服务商</a></li>
                                <li @if('/task/successCase' == $_SERVER['REQUEST_URI']) class="hActive" @endif><a class="topborbtm" href="/task/successCase">成功案例</a></li>
                                <li @if('/article' == $_SERVER['REQUEST_URI']) class="hActive" @endif><a class="topborbtm" href="/article" > 资讯中心</a></li>
                            @endif
                            <li class="pd-navppd">
                                <form class="navbar-form navbar-left hd-seachW" action="@if(Theme::get('now_menu')=='/bre/service')/bre/service @else/task @endif" role="search" method="get" class="switchSearch">
                                    <div class="input-group input-group-btnInput">
                                        <div class="input-group-btn search-aBtn">
                                            <a type="button" class="search-btn-toggle btn btn-default dropdown-toggle f-click bg-white bor-radius2 hidden-xs hidden-sm" data-toggle="dropdown">
                                                @if(Theme::get('now_menu')=='/bre/service')找服务商@else找任务@endif

                                            </a>
                                            <span class="caret hidden-xs hidden-sm"></span>
                                            <ul class="dropdown-menu s-listseed dropdown-yellow search-btn-select">
                                                <li><a href="javascript:void(0)" url="/task" onclick="switchSearch(this)">找任务</a></li>
                                                <li><a href="javascript:void(0)" url="/bre/service" onclick="switchSearch(this)">找服务商</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                        <button type="submit" class="form-control-feedback fa fa-search s-navfonticon hidden-sm hidden-xs"></button>
                                        <input type="text" name="keywords" class="input-boxshaw form-control-feedback-btn form-control bor-radius2 hidden-sm hidden-xs" value="@if(!empty(request('keywords'))){!! request('keywords') !!}@endif">
                                        <a href="/task/create" type="submit" class="btn btn-default f-click cor-blue bor-radius2 hidden-lg hidden-md">发布任务</a>
                                    </div>
                                    <span class="hidden-md hidden-xs hidden-sm">&nbsp;&nbsp;<span class="u-tit">或</span>&nbsp;&nbsp;
                                    <a href="/task/create" type="submit" class="btn btn-default f-click cor-blue bor-radius2">发布任务</a></span>
                                </form>
                            </li>
                            <li class="s-sign clearfix hidden-md hidden-xs hidden-sm navactiveImg">
                                @if(Auth::check())
                                    <a href="javascript:;" class="u-img topheadimg" data-toggle="dropdown" class="dropdown-toggle">
                                        <img src="@if(!empty(Theme::get('avatar'))) {!!  url(Theme::get('avatar')) !!}
                                        @else {!! Theme::asset()->url('images/default_avatar.png') !!} @endif"
                                             alt="..." class="img-circle" width="31" height="34">
                                    </a>
                                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                        <li>
                                            <a href="{!! url('user/index') !!}">
                                                我的主页
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{!! url('user/info') !!}">
                                                账号设置
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{!! url('finance/list') !!}">
                                                财务管理
                                            </a>
                                        </li>

                                        <li class="divider">
                                            <a href="#"></a>
                                        </li>

                                        <li>
                                            <a href="{!! url('logout') !!}">
                                                <i class="fa fa-sign-out fa-rotate-270"></i>
                                                退出
                                            </a>
                                        </li>
                                    </ul>
                                @else
                                    <a href="{!! url('login') !!}" class="text-size14 pull-left">登录</a>
                                    <a class="pull-left">|</a>
                                    <a href="{!! url('register') !!}" class="text-size14 pull-right">注册</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                    {{--导航 768px以下--}}
                    <div class="hidden-lg hidden-sm hidden-md">
                        <div class="navbar-header">
                            <button class="navbar-toggle pull-left" type="button" data-toggle="collapse"
                                    data-target=".bs-js-navbar-scrollspy">
                                <span class="sr-only">切换导航</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="/task/create" type="submit" class=" f-click bor-radius2 hidden-lg hidden-md cor-white f-click-btn">发布任务</a>
                        </div>
                        <div class="collapse navbar-collapse bs-js-navbar-scrollspy">
                            <ul class="nav navbar-nav">
                                @if(!empty(Theme::get('nav_list')))
                                    @foreach(Theme::get('nav_list') as $m => $n)
                                        @if($n['is_show'] == 1)
                                            <li @if($n['link_url'] == $_SERVER['REQUEST_URI']) class="hActive" @endif><a href="{!! $n['link_url'] !!}" @if($n['is_new_window'] == 1)target="_blank" @endif >{!! $n['title'] !!}</a></li>
                                        @endif
                                    @endforeach
                                @else
                                    <li @if(CommonClass::homePage() == $_SERVER['REQUEST_URI']) class="hActive" @endif>
                                        <a href="{!! CommonClass::homePage() !!}" >首页</a>
                                    </li>
                                    <li @if('/task' == $_SERVER['REQUEST_URI']) class="hActive" @endif>
                                        <a href="/task" >任务大厅</a>
                                    </li>
                                    <li @if('/bre/service' == $_SERVER['REQUEST_URI']) class="hActive" @endif>
                                        <a href="/bre/service" >服务商</a>
                                    </li>
                                    <li @if('/task/successCase' == $_SERVER['REQUEST_URI']) class="hActive" @endif>
                                        <a href="/task/successCase" >成功案例</a>
                                    </li>
                                    <li @if('/article' == $_SERVER['REQUEST_URI']) class="hActive" @endif>
                                        <a href="/article">资讯中心</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
