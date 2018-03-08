<div class="text-size14 cor-gray51 clearfix record">
    <div class="col-xs-12 task-mediaAssessR pd-padding0">
        <label class="evaluate-back">
            <input name="type" type="radio" class="ace ajaxchangetype" {{ ($type==1 || $type==0)?'checked':'' }} value=1 url="{{ URL('shop/ajaxServiceComments').'?type=1&id='.$id }}">
            <span class="lbl"> <span class="flower4">好评</span></span>&nbsp;&nbsp;&nbsp;
        </label>
        <label class="evaluate-back">
            <input name="type" type="radio" class="ace ajaxchangetype" {{ ($type==2)?'checked':'' }} value="2" url="{{ URL('shop/ajaxServiceComments').'?type=2&id='.$id }}">
            <span class="lbl"> <span class="flower5">中评</span></span>&nbsp;&nbsp;&nbsp;
        </label>
        <label>
            <input name="type" type="radio" class="ace ajaxchangetype" {{ ($type==3)?'checked':'' }} value="3" url="{{ URL('shop/ajaxServiceComments').'?type=3&id='.$id }}">
            <span class="lbl"> <span class="flower6">差评</span></span>
        </label>
    </div>
</div>
@if($comments_toArray['total']>0)
    <ul>
        @foreach($comments_toArray['data'] as $v)
            <li class="personal-evaluate-list-item">
                <div class="personal-case-evaluate-words personal-shop-evaluate">
                    <h5>
                        {{--<span>￥1000</span>--}}
                        <a href="/task/740">{{ $v['title'] }}</a>
                    </h5>
                    <p>评价：{{ $v['comment'] }}</p>
                </div>
                <div class="personal-case-evaluate-person-time personal-shop-evaluate-time pull-right text-right">
                    <div class="z-hov">
                        @if($v['type'] == 1)
                            <i class="evaluate-flowers"></i>
                            <span class="good-evaluate">好评</span>
                        @elseif($v['type'] == 2)
                            <i class="evaluate-flowers evaluate-flowersin"></i>
                            <span class="good-evaluate">中评</span>
                        @else
                            <i class="evaluate-flowers evaluate-flowersno"></i>
                            <span class="good-evaluate">差评</span>
                        @endif
                        {{ $v['total_score'] }}分
                        <i class="u-evaico"></i>
                        <div class="u-recordstar b-border">
                            <div>
                                工作速度：
                                @for($i=0;$i<$v['speed_score'];$i++)
                                    <span class="rec-active"></span>
                                @endfor
                                @for($i=0;$i<(5-$v['speed_score']);$i++)
                                    <span ></span>
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
                                    <span ></span>
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
                                    <span class="rec-active"></span>
                                @endfor
                                @for($i=0;$i<(5-$v['attitude_score']);$i++)
                                    <span ></span>
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
                        </div>
                    </div>
                    <div class="space-6"></div>
                    <p><span>雇主：<span class="span-space p-space">{{ $v['user_name'] }}</span></span>&nbsp;<span>评价于：{{ date('Y-m-d',strtotime($v['created_at'])) }}</span></p>
                </div>
            </li>
        @endforeach
    </ul>
    <!-- 底部分页 -->
    <div class="space-6"></div>
    <div class="row personal-evaluate-page">
        <div class="col-md-12">
            <div class="dataTables_paginate paging_bootstrap">
                {!! $comments->appends(['type'=>$type,'id'=>$id])->render() !!}
            </div>
        </div>
    </div>
    <div class="space-6"></div>
@else
    <div class="row close-space-tip">
        <div class="col-md-12 text-center">
            <div class="space"></div>
            <div class="space"></div>
            <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
            <div class="space-10"></div>
            <p class="text-size16 cor-gray87">暂无评价</p>
            <div class="space-32"></div>
        </div>
    </div>
@endif
<script>
    $('.pagination').find('li').find('a').on('click',function(){
        var url = $(this).attr('href');
        $.get(url,function(data){
            $('#ajaxcomments').html(data);

        });
        return false;
    })
    //ajax评论
    var switchs = 1;
    $('.ajaxchangetype').on('click',function(){
        $('.ajaxchangetype').attr("disabled","disabled");
        ajaxComment(switchs,$(this));
    })
    function ajaxComment(switchs,obj)
    {
        var url = obj.attr('url');
        if(switchs==1) {
            switchs = 0;
            $.get(url, function (data) {
                $('#ajaxcomments').html(data);
                var switchs = 1;
            });
        }
    }
</script>