<div class="g-main g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">我的投稿记录</h4>
    <div class="space-12"></div>
    <div class="clearfix g-reletaskhd hidden-xs">
        <form action="/user/myWorkHistory" method="get">
        <div class="pull-left">
            <div class="pull-left">
                <select class="form-control" name="type">
                    <option value="0" {{ (empty($_GET['type']) || $_GET['type']==0)?'selected':'' }}>类型</option>
                    <option value="1" {{ (!empty($_GET['type']) && $_GET['type']==1)?'selected':'' }}>悬赏</option>
                </select>
            </div>
            <div class="pull-left">
                <select class="form-control" name="status">
                    <option value="0" {{ (empty($_GET['status']) || $_GET['status']==0)?'selected':'' }}>状态</option>
                    <option value="1" {{ (!empty($_GET['status']) && $_GET['status']==1)?'selected':'' }}>工作中</option>
                    <option value="2" {{ (!empty($_GET['status']) && $_GET['status']==2)?'selected':'' }}>选稿中</option>
                    <option value="3" {{ (!empty($_GET['status']) && $_GET['status']==3)?'selected':'' }}>交付中</option>
                    <option value="4" {{ (!empty($_GET['status']) && $_GET['status']==4)?'selected':'' }}>已结束</option>
                </select>
            </div>
            <div class="pull-left">
                <select class="form-control" name="time">
                    <option value="0" {{ (empty($_GET['time']) || $_GET['time']==0)?'selected':'' }}>时间段</option>
                    <option value="1" {{ (!empty($_GET['time']) && $_GET['time']==1)?'selected':'' }}>1个月</option>
                    <option value="2" {{ (!empty($_GET['time']) && $_GET['time']==2)?'selected':'' }}>3个月</option>
                    <option value="3" {{ (!empty($_GET['time']) && $_GET['time']==3)?'selected':'' }}>6个月</option>
                </select>
            </div>
            <button type="submit">
                <i class="fa fa-search text-size16 cor-graybd"></i> 搜索
            </button>
        </div>
        </form>
        <div class="pull-right">
            <a class="text-size14 cor-blue2f" href="/user/myWorkHistory"><i class="fa fa-list-ul"></i></a>
            <a class="text-size14 cor-graybd" href="/user/myWorkHistoryAxis"><i class="fa fa-list-ul fa-rotate-90"></i></a>
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
    <div class="space-6"></div>
    <ul id="useraccept" class="tab-pane fade active in">
        @foreach($my_works['data'] as $v)
        <li class="row">
            <div class="col-sm-1 usercter"><img src="{{ $domain.'/'.$v['avatar'].md5($v['task_uid'].'large').'.jpg' }}"></div>
            <div class="space-10 visible-xs-block"></div>
            <div class="col-sm-11 usernopd">
                <div class="col-sm-9">
                    <div class="text-size14 cor-gray51"><span class="cor-orange">￥{{ $v['bounty'] }}</span> <a href="">{{ $v['task_title'] }}</a> | 投稿中</div>
                    <div class="space-4"></div>
                    <p class="cor-gray87"><i class="ace-icon fa fa-user bigger-110"></i> {{ $v['nickname'] }} <i class="fa fa-eye"></i> {{ $v['view_count'] }}人浏览/{{ $v['delivery_count'] }}人投稿 <i class="fa fa-clock-o"></i> {{ date('d',strtotime($v['created_at'])) }}天前 <i class="fa fa-unlock-alt"></i> {{ ($v['bounty_status']==1)?'已托管赏金':'待托管赏金' }}</p>
                    <div class="space-4"></div>
                    <p class="cor-gray51">{{ str_limit($v['task_desc'],120) }}</p>
                    <div class="g-userlabel"><a href="">{{ $v['cate_name'] }}</a><a href="">湖北武汉</a></div>
                </div>
                <div class="col-sm-3 text-right"><a class="btn-big bg-blue bor-radius2" href="">查看</a></div>
            </div>
            <div class="col-sm-10 g-userborbtm"></div>
        </li>
        @endforeach
    </ul>
    <div class="space-20"></div>
    <div class="dataTables_paginate paging_bootstrap">
        <ul class="pagination">
            @if(!is_null($my_works['prev_page_url']))
                <li><a href="{{ $my_works['prev_page_url'] }}">&lt;</a></li>
            @endif
            @if($my_works['last_page']>1)
                @for($i=1;$i<=$my_works['last_page'];$i++)
                    <li class="{{ ($i==$my_works['current_page'])?'active':'' }}"><a href="{{ 'myfocus?page='.$i }}" class="bg-blue">{{ $i }}</a></li>
                @endfor
            @endif
            @if(!is_null($my_works['next_page_url']))
                <li><a href="{{ $my_works['next_page_url'] }}">&gt;</a></li>
            @endif
        </ul>
    </div>
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
{!! Theme::asset()->container('custom-js')->usepath()->add('myworkhistory','js/doc/myworkhistory.js') !!}
