<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="">
                <a  href="/manage/goodsInfo/{!! $id !!}">作品信息</a>
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
        @if(!empty($comment_list['comment_list']->toArray()['data']))
            @foreach($comment_list['comment_list']->toArray()['data'] as $item)
                <div class="form-group interface-bottom col-xs-12">
                <div class="col-sm-1 record">
                    <span class="flower1">
                        @if($item['type'] == 0)好评
                        @elseif($item['type'] == 1)中评
                        @elseif($item['type'] == 2)差评
                        @endif
                    </span>
                </div>
                <div class="col-sm-10 g-message">
                    <div class="col-sm-3">
                        <b>{!! $item['name'] !!}</b> 评价
                    </div>
                    <div class="col-sm-3">
                        <b>评价时间：</b> {!! $item['created_at'] !!}
                    </div>
                    <div class="col-sm-4 s-myborder ">
                        <span class="cor-gray87 z-hov">
                            综合评分：
                            <span class="cor-orange">
                                {!! round(($item['speed_score']+$item['quality_score']+$item['attitude_score'])/3,1) !!}
                            </span><i class="u-evaico"></i>
                            <div class="u-recordstar b-border ">
                                <div>
                                    工作速度：
                                    @if($item['speed_score']>0 && $item['speed_score'] <= 1)
                                        <span class="rec-active"></span>
                                    @elseif($item['speed_score']>1 && $item['speed_score'] <= 2)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @elseif($item['speed_score']>2 && $item['speed_score'] <= 3)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @elseif($item['speed_score']>3 && $item['speed_score'] <= 4)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @elseif($item['speed_score']>4 && $item['speed_score'] <= 5)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @endif
                                    <a class="cor-orange mg-left">{!! $item['speed_score'] !!}分 </a>
                                    - @if($item['speed_score']>0 && $item['speed_score'] <= 1)
                                        速度很慢
                                    @elseif($item['speed_score']>1 && $item['speed_score'] <= 2)
                                        速度慢
                                    @elseif($item['speed_score']>2 && $item['speed_score'] <= 3)
                                        速度一般
                                    @elseif($item['speed_score']>3 && $item['speed_score'] <= 4)
                                        速度快
                                    @elseif($item['speed_score']>4 && $item['speed_score'] <= 5)
                                        速度很快
                                    @endif
                                </div>
                                <div class="space-8"></div>
                                <div>
                                    工作质量：
                                    @if($item['quality_score']>0 && $item['quality_score'] <= 1)
                                        <span class="rec-active"></span>
                                    @elseif($item['quality_score']>1 && $item['quality_score'] <= 2)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @elseif($item['quality_score']>2 && $item['quality_score'] <= 3)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @elseif($item['quality_score']>3 && $item['quality_score'] <= 4)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @elseif($item['quality_score']>4 && $item['quality_score'] <= 5)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @endif
                                    <a class="cor-orange mg-left">{!! $item['quality_score'] !!}分 </a>
                                    - @if($item['quality_score']>0 && $item['quality_score'] <= 1)
                                        质量很低
                                    @elseif($item['quality_score']>1 && $item['quality_score'] <= 2)
                                        质量低
                                    @elseif($item['quality_score']>2 && $item['quality_score'] <= 3)
                                        质量一般
                                    @elseif($item['quality_score']>3 && $item['quality_score'] <= 4)
                                        质量高
                                    @elseif($item['quality_score']>4 && $item['quality_score'] <= 5)
                                        质量很高
                                    @endif
                                </div>
                                <div class="space-8"></div>
                                <div>
                                    工作态度：
                                    @if($item['attitude_score']>0 && $item['attitude_score'] <= 1)
                                        <span class="rec-active"></span>
                                    @elseif($item['attitude_score']>1 && $item['attitude_score'] <= 2)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @elseif($item['attitude_score']>2 && $item['attitude_score'] <= 3)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @elseif($item['attitude_score']>3 && $item['attitude_score'] <= 4)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @elseif($item['attitude_score']>4 && $item['attitude_score'] <= 5)
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                        <span class="rec-active"></span>
                                    @endif
                                    <a class="cor-orange mg-left">{!! $item['attitude_score'] !!}分 </a>
                                    - @if($item['attitude_score']>0 && $item['attitude_score'] <= 1)
                                        态度很差
                                    @elseif($item['attitude_score']>1 && $item['attitude_score'] <= 2)
                                        态度差
                                    @elseif($item['attitude_score']>2 && $item['attitude_score'] <= 3)
                                        态度一般
                                    @elseif($item['attitude_score']>3 && $item['attitude_score'] <= 4)
                                        态度好
                                    @elseif($item['attitude_score']>4 && $item['attitude_score'] <= 5)
                                        态度很好
                                    @endif
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="space-14"></div>
                    <p class="col-sm-12">{!! $item['comment_desc'] !!}</p>
                </div>
            </div>
            @endforeach

                {{--分页--}}
                <div class="col-sm-6">
                    <div class="dataTables_paginate paging_bootstrap text-right">
                        <ul class="pagination">
                            {!! $comment_list['comment_list']->appends($merge)->render() !!}
                        </ul>
                    </div>
                </div>
            @endif

            <div class="form-group basic-form-bottom">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"></label>

                <div class="col-sm-9">
                    <div class="col-sm-9">
                        <a href="/manage/goodsComment/{!! $pre_id !!}">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/manage/goodsList">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/manage/goodsComment/{!! $next_id !!}">下一项</a>
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