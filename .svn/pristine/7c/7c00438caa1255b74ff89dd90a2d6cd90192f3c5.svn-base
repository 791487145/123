<div class="location">
    <div class="container">
        <i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;当前位置 > 任务大厅
    </div>
</div>
<article>
    <div class="container">
	    <div class="classify">
            <label><i class=" fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;任务模式:</label>
           <a  href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['keywords','page']),['taskType'=>0])) !!}"><span class="classify-wrap {!! (!isset($merge['taskType']) || $merge['taskType']==0)?'active':'' !!}">全部</span></a>
            @foreach($task_type as $Vtt)						
                <a  href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['taskType'=>$Vtt->id])) !!}"><span class="classify-wrap {!! (isset($merge['taskType']) && $merge['taskType']==$Vtt->id)?'active':'' !!}">{!!mb_substr($Vtt->name,0,2)!!}任务</span></a>
			@endforeach
        </div>
        <div class="classify">
            <label><i class=" fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;任务分类:</label>
            <a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['keywords','page']),['category'=>0])) !!}"><span class="classify-wrap {!! (!isset($merge['category']) || $merge['category']==$pid)?'active':'' !!}" >全部</span></a>
            @foreach(array_slice($category,0,7) as $v)
                <a href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}"><span class="classify-wrap {!! (isset($merge['category']) && $merge['category']==$v['id'])?'active':'' !!}" >{{ $v['name'] }}</span></a>
            @endforeach
        </div>
        <div class="sort clearfix">
            <div class="pull-left sort-l">
                <label class=""><i class="ico-sort-amount-desc"></i>&nbsp;&nbsp;&nbsp;排序 :&nbsp;&nbsp;&nbsp;</label>
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        @if(isset($merge['desc']) && $merge['desc']=='created_at')
                        <span>发布时间</span> <b class="fa fa-angle-down"></b>
                        @elseif(isset($merge['desc']) && $merge['desc']=='delivery_count')
                        <span>稿件数</span> <b class="fa fa-angle-down"></b>
                        @elseif(isset($merge['desc']) && $merge['desc']=='bounty')
                        <span>金额</span> <b class="fa fa-angle-down"></b>
                        @else
                        <span>综合</span> <b class="fa fa-angle-down"></b>
                        @endif
                    </span>
                    <ul class="dropdown-menu">
                        @if(isset($merge['desc']))
                        <li><a data-value="综合" href="{!! URL('task').'?'.http_build_query(array_except($merge,['desc','keywords'])) !!}">综合</a></li>
                        @endif
                        @if(!isset($merge['desc']) || $merge['desc']!='created_at')
                        <li><a data-value="发布时间" href="{!! URL('task').'?'.http_build_query(array_merge($merge,['desc'=>'created_at'])) !!}">发布时间</a></li>
                        @endif
                        @if(!isset($merge['desc']) || $merge['desc']!='delivery_count')
                        <li><a data-value="稿件数" href="{!! URL('task').'?'.http_build_query(array_merge($merge,['desc'=>'delivery_count'])) !!}">稿件数</a></li>
                        @endif
                        @if(!isset($merge['desc']) || $merge['desc']!='bounty')
                        <li><a data-value="稿件数" href="{!! URL('task').'?'.http_build_query(array_merge($merge,['desc'=>'bounty'])) !!}">金额</a></li>
                        @endif
                    </ul>
                </label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class=""><i class="fa fa-filter"></i>&nbsp;&nbsp;&nbsp;状态 :&nbsp;&nbsp;&nbsp;</label>
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                         @if(isset($merge['status']) && $merge['status']==1)
                            <span>工作中</span> <b class="fa fa-angle-down"></b>
							{{-- @elseif(isset($merge['status']) && $merge['status']==2)
                            <span>选稿中</span> <b class="fa fa-angle-down"></b>
                        @elseif(isset($merge['status']) && $merge['status']==3)
                            <span>交付中</span> <b class="fa fa-angle-down"></b>--}}
                        @elseif(isset($merge['status']) && $merge['status']==12)
                            <span>已结束</span> <b class="fa fa-angle-down"></b>
						@else
                            <span>全部</span> <b class="fa fa-angle-down"></b>
                        @endif
                    </span>
                    <ul class="dropdown-menu">
                        @if(isset($merge['status']))
                            <li><a data-value="全部" href="{!! URL('task').'?'.http_build_query(array_except(array_except($merge,['keywords','paeg']),'status')) !!}">全部</a></li>
                        @endif
                        @if(!isset($merge['status']) || $merge['status']!=1)
                            <li><a data-value="工作中" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>1])) !!}">工作中</a></li>
                        @endif
                        {{--@if(!isset($merge['status']) || $merge['status']!=2)
                            <li><a data-value="选稿中" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>2])) !!}">选稿中</a></li>
                        @endif
                        @if(!isset($merge['status']) || $merge['status']!=3)
                            <li><a data-value="交付中" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>3])) !!}">交付中</a></li>
                        @endif--}}
                        @if(!isset($merge['status']) || $merge['status']!=4)
                            <li><a data-value="已结束" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>4])) !!}">已结束</a></li>
                        @endif
                    </ul>
                </label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label><i class="ico-sort-amount"></i>&nbsp;&nbsp;&nbsp;地区 :&nbsp;&nbsp;&nbsp;</label>
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        @if(!empty($province_id))
                            @foreach($province as $v)
                                @if($v['id']==$province_id)
                                    <span>{{ $v['name'] }}</span> <b class="fa fa-angle-down"></b>
                                @endif
                            @endforeach
                        @else
                            <span>全部</span> <b class="fa fa-angle-down"></b>
                        @endif
                    </span>
                    <ul class="dropdown-menu dialogs">
                        <li><a data-value="全部" href="{!! URL('task').'?'.http_build_query(array_merge(array_except(array_except($merge,['keywords','page']),['area','city','province']))) !!}">全部</a></li>
                        @forelse($province as $v)
                        <li><a data-value="{{ $v['name'] }}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['province'=>$v['id']])) !!}">{{ $v['name'] }}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        @if(!empty($city_id))
                            @foreach($city as $v)
                                @if($v['id']==$city_id)
                                    <span>{{ $v['name'] }}</span> <b class="fa fa-angle-down"></b>
                                @endif
                            @endforeach
                        @else
                            <span>全部</span> <b class="fa fa-angle-down"></b>
                        @endif
                    </span>
                    <ul class="dropdown-menu dialogs">
                        <li><a data-value="全部" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['page','city']), ['province'=>$province_id])) !!}">全部</a></li>
                        @if((isset($_GET['province']) && $_GET['province']!=0) || (isset($_GET['area']) && $_GET['area']!=0) || (isset($_GET['city']) && $_GET['city']!=0))
                        @foreach($city as $v)
                        <li><a data-value="{{ $v['name'] }}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['page','province']), ['city'=>$v['id']])) !!}">{{ $v['name'] }}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        @if(!empty($areas_id))
                            @foreach($areas as $v)
                                @if($v['id']==$areas_id)
                                    <span>{{ $v['name'] }}</span> <b class="fa fa-angle-down"></b>
                                @endif
                            @endforeach
                        @else
                            <span>全部</span> <b class="fa fa-angle-down"></b>
                        @endif
                    </span>
                    <ul class="dropdown-menu dialogs">
                        <li><a data-value="全部" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,'page'), ['city'=>$city_id])) !!}">全部</a></li>
                        @if((isset($_GET['city']) && $_GET['city']!=0) ||  (isset($_GET['area']) && $_GET['area']!=0))
                        @foreach($areas as $v)
                        <li><a data-value="{{ $v['name'] }}" href="{!! URL('task').'?'.http_build_query(array_merge(array_except($merge,['page','city']), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </label>
            </div>
            <div class="pull-right sort-search">
                <form action='{{ URL('task') }}' method="get" class="form-inline" role="form">
                    <div class="form-group">
                        <button class="ico-search fa fa-search" type="submit"></button>
                        <input type="text" name="keywords" class="form-control" id="exampleInputEmail2" placeholder="输入关键词">
                    </div>
                </form>
            </div>
        </div>
    </div>
</article>
<section class="shop task">
    <div class="container">
        <ul class="clearfix list">
            @foreach($list as $v)
            <li class="clearfix">
                <div class="col-lg-10 list-r">
                    <h4 class="tit">
                        <span class="money">@if($v['type_alias'] == "zhaobiao" && $v['bounty_status'] == 0)<strong>可议价</strong>@else<i class="fa fa-cny"></i>&nbsp;&nbsp;<b>{{ $v['bounty'] }}</b>@endif</span>&nbsp;&nbsp;
                        <a href="{{ URL('task').'/'.$v['id'] }}">{{ $v['title'] }}</a>&nbsp;&nbsp;
                        @if(!empty($task_service[$v['id']]))
                            @for($i=0;$i<count($task_service[$v['id']]);$i++)
                                @if($i%2==1)
                                    <span class="top">{{ substr($task_service[$v['id']][$i]['title'],3,3) }}</span>
                                @else
                                    <span class="top28">{{ substr($task_service[$v['id']][$i]['title'],3,3) }}</span>
                                @endif
                            @endfor
                        @endif
                    </h4>
                    <p class="type">
                        <span><i class="user"></i>{{ str_limit($v['user_name'],5) }}</span>
                        <span>
                            <i class="num"></i>
                            {{ $v['view_count'] }}人浏览/{{ $v['delivery_count'] }}人投稿
                        </span>
                        <span>
                            <i class="timer"></i>
                            {{ $v['show_publish']}}&nbsp;&nbsp;&nbsp;
                        </span>
                        <span>
                            <i class="trustee"></i>
                            {{ ($v['bounty_status']==1)?'已托管赏金':'待托管赏金' }}
                        </span>
                    </p>
                    <p class="content p-space">
                        {!! strip_tags(htmlspecialchars_decode($v['desc'])) !!}
                    </p>
                </div>
                <div class="col-lg-2 text-center clearfix position-relative">
                    @if(in_array($v['status'],[3,4,5,6,7]))
                        <a class="state bg-cor0a" href="{{ URL('task',['id'=>$v['id']]) }}">进行中</a>
                    @elseif(in_array($v['status'],[8,9]))
                        <a class="state bg-corB6" href="{{ URL('task',['id'=>$v['id']]) }}">已结束</a>
                    @endif

                    {{--@if(Auth::check() && !in_array($v['id'],$my_focus_task_ids))--}}
                        {{--<span class="fa fa-star u-collect"  data-id="{{$v['id']}}"></span>--}}
                    {{--@elseif(Auth::check() && in_array($v['id'],$my_focus_task_ids))--}}
                        {{--<span class="fa fa-star u-collect u-collectf6"  data-id="{{$v['id']}}"></span>--}}
                    {{--@else--}}
                        {{--<span class="fa fa-star u-collect u-collectf6"  data-id="{{$v['id']}}"></span>--}}
                    {{--@endif--}}
                        @if(Auth::check() && !in_array($v['id'],$my_focus_task_ids))
                            <span class="fa fa-star u-collect" data-values="1" data-toggle="tooltip" data-placement="top" title="收藏" data-id="{{$v['id']}}" ></span>
                        @elseif(Auth::check())
                            <span class="fa fa-star u-collect u-collectf6" data-values="2" data-toggle="tooltip" data-placement="top" title="收藏" data-id="{{$v['id']}}" ></span>
                        @else
                            <span class="fa fa-star u-collect" data-values="1" data-toggle="tooltip" data-placement="top" title="收藏" data-id="{{$v['id']}}" ></span>
                        @endif
                </div>
            </li>
            @endforeach
            {{--<li class="clearfix">--}}
                {{--<div class="col-lg-10 list-r">--}}
                    {{--<h4 class="tit"><span class="money"><i class="fa fa-cny"></i>&nbsp;&nbsp;<b>3430.00</b></span>&nbsp;&nbsp;<a href="javascript:;">申请运用微信公众平台常见问题</a>&nbsp;&nbsp;<span class="top">置顶</span></h4>--}}
                    {{--<p class="type"><span><i class="user"></i>水馒头</span><span><i class="num"></i>10人浏览投稿</span><span><i class="timer"></i>3天前</span><span><i class="trustee"></i>未托管</span></p>--}}
                    {{--<p class="content p-space">任务描述：目前，大理市海东新区的多条城市干道正在建设当中，为展示海东新区的新形象，甲方要求将隧道口进行美化，由乙方通过... 念策划、...艺术彩绘、浮雕设计的形式，以大理和海东地方元素，对隧道口进行全方位的美化设计。--}}
                    {{--</p>--}}
                {{--</div>--}}
                {{--<div class="col-lg-2 text-center clearfix">--}}
                    {{--<a class="state bg-corB6" href="javascript:;">已结束</a>--}}
                {{--</div>--}}
            {{--</li>--}}
        </ul>
        <div class="clearfix">
            <div class=" paging_bootstrap text-center">
                <ul class="pagination case-page-list">
                    {!! $list->appends($_GET)->render() !!}
                </ul>
            </div>
        </div>
    </div>
</section>

{!! Theme::asset()->container('specific-js')->usepath()->add('elements','plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ace','plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('dialogs','js/dialogs.js') !!}

{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

{!! Theme::asset()->container('custom-css')->usePath()->add('station-css', 'css/station.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('case','js/doc/taskindex.js') !!}