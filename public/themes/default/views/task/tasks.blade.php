<div class="g-taskposition col-lg-12 col-left">您的位置：首页 > 任务大厅</div>
<div class="col-lg-9 col-left">
    <div class="g-taskprocess hidden-xs">
        <div class="row">
            <div class="col-md-4 col-xs-4"><div class="g-taskpro1 pull-left"><span>免费发布任务</span><p>100%免费发布</p></div><div class="g-taskproico1 pull-right">></div></div>
            <div class="col-md-4 col-xs-4"><div class="g-taskpro2 pull-left"><span>服务商投标</span><p>多家威客，择优雇佣</p></div><div class="g-taskproico2 pull-right">></div></div>
            <div class="col-md-4 col-xs-4"><div class="g-taskpro3"><span>担保交易</span><p>担保交易，满意付款</p></div></div>
        </div>
    </div>
    <div class="">
        <div class="g-taskclassify clearfix  table-responsive">
		    <div class="col-xs-12 clearfix task-type">
                <div class="row">
                    <div class="col-lg-1 cor-gray51 text-size14 col-sm-2 col-xs-12" >任务模式</div>
                    <div class="col-lg-11 col-sm-10  col-xs-12">
                        <a class="{!! (!isset($merge['taskType'])|| $merge['taskType']==0)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['keywords','page']),['taskType'=>0])) !!}">全部</a>
                        @foreach($task_type as $Vtt)						
                        <a class="{!! (isset($merge['taskType']) && $merge['taskType']==$Vtt->id)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['taskType'=>$Vtt->id])) !!}">{!!mb_substr($Vtt->name,0,2)!!}任务</a>
						@endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 clearfix task-type">
                <div class="row">
                    <div class="col-lg-1 cor-gray51 text-size14 col-sm-2 col-xs-12" >任务分类</div>
                    <div class="col-lg-11 col-sm-10  col-xs-12">
                        <a class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['keywords','page']),['category'=>0])) !!}">全部</a>
                        @foreach(array_slice($category,0,7) as $v)
                            <a class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
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
                    <div class="col-lg-1 cor-gray51 text-size14 col-sm-2 col-xs-12" ></div>
                    <div class="col-lg-11 col-sm-10 col-xs-12">
                        @foreach(array_slice($category,7,(count($category)-7)) as $v)
                            <a class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <div class="collapse col-xs-12 task-filter-content" id="collapseExample">
                <div class="well clearfix task-well-content">
                    <a class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['keywords','page']),['category'=>$pid])) !!}">全部</a>
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
                    <div class="col-lg-1 col-sm-2 col-md-2 cor-gray51 text-size14 col-xs-12">任务状态</div>
                    <div class="col-lg-11 col-sm-10 col-md-10 col-xs-12">
                        <a class="{!! (!isset($merge['status']))?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_except(array_except($merge,['keywords','paeg']),'status')) !!}">全部</a>
                        <a class="{!! (isset($merge['status']) && $merge['status']==1)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>1])) !!}">工作中</a>
                        <!--<a class="{!! (isset($merge['status']) && $merge['status']==2)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>2])) !!}">选稿中</a>
                        <a class="{!! (isset($merge['status']) && $merge['status']==3)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>3])) !!}">交付中</a> -->
                        <a class="{!! (isset($merge['status']) && $merge['status']==12)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>12])) !!}">已完成</a>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 clearfix task-area">
                <div class="row">
                    <div class="col-lg-1 col-sm-2 col-md-2 cor-gray51 text-size14 col-xs-12">
                        <div class="task-dq-label">
                            地区限制
                        </div>
                    </div>
                    <div class="col-lg-11 col-sm-10 col-md-10 col-xs-12">
                        @if(count($area)>7)
                        <div class="pull-right select-fa-angle-down">
                            <i class="fa fa-angle-down text-size14 show-next"></i>
                        </div>
                        @endif
                        @if(isset($_GET['province']))
                            <a class="{!! ( $merge['province']==$area_pid)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except(array_except($merge,['keywords','page']),['area','city','province']))) !!}">全部</a>
                            @foreach(array_slice($area,0,7) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['page','province']), ['city'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @elseif(isset($_GET['city']))
                            <a class="{!! ($merge['city']==$area_pid)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['area','city','province','page']))) !!}">全部</a>
                            @foreach(array_slice($area,0,7) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['page','city']), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @elseif(isset($_GET['area']))
                            <a class="{!! (!isset($_GET['area']) && $merge['area']==$area_pid)?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['area','city','province','keywords','page']))) !!}">全部</a>
                            @foreach(array_slice($area,0,7) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @else
                            <a class="bg-blue" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['area','city','keywords','page']),['province'=>0])) !!}">全部</a>
                            @foreach(array_slice($area,0,7) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['province'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            {{--地区限制筛选--}}
            @if(count($area)>7)
            <div class="col-xs-12 clearfix service-area">
                <div class="row">
                    <div class="col-lg-1 col-sm-2 col-md-2 cor-gray51 text-size14 col-xs-12">
                        <div class="task-dq-label">

                        </div>
                    </div>
                    <div class="col-lg-11 col-sm-10 col-md-10 col-xs-12">
                        @if(isset($_GET['province']))
                            @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['page','province']), ['city'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @elseif(isset($_GET['city']))
                            @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['page','city']), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @elseif(isset($_GET['area']))
                            @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @else
                            @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['province'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="g-taskmain">
        <div class="clearfix g-taskmainhd">
            <div class="pull-left">
                <a  class="{!! (!isset($merge['desc']))?'g-taskmact':'' !!}" href="{!! URL('task').'?'.http_build_query(array_except($merge,['desc','keywords'])) !!}">综合</a><span>|</span>
                <a class="{!! (isset($merge['desc']) && $merge['desc']=='created_at')?'g-taskmact':'' !!} g-taskmaintime" href="{!! URL('task').'?'.http_build_query(array_merge($merge,['desc'=>'created_at'])) !!}">发布时间 <i class="glyphicon glyphicon-arrow-{!! (isset($merge['desc']) && $merge['desc']=='created_at')?'up':'down' !!}"></i></a><span>|</span>
                <a class="{!! (isset($merge['desc']) && $merge['desc']=='delivery_count')?'g-taskmact':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge($merge,['desc'=>'delivery_count'])) !!}">稿件数</a><span>|</span>
                <a class="{!! (isset($merge['desc']) && $merge['desc']=='bounty')?'g-taskmact':'' !!}" href="{!! URL('task').'?'.http_build_query(array_merge($merge,['desc'=>'bounty'])) !!}">金额</a>
            </div>
            <form action="/task" method="get" />
                <div class="pull-left g-taskmaininp">
                    <input type="text" name="keywords" placeholder="请输入关键字" />
                    <button type="submit">
                        <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                    </button>
                </div>
            </form>
        </div>
        <ul class="g-taskmainlist">
            @foreach($list as $v)
                <li class="clearfix"><div class="row">
                    <div class="col-lg-9 col-sm-8">
                        <div class="text-size16">
                            <b class="cor-orange">@if($v['type_alias'] == "zhaobiao" && $v['bounty_status'] == 0)<strong>可议价</strong>@else￥{{ $v['bounty'] }}@endif</b>
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
                            <span class="hidden-xs">
                                <i class="fa fa-clock-o cor-grayd2"></i>
                                {{ $v['show_publish']}}&nbsp;&nbsp;&nbsp;
                            </span>
                            <i class="fa fa-unlock-alt cor-grayd2"></i>
                            {{ ($v['bounty_status']==1)?'已托管赏金':'待托管赏金' }}
                        </p>
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
            {!! $list->appends($_GET)->render() !!}
        </div>
    </div>
    <div class="space-14"></div>
</div>
<div class="col-lg-3 g-taskside visible-lg-block col-left">
    <div class="g-tasksidemand">
        <div>
            @if(count($rightAd))
            <a  href="{!! $rightAd[0]['ad_url'] !!}"><img  src="{!! URL($rightAd[0]['ad_file']) !!}"  alt=""></a>
            @else
            <img src="{!! Theme::asset()->url('images/mybg.png') !!}" />
            @endif
        </div>
        <form class="registerform" action="/task/create" method="get">
            <div>
                <div class="space-10"></div>
                <b class="text-size16 cor-gray51">快速发布需求</b>
                <div class="space-2"></div>
                <p class="cor-gray87">快速发布，坐等服务商回复</p>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="u-tasksideico1"></i>
                    </span>
                    <select readonly="true" name="type" disabled><option value="1" >悬赏任务</option></select>
                </div>
                <div class="space-6"></div>
                <div class="input-group">
                    <span class="input-group-addon" style="height:11px!important;">
                    <i class="u-tasksideico2"></i>
                    </span>
                    <div>
                        <input id="form-field-mask-2" class="form-control input-mask-phone" name="title" type="text" placeholder="需求标题,如：logo设计" />
                    </div>
                </div>
                <div class="space-6"></div>
                <div class="input-group">
                    <span class="input-group-addon">
                    <i class="u-tasksideico3"></i>
                    </span>
                    <input id="form-field-mask-2" class="form-control input-mask-phone" name="phone" type="text" placeholder="手机号码"  />
                </div>
                <div class="space-6"></div>
                <button class="btn btn-block btn-primary bor-radius2 text-size14 btn-blue" type="submit">发布需求</button>
            </div>
        </form>
    </div>
    <div class="space-8"></div>
    @if(count($hotList))
    <div class="g-tasksidelist">
        <div class="clearfix g-tasksidelihd">
            <b class="pull-left cor-gray51 text-size14">{!! $targetName !!}</b>
            <a class="pull-right" href="{!! URL('bre/service' ) !!}">More></a>
        </div>
        <ul>
            @foreach($hotList as $v)
            <li class="clearfix">
                <div class="media-left">
                   {{-- <img src="{!! Theme::asset()->url('images/mybg.png') !!}">--}}
                    <a href="{!!$v['url']!!}"><img src="{!! URL($v['recommend_pic']) !!}"></a>
                </div>
                <div class="media-body g-tasksidelinfo">
                    <a class="cor-gray51" href="{!!$v['url']!!}">{!! $v['recommend_name'] !!}</a>
                    <div class="space-4"></div>
                    <p class="cor-gray87">好评率：<b class="cor-orange">{!! $v['percent']*100 !!}%</b></p>
                    <div class="space-12"></div>
                    <a class="cor-gray87 visible-lg-block" href="{!!$v['url']!!}">详情>></a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="space-14"></div>
</div>
@if(count($ad))
<div class="visible-lg-block visible-md-block clearfix" >
    <div class="for-advertise col-md-12 col-left">
        <a  href="{!! $ad[0]['ad_url'] !!}"><img  src="{!! URL($ad[0]['ad_file']) !!}"  alt=""></a>
        <div class="space-10"></div>
    </div>
</div>
@endif
{!! Theme::asset()->container('custom-css')->usepath()->add('case','css/taskbar/taskindex.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('case','js/doc/taskindex.js') !!}

{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

{!! Theme::asset()->container('custom-css')->usePath()->add('station-css', 'css/station.css') !!}
