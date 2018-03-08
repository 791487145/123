<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 case-col-md-12 col-left">
                <!-- 所在位置 -->
                <div class="now-position text-size12">
                    您的位置：首页 > 服务商 > 个人空间 > 评价详情
                </div>
            </div>
            <!-- 个人简介 -->
            <div class="col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="personal-info">
                    @if($introduce['backgroundurl']=="")
                        <img src="{!! Theme::asset()->url('images/personal_back.png') !!}" alt="" class="personal-info-back-pic" id="backgroud-img2">
                    @else()
                        <img src="{!!  $domain.'/'.$introduce['backgroundurl'] !!}" class="personal-info-back-pic" id="backgroud-img2"/>
                        @endif()
                                <!-- 切换背景 -->
                        <div class="personal-info-words">
                            @if($introduce['avatar']=="")
                                <img src="{!! Theme::asset()->url('images/default_avatar.png') !!}" alt="" class="img-circle personal-info-pic">
                            @else()
                                <img src="{!!  $domain.'/'.$introduce['avatar'] !!}" class="img-circle personal-info-pic"/>
                            @endif()
                    <div class="personal-info-block">
                        <div class="personal-info-block-name">
                            <h3>{!!  $user->name !!}</h3>
                            @if(CommonClass::getUserAuthData($uid,'bank'))
                                <span class="bank-attestation"></span>
                            @else
                                <span class="bank-attestation-no"></span>
                            @endif
                            @if(CommonClass::getUserAuthData($uid,'realname'))
                                <span class="cd-card-attestation"></span>
                            @else
                                <span class="cd-card-attestation-no"></span>
                            @endif
                            @if($user->email_status == 2)
                                <span class="email-attestation"></span>
                            @else
                                <span class="email-attestation-no"></span>
                            @endif
                            @if(CommonClass::getUserAuthData($uid,'alipay'))
                                <span class="alipay-attestation"></span>
                            @else
                                <span class="alipay-attestation-no"></span>
                            @endif
                            @if(Auth::check())
                                @if(!empty($is_focus))
                                    <a class="followed-me" id="focus_uid" focus_uid = {{ $uid }}> <i class="glyphicon glyphicon-minus"></i>已关注 </a>
                                @else
                                    <a class="follow-me" id="focus_uid"  focus_uid = {{ $uid }}> <i class="glyphicon glyphicon-plus"></i>加关注 </a>
                                @endif
                            @endif
                        </div>

                        <p class="personal-tag hidden-xs hidden-sm hidden-md">
                            标签：
                            @if($skill_tag || $addr)
                                @if(!empty($skill_tag))
                                    @foreach($skill_tag as $item)<span>{{ $item['tag_name']}}</span>@endforeach
                                @endif
                                @if($addr)<span>{{ $addr }}</span>@endif
                            @else
                                这家伙很懒什么也没留下！
                            @endif

                            @if(Auth::check())
                            <a class="contact-me" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-envelope"></i>联系我</a>
                            @endif
                        </p>

                        <div class="personal-about">
                            <span>简介：</span>
                            @if(!empty($introduce['introduce']))
                                <p> {{ $introduce['introduce'] }}</p>
                            @else
                                <p>这家伙很懒什么也没留下！</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 成功案例和评价详情 -->
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="personal-case-detail-list">
                    <a href="{!! URL('bre/serviceEvaluateDetail/'.$uid) !!}" title="" class="personal-evaluate-detail personal-active">评价详情</a>
                </div>
            </div>
        </div>
        <!-- 服务商  评价详情-->


        <div class="row ">
            <div class="col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="personal-evaluate-area">
                    <!-- 总评 -->
                    <div class="personal-total-evaluate">
                        <!-- 总体评价数量 -->
                        <div class="personal-total-evaluate-num">
                            <span class="personal-evaluate-cicle-title">总体评价</span>
                            <div class="personal-good-evaluate">
                                <p>好评率：<span>{{ $feedbackRete }}%</span></p>
                                <p>好评数量：<span>{{ $count }}</span>个</p>
                            </div>
                        </div>
                        <!-- 总体评分 -->
                        <div class="personal-total-evaluate-point">
                            <span class="personal-evaluate-cicle-title">总体评分</span>
                            <div class="personal-evaluate-starts-list">
                                <div class="personal-evaluate-starts-item">
                                    <p>工作速度：{{ $avgspeed }}分</p>
                                     <span class="personal-star">
                                        @if($avgspeed > 0 && $avgspeed <= 1)
                                        <span class="personal-evaluate-star-base-1"></span>
                                        @elseif($avgspeed > 1 && $avgspeed <= 2)
                                        <span class="personal-evaluate-star-base-2"></span>
                                        @elseif($avgspeed > 2 && $avgspeed <= 3)
                                        <span class="personal-evaluate-star-base-3"></span>
                                        @elseif($avgspeed > 3 && $avgspeed <= 4)
                                        <span class="personal-evaluate-star-base-4"></span>
                                        @elseif($avgspeed > 4 && $avgspeed <= 5)
                                        <span class="personal-evaluate-star-base-5"></span>
                                        @endif
                                     </span>
                                </div>
                                <div class="personal-evaluate-starts-item">
                                    <p>工作质量：{{  $avgattitude }}分</p>
                                     <span class="personal-star">
                                        @if($avgattitude > 0 && $avgattitude <= 1)
                                        <span class="personal-evaluate-star-base-1"></span>
                                        @elseif($avgattitude > 1 && $avgattitude <= 2)
                                        <span class="personal-evaluate-star-base-2"></span>
                                        @elseif($avgattitude > 2 && $avgattitude <= 3)
                                        <span class="personal-evaluate-star-base-3"></span>
                                        @elseif($avgattitude > 3 && $avgattitude <= 4)
                                        <span class="personal-evaluate-star-base-4"></span>
                                        @elseif($avgattitude > 4 && $avgattitude <= 5)
                                        <span class="personal-evaluate-star-base-5"></span>
                                        @endif
                                     </span>
                                </div>
                                <div class="personal-evaluate-starts-item">
                                    <p>工作态度：{{  $avgquality }}分</p>
                                     <span class="personal-star">
                                        @if($avgquality > 0 && $avgquality <= 1)
                                        <span class="personal-evaluate-star-base-1"></span>
                                        @elseif($avgquality > 1 && $avgquality <= 2)
                                        <span class="personal-evaluate-star-base-2"></span>
                                        @elseif($avgquality > 2 && $avgquality <= 3)
                                        <span class="personal-evaluate-star-base-3"></span>
                                        @elseif($avgquality > 3 && $avgquality <= 4)
                                        <span class="personal-evaluate-star-base-4"></span>
                                        @elseif($avgquality > 4 && $avgquality <= 5)
                                        <span class="personal-evaluate-star-base-5"></span>
                                        @endif
                                     </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 案例评价列表 -->
                    <div class="personal-evaluate-list">
                        @if($commentListCount > 0)
                        <ul>
                            @foreach($commentList as $v)
                                <li class="personal-evaluate-list-item">
                                    {{--<a href="{!! URL('bre/serviceCaseDetail/'.$v['task_id'].'/'.$uid) !!}" title="">--}}
                                        <div class="personal-case-evaluate-words">
                                            <h5>
                                                <span>￥{{ $v['bounty'] }}</span>
                                                <a href="/task/{{$v['task_id']}}">{{ $v['title'] }}</a>
                                            </h5>
                                            <p>评价：{{ $v['comment'] }}</p>
                                        </div>
                                        <div class="personal-case-evaluate-person-time">
                                            <p class="text-size14"><i class="evaluate-flowers"></i><span>@if($v['type'] == 1)好评@elseif($v['type'] == 2)中评@elseif($v['type'] ==3)差评@endif</span> {{$v['attitude_score']}}分</p>
                                            <p>雇主：<i class="p-space">{{ $v['name'] }}</i>  评价于：{{ substr($v['created_at'],0,10) }}</p>
                                        </div>
                                    {{--</a>--}}
                                </li>
                            @endforeach


                        </ul>
                        @else
                            <div class="row">
                                <div class="col-md-12  close-space-tip center">
                                    <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                                    <p>暂无评论哦！</p>
                                </div>
                            </div>
                        @endif

                        @if($commentListCount > 0)
                        <!-- 底部分页 -->
                        <div class="row personal-evaluate-page">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="dataTables_paginate paging_bootstrap">

                                    <div class="pull-right">
                                        {!! $commentList->render() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
</section>

<!-- 联系我模态框 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  contact-me-modal" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-size14" id="myModalLabel">联系TA</h4>
            </div>
            <form class="form-horizontal" action="seriveceCaseDetail_submit" method="post" accept-charset="utf-8">

                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                            标题： </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-1" name="title" class="col-xs-10 col-sm-12 title">
                            <input type="hidden" name="js_id" class="js_id" value="{{$uid}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                            内容： </label>

                        <div class="col-sm-9">
                            <textarea class="form-control col-xs-10 col-sm-5 content" id="form-field-8" name="content"></textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="btn_primary">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('serviceEvaluateDetail','css/serivceCase.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('serviceCase','js/doc/serviceCase.js') !!}