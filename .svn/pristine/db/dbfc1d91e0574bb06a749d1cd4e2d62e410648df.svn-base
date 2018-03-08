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
                            <p class="cor-gray87">好评数：<b class="cor-orange">{!! $v['percent'] !!}%</b></p>
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
        <div class="g-stationmaintit">{!! $substation_name !!}服务商</div>
        <div class="station-type clearfix g-taskclassify serivce-type">
            <div class="col-md-1 col-xs-2 cor-gray51 text-size14">
                <div class="row">
                    服务商分类
                </div>
            </div>
            <div class="col-lg-11 col-xs-10">
                <a class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'bg-blue':'' !!}" href="{!! URL('substation/service').'/'.$substation_id !!}">全部</a>
                @foreach(array_slice($category,0,7) as $v)
                    <a class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('substation/service').'/'.$substation_id.'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                @endforeach
                @if(count($category)>7)
                    <div class="pull-right select-fa-angle-down">
                        <i class="fa fa-angle-down text-size14 show-next"></i>
                    </div>
                @endif
            </div>


{{--服务商筛选--}}

            <div class="serivcelist-type row">
                <div class="col-md-1 col-xs-2 cor-gray51 text-size14">
                    <div class="row">

                    </div>
                </div>
                @if(count($category)>7)
                    <div class="col-lg-11  col-xs-10">
                        @foreach(array_slice($category,7,(count($category)-7)) as $v)
                            <a class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}"
                               href="{!! URL('substation/service').'/'.$substation_id.'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        <div class="clearfix g-taskmainhd">
            <div class="pull-left">
                <a href="/substation/service/{!! $substation_id !!}" class="g-taskmact">综合</a>
                {{--<span>|</span>--}}
                {{--<a class="g-taskmaintime" href="">
                    成交额 <i class="glyphicon glyphicon-arrow-down"></i>
                </a>
                <span>|</span>
                <a class="g-taskmaintime" href="">
                    成交量 <i class="glyphicon glyphicon-arrow-down"></i>
                </a>--}}
                <span>|</span>
                <a class="g-taskmaintime" href="{!! URL('substation/service').'/'.$substation_id.'?'.http_build_query(array_merge(array_except($merge,'page'), ['employee_praise_rate'=>1]))!!}">
                    好评率 <i class="glyphicon glyphicon-arrow-down"></i>
                </a>
            </div>
            <div class="pull-right g-taskmaininp">
                <form method="get" action="{!! URL('substation/service').'/'.$substation_id.'?'.http_build_query($merge)!!}">
                    <input type="text" name="service_name" placeholder="请输入关键字" @if(!empty($merge['service_name']))value="{{$merge['service_name']}}"@endif/>
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <ul class="g-taskmainlist g-stasionmainlist">
            @if(!empty($list->toArray()['data']))
                @foreach($list->toArray()['data'] as $item)
                    <li class="clearfix">
                        <div class="col-sm-2 col-xs-2 m-serivcebox">
                            <div class="row">
                                <img src="@if($item['avatar']){!! URL($item['avatar']) !!} @else {!! Theme::asset()->url('images/default_avatar.png') !!} @endif"
                                     class="img-responsive" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                            </div>
                            @if($item['is_recommend'] == 1 && $item['shop_status'] == 1 && $item['shopId'])
                                <span class="u-serviceimgico">荐</span>
                            @endif
                        </div>
                        <div class="col-sm-9 col-xs-10 nopdr">
                            <div class="">
                                <a class="cor-blue2f text-size18 text-blod "
                                   href="@if($item['shop_status'] == 1 && $item['shopId']) {!! url('shop/'.$item['shopId']) !!}
                                   @else{!! URL('bre/serviceEvaluateDetail/'.$item['id']) !!}@endif" target="_blank">{!! $item['name'] !!}

                                    &nbsp;
                                    @if(isset($item['auth']) && $item['auth']['bank'] == true)
                                        <span class="s-servicericon bank-attestation"></span>
                                    @else
                                        <span class="s-servicericon bank-attestation-no"></span>
                                    @endif
                                    @if(isset($item['auth']) && $item['auth']['realname'] == true)
                                        <span class="s-servicericon cd-card-attestation"></span>
                                    @else
                                        <span class="s-servicericon cd-card-attestation-no"></span>
                                    @endif
                                    @if($item['email_status'] == 2)
                                        <span class="s-servicericon email-attestation"></span>
                                    @else
                                        <span class="s-servicericon email-attestation-no"></span>
                                    @endif
                                    @if(isset($item['auth']) && $item['auth']['alipay'] == true)
                                        <span class="s-servicericon alipay-attestation"></span>
                                    @else
                                        <span class="s-servicericon alipay-attestation-no"></span>
                                    @endif
                                    @if(isset($item['auth']) && $item['auth']['enterprise'] == true)
                                        <span class="s-servicericon company-attestation"></span>
                                    @else
                                        <span class="s-servicericon company-attestation-no"></span>
                                    @endif
                                </a>
                                <p class="p-space cor-gray87 hidden-xs">服务范围：
                                    @if(empty($item['skill']))
                                        暂无标签
                                    @else
                                        @foreach($item['skill'] as $value)
                                            {!! $value !!}&nbsp;&nbsp;
                                        @endforeach
                                    @endif
                                </p>
                                <p class="cor-gray87">
                                    好评数：{!! $item['employee_praise_rate'] !!}个&nbsp;&nbsp;|&nbsp;&nbsp;
                                    好评率：<b class="cor-orange">{!! $item['percent'] !!}%</b>
                                </p>

                            </div>
                        </div>
                        @if($item['shop_status'] == 1 && $item['shopId'])
                            <div class="col-sm-2 hidden-xs m-serivcebox1">
                                <div class="row text-right">
                                    <a class="g-toshopbtn"
                                       @if(Auth::check() && Auth::id() == $item['id']) href="{!! URL('/shop/manage/'.$item['shopId']) !!}"
                                       @else href="{!! URL('/shop/'.$item['shopId']) !!}"
                                       @endif target="_blank">进入店铺
                                    </a>
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="clearfix">
        <div class="g-taskpaginfo">@if(!empty($page))显示{!! ($page - 1) * $paginate + 1 !!}~{!! $page * $paginate !!}项@endif 共{!! $list->total() !!}个服务商</div>
        <div class="paginationwrap">
            {!! $list->appends($merge)->render() !!}
        </div>
    </div>
</div>



{!! Theme::asset()->container('custom-css')->usePath()->add('service-task-css', 'css/taskbar/taskindex.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('service-css', 'css/service.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('station-css', 'css/station.css') !!}