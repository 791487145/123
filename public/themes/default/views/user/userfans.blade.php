<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">我的粉丝</h4>
    <div class="space-20"></div>
    <ul class="row s-myul">
        @if($focus_data['total']>0)
            @foreach($focus_data['data'] as $v)
                <li class="col-lg-6 " id="focus-remove-{{ $v['id'] }}">
                    <div class="media-left">
                        <div class="s-myimg">
                            <img class=" pull-left img-responsive" src="{{ $domain.'/'.$v['avatar'] }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                        </div>
                    </div>
                    <div class="media-body">
                        <div class="clearfix">
                            @if(!in_array($v['uid'],$my_focus_ids))
                            <a href="/bre/serviceCaseList/{{$v['focus_uid']}}" class=" pull-left text-muted text-size16 cor-blue s-myname">{{ $v['nickname'] }}</a><a class="pull-right s-mtcutbtn" uid="{{ $v['uid'] }}" type="1" onclick="doFocus($(this))">关注他</a>
                            @else
                            <a href="/bre/serviceCaseList/{{$v['focus_uid']}}" class=" pull-left text-muted text-size16 cor-blue s-myname">{{ $v['nickname'] }}</a><a class="pull-right s-mtcutbtn" uid="{{ $v['uid'] }}" type="2" onclick="doFocus($(this))">取消关注</a>
                            @endif
                        </div>
                        <div class="space-4"></div>
                        <div>
                            <p class="cor-gray97">好评率{{ CommonClass::applauseRate($v['uid']) }}%</p>
                        </div>
                        <div class="space-2"></div>
                        <div>
                            @if(count($v['tagsfans'])<=3)
                                @foreach($v['tagsfans'] as $value)
                                    <a class="s-mybtn" href="javscript:;">{{ $value['tag_name'] }}</a>
                                @endforeach
                            @else
                                @foreach(array_slice($v['tagsfans'],0,3) as $value)
                                    <a class="s-mybtn" href="javscript:;">{{ $value['tag_name'] }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        @else
            <div class="g-nomessage">暂无粉丝哦 ！</div>
        @endif
    </ul>
    <div class="clearfix">
        <ul class="pagination pull-right">
            {!! $focus->appends($_GET)->render() !!}
        </ul>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('userfocus','js/doc/userfocus.js') !!}

{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}