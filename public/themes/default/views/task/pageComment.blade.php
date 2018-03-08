
<div class="tab-content bg-white task-taskdisplay">
    <ul class="nav nav-pills mg-margin">
        <li class="{{ (!isset($merge['evaluate_type']) && !isset($merge['evaluate_type']))?'active ':'' }}"><a href="javascript:void(0)" onclick="ajaxPageComment($(this))" url="{{ URL('task/ajaxPageComment/').'/'.$detail['id'] }}" >全部</a></li>
        <li class="{{ (isset($merge['evaluate_type']) && $merge['evaluate_type']==1)?'active ':'' }}"><a href="javascript:void(0)" onclick="ajaxPageComment($(this))" url="{{ URL('task/ajaxPageComment/').'/'.$detail['id'].'?'.http_build_query(['evaluate_type'=>1]) }}">好评<span> ({{ $good_comment }})</span></a></li>
        <li class="{{ (isset($merge['evaluate_type']) && $merge['evaluate_type']==2)?'active ':'' }}"><a href="javascript:void(0)" onclick="ajaxPageComment($(this))" url="{{ URL('task/ajaxPageComment/').'/'.$detail['id'].'?'.http_build_query(['evaluate_type'=>2]) }}">中评<span> ({{ $middle_comment }})</span></a></li>
        <li class="{{ (isset($merge['evaluate_type']) && $merge['evaluate_type']==3)?'active ':'' }}"><a href="javascript:void(0)" onclick="ajaxPageComment($(this))" url="{{ URL('task/ajaxPageComment/').'/'.$detail['id'].'?'.http_build_query(['evaluate_type'=>3]) }}">差评<span> ({{ $bad_comment }})</span></a></li>
        <li class="{{ (isset($merge['evaluate_from']) && $merge['evaluate_from']==1)?'active ':'' }}"><a href="javascript:void(0)" onclick="ajaxPageComment($(this))" url="{{ URL('task/ajaxPageComment/').'/'.$detail['id'].'?'.http_build_query(['evaluate_from'=>1]) }}">给威客</a></li>
        <li class="{{ (isset($merge['evaluate_from']) && $merge['evaluate_from']==2)?'active ':'' }}"><a href="javascript:void(0)" onclick="ajaxPageComment($(this))" url="{{ URL('task/ajaxPageComment/').'/'.$detail['id'].'?'.http_build_query(['evaluate_from'=>2]) }}">给雇主</a></li>
    </ul>
</div>
@if(!empty($comment['data']))
@foreach($comment['data'] as $v)
    <div class="bidrecords">
        <div class="evaluate">
            <div class="record">
                <div class="row">
                    <div class="col-md-1 evaluateimg"><img src="{{ CommonClass::getDomain().'/'.$v['avatar'] }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))"></div>
                    <div class="col-md-11 evaluatemain">
                        <div class="evaluateinfo">
                            <div>
                                <p><b>{{ $v['nickname'] }}</b>
                                    @if($v['type']==1)
                                        <span class="flower1">好评</span>
                                    @elseif($v['type']==2)
                                        <span class="flower2">中评</span>
                                    @elseif($v['type']==3)
                                        <span class="flower3">差评</span>
                                    @endif
                                </p>
                                <p class="evaluatetime">提交于{{ date('Y-m-d H:i:s',strtotime($v['created_at'])) }}</p>
                            </div>
                        </div>
                        <div class="evaluatext">{{ $v['comment'] }}</div>
                        <div class="recordstar">
                            @if($detail['uid']!=$v['to_uid'])
                                <div class="mg-right visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-inline-block">
                                    工作速度：
                                    @for($i=0;$i<$v['speed_score'];$i++)
                                        <span class="rec-active"></span>
                                    @endfor
                                    @for($i=0;$i<(5-$v['speed_score']);$i++)
                                        <span></span>
                                    @endfor
                                </div>
                                <div class="mg-right visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-inline-block">
                                    工作质量：
                                    @for($i=0;$i<$v['quality_score'];$i++)
                                        <span class="rec-active"></span>
                                    @endfor
                                    @for($i=0;$i<(5-$v['quality_score']);$i++)
                                        <span></span>
                                    @endfor
                                </div>
                                <div class="visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-inline-block">
                                    工作态度：
                                    @for($i=0;$i<$v['attitude_score'];$i++)
                                        <span class="rec-active"></span>
                                    @endfor
                                    @for($i=0;$i<(5-$v['attitude_score']);$i++)
                                        <span></span>
                                    @endfor
                                </div>
                            @else
                                <div class="mg-right visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-inline-block">
                                    付款及时性：
                                    @for($i=0;$i<$v['speed_score'];$i++)
                                        <span class="rec-active"></span>
                                    @endfor
                                    @for($i=0;$i<(5-$v['speed_score']);$i++)
                                        <span></span>
                                    @endfor
                                </div>
                                <div class="mg-right visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-inline-block">
                                    合作愉快：
                                    @for($i=0;$i<$v['quality_score'];$i++)
                                        <span class="rec-active"></span>
                                    @endfor
                                    @for($i=0;$i<(5-$v['quality_score']);$i++)
                                        <span></span>
                                    @endfor
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="pull-right">
    <ul class="pagination ">
        @if(!empty($comment['prev_page_url']))
            <li><a href="javascript:void(0)" onclick="ajaxPageComment($(this))" url="{!! URL('task/ajaxPageComment').'/'.$detail['id'].'?'.http_build_query(array_merge($merge,['page'=>$comment['current_page']-1])) !!}">«</a></li>
        @elseif($comment['last_page']>1)
            <li class="disabled"><span>«</span></li>
        @endif
        @if($comment['last_page']>1)
            @for($i=1;$i<=$comment['last_page'];$i++)
                <li class="{{ ($i==$comment['current_page'])?'active disabled':'' }}"><a href="javascript:void(0)" onclick="ajaxPageComment($(this))" url="{!! URL('task/ajaxPageComment').'/'.$detail['id'].'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
            @endfor
        @endif
        @if(!empty($comment['next_page_url']))
            <li><a href="javascript:void(0)" onclick="ajaxPageComment($(this))" url="{!! URL('task/ajaxPageComment').'/'.$detail['id'].'?'.http_build_query(array_merge($merge,['page'=>$comment['current_page']+1])) !!}">»</a></li>
        @elseif($comment['last_page']>1)
            <li class="disabled"><span>»</span></li>
        @endif
    </ul>
</div>
@else
<div class="norecord">
    <div class="tab-content text-center text-gray">
        <h2><i class="fa fa-exclamation-circle"></i></h2>
        <p>暂无消息</p>
    </div>
</div>
@endif