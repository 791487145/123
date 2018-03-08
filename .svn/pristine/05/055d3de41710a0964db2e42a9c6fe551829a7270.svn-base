<div class="space"></div>

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
    <div class="space-10"></div>
    @if(count($hotList))
        <div class="g-tasksidelist g-stationsidelist">
            <div class="clearfix g-tasksidelihd"><span class="pull-left cor-gray51 text-size14">最新服务商</span><a class="pull-right" href="">More></a></div>
            <ul>
                @foreach($hotList as $v)
                    <li class="clearfix">
                        <div class="media-left">
                            <a href="@if($v['shop_status'] == 1 && $v['shopId']) {!! url('shop/'.$v['shopId']) !!}
                            @else{!! URL('bre/serviceEvaluateDetail/'.$v['id']) !!}@endif" target="_blank">
                                <img src="{!! URL($v['avatar']) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                            </a>
                        </div>
                        <div class="media-body g-tasksidelinfo">
                            <a class="cor-gray51 p-space" href="@if($v['shop_status'] == 1 && $v['shopId']) {!! url('shop/'.$v['shopId']) !!}
                            @else{!! URL('bre/serviceEvaluateDetail/'.$v['id']) !!}@endif" target="_blank">{!! $v['name'] !!}</a>
                            <div class="space-2"></div>
                            <p class="cor-gray87">好评率：<b class="cor-orange">{!! $v['percent'] !!}%</b></p>
                            <div class="space-2"></div>
                            <a class="cor-gray87 visible-lg-block"
                               href="@if($v['shop_status'] == 1 && $v['shopId']) {!! url('shop/'.$v['shopId']) !!}
                               @else{!! URL('bre/serviceEvaluateDetail/'.$v['id']) !!}@endif" target="_blank">查看更多>></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="space-14"></div>

</div>
<div class="col-lg-9 col-left g-stationmain">
    <div class="g-taskmain no-margin-top">
        <div class="g-stationmaintit">{!! Theme::get('substationNAME') !!}需求</div>
        <div class="station-type clearfix g-taskclassify">
            <div class="col-xs-12 clearfix task-type">
                <div class="row">
                    <div class="col-lg-1 cor-gray51 text-size14 col-xs-2" >任务分类</div>
                    <div class="col-lg-11  col-xs-10">
                        <a class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,['keywords','page']),['category'=>0])) !!}">全部</a>
                        @foreach(array_slice($category,0,7) as $v)
                            <a class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                        @endforeach
                        @if(count($category)>7)
                            <div class="pull-right select-fa-angle-down">
                                <i class="fa fa-angle-down text-size14 show-next"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        {{--筛选内容--}}


            @if(count($category)>7)
                <div class="col-xs-12 clearfix service-type">
                    <div class="row">
                        <div class="col-lg-1 cor-gray51 text-size14 col-xs-2" ></div>
                        <div class="col-lg-11  col-xs-10">
                            @foreach(array_slice($category,7,(count($category)-7)) as $v)
                                <a class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="collapse col-xs-12 task-filter-content" id="collapseExample">
                <div class="well clearfix task-well-content">
                    <a class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,['keywords','page']),['category'=>$pid])) !!}">全部</a>
                    @foreach($category as $v)
                        <a  data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                    @endforeach
                    <button type="button" class="close task-filter-close cor-blue2f" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span aria-hidden="true" class="cor-blue2f">&times;</span>
                    </button>
                </div>
            </div>
            <div class="col-xs-12 clearfix">
                <div class="row">
                    <div class="col-lg-1 col-sm-2 col-md-2 cor-gray51 text-size14 col-xs-2">任务状态</div>
                    <div class="col-lg-11 col-sm-10 col-md-10 col-xs-10">
                        <a class="{!! (!isset($merge['status']))?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_except(array_except($merge,['keywords','paeg']),'status')) !!}">全部</a>
                        <a class="{!! (isset($merge['status']) && $merge['status']==1)?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>1])) !!}">工作中</a>
                        <a class="{!! (isset($merge['status']) && $merge['status']==2)?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>2])) !!}">选稿中</a>
                        <a class="{!! (isset($merge['status']) && $merge['status']==3)?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>3])) !!}">交付中</a>
                        <a class="{!! (isset($merge['status']) && $merge['status']==4)?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>4])) !!}">已结束</a>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 clearfix task-area">
                <div class="row">
                    <div class="col-lg-1 col-sm-2 col-md-2 cor-gray51 text-size14 col-xs-2">
                        <div class="task-dq-label">
                            地区限制
                        </div>
                    </div>
                    <div class="col-lg-11 col-sm-10 col-md-10 col-xs-10">
                        @if(count($area)>7)
                            <div class="pull-right select-fa-angle-down">
                                <i class="fa fa-angle-down text-size14 show-next"></i>
                            </div>
                        @endif
                        @if(isset($_GET['province']))
                            <a class="{!! ( $merge['province']==$area_pid)?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except(array_except($merge,['keywords','page']),['area','city','province']))) !!}">全部</a>
                            @foreach(array_slice($area,0,7) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,['page','province']), ['city'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @elseif(isset($_GET['city']))
                            <a class="{!! ($merge['city']==$area_pid)?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,['area','city','province','page']))) !!}">全部</a>
                            @foreach(array_slice($area,0,7) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,['page','city']), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @elseif(isset($_GET['area']))
                            <a class="{!! (!isset($_GET['area']) && $merge['area']==$area_pid)?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['city'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,['area','city','province','keywords','page']))) !!}">全部</a>
                            @foreach(array_slice($area,0,7) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['id'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @else
                            <a class="bg-blue" href="{!! URL('substation/tasks',['id'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,['area','city','keywords','page']),['city'=>$city['district_id']])) !!}">全部</a>
                            @foreach(array_slice($area,0,7) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['id'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>


{{--地区限制筛选--}}
            @if(count($area)>7)
                <div class="col-xs-12 clearfix service-area">
                    <div class="row">
                        <div class="col-lg-1 col-sm-2 col-md-2 cor-gray51 text-size14 col-xs-2">
                            <div class="task-dq-label">

                            </div>
                        </div>
                        <div class="col-lg-11 col-sm-10 col-md-10 col-xs-10">
                            @if(isset($_GET['province']))
                                @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                    <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['id'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,['page','province']), ['city'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                @endforeach
                            @elseif(isset($_GET['city']))
                                @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                    <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['id'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,['page','city']), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                @endforeach
                            @elseif(isset($_GET['area']))
                                @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                    <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['id'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                @endforeach
                            @else
                                @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                    <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/tasks',['id'=>$city['district_id']]).'?'.http_build_query(array_merge(array_except($merge,'page'), ['province'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>


        <div class="clearfix g-taskmainhd">
            <div class="pull-left">
                <a href="/bre/service" class="g-taskmact">综合</a>
                <span>|</span>
                <a class="g-taskmaintime" href="">
                    剩余时间 <i class="glyphicon glyphicon-arrow-down"></i>
                </a>
                <span>|</span>
                <a class="g-taskmaintime" href="">
                    稿件数
                </a>
                <span>|</span>
                <a class="g-taskmaintime" href="">
                    金额
                </a>
            </div>
            <div class="pull-right g-taskmaininp">
                <form method="get" action="{!! URL('bre/service').'?'.http_build_query($merge)!!}">
                    <input type="text" name="service_name" placeholder="请输入关键字" @if(!empty($merge['service_name']))value="{{$merge['service_name']}}"@endif/>
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <ul class="g-taskmainlist">
            @foreach($list as $v)
                <li class="clearfix"><div class="row">
                        <div class="col-lg-9 col-sm-8">
                            <div class="text-size16">
                                <b class="cor-orange">￥{{ $v['bounty'] }}</b>
                                <a href="{{ URL('task').'/'.$v['id'] }}" target="_blank">
                                    <b>{{ $v['title'] }}</b>
                                </a>
                                @if(!empty($task_service[$v['id']]))
                                    @for($i=0;$i<count($task_service[$v['id']]);$i++)
                                        @if($i%2==1)
                                            <span class="bg-red span-pd2">{{ substr($task_service[$v['id']][$i]['title'],3,3) }}</span>
                                        @else
                                            <span class="bg-orange span-pd2">{{ substr($task_service[$v['id']][$i]['title'],3,3) }}</span>
                                        @endif
                                    @endfor
                                @endif
                            </div>
                            <p class="cor-gray87">
                                <i class="ace-icon fa fa-user bigger-110 cor-grayd2"></i> {{ str_limit($v['user_name'],5) }}&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-eye cor-grayd2"></i> {{ $v['view_count'] }}人浏览/{{ $v['delivery_count'] }}人投稿&nbsp;&nbsp;&nbsp;
                                <span class="hidden-xs"><i class="fa fa-clock-o cor-grayd2"></i> {{ date('d',time()-strtotime($v['created_at'])) }}天前&nbsp;&nbsp;&nbsp;</span> <i class="fa fa-unlock-alt cor-grayd2"></i> {{ ($v['bounty_status']==1)?'已托管赏金':'待托管赏金' }}</p>
                            <p class="cor-gray51 hidden-xs">{!! strip_tags(htmlspecialchars_decode($v['desc'])) !!} </p>
                        </div>
                        <div class="cor-gray87 text-size14 pull-up hidden-xs col-lg-3 col-sm-4">
                            <div class="text-right">
                            <span class="u-inline u-timeollect">
                                @if(strtotime($v['delivery_deadline'])>time() && ($v['status']==3 || $v['status']==4))
                                    <i class="u-tasktime"></i>
                                    <span class="cor-red">{{ CommonClass::changeTimeType(strtotime($v['delivery_deadline'])-time())}}</span> 后截止投标
                                @elseif($v['status']==5)
                                    任务选稿中
                                @elseif($v['status']==6)
                                    任务公示中
                                @elseif($v['status']==7)
                                    任务交付中
                                @elseif($v['status']==8)
                                    任务评价中
                                @elseif($v['status']==9)
                                    任务已完成
                                @endif
                            </span>
                                @if(Auth::check() && !in_array($v['id'],$my_focus_task_ids))
                                    <span class="fa fa-star u-collect" data-values="1" data-toggle="tooltip" data-placement="top" title="收藏" data-id="{{$v['id']}}" ></span>
                                @elseif(Auth::check())
                                    <span class="fa fa-star u-collect" data-values="2" data-toggle="tooltip" data-placement="top" title="收藏" data-id="{{$v['id']}}" style="color: rgb(255, 168, 30);"></span>
                                @else
                                    <span class="fa fa-star u-collect" data-values="1" data-toggle="tooltip" data-placement="top" title="收藏" data-id="{{$v['id']}}" ></span>
                                @endif
                            </div>
                        </div>
                    </div></li>
            @endforeach
        </ul>
    </div>
    <div class="clearfix">
        <div class="g-taskpaginfo">
            @if($list_array['current_page']!=$list_array['last_page'])
                显示 {{ $list_array['per_page']*($list_array['current_page']-1)+1 }}~
                {{ $list_array['per_page']*$list_array['current_page'] }}
            @elseif($list_array['current_page']==$list_array['last_page'] && $list_array['per_page']*($list_array['current_page']-1)+1!=$list_array['total'])
                显示{{ $list_array['per_page']*($list_array['current_page']-1)+1 }}~
                {{ $list_array['total'] }}
            @else
                显示第{{ $list_array['total'] }}
            @endif
            项 共 {{ $list_array['total'] }} 个任务
        </div>
        <div class="paginationwrap">
            {!! $list->render() !!}
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('service-task-css', 'css/taskbar/taskindex.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('service-css', 'css/service.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('station-css', 'css/station.css') !!}