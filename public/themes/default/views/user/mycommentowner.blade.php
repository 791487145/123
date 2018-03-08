<div class="g-main g-message">
        <h4 class="text-size16 cor-blue u-title">交易评价</h4>
        <div class="space"></div>
        <div class="clearfix hidden-xs">
            <form action="/user/myCommentOwner" method="get" id="screen_form">
                <div class="control-group pull-left">
                    <label>
                        <input name="type" type="radio" class="ace screen" value=0 {{ (empty($_GET['type'])|| $_GET['type']==0)?'checked':'' }}>
                        <span class="lbl"> 全部</span>
                    </label>
                    <label>
                        <input name="type" type="radio" class="ace screen" value=1 {{ (!empty($_GET['type']) && $_GET['type']==1)?'checked':'' }}>
                        <span class="lbl"> 好评</span>
                    </label>
                    <label>
                        <input name="type" type="radio" class="ace screen" value=2 {{ (!empty($_GET['type']) && $_GET['type']==2)?'checked':'' }}>
                        <span class="lbl"> 中评</span>
                    </label>
                    <label>
                        <input name="type" type="radio" class="ace screen" value=3 {{ (!empty($_GET['type']) && $_GET['type']==3)?'checked':'' }}>
                        <span class="lbl"> 差评</span>
                    </label>
                </div>
                <div class=" pull-right">
                    <select name="from" class="form-control btn-big screen">
                        <option value="0" {{ (empty($_GET['from']) || $_GET['from']==0)?'selected':'' }}>给威客的评价</option>
                        <option value="1" {{ (!empty($_GET['from']) && $_GET['from']==1)?'selected':'' }}>威客给我的评价</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="space"></div>
        @if(count($comment_data['data'])>0)
        <div class="g-tradevaluate">
            @foreach($comment_data['data'] as $v)
                <div class="clearfix ">
                    <div class="col-sm-1 col-xs-3">
                        <div class="row">
                            @if($v['type']==1)
                            <div class="g-valugood">
                            @elseif($v['type']==2)
                            <div class="g-valuin">
                            @elseif($v['type']==3)
                            <div class="g-valupoor">
                            @endif
                                @if(empty($_GET['from']) || $_GET['from']==0)
                                    <img class="img-responsive" src="{{ CommonClass::getDomain().'/'.CommonClass::getAvatar($v['to_uid']) }}"  onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))"alt="...">
                                @elseif(!empty($_GET['from']) && $_GET['from']==1)
                                    <img class="img-responsive" src="{{ CommonClass::getDomain().'/'.CommonClass::getAvatar($v['from_uid']) }}"  onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))"alt="...">
                                @endif
                                <div class="g-valuimgbg"></div>
                            </div>
                            <div class="space-6"></div>
                            <p class="text-center g-valuin p-space"><a href="javascript:;" class=" cor-blue2f">{{ $v['nickname'] }}</a></p>
                        </div>
                    </div>
                    <div class="col-sm-11 col-xs-9 s-myborder">
                        <div class="clearfix">
                            <span class=" pull-left text-muted text-size12 cor-gray87 s-myname">任务：<a target="_blank" class="cor-blue42" href="{{ url('task',['id'=>$v['task_id']]) }}">  {{ $v['title'] }}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;成交价：￥{{ $v['bounty'] }}</span>
                            <a  class="pull-right cor-gray87 text-size12" >{{ date('Y-m-d',strtotime($v['task_create'])) }}</a>
                        </div>
                        <div class="space-6"></div>
                        <div class="p-space">
                            <p class="cor-gray51 text-size14">{{ str_limit($v['comment'],120)  }}</p>
                        </div>
                        <div class="space-2"></div>
                        <div class="clearfix">
                        <span class="cor-gray87 z-hov">
                            本次终合评分：<span class="cor-orange">{{ $v['globle_score'] }} </span><i class="u-evaico"></i>
                            <div class="u-recordstar b-border">
                                <div>
                                    @if(!empty($_GET['from']) && $_GET['from']==1)
                                    付款及时性：
                                    @else
                                    工作速度：
                                    @endif
                                    @for($i=0;$i<$v['speed_score'];$i++)
                                        <span class="rec-active"></span>
                                    @endfor
                                    @for($i=0;$i<(5-$v['speed_score']);$i++)
                                        <span></span>
                                    @endfor
                                    <a class="cor-orange mg-left">{{ $v['speed_score'] }}分 </a>
                                    @if($v['speed_score']>4 && $v['speed_score']<=5)
                                        - 速度很快
                                    @elseif($v['speed_score']>3 && $v['speed_score']<=4)
                                        - 速度一般
                                    @elseif($v['speed_score']>2 && $v['speed_score']<=3)
                                        - 速度较慢
                                    @else
                                        - 速度很慢
                                    @endif
                                </div>
                                <div class="space-8"></div>
                                <div>
                                    @if(!empty($_GET['from']) && $_GET['from']==1)
                                        合作愉快度：
                                    @else
                                        工作质量：
                                    @endif
                                    @for($i=0;$i<$v['quality_score'];$i++)
                                        <span class="rec-active"></span>
                                    @endfor
                                    @for($i=0;$i<(5-$v['quality_score']);$i++)
                                        <span></span>
                                    @endfor
                                    <a class="cor-orange mg-left">{{ $v['quality_score'] }}分 </a>
                                    @if($v['quality_score']>4 && $v['quality_score']<=5)
                                        - 质量很高
                                    @elseif($v['quality_score']>3 && $v['quality_score']<=4)
                                        - 质量一般
                                    @elseif($v['quality_score']>2 && $v['quality_score']<=3)
                                        - 质量较低
                                    @else
                                        - 质量很低
                                    @endif
                                </div>
                                <div class="space-8"></div>
                                @if(empty($_GET['from']) || $_GET['from']==0)
                                <div>
                                    工作态度：
                                    @for($i=0;$i<$v['attitude_score'];$i++)
                                        <span class="rec-atv"></span>
                                    @endfor
                                    @for($i=0;$i<(5-$v['attitude_score']);$i++)
                                        <span></span>
                                    @endfor
                                    <a class="cor-orange mg-left">{{ $v['attitude_score'] }}分 </a>
                                    @if($v['attitude_score']>4 && $v['attitude_score']<=5)
                                        - 态度很好
                                    @elseif($v['attitude_score']>3 && $v['attitude_score']<=4)
                                        - 速度一般
                                    @elseif($v['attitude_score']>2 && $v['attitude_score']<=3)
                                        - 态度较差
                                    @else
                                        - 态度很差
                                    @endif
                                </div>
                                @endif
                            </div>
                        </span>
                        </div>
                        <div class="g-userborbtm"></div>
                    </div>
                </div>
                <div class="space"></div>
            @endforeach
            <div class="clearfix">
                <ul class="pagination pull-right">
                    {!! $comment->appends($_GET)->render()  !!}
                </ul>
            </div>
        </div>
        @else
        <div class="g-nomessage">暂无信息哦 ！</div>
        @endif
    </div>

{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ownercomment','js/doc/ownercomment.js') !!}