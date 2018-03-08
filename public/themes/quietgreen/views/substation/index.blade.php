<div class="space-8 col-xs-12"></div>
<div class="col-xs-12">
    <div class="row">
        <div class="col-lg-3 g-stationside visible-lg-block col-left">
            <div class="g-stationmenu">
                <div class="g-stationmenuhd">全部任务分类</div>
                <ul>
                    @if(!empty(Theme::get('task_cate')))
                        @if(count(Theme::get('task_cate')) >= 8)
                            @for($j=0;$j<8;$j++)
                                @if(isset(Theme::get('task_cate')[$j]['pid']) && Theme::get('task_cate')[$j]['pid'] == 0)
                                    <li class="text-size12 claerfix"><span class="text-size14">{!! Theme::get('task_cate')[$j]['name'] !!}</span>
                                        / @if(!empty(Theme::get('task_cate')[$j]['child_task_cate']) && Theme::get('task_cate')[$j]['child_task_cate'][0])
                                            {!! Theme::get('task_cate')[$j]['child_task_cate'][0]['name'] !!}
                                        @endif
                                        <i class="fa fa-angle-right pull-right"></i>
                                        <div class="stationsubshow">
                                            @if(!empty(Theme::get('task_cate')[$j]['child_task_cate']) && is_array(Theme::get('task_cate')[$j]['child_task_cate']))
                                                @if(count(Theme::get('task_cate')[$j]['child_task_cate']) >= 9)
                                                    @for($i =0 ;$i<9;$i++)
                                                        <a class="cor-gray89 text-size14"
                                                           href="/substation/tasks/{!! Theme::get('substationID') !!}?category={!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['id'] !!}">
                                                            {!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}
                                                        </a>
                                                    @endfor
                                                @else
                                                    @for($i =0 ;$i<count(Theme::get('task_cate')[$j]['child_task_cate']);$i++)
                                                        <a class="cor-gray89 text-size14"
                                                           href="/substation/tasks/{!! Theme::get('substationID') !!}?category={!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['id'] !!}">
                                                            {!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}
                                                        </a>

                                                    @endfor
                                                @endif
                                            @endif
                                        </div>
                                    </li>
                                @endif
                            @endfor
                        @else
                            @for($j=0;$j<count(Theme::get('task_cate'));$j++)
                                @if(isset(Theme::get('task_cate')[$j]['pid']) && Theme::get('task_cate')[$j]['pid'] == 0)
                                    <li class="text-size12 claerfix"><span class="text-size14">{!! Theme::get('task_cate')[$j]['name'] !!}</span>
                                        / @if(!empty(Theme::get('task_cate')[$j]['child_task_cate']) && Theme::get('task_cate')[$j]['child_task_cate'][0])
                                            {!! Theme::get('task_cate')[$j]['child_task_cate'][0]['name'] !!}
                                        @endif
                                        <i class="fa fa-angle-right pull-right"></i>
                                        <div class="stationsubshow">
                                            @if(!empty(Theme::get('task_cate')[$j]['child_task_cate']) && is_array(Theme::get('task_cate')[$j]['child_task_cate']))
                                                @if(count(Theme::get('task_cate')[$j]['child_task_cate']) >= 9)
                                                    @for($i =0 ;$i<9;$i++)
                                                        <a class="cor-gray89 text-size14"
                                                           href="/substation/tasks/{!! Theme::get('substationID') !!}?category={!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['id'] !!}">
                                                            {!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}
                                                        </a>
                                                    @endfor
                                                @else
                                                    @for($i =0 ;$i<count(Theme::get('task_cate')[$j]['child_task_cate']);$i++)
                                                        <a class="cor-gray89 text-size14"
                                                           href="/substation/tasks/{!! Theme::get('substationID') !!}?category={!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['id'] !!}">
                                                            {!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}
                                                        </a>

                                                    @endfor
                                                @endif
                                            @endif
                                        </div>
                                    </li>
                                @endif
                            @endfor
                        @endif
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-lg-7 pd-padding7">
            <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
                <!-- Indicators -->
                @if(count($banner)>=1)
                <ol class="carousel-indicators">
                    @if(count($banner)>1)
                    @foreach($banner as $k=>$v)
                    <li data-target="#carousel-example-generic" data-slide-to="{{ $k }}" @if($k == 0)class="active" @else class=""@endif></li>
                    @endforeach
                    @endif
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
                @if(count($banner)>=1)
                <div class="carousel-inner" role="listbox">
                    @foreach($banner as $k=>$v)
                    <div  @if($k == 0)class="item item-banner1 active"@else class=" item-banner1 item" @endif>
                        <a href="{{ $v['ad_url'] }}" target="_blank">
                            <img src="{{ url().'/'.$v['ad_file'] }}" alt="..." class="img-responsive itm-banner" data-adaptive-background="1" data-ab-color="rgb(172,201,207)">
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                <div  class="carousel-inner" role="listbox" >
                    <div  class="item item-banner1 active">
                        <a href="javascript:;" target="_blank">
                            <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background="1" data-ab-color="rgb(172,201,207)">
                        </a>
                    </div>
                    <div  class="item item-banner1">
                        <a href="javascript:;" target="_blank">
                            <img src="{!! Theme::asset()->url('images/banner2.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background="2" data-ab-color="rgb(172,201,207)">
                        </a>
                    </div>
                    <div  class="item item-banner1">
                        <a href="javascript:;" target="_blank">
                            <img src="{!! Theme::asset()->url('images/banner3.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background="3" data-ab-color="rgb(172,201,207)">
                        </a>
                    </div>
                    <div  class="item item-banner1">
                        <a href="javascript:;" target="_blank">
                            <img src="{!! Theme::asset()->url('images/banner4.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background="4" data-ab-color="rgb(172,201,207)">
                        </a>
                    </div>
                    <div  class="item item-banner1">
                        <a href="javascript:;" target="_blank">
                            <img src="{!! Theme::asset()->url('images/banner5.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background="5" data-ab-color="rgb(172,201,207)">
                        </a>
                    </div>
                    <div  class="item item-banner1">
                        <a href="javascript:;" target="_blank">
                            <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background="6" data-ab-color="rgb(172,201,207)">
                        </a>
                    </div>
                </div>
                @endif
            </div>
            <div class="clearfix u-subtation hidden-md hidden-sm hidden-xs">
                <div class="col-md-4 s-ico clearfix">
                    <div class="space-10"></div>
                    <div class="">
                        <h4 class="text-size16 cor-gray51">有需求？</h4>
                        <p class="cor-gray97">万千威客为您出谋划策</p>
                    </div>
                </div>
                <div class="col-md-4 s-ico s-ico2">
                    <div class="space-10"></div>
                    <div class="">
                        <h4 class="text-size16 cor-gray51">找任务</h4>
                        <p class="cor-gray97">海量需求任你来挑</p>
                    </div>
                </div>
                <div class="col-md-4 s-ico s-ico3">
                    <div class="space-10"></div>
                    <div class="">
                        <h4 class="text-size16 cor-gray51">快速交易</h4>
                        <p class="cor-gray97">轻松交易快速解决</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 g-stationside pd-padding7">
            <div class="sidetation-r hidden-sm hidden-xs hidden-md">
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
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
{{--最新动态--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left">
            <div class="b-border clearfix m-new">
                <div class="col-lg-2 col-sm-3 col-xs-2 text-center">
                    <div class="space"></div>
                    <div class="space"></div>
                    <img src="{{ Theme::asset()->url('images/zxdt.png')}}" alt="" class="">
                </div>
                <div class="col-lg-10 col-sm-9 col-xs-9 col-left col-right">
                    <div class="row">
                        <div class="space"></div>
                        <div class="renav clearfix">
                            <ul class="ul clearfix">
                                <li class="mg-margin clearfix " >
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=2)
                                            @foreach(array_slice($active,0,2) as $v)
                                                <p class="p-space">
                                                    @if(isset($v['uid'],$shops[$v['uid']]))
                                                        <a target="_blank" href="{{ URL('shop',['id'=>$shops[$v['uid']]['id']]) }}">{{ $v['name']}}</a>
                                                    @else
                                                        <a target="_blank" href="{{ URL('/bre/serviceCaseList',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    @endif
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=4)
                                            @foreach(array_slice($active,2,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=6)
                                            @foreach(array_slice($active,4,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=8)
                                            @foreach(array_slice($active,6,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                </li>
                                <li class="mg-margin clearfix " >
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=2)
                                            @foreach(array_slice($active,0,2) as $v)
                                                <p class="p-space">
                                                    @if(isset($shops[$v['uid']]))
                                                        <a target="_blank" href="{{ URL('shop',['id'=>$shops[$v['uid']]['id']]) }}">{{ $v['name']}}</a>
                                                    @else
                                                        <a target="_blank" href="{{ URL('/bre/serviceCaseList',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    @endif
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=4)
                                            @foreach(array_slice($active,2,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=6)
                                            @foreach(array_slice($active,4,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=8)
                                            @foreach(array_slice($active,6,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                </li>
                                <li class="mg-margin clearfix " >
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=2)
                                            @foreach(array_slice($active,0,2) as $v)
                                                <p class="p-space">
                                                    @if(isset($shops[$v['uid']]))
                                                        <a target="_blank" href="{{ URL('shop',['id'=>$shops[$v['uid']]['id']]) }}">{{ $v['name']}}</a>
                                                    @else
                                                        <a target="_blank" href="{{ URL('/bre/serviceCaseList',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    @endif
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=4)
                                            @foreach(array_slice($active,2,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=6)
                                            @foreach(array_slice($active,4,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=8)
                                            @foreach(array_slice($active,6,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                </li>
                                <li class="mg-margin clearfix " >
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=2)
                                            @foreach(array_slice($active,0,2) as $v)
                                                <p class="p-space">
                                                    @if(isset($shops[$v['uid']]))
                                                        <a target="_blank" href="{{ URL('shop',['id'=>$shops[$v['uid']]['id']]) }}">{{ $v['name']}}</a>
                                                    @else
                                                        <a target="_blank" href="{{ URL('/bre/serviceCaseList',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    @endif
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=4)
                                            @foreach(array_slice($active,2,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=6)
                                            @foreach(array_slice($active,4,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                        @if(count($active)>=8)
                                            @foreach(array_slice($active,6,2) as $v)
                                                <p class="p-space">
                                                    <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                    接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                </li>
                                {{-- <ul class="mg-margin clearfix " >
                                     <li class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                         @if(count($active)>=2)
                                             @foreach(array_slice($active,0,2) as $v)
                                                 <p class="p-space">
                                                     @if(in_array($v['uid'],$uids))
                                                         <a target="_blank" href="{{ URL('shop',['id'=>$shops[$v['uid']]['id']]) }}">{{ $v['name']}}</a>
                                                     @else
                                                         <a target="_blank" href="{{ URL('/bre/serviceCaseList',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                     @endif
                                                     接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                 </p>
                                             @endforeach
                                         @endif
                                     </li>
                                     <li class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                         @if(count($active)>=4)
                                             @foreach(array_slice($active,2,2) as $v)
                                                 <p class="p-space">
                                                     <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                     接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                 </p>
                                             @endforeach
                                         @endif
                                     </li>
                                     <li class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                         @if(count($active)>=6)
                                             @foreach(array_slice($active,4,2) as $v)
                                                 <p class="p-space">
                                                     <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                     接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                 </p>
                                             @endforeach
                                         @endif
                                     </li>
                                     <li class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                         @if(count($active)>=8)
                                             @foreach(array_slice($active,6,2) as $v)
                                                 <p class="p-space">
                                                     <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                     接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                 </p>
                                             @endforeach
                                         @endif
                                     </li>
                                     <li class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                         @if(count($active)>=2)
                                             @foreach(array_slice($active,0,2) as $v)
                                                 <p class="p-space">
                                                     @if(in_array($v['uid'],$uids))
                                                         <a target="_blank" href="{{ URL('shop',['id'=>$shops[$v['uid']]['id']]) }}">{{ $v['name']}}</a>
                                                     @else
                                                         <a target="_blank" href="{{ URL('/bre/serviceCaseList',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                     @endif
                                                     接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                 </p>
                                             @endforeach
                                         @endif
                                     </li>
                                     <li class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                         @if(count($active)>=4)
                                             @foreach(array_slice($active,2,2) as $v)
                                                 <p class="p-space">
                                                     <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                     接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                 </p>
                                             @endforeach
                                         @endif
                                     </li>
                                     <li class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                         @if(count($active)>=6)
                                             @foreach(array_slice($active,4,2) as $v)
                                                 <p class="p-space">
                                                     <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                     接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                 </p>
                                             @endforeach
                                         @endif
                                     </li>
                                     <li class="col-lg-3 col-sm-6 col-xs-6 p-space">
                                         @if(count($active)>=8)
                                             @foreach(array_slice($active,6,2) as $v)
                                                 <p class="p-space">
                                                     <a target="_blank" href="{{ URL('task',['id'=>$v['uid']]) }}">{{ $v['name']}}</a>
                                                     接受了任务: <a target="_blank" href="{{ URL('task',['id'=>$v['id']]) }}">{{\CommonClass::cc_msubstr($v['title'],12) }}</a>
                                                 </p>
                                             @endforeach
                                         @endif
                                     </li>
                                 </ul>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
@if(count($recommendshops)>0)
{{--推荐店铺--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left m-shop">
            <div class="bg-white b-border">
                <div class="tit">
                    <h4 class=" text-size16 cor-gray51">推荐店铺<a class="pull-right cor-gray97 text-size12" href="{{ URL('substation/service',['id'=>Theme::get('substationID')]) }}" target="_blank">More&gt;</a></h4>
                </div>
                <ul class="clearfix mg-margin g-servicer clearfix g-serv row ">
                    @foreach($recommendshops as $v)
                    <li class="col-lg-2 col-md-3 col-sm-3 col-xs-12 u-listitem1 p-space">
                        <div class="carousel slide g-servicer-wrap1 text-center">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="f-pr">
                                        <a href="{{ URL('shop',['id'=>$v['id']]) }}" target="_blank">
                                            <img src="{{ (!is_null($v['shop_pic']))?url().'/'.$v['shop_pic']:Theme::asset()->url('images/employ/bg2.jpg') }}" alt="First slide" class="j-img img-responsive" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <a href="{{ URL('shop',['id'=>$v['id']]) }}" target="_blank" class="text-size14 cor-gray51 p-space text-center">
                                {{ $v['shop_name'] }}
                            </a>
                            <p class="text-size12 cor-gray51 p-space text-center">
                                <span>好评率：</span>
                                @if($v['total_comment']!=0)
                                <span class="cor-orange">{{ sprintf('%.2f',$v['good_comment']/$v['total_comment'])*100 }}%</span>
                                @else
                                <span class="cor-orange">100%</span>
                                @endif
                            </p>
                            <a href="{{ URL('shop',['id'=>$v['id']]) }}" class="a-btn">进入店铺</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="space-14"></div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
@endif
@if(count($recommendservice)>0)
{{--服务作品--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left  m-serve">
            <div class="bg-white b-border">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                        <a class="text-size16 cor-gray51" href="#serve" data-toggle="tab">服务</a>
                    </li>
                    <li>
                        <a class="text-size16 cor-gray51" href="#works" data-toggle="tab">作品</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="serve">
                        <ul class="mg-margin list-inline clearfix">
                            @foreach($recommendservice as $v)
                            <li class="clearfix list-category col-lg-3 col-sm-6 col-xs-12">
                                <div class="pull-left ">
                                    <a  href="{{ URL('shop/buyservice',['id'=>$v['id']]) }}" target="_blank">
                                        <img src="{{ (!is_null($v['cover']))?url().'/'.$v['cover']:Theme::asset()->url('images/employ/bg2.jpg') }}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                                    </a>
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51 p-space">
                                    <a class="p-space" href="{{ URL('shop/buyservice',['id'=>$v['id']]) }}" target="_blank">{{ $v['title'] }}</a>
                                    <p class="cor-orange p-space">￥{{ $v['cash'] }}</p>
                                    <p class="text-size12 p-space">好评率：
                                        @if(!is_null($v['comments_num']) && $v['comments_num']!=0)
                                        <span class="cor-orange">{{ sprintf('%.2f',$v['good_comment']/$v['comments_num'])*10 }}%</span>
                                        @else
                                        <span class="cor-orange">100%</span>
                                        @endif
                                        |  <span class="cor-orange">{{ $v['sales_num'] }}</span>人购买</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="works">
                        <ul class="mg-margin list-inline clearfix">
                            @foreach($recommendgoods as $v)
                                <li class="clearfix list-category col-lg-3 col-sm-6 col-xs-12">
                                    <div class="pull-left ">
                                        <a  href="{{ URL('shop/buyGoods',['id'=>$v['id']]) }}" target="_blank">
                                            <img src="{{ (!is_null($v['cover']))?url().'/'.$v['cover']:Theme::asset()->url('images/employ/bg2.jpg') }}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                                        </a>
                                    </div>
                                    <div class="space-2"></div>
                                    <div class="text-size14 cor-gray51 p-space">
                                        <a class="p-space" href="{{ URL('shop/buyGoods',['id'=>$v['id']]) }}" target="_blank">{{ $v['title'] }}</a>
                                        <p class="cor-orange p-space">￥{{ $v['cash'] }}</p>
                                        <p class="text-size12 p-space">好评率：
                                            @if(!is_null($v['comments_num']) && $v['comments_num']!=0)
                                                <span class="cor-orange">{{ sprintf('%.2f',$v['good_comment']/$v['comments_num'])*10 }}%</span>
                                            @else
                                                <span class="cor-orange">100%</span>
                                            @endif
                                            |  <span class="cor-orange">{{ $v['sales_num'] }}</span>人购买</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
@endif
@if(count($new_tasks)>0)
{{--最新任务--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left m-shop m-tasks">
            <div class="bg-white b-border">
                <div class="tit">
                    <h4 class=" text-size16 cor-gray51">最新任务<a class="pull-right cor-gray97 text-size12" href="{{ URL('substation/tasks',['id'=>Theme::get('substationID')]) }}" target="_blank">More&gt;</a></h4>
                </div>
                <div class=" clearfix">
                    <ul class=" clearfix text-size14 cor-grayC2 mg-margin col-sm-12">
                        @foreach($new_tasks as $v)
                        <li class="col-lg-3 col-md-3 col-sm-4 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥{{ $v['bounty'] }}</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="{{ URL('task',['id'=>$v['id']]) }}" target="_blank">{{ \CommonClass::cc_msubstr($v['title'],15) }}</a>
                                </p>
                                <p class="p-space ">
                                    <span class="cor-grayC2 s-hometit" target="_blank">{{ \CommonClass::cc_msubstr($v['username'],15) }}</span>
                                    <span class="cor-grayC2 s-hometit" href="javascript:;">{{ $v['delivery_count'] }}投标</span>
                                </p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
@endif
@if(count($success_case)>0)
{{--成功案例--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left m-shop u-case">
            <div class="bg-white b-border">
                <div class="tit">
                    <h4 class=" text-size16 cor-gray51">成功案例</h4>
                </div>
                <ul class="clearfix mg-margin g-servicer g-succ  g-servicer-list">
                    @foreach($success_case as $v)
                    <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1">
                        <div class="u-index">
                            <div class="f-pr">
                                <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank">
                                    <img src="{{ (!is_null($v['pic']))?url().'/'.$v['pic']:Theme::asset()->url('images/employ/bg2.jpg') }}" width="100%" class="img-responsive j-img" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                                </a>
                            </div>
                            <div class="g-scueeitem1 clearfix  p-space">
                                <h4 class="text-size14 mg-margin p-space">
                                    <a href="{{ URL('task/successDetail',$v['id']) }}" target="_blank" class="cor-gray51">
                                        {{ \CommonClass::cc_msubstr($v['title'],12) }}
                                    </a>
                                </h4>
                                <div class="space-2"></div>
                                <div class="clearfix p-space">
                                    <div class="p-space">
                                        <i class="fa fa-tag fa-rotate-90 cor-gray87 text-size12"></i>&nbsp;
                                        <span class="cor-gray97">{{ $v['category'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="space-14"></div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
@endif
{{--资讯--}}
@if(count($article)>0)
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left m-shop m-serve">
            <div class="bg-white b-border">
                <div class="tit">
                    <h4 class=" text-size16 cor-gray51">资讯</h4>
                </div>
                <ul class="mg-margin clearfix">
                    @foreach($article as $v)
                    <li class="clearfix list-category col-lg-4 col-sm-6 col-xs-12">
                        <div class="pull-left ">
                            <a href="{{ URL('article',['id'=>$v['recommend_id']]) }}" target="_blank">
                                <img src="{{ (!is_null($v['recommend_pic']))?url().'/'.$v['recommend_pic']:Theme::asset()->url('images/employ/bg2.jpg') }}"  onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                            </a>
                        </div>
                        <div class="space-2"></div>
                        <div class="text-size14 cor-gray97">
                            <a class="p-space text-size16 cor-gray51"  href="{{ URL('article',['id'=>$v['recommend_id']]) }}" target="_blank">{{ \CommonClass::cc_msubstr($v['recommend_name'],12) }}</a>
                            <p class="mg-margin">{{ \CommonClass::cc_msubstr($v['summary'],30) }}</p>
                            <p class="text-size12 p-space">
                                <a href="{{ URL('article',['id'=>$v['recommend_id']]) }}" class="cor-gray97 p-space" target="_blank">{{ $v['cate_name'] }} ·  详情</a>
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
@endif

{!! Theme::asset()->container('custom-css')->usepath()->add('index','css/index.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('station-css', 'css/station.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('station-js', 'js/station.js') !!}
