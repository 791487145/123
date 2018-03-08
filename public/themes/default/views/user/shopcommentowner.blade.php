<div class="g-main g-message">
        <h4 class="text-size16 cor-blue u-title">交易评价</h4>
        <div class="space"></div>
        @if($is_shop_open==1)
        <div class="clearfix hidden-xs">
            <form action="/user/shopcommentowner" method="get" id="screen_form">
                <div class="control-group pull-left">
                    <label>
                        <input name="type" type="radio" class="ace screen" value=0 {{ (!isset($_GET['type']) || $_GET['type']=='0')?'checked':'' }}>
                        <span class="lbl"> 作品</span>
                    </label>
                    <label>
                        <input name="type" type="radio" class="ace screen" value=1 {{ (isset($_GET['type']) && $_GET['type']=='1')?'checked':'' }}>
                        <span class="lbl"> 服务</span>
                    </label>
                </div>
                <div class=" pull-right">
                    <select name="from" class="form-control btn-big screen">
                        <option value="0" {{ (!isset($_GET['from']) || $_GET['from']=='0')?'selected':'' }}>我接受的评价</option>
                        <option value="1" {{ (isset($_GET['from']) && $_GET['from']=='1')?'selected':'' }}>我做出的评价</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="space"></div>
        <div class="g-tradevaluate">
                @if($comments_toArray['total']>0)
                @foreach($comments_toArray['data'] as $k=>$v)
                <div class="clearfix ">
                    <div class="col-sm-1 col-xs-3">
                        <div class="row">
                            @if(isset($_GET['type']) && $_GET['type']=='1')
                                @if($v['type']==1)
                                <div class="g-valugood">
                                @elseif($v['type']==2)
                                <div class="g-valuin">
                                @elseif($v['type']==3)
                                <div class="g-valupoor">
                                @endif
                            @else
                                @if($v['type']==0)
                                <div class="g-valugood">
                                @elseif($v['type']==1)
                                <div class="g-valuin">
                                @elseif($v['type']==2)
                                <div class="g-valupoor">
                                @endif
                            @endif
                                    <img class="img-responsive" src="{{ $v['avatar'] }}"  alt=''  onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">

                                <div class="g-valuimgbg"></div>
                            </div>
                            <div class="space-6"></div>
                            <p class="text-center g-valuin p-space"><span class=" cor-blue2f">{{ $v['user_name'] }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-11 col-xs-9 s-myborder">
                        <div class="clearfix">
                            <span class=" pull-left text-muted text-size12 cor-gray87 s-myname">{{ (!empty($_GET['type']) && $_GET['type']==1)?'服务：':'作品：' }}
                                @if(!empty($_GET['type']) && $_GET['type']==1)
                                <a target="_blank" class="cor-blue42" href="{{ URL('shop/buyservice',['id'=>$service[$k]['id']]) }}">  {{ $service[$k]['title'] }}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;成交价：￥{{ $service[$k]['cash'] }}
                                @else
                                <a target="_blank" class="cor-blue42" href="{{ URL('shop/buyGoods',['id'=>$v['goods_id']]) }}">  {{ $v['goods_name'] }}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;成交价：￥{{ $v['goods_price'] }}
                                @endif
                                </span>
                            <a  class="pull-right cor-gray87 text-size12" >
                                {{ date('Y-m-d',strtotime($v['created_at'])) }}
                            </a>
                        </div>
                        <div class="space-6"></div>
                        <div class="p-space">
                            @if(!empty($_GET['type']) && $_GET['type']==1)
                            <p class="cor-gray51 text-size14">{{ $v['comment'] }}</p>
                            @else
                            <p class="cor-gray51 text-size14">{{ $v['comment_desc'] }}</p>
                            @endif
                        </div>
                        <div class="space-2"></div>
                        <div class="clearfix">
                        <span class="cor-gray87 z-hov">
                            @if(!empty($_GET['type']) && $_GET['type']==1 && $_GET['from']==0)
                                本次终合评分：<span class="cor-orange">{{ round(($v['speed_score']+$v['quality_score']+$v['speed_score'])/3,1) }} </span><i class="u-evaico"></i>
                            @else
                                本次终合评分：<span class="cor-orange">{{ round(($v['speed_score']+$v['quality_score'])/2,1) }} </span><i class="u-evaico"></i>
                            @endif
                            <div class="u-recordstar b-border">
                                @if(!empty($_GET['type']) && $_GET['type']==1 && $_GET['from']==0)
                                    <div>
                                        工作速度：
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
                                        工作质量：
                                        @for($i=0;$i<$v['quality_score'];$i++)
                                            <span class="rec-active"></span>
                                        @endfor
                                        @for($i=0;$i<(5-$v['quality_score']);$i++)
                                            <span></span>
                                        @endfor
                                        <a class="cor-orange mg-left">{{ $v['quality_score'] }}分 </a>
                                        @if($v['quality_score']>4 && $v['quality_score']<=5)
                                            - 质量很好
                                        @elseif($v['quality_score']>3 && $v['quality_score']<=4)
                                            - 质量一般
                                        @elseif($v['quality_score']>2 && $v['quality_score']<=3)
                                            - 质量较差
                                        @else
                                            - 质量很差
                                        @endif
                                    </div>
                                    <div class="space-8"></div>
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
                                @else
                                    <div>
                                        付款及时性：
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
                                        合作愉快度：
                                        @for($i=0;$i<$v['quality_score'];$i++)
                                            <span class="rec-active"></span>
                                        @endfor
                                        @for($i=0;$i<(5-$v['quality_score']);$i++)
                                            <span></span>
                                        @endfor
                                        <a class="cor-orange mg-left">{{ $v['quality_score'] }}分 </a>
                                        @if($v['quality_score']>4 && $v['quality_score']<=5)
                                            - 非常愉快
                                        @elseif($v['quality_score']>3 && $v['quality_score']<=4)
                                            - 较为愉快
                                        @elseif($v['quality_score']>2 && $v['quality_score']<=3)
                                            - 不愉快
                                        @else
                                            - 很不愉快
                                        @endif
                                    </div>
                                    <div class="space-8"></div>
                                @endif
                            </div>
                        </span>
                        </div>
                        <div class="g-userborbtm"></div>
                    </div>
                </div>
                @endforeach
                <div class="space"></div>
                <div class="clearfix">
                    <ul class="pagination pull-right">
                        {!! $comments->appends($_GET)->render() !!}
                    </ul>
                </div>
                @else
                <div class="g-nomessage">暂无信息哦 ！</div>
                @endif

        </div>
        {{--<div class="g-nomessage">暂无信息哦 ！</div>--}}
        @else
        <div class="row close-space-tip">
            <div class="col-md-12 text-center">
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <div class="space-10"></div>
                <p class="text-size16 cor-gray87">您的店铺还没设置，暂不能发布服务！<a href="/user/shop">店铺设置</a></p>
            </div>
        </div>
        @endif
</div>



{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ownercomment','js/doc/ownercomment.js') !!}