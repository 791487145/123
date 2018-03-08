<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">我的关注</h4>
    <div class="space-20"></div>
    <ul class="row s-myul">
        @if($focus_data['total']>0)
            @foreach($focus_data['data'] as $v)
            <li class="col-lg-6 " id="focus-remove-{{ $v['id'] }}">
                <div class="media-left">
                    <div class="s-myimg">
                        <img class=" pull-left img-responsive" src="{{ CommonClass::getDomain().'/'.CommonClass::getAvatar($v['focus_uid']) }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))" alt="...">
                    </div>
                </div>
                <div class="media-body">
                    <div class="clearfix">
                        <a href="/bre/serviceCaseList/{{$v['focus_uid']}}" class=" pull-left text-muted text-size16 cor-blue s-myname">{{ $v['nickname'] }}</a><a class="pull-right s-mtcutbtn" data-target="#myModal-{{ $v['id'] }}" data-toggle="modal" >取消关注</a>
                    </div>
                    <div class="space-4"></div>
                    <div>
                        <p class="cor-gray97">好评率{{ CommonClass::applauseRate($v['uid']) }}%</p>
                    </div>
                    <div class="space-2"></div>
                    <div>
                        @if(count($v['tags'])<=3)
                            @foreach($v['tags'] as $value)
                                <a class="s-mybtn" href="javscript:;">{{ $value['tag_name'] }}</a>
                            @endforeach
                        @else
                            @foreach(array_slice($v['tags'],0,3) as $value)
                                <a class="s-mybtn" href="javscript:;">{{ $value['tag_name'] }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- 模态框（Modal） -->
                <div class="modal fade" id="myModal-{{ $v['id'] }}" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header widget-header-flat">
                                <span class="modal-title" id="myModalLabel">
                                    审核提示：
                                </span>
                            </div>
                            <div class="modal-body text-center">
                                <p class="h5">确定将“<span class="text-primary">{{ $v['nickname'] }}</span>”取消关注？</p>
                                <div class="space"></div>
                                <p><button class="btn btn-primary btn-blue bor-radius2" type="button"  id="win-bid" data-dismiss="modal" onclick="removeFocus({{ $v['id'] }})">确 定</button>　　<button class="btn bor-radius2" type="button" data-dismiss="modal">取 消</button></p>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>
            </li>
            @endforeach
        @else
            <div class="g-nomessage">暂无关注哦 ！</div>
        @endif
    </ul>
    <div class="clearfix">
        <ul class="pagination pull-right">
            {{--@if(!is_null($focus_data['prev_page_url']))--}}
                {{--<li><a href="{{ $focus_data['prev_page_url'] }}">&lt;</a></li>--}}
            {{--@endif--}}
            {{--@if($focus_data['last_page']>1)--}}
                {{--@for($i=1;$i<=$focus_data['last_page'];$i++)--}}
                    {{--<li class="{{ ($i==$focus_data['current_page'])?'active':'' }}"><a href="{{ 'userfocus?page='.$i }}" class="bg-blue">{{ $i }}</a></li>--}}
                {{--@endfor--}}
            {{--@endif--}}
            {{--@if(!is_null($focus_data['next_page_url']))--}}
                {{--<li><a href="{{ $focus_data['next_page_url'] }}">&gt;</a></li>--}}
            {{--@endif--}}
            {!! $focus->appends($_GET)->render() !!}
        </ul>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('userfocus','js/doc/userfocus.js') !!}

{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}