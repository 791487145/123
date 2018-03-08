<div class="g-main g-releasetask">
        <h4 class="text-size16 cor-blue2f u-title">我的投稿记录</h4>
        <div class="space-12"></div>
        <div class="clearfix g-reletaskhd">
            <div class="pull-left">
                <form action="/user/myWorkHistoryAxis" method="get">
                <span class="cor-gray51 text-size14">搜索任务： </span>
                <input type="text" placeholder="输入任务关键词" name="search" class="input-xlarge" />
                <button class="g-reletimehd"><i class="fa fa-search text-size16 cor-graybd"></i></button>
                </form>
            </div>
            <div class="pull-right">
                <a class="text-size14 cor-graybd" href="/user/myWorkHistory"><i class="fa fa-list-ul"></i></a>
                <a class="text-size14 cor-graybd cor-blue2f" href="/user/myWorkHistoryAxis"><i class="fa fa-list-ul fa-rotate-90"></i></a>
                <div class="text-size14 cor-graybd g-releasechart" href="javascript:;">
                    <i class="fa fa-pie-chart"></i>
                    <div class="g-releasehidea"></div>
                    <div class="g-releasehide">
                        <div>
                            <div>饼图统计</div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <!-- #section:plugins/charts.flotchart -->
                                    <div id="piechart-placeholder"></div>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-20"></div>
        <ul class="g-reletimeline">
            @foreach($my_tasks['data'] as $k=>$v)
                <span style="display:none;">{{ $num +=1 }}</span>
                @if($num!=1)
                    <li class="g-reletimeper"><div class="g-reletimebor"><span>{{ date('Y',strtotime($k)) }}</span>{{ date('m',strtotime($k)) }}月</div></li>
                @endif
                @if(!empty($v))
                    @foreach($v as $value)
                        <li class="row">
                            <div class="col-md-10 g-userborbtm"></div>
                            <div class="g-reletimeli"><b>{{ date('m-d',strtotime($value['created_at'])) }}</b><span><i></i></span></div>
                            <div class="col-md-1"><img src="{{ $domain.'/'.$value['avatar'].md5($value['uid'].'large').'.jpg' }}"></div>
                            <div class="col-md-11">
                                <div class="col-md-9">
                                    <div class="text-size14 cor-gray51"><span class="cor-orange">￥{{ $value['bounty'] }}</span> <a href="">{{ $value['task_title'] }}</a> | 投稿中</div>
                                    <div class="space-4"></div>
                                    <p class="cor-gray87"><i class="ace-icon fa fa-user bigger-110"></i> {{ $value['nickname'] }} <i class="fa fa-eye"></i> {{ $value['view_count'] }}人浏览/{{ $value['delivery_count'] }}人投稿 <i class="fa fa-clock-o"></i> {{ date('d',strtotime(time()-$value['created_at'])) }}天前 <i class="fa fa-unlock-alt"></i>{{ ($value['bounty_status']==1)?'已托管赏金':'待托管赏金' }}</p>
                                    <div class="space-4"></div>
                                    <p class="cor-gray51 p-space">{{ str_limit($value['desc']) }}</p>
                                    <div class="g-userlabel"><a href="">{{ $value['cate_name'] }}</a><a href="">湖北武汉</a></div>
                                </div>
                                <div class="col-md-3 text-right"><a class="btn-big bg-blue bor-radius2" href="">查看</a></div>
                            </div>
                        </li>
                    @endforeach
                @endif
            @endforeach
        </ul>
        @if(!is_null($my_tasks['next_page_url']))
        <div class="g-reletimedrop"><div role="tooltip" class="popover fade top in" style="display: block;"><div class="arrow" style="left: 50%;"></div><h3 class="popover-title" style="display: none;"></h3><div class="popover-content"><a href="javascript:;">查看更多</a></div></div></div>
        @endif
        <div class="space-20"></div>
    </div>

{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('excanvas','plugins/ace/js/excanvas.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('custom_min','plugins/ace/js/jquery-ui.custom.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('touch-punch','plugins/ace/js/jquery.ui.touch-punch.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('easypiechart','plugins/ace/js/jquery.easypiechart.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('sparkline','plugins/ace/js/jquery.sparkline.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_flot','plugins/ace/js/flot/jquery.flot.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_flot_pie','plugins/ace/js/flot/jquery.flot.pie.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_flot_resize','plugins/ace/js/flot/jquery.flot.resize.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ace_min','plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ace-elements','plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('mytasklist','js/doc/mytasklist.js') !!}