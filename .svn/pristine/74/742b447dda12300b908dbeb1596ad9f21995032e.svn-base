
<nav>
    <div class="g-taskbarnav homemenu-taskbarnav">
        <div class="container clearfix">
            <div class="row g-nav">
                <div class="col-xs-12 clearfix col-left col-right">
                    <div class="pull-left hidden-xs">
                        <div class="g-tasknavdrop" id="nav"><i class="fa fa-reorder"></i>全部任务分类<i class="fa fa-exchange"></i>
                            <ul class="sub nav-dex text-left">
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
                        </div>
                        <div class="g-navList"><div class="g-navList-wrap clearfix">
                            @if(!empty(Theme::get('nav_list')))
                                @if(count(Theme::get('nav_list')) > 6)
                                    @for($i=0;$i<6;$i++)
                                        @if(Theme::get('nav_list')[$i]['is_show'] == 1)
                                            <a href="{!! Theme::get('nav_list')[$i]['link_url'] !!}"
                                               @if(Theme::get('nav_list')[$i]['is_new_window'] == 1)target="_blank" @endif @if(Theme::get('nav_list')[$i]['link_url'] == Theme::get('now_menu')) class="z-navHome" @endif>
                                                {!! Theme::get('nav_list')[$i]['title'] !!}
                                            </a>
                                        @endif
                                    @endfor

                                    <div class="pull-left dropdown-navwrap">
                                        <a href="" class="dropdown-toggle" data-toggle="dropdown">更多   <b class="caret"></b></a>
                                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close50 z-navactive">
                                            @for($i=7;$i<count(Theme::get('nav_list'))+1;$i++)
                                                <li @if(Theme::get('nav_list')[$i-1]['link_url'] == $_SERVER['REQUEST_URI']) class="hActive" @endif>
                                                    <a class="text-center" href="{!! Theme::get('nav_list')[$i-1]['link_url'] !!}"
                                                       @if(Theme::get('nav_list')[$i-1]['is_new_window'] == 1)target="_blank" @endif >
                                                        {!! Theme::get('nav_list')[$i-1]['title'] !!}
                                                    </a>
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                @else
                                    @for($i=0;$i<count(Theme::get('nav_list'));$i++)
                                        @if(Theme::get('nav_list')[$i]['is_show'] == 1)
                                            <a href="{!! Theme::get('nav_list')[$i]['link_url'] !!}"
                                               @if(Theme::get('nav_list')[$i]['is_new_window'] == 1)target="_blank" @endif @if(Theme::get('nav_list')[$i]['link_url'] == Theme::get('now_menu')) class="z-navHome" @endif>
                                                {!! Theme::get('nav_list')[$i]['title'] !!}
                                            </a>
                                        @endif
                                    @endfor
                                @endif
                            @else
                            <a href="{!! CommonClass::homePage() !!}" @if(CommonClass::homePage() == Theme::get('now_menu')) class="z-navHome" @endif>首页</a>
                            <a href="/task" @if('/task' == Theme::get('now_menu')) class="z-navHome" @endif>任务大厅</a>
                            <a href="/bre/service" @if('/bre/service' == Theme::get('now_menu')) class="z-navHome" @endif>服务商</a>
                            <a href="/task/successCase" @if('/task/successCase' == Theme::get('now_menu')) class="z-navHome" @endif>成功案例</a>
                            <a href="/article" @if('/article' ==   Theme::get('now_menu')) class="z-navHome" @endif>资讯中心</a>
                            @endif
                        </div></div>
                    </div>
                    <div class="pull-right g-tasknavbtn hidden-sm hidden-xs">
                        {{--<button>发布需求</button>--}}
                        <a href="/task/create" class="u-ahref">发布需求</a>
                    </div>
                    <div class="banner-r hidden-sm hidden-xs hidden-md">
                        <div class="tab-content tab-top">
                            <div class="clearfix">
                                @if(Auth::check())
                                        <!--登录后状态-->
                                <div class="pull-left">
                                    <img src="@if(!empty(Theme::get('avatar'))) {!!  url(Theme::get('avatar')) !!} @else {!! Theme::asset()->url('images/defauthead.png') !!}  @endif" height="70" width="70" class="img-responsive img-circle" alt="">
                                </div>
                                <div class="p-mgl">
                                    <p class="p-space">Hi,<span class="text-blod cor-gray51">{!! Auth::User()->name !!}</span></p>
                                    <p>您有新的消息</p>
                                    <div class="space-4"></div>
                                    <a href="/user/index" class="b-border btn-big1 home-usercenter">个人中心</a>
                                </div>
                                @else
                                        <!--未登录状态-->
                                <div class="pull-left">
                                    <img src="{!! Theme::asset()->url('images/defauthead.png') !!} " height="70" width="70" class="img-responsive img-circle" alt="">
                                </div>
                                <div class="p-mgl">
                                    <p>您还未登录</p>
                                    <p><a class="text-under" href="{!! url('login') !!}" >点击登录</a>，更多精彩</p>
                                    <p><a class="text-under cor-gray8f" href="{!! url('register') !!}" >去注册»</a></p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a data-toggle="tab" href="#home" class="z-tit1">公告</a>
                                    <i class="fa fa-sort-desc icon-down text-size18 cor-blue2f"></i>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#messages" class="z-tit1 z-tititm">中标通知</a>
                                    <i class="fa fa-sort-desc icon-down text-size18 cor-blue2f"></i>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#messages1" class="z-tit1">提现</a>
                                    <i class="fa fa-sort-desc icon-down text-size18 cor-blue2f"></i>
                                </li>
                            </ul>
                            <div class="tab-content tab-content-wrap">
                                <div id="home" class="tab-pane fade in active">
                                    <ul class="mg-margin">
                                        @if(!empty(Theme::get('notice')['notice_article']))
                                            @foreach(Theme::get('notice')['notice_article'] as $item)
                                            <li>
                                                <p><a class="text-under cor-gray8f" href="/article/{!! $item['id'] !!}">&middot; {!! $item['title'] !!}</a></p>
                                            </li>
                                             @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div id="messages" class="tab-pane fade">
                                    <ul class="mg-margin">
                                        @if(!empty(Theme::get('task_win')))
                                            @foreach(Theme::get('task_win') as $ite)
                                                <li>
                                                    <p class="text-size14 s-hometit">
                                                        <a href="/bre/serviceCaseList/{{$ite['uid']}}" class="cor-blue2f" target="_blank">{{$ite['name']}}</a>
                                                        中标：<a href="/task/{{$ite['task_id']}}" target="_blank">{{$ite['title']}}</a>
                                                    </p>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div id="messages1" class="tab-pane fade">
                                    <ul class="mg-margin">
                                        @if(!empty(Theme::get('withdraw')))
                                            @foreach(Theme::get('withdraw') as $ite)
                                                <li>
                                                    <p class="text-size14 s-hometit">
                                                        {{$ite['name']}}提现{{$ite['cash']}}元
                                                    </p>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-bot">
                            <a @if(!empty(Theme::get('help_center')))href="/article/aboutUs/{!! Theme::get('help_center') !!}"@endif class="u-btn"><i class="fa fa-flag-o"></i> 新手指导</a>
                            <a href="/user/personCase" class=""><i class="fa fa-desktop"></i> 查看空间</a>
                        </div>
                    </div><!-- /.col -->
                    <nav  class="navbar navbar-default navbar-static navbar-static-position hidden-sm hidden-md hidden-lg col-xs-12"  id="navbar-example" role="navigation">
                        <div class="navbar-header">
                            <button class="navbar-toggle z-activeNavlist" type="button" data-toggle="collapse"
                                    data-target=".bs-js-navbar-scrollspy">
                                <span class="sr-only">切换导航</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <button class="navbar-toggle mg-right0" type="button" data-toggle="collapse"
                                    data-target=".bs-js-navbar-scrollspy1">
                                <span class="fa fa-search"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse bs-js-navbar-scrollspy">
                            <ul class="nav navbar-nav">
                                @if(!empty(Theme::get('nav_list')))
                                    @foreach(Theme::get('nav_list') as $m => $n)
                                        @if($n['is_show'] == 1)
                                            <li><a href="{!! $n['link_url'] !!}" @if($n['is_new_window'] == 1)target="_blank" @endif @if($n['link_url'] == Theme::get('now_menu')) class="z-navHome" @endif>{!! $n['title'] !!}</a></li>
                                        @endif
                                    @endforeach
                                @else
                                <li>
                                    <a href="{!! CommonClass::homePage() !!}" @if(CommonClass::homePage() == Theme::get('now_menu')) class="z-navHome" @endif>首页</a>
                                </li>
                                <li>
                                    <a href="/task" @if('/task' == Theme::get('now_menu')) class="z-navHome" @endif>任务大厅</a>
                                </li>
                                <li>
                                    <a href="/bre/service" @if('bre/service' == Theme::get('now_menu')) class="z-navHome" @endif>服务商</a>
                                </li>
                                <li>
                                    <a href="/task/successCase" @if('/task/successCase' == Theme::get('now_menu')) class="z-navHome" @endif>成功案例</a>
                                </li>
                                <li>
                                    <a href="/article" @if('/article' == Theme::get('now_menu')) class="z-navHome" @endif>资讯中心</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="collapse navbar-collapse bs-js-navbar-scrollspy1 bg-white">
                            <ul class="nav navbar-nav clearfix">
                                <li class="clearfix">
                                    <a href="javascript:;" class="clearfix search-btn">
                                        <div class="g-tasksearch clearfix">
                                            <form action="/task" method="get" class="switchSearch" />
                                                <i class="fa fa-search"></i>
                                                <input type="text" placeholder="输入关键词" name="keywords" class="input-boxshaw"/>
                                                <button>搜索</button>
                                            </form>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</nav>


<div class="g-banner hidden-sm hidden-xs hidden-md">
    <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        @if(!empty(Theme::get('banner')))
        <ol class="carousel-indicators">
            @foreach(Theme::get('banner') as $k => $v)
            <li data-target="#carousel-example-generic" data-slide-to="{!! $k !!}" @if($k == 0) class="active" @endif></li>
            @endforeach
        </ol>
        @else
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
            <li data-target="#carousel-example-generic" data-slide-to="5"></li>
        </ol>
        @endif

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @if(!empty(Theme::get('banner')))
                @foreach(Theme::get('banner') as $key => $value)
            <div  class="item @if($key == 0)active @endif item-banner{!! $key+1 !!}" >
                <a href="{!! $value['ad_url'] !!}" target="_blank">
                    <div>
                        <img src="{!!  URL($value['ad_file'])  !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='{!! $key+1 !!}'>
                    </div>
                </a>
            </div>
                @endforeach
            @else
            <div  class="item active item-banner1" >
                <a href="javascript:;">
                    <div>
                        <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='1'>
                    </div>
                </a>
            </div>
            <div class="item item-banner2">
                <a href="javascript:;">
                    <div>
                        <img src="{!! Theme::asset()->url('images/banner2.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='2'>
                    </div>
                </a>
            </div>
            <div class="item item-banner3">
                <a href="javascript:;">
                    <div>
                        <img src="{!! Theme::asset()->url('images/banner3.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='3'>
                    </div>
                </a>
            </div>
            <div class="item item-banner4">
                <a href="javascript:;">
                    <div>
                        <img src="{!! Theme::asset()->url('images/banner4.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='4'>
                    </div>
                </a>
            </div>
            <div class="item item-banner5">
                <a href="javascript:;">
                    <div>
                        <img src="{!! Theme::asset()->url('images/banner5.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='5'>
                    </div>
                </a>
            </div>
            <div class="item item-banner6">
                <a href="javascript:;">
                    <div>
                        <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='6'>
                    </div>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="space-6 hidden-lg hidden-md hidden-sm visible-xs-block "></div>
<div class="container hidden-lg visible-md-block visible-sm-block visible-xs-block ">
    <div class="row">
        <div class="col-xs-12 col-left col-right">
            <div class="g-banner">
                <div id="carousel-example-generic1" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Indicators -->
                    @if(!empty(Theme::get('banner')))
                        <ol class="carousel-indicators">
                            @foreach(Theme::get('banner') as $k => $v)
                                <li data-target="#carousel-example-generic" data-slide-to="{!! $k !!}"  @if($k == 0) class="active" @endif></li>
                            @endforeach
                        </ol>
                    @else
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="5"></li>
                    </ol>
                    @endif

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        @if(!empty(Theme::get('banner')))
                            @foreach(Theme::get('banner') as $key => $value)
                                <div  class="item @if($key == 0)active @endif" >
                                    <a href="{!! $value['ad_url'] !!}" target="_blank">
                                        <div>
                                            <img src="{!!  URL($value['ad_file'])  !!}" alt="..."class="img-responsive">
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                        <div class="item active">
                            <a href="javascript:;" class="u-item1">
                                <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" alt="..." class="img-responsive">
                            </a>
                        </div>
                        <div class="item">
                            <a href="javascript:;">
                                <img src="{!! Theme::asset()->url('images/banner2.jpg') !!}" height="460" width="100%" alt="..." class="img-responsive">
                            </a>
                        </div>
                        <div class="item">
                            <a href="javascript:;">
                                <img src="{!! Theme::asset()->url('images/banner3.jpg') !!}" height="460" width="100%" alt="..." class="img-responsive">
                            </a>
                        </div>
                        <div class="item">
                            <a href="javascript:;" class="u-item1">
                                <img src="{!! Theme::asset()->url('images/banner4.jpg') !!}" alt="..." class="img-responsive">
                            </a>
                        </div>
                        <div class="item">
                            <a href="javascript:;">
                                <img src="{!! Theme::asset()->url('images/banner5.jpg') !!}" height="460" width="100%" alt="..." class="img-responsive">
                            </a>
                        </div>
                        <div class="item">
                            <a href="javascript:;">
                                <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" height="460" width="100%" alt="..." class="img-responsive">
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--top-->
<div class="go-top dn" id="go-top">
    <div class="uc-2vm u-hov">
        {{--<a href="javascript:;" class="uc-2vm u-hov"></a>--}}
        <form class="form-horizontal" action="/bre/feedbackInfo" method="post" enctype="multipart/form-data" id="complain">
            {!! csrf_field() !!}
            <div class="u-pop dn clearfix">
                    <input type="text" name="uid" @if(!empty(Theme::get('complaints_user'))) value="{!! Theme::get('complaints_user')->uid !!}"@endif style="display:none">
                    <h2 class="mg-margin text-size12 cor-gray51">一句话点评</h2>
                    <div class="space-4"></div>
                    <textarea class="form-control" rows="3" name="desc" placeholder="期待您的一句话点评，不管是批评、感谢还是建议，我们都将会细心聆听，及时回复"></textarea>
                    {!! $errors->first('desc') !!}
                    <div class="space-4"></div>
                    <input type="text" name="phone" @if(!empty(Theme::get('complaints_user'))) value="{!! Theme::get('complaints_user')->mobile !!}" readonly="readonly" @endif placeholder="填写手机号">
                    {!! $errors->first('phone') !!}
                    <button type="submit" class="btn-blue btn btn-sm btn-primary">提交</button>
                <div class="arrow">
                    <div class="arrow-sanjiao"></div>
                    <div class="arrow-sanjiao-big"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="feedback u-hov">
        {{--<a href="" target="_blank" class="feedback u-hov"></a>--}}
        <div class="dn dnd">
            <h2 class="mg-margin text-size12 cor-gray51">在线时间：09:00 -18:00</h2>
            <div class="space-4"></div>
            <div>
                <a href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}" target="_blank"><img src="{!! Theme::asset()->url('images/pa.jpg') !!}" alt=""></a>
                {{--<a href="javscript:;"><img src="{!! Theme::asset()->url('images/pa.jpg') !!}" alt=""></a>--}}
            </div>
            <div class="hr"></div>
            <div class="iss-ico1">
                <p class="cor-gray51 mg-margin">全国免长途电话：</p>
                <p class="text-size20 cor-gray51">{!! Theme::get('site_config')['phone'] !!}</p>
            </div>
            <div class="arrow">
                <div class="arrow-sanjiao feedback-sanjiao"></div>
                <div class="arrow-sanjiao-big feedback-sanjiao-big"></div>
            </div>
        </div>
    </div>
    <a href="javascript:;" class="go u-hov"></a>
</div>


