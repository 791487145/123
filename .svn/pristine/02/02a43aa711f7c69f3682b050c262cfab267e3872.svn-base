<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="">
                <a  href="/manage/serviceInfo/{!! $id !!}">服务信息</a>
            </li>

            <li class="active">
                <a  href="">评价</a>
            </li>
        </ul>
    </div>
</div>

<form action="" method="post" name="seo-form">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="">
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
            @if($comment_list['total']>0)
                @foreach($comment_list['data'] as $v)
                    <div class="form-group interface-bottom col-xs-12">
                        <div class="col-sm-1 record">
                            <span class="flower1">
                                @if($v['type'] == 0)好评
                                @elseif($v['type'] == 1)中评
                                @elseif($v['type'] == 2)差评
                                @endif
                            </span>
                        </div>
                        <div class="col-sm-10 g-message">
                            <div class="col-sm-3">
                                <b>{!! $v['title'] !!}</b> 评价
                            </div>
                            <div class="col-sm-3">
                                <b>评价时间：</b> {!! $v['created_at'] !!}
                            </div>
                            <div class="col-sm-4 s-myborder ">
                        <span class="cor-gray87 z-hov">
                            综合评分：
                            <span class="cor-orange">
                                {!! round(($v['speed_score']+$v['quality_score']+$v['attitude_score'])/3,1) !!}
                            </span><i class="u-evaico"></i>
                            <div class="u-recordstar b-border ">
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
                        </span>
                            </div>
                            <div class="space-14"></div>
                            <p class="col-sm-12">{!! $v['comment'] !!}</p>
                        </div>
                    </div>
                @endforeach
                {{--分页--}}
                <div class="col-xs-12">
                    <div class="dataTables_paginate paging_bootstrap text-right">
                        <ul class="">
                            {!! $comments->render() !!}
                        </ul>
                    </div>
                </div>
            @endif

            <div class="col-xs-12">
                <label class="col-sm-1" for="form-field-1"></label>

                <div class="col-sm-9">
                    <div class="col-sm-9">
                        <a href="/manage/serviceComments/{!! $pre_id !!}">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/manage/serviceList">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/manage/serviceComments/{!! $next_id !!}">下一项</a>
                        <div class="space"></div>
                    </div>
                </div>
            </div>
        </div>
</form>
{!! Theme::widget('editor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ownercomment','js/doc/ownercomment.js') !!}