<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">我收藏的任务</h4>
    <div class="space"></div>
    <form class="form-inline" role="form" action="/user/myfocus" method="get" >
        <div class="form-group">
            <label class="text-size14">搜索任务：</label>
            <div class="input-group">
                <input type="text" class="form-control search-query" placeholder="请输入任务关键词" name="search">
                <span class="input-group-btn">
                      <button class="btn btn-default btn-sm s-myformbtn" type="submit">
                          <span class="fa fa-search"></span>
                      </button>
                </span>
            </div>
        </div>
    </form>
    @if($task_focus['total']>0)
    @foreach($task_focus['data'] as $v)
    <div class="space" id="task-focus-space-{{ $v['focus_id'] }}"></div>
    <div class="clearfix" id="task-focus-{{ $v['focus_id'] }}">
        <div class="col-sm-1 col-xs-2">
            <div class="row" >
                <img class=" pull-left img-responsive img-circle" style="width:60px;height:60px;border-radius:100%;" src="{{ CommonClass::getDomain().'/'.CommonClass::getAvatar($v['uid']) }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))" alt="...">
            </div>
        </div>
        <div class="col-sm-11 col-xs-10 s-myborder">
            <div class="">
                <div class="clearfix">
                    <a class=" pull-left text-muted text-size16 cor-blue s-myname" href="/task/{{ $v['id'] }}" target="_blank"><span class="cor-orange">￥{{ $v['bounty'] }}</span> {{ $v['title'] }}</a><a class="pull-right cor-gray97" href="javascript:;">发布时间：{{ date('Y-m-d',strtotime($v['created_at'])) }}</a>
                </div>
                <div class="space-4"></div>
                <div>
                    <p class="cor-gray97">{!! str_limit(strip_tags(htmlspecialchars_decode($v['desc'])),120) !!}</p>
                </div>
                <div class="space-8"></div>
                <div class="clearfix">
                    <div class="pull-left hidden-xs">
                        <a class="s-mybtn" href="javscript:;">{{ $v['category_name'] }}</a> @if($v['region_limit'] == 1)<a class="s-mybtn" href="javscript:;">{{$v['province_name']}}{{$v['city_name']}}</a>@endif <a class="s-mybtn" href="javscript:;">悬赏任务
                        </a> <a class="s-mybtn" href="javscript:;">{{ $v['bounty_status']==1?'已托管赏金':'待托管赏金' }}</a>
                    </div>
                    <div class="pull-right text-size14">
                        <a class="text-under" href="/task/{{$v['id']}}" target="_blank">查看</a> | <a class="text-under" data-target="#myModal-{{ $v['id'] }}" data-toggle="modal"  >删除</a>
                    </div>
                </div>
                <!-- 模态框（Modal） -->
                <div class="modal fade" id="myModal-{{ $v['id'] }}" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header widget-header-flat">
                                <span class="modal-title" id="myModalLabel">
                                    {{--审核提示：--}}
                                </span>
                            </div>
                            <div class="modal-body text-center">
                                <p class="h5">确定将“<span class="text-primary">{{ $v['title'] }}</span>”取消收藏？</p>
                                <div class="space"></div>
                                <p><button class="btn btn-primary btn-blue bor-radius2" type="button"  id="win-bid" data-dismiss="modal" url='{{ URL('user/ajaxDeleteFocus/'.$v['focus_id']) }} 'onclick = 'deleteFocus($(this))' focus_id="{{ $v['focus_id'] }}">确 定</button>　　<button class="btn bor-radius2" type="button" data-dismiss="modal">取 消</button></p>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>
                <div class="col-xs-12 g-userborbtm"></div>
            </div>
        </div>
    </div>
    @endforeach
    @else
        <div class="g-nomessage">暂无消息哦 ！</div>
    @endif
    <div class="space"></div>
    <div class="clearfix">
        <ul class="pagination pull-right">
            {!! $task->appends($_GET)->render() !!}
        </ul>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
<script>
    function deleteFocus(obj){
        var url = obj.attr('url');
        $.get(url,function(data){
            if(data.errCode==1){
                $('#task-focus-'+data.id).remove();
                $('#task-focus-space-'+data.id).remove();
            }else{
                alert(data.errMsg);
            }
        });
    }
</script>