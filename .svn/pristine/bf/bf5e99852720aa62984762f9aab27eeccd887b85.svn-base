<div class="container" xmlns="http://www.w3.org/1999/html">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#example-navbar-collapse">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="/">

                    @if(Theme::get('site_config')['site_logo_1'])
                        <img src="{!! url(Theme::get('site_config')['site_logo_1'])!!}"
                             onerror="onerrorImage('{{ Theme::asset()->url('images/mb1/logo1.png')}}',$(this))">
                    @else
                        <img src="{!! Theme::asset()->url('images/mb1/logo1.png') !!}">
                    @endif
                </a>
            </div>
            {{--分站--}}
            @if(Module::exists('substation') && Theme::get('is_substation') == 1)
            <div class="address-wrap pull-left dropdown">
                <a class="hovbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:;">
                    <i class="fa fa-map-marker text-size16 cor-blue2f"></i>
                    @if(Session::get('substation_name')){!! Session::get('substation_name') !!}@else 全国 @endif
                </a>
                <div class="dropdown-menu text-center" role="menu" aria-labelledby="dLabel">
                    <div class="city">
                        当前城市：  <a href="javascript:;">
                            @if(Session::get('substation_name')){!! Session::get('substation_name') !!}@else 全国 @endif
                        </a>
                    </div>
                    <div class="hot">
                        <p>热门城市</p>
                        @if(Theme::get('substation'))
                            @foreach(Theme::get('substation') as $k=>$item)
                                <a href="/substation/{!! $item['district_id'] !!}">{!! $item['name'] !!}站</a>
                                @if(is_int(($k)/2))
                                <span>|</span>
                                @endif
                            @endforeach
                        @endif
                        {{--<a>北京</a><span>|</span><a>北京</a><span>|</span><a>北京</a>
                        <a>北京</a><span>|</span><a>北京</a><span>|</span><a>北京</a>
                        <a>北京</a><span>|</span><a>北京</a><span>|</span><a>北京</a>--}}
                    </div>
                    <div class="more">
                        <i class=""></i>更多城市即将上线
                    </div>
                </div>
            </div>
            @endif
            <div class="collapse navbar-collapse" id="example-navbar-collapse">
                <ul class="nav navbar-nav">

                    @if(!empty(Theme::get('nav_list')))
                        @if(count(Theme::get('nav_list')) > 6)
                            @for($i=1;$i<7;$i++)
                                <li @if(Theme::get('nav_list')[$i-1]['link_url'] == $_SERVER['REQUEST_URI']) class="active" @endif>
                                    <a href="{!! Theme::get('nav_list')[$i-1]['link_url'] !!}"
                                       @if(Theme::get('nav_list')[$i-1]['is_new_window'] == 1)target="_blank" @endif >
                                        {!! Theme::get('nav_list')[$i-1]['title'] !!}
                                    </a>
                                </li>
                            @endfor
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    更多   <b class="fa fa-angle-down"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    @for($i=7;$i<count(Theme::get('nav_list'))+1;$i++)
                                        <li @if(Theme::get('nav_list')[$i-1]['link_url'] == $_SERVER['REQUEST_URI']) class="divider" @endif>
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
                                    <li @if($n['link_url'] == $_SERVER['REQUEST_URI']) class="active" @endif>
                                        <a href="{!! $n['link_url'] !!}" @if($n['is_new_window'] == 1)target="_blank" @endif >
                                            {!! $n['title'] !!}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @else
                        <li @if(CommonClass::homePage() == $_SERVER['REQUEST_URI']) class="active"@endif><a  class="topborbtm" href="{!! CommonClass::homePage() !!}" >首页</a></li>
                        <li @if('/task' == $_SERVER['REQUEST_URI']) class="active" @endif><a class="topborbtm" href="/task">任务大厅</a></li>
                        <li @if('/bre/service' == $_SERVER['REQUEST_URI']) class="active" @endif><a class="topborbtm" href="/bre/service">服务商</a></li>
                        <li @if('/task/successCase' == $_SERVER['REQUEST_URI']) class="active" @endif><a class="topborbtm" href="/task/successCase">成功案例</a></li>
                        <li @if('/article' == $_SERVER['REQUEST_URI']) class="active" @endif><a class="topborbtm" href="/article" > 资讯中心</a></li>
                    @endif

                </ul>
                <div class="issue clearfix row">
                    <form class="navbar-form navbar-left" action="/task" role="search" method="get" class="switchSearch">
                        {{--搜索--}}
                        <div class="form-group fom-search dropdown">
                            <input type="text"  name="keywords" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="form-control" placeholder="输入搜索内容"
                                   value="@if(!empty(request('keywords'))){!! request('keywords') !!}@endif">
                            <input type="hidden" value="" id="type" name="">
                            <button class="ico-search fa fa-search" type="submit" /> </button>
                            <ul class="dropdown-menu text-center" role="menu" aria-labelledby="dLabel">
                                <li>
                                    <a href="javascript:void(0)" url="/task" onclick="switchSearch(this)">搜索任务</a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" url="/bre/service" onclick="switchSearch(this)">搜索服务商</a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn-green btn btn-default" href="{{ URL('task/create') }}">发布任务</a>
                    </form>
                    <div class="state">
                        <a href="/user/index">
                            {{--用户头像--}}
                            <img src="@if(!empty(Theme::get('avatar'))){!!  url(Theme::get('avatar')) !!}@else {!! Theme::asset()->url('images/default_avatar.png') !!} @endif"
                                 alt="..." class="img-circle" width="31" height="34" onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                        </a>
                        @if(!Auth::check())
                            <div class="login">
                                <div class="foc-ewm-arrow1"></div>
                                <div class="foc-ewm-arrow2"></div>
                                <p>HI~登录后有更多精彩等着你哦~</p>
                                <a href="{!! url('login') !!}">登录</a>
                                <a class="hov" href="{!! url('register') !!}">注册</a>
                            </div>
                        @else
                            <div class="login login-end">
                                <div class="foc-ewm-arrow1"></div>
                                <div class="foc-ewm-arrow2"></div>
                                <div class="bd clearfix">
                                    <div class="pull-left img">
                                        <img src="{!!  url(Theme::get('avatar')) !!}" alt="" width="31" height="34"
                                             onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                                    </div>
                                    <div class="ostate">
                                        <a class="p-space" href="{!! url('user/index') !!}">{!! Auth::User()->name !!}</a>
                                        <a class="p-space" href="{!! url('user/messageList/1') !!}">您有新的消息</a>
                                        <a href="{!! url('logout') !!}">[退出]</a>
                                    </div>
                                </div>
                                <div class="usercenter">
                                    <a href="{!! url('user/index') !!}" class="">个人中心</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
