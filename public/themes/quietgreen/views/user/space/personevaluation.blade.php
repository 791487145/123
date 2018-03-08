
        <div class="row">
            <!-- 个人简介 -->
            <div class="col-md-12 col-left">
                <div class="personal-info">
                    @if($introduce['backgroundurl']=="")
                        <img src="{!! Theme::asset()->url('images/personal_back.png') !!}" alt="" class="personal-info-back-pic" id="backgroud-img2">
                    @else()
                        <img src="{!!  $domain.'/'.$introduce['backgroundurl'] !!}" class="personal-info-back-pic" id="backgroud-img2"/>
                    @endif()
                    <div class="personal-info-words">

                    <span class="change-back-img-btn" data-toggle="modal" data-target="#myModal">
                    </span>
                        @if($introduce['avatar']=="")
                            <img src="{!! Theme::asset()->url('images/default_avatar.png') !!}" alt="" class="img-circle personal-info-pic">
                        @else()
                            <img src="{!!  $domain.'/'.$introduce['avatar'] !!}" class="img-circle personal-info-pic"/>
                        @endif()
                        <div class="personal-info-block">
                            <div class="personal-info-block-name">
                                {{--<h3>{{ $introduce['nickname'] }}</h3>--}}
                                {{--<span class="bank-attestation"></span>--}}
                                {{--<span class="cd-card-attestation"></span>--}}
                                {{--<span class="alipay-attestation"></span>--}}
                                    <h3>{!!  Auth::user()->name !!}</h3>
                                    @if($auth_user['bank'] == true)
                                        <span class="bank-attestation"></span>
                                    @else
                                        <span class="bank-attestation-no"></span>
                                    @endif

                                    @if($auth_user['realname'] == true)
                                        <span class="cd-card-attestation"></span>
                                    @else
                                        <span class="cd-card-attestation-no"></span>
                                    @endif

                                    @if(Auth::User()->email_status != 2)
                                        <span class="email-attestation-no"></span>
                                    @else
                                        <span class="email-attestation"></span>
                                    @endif

                                    @if($auth_user['alipay'] == true)
                                        <span class="alipay-attestation"></span>
                                    @else
                                        <span class="alipay-attestation-no"></span>
                                    @endif
                                <label class="open-close-space-btn">
                                    <input name="switch-field-1" class="ace ace-switch" type="checkbox" {{ ($introduce['shop_status']==1)?'checked':'' }} user_id="{{ $introduce['uid'] }}" onchange="switchStatus($(this))" >
                                    <span class="lbl"></span>
                                </label>
                            </div>
                            <p class="personal-tag hidden-xs hidden-sm">标签：
                                @if(!empty($skill_tag))
                                    @foreach($skill_tag as $item)<span>{{ $item['tag_name']}}</span>@endforeach
                                @endif
                                @if($addr)<span>{{ $addr }}</span>@endif</p>
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
        </div>
        <!-- 成功案例和评价详情 -->
        <div class="row">
            @if( $introduce['shop_status'] == 1)
            <div class="col-md-12 col-left">
                <div class="personal-case-detail-list personal-case-detail-list-active">
                    <a href="{!! URL('user/personCase') !!}" title="" class="personal-case-list personal-case-list-tit">成功案例</a>
                    <a href="{!! URL('user/personevaluation') !!}" title="" class="personal-evaluate-detail personal-active personal-case-list-tit">评价详情</a>
                    <a href="{!! URL('user/addpersoncase/2') !!}" title="" class="personal-add-case-btn">添加案例</a>
                </div>
            </div>
        </div>
        <!--评价详情 -->

        <div class="row ">
            <div class="col-md-12 col-left">
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
                                 @if($avgspeed>0 && $avgspeed <= 1)
                                     <span class="personal-evaluate-star-base-1"></span>
                                 @elseif($avgspeed>1 && $avgspeed <= 2)
                                    <span class="personal-evaluate-star-base-2"></span>
                                 @elseif($avgspeed>2 && $avgspeed <= 3)
                                     <span class="personal-evaluate-star-base-3"></span>
                                 @elseif($avgspeed>3 && $avgspeed <= 4)
                                     <span class="personal-evaluate-star-base-4"></span>
                                 @elseif($avgspeed>4 && $avgspeed <= 5)
                                     <span class="personal-evaluate-star-base-5"></span>
                                 @endif
                                </span>
                                </div>
                                <div class="personal-evaluate-starts-item">
                                    <p>工作质量：{{  $avgattitude }}分</p>
                                <span class="personal-star">
                                   @if($avgattitude>0 && $avgattitude <= 1)
                                        <span class="personal-evaluate-star-base-1"></span>
                                    @elseif($avgattitude>1 && $avgattitude <= 2)
                                        <span class="personal-evaluate-star-base-2"></span>
                                    @elseif($avgattitude>2 && $avgattitude <= 3)
                                        <span class="personal-evaluate-star-base-3"></span>
                                    @elseif($avgattitude>3 && $avgattitude <= 4)
                                        <span class="personal-evaluate-star-base-4"></span>
                                    @elseif($avgattitude>4 && $avgattitude <= 5)
                                        <span class="personal-evaluate-star-base-5"></span>
                                    @endif
                                </span>
                                </div>
                                <div class="personal-evaluate-starts-item">
                                    <p>工作态度：{{  $avgquality }}分</p>
                                <span class="personal-star">
                                   @if($avgquality>0 && $avgquality <= 1)
                                        <span class="personal-evaluate-star-base-1"></span>
                                    @elseif($avgquality>1 && $avgquality <= 2)
                                    <span class="personal-evaluate-star-base-2"></span>
                                    @elseif($avgquality>2 && $avgquality <= 3)
                                    <span class="personal-evaluate-star-base-3"></span>
                                    @elseif($avgquality>3 && $avgquality <= 4)
                                    <span class="personal-evaluate-star-base-4"></span>
                                    @elseif($avgquality>4 && $avgquality <= 5)
                                        <span class="personal-evaluate-star-base-5"></span>
                                    @endif
                                    {{--<span class="personal-evaluate-star-base-5"></span>--}}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 案例评价列表 -->
                    <div class="personal-evaluate-list">
                        @if( !empty($commentList->count()))
                        <ul>
                            @foreach($commentList as $v)
                                <li class="personal-evaluate-list-item">
                                    {{--<a href="{!! URL('user/personevaluationdetail/'.$v['task_id']) !!}" title="">--}}
                                        <div class="personal-case-evaluate-words">
                                            <h5>
                                                <span>￥{{ $v['bounty'] }}</span>
                                                <a href="/task/{{$v['task_id']}}">{{ $v['title'] }}</a>
                                            </h5>
                                            <p>评价：{{ $v['comment'] }}</p>
                                        </div>
                                        <div class="personal-case-evaluate-person-time">
                                            <p><i class="evaluate-flowers evaluate-flowersno evaluate-flowersin"></i><span class="good-evaluate">@if($v['type'] == 1)好评@elseif($v['type'] == 2)中评@elseif($v['type'] ==3)差评@endif</span> {{$v['attitude_score']}}分</p>
                                            <p><span>雇主：<span class="span-space p-space">{{ $v['name'] }}</span></span>&nbsp;<span>评价于：{{ substr($v['created_at'],0,10) }}</span></p>
                                        </div>
                                    {{--</a>--}}
                                </li>
                            @endforeach
                        </ul>
                        <!-- 底部分页 -->
                        <div class="row personal-evaluate-page">
                            <div class="col-md-12">
                                <div class="dataTables_paginate paging_bootstrap">
                                    <div class="pull-right">
                                        {!! $commentList->render() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="row">
                                <div class="col-md-12  close-space-tip">
                                    <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                                    <p>暂无评论哦！</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        {{--空间关闭提示--}}
        <div class="row close-space-tip">
            <div class="col-md-12">

                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <p>您的空间已关闭。请开启空间！</p>
            </div>
        </div>
    @endif


<!-- 切换背景模态框 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  add-case-modal" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">个性化设置</h4>
            </div>
            <form  action="/user/ajaxCasePic" method="post" enctype="multipart/form-data" id="uploadpic">

                <div class="modal-body">
                    @if($introduce['backgroundurl']=="")
                        <img src="{!! Theme::asset()->url('images/personal_back.png') !!}" id="backgroud-img" class="img-responsive">
                    @else()
                        <img src="{!!  $domain.'/'.$introduce['backgroundurl'] !!}" class="img-responsive" id="backgroud-img"/>

                    @endif
                    {{ csrf_field() }}
                    <div class="upload-case-back-btn-tips">
                        <a href="javascript:;" title="" class="upload-case-back-btn" id = "addpic">上传图片
                            <input type="file" name="back" id = "back"/>
                            <input type="hidden" name="uid" value="{{ $introduce['uid'] }}">
                        </a>


            <span class="upload-case-back-tips">
                <i class="fa  fa-exclamation-circle"></i>
                提示 最佳图片尺寸：1200*195像素
            </span>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn restore-default-btn" user_id="{{ $introduce['uid'] }}" onclick="delback($(this))">恢复默认</button>
                    <button type="button" class="btn btn-primary " id="changeBack" data-dismiss="modal">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </form>
        </div>

    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('userCase','css/usercenter/successCase/userCenterCase.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('personcase','js/doc/personcase.js') !!}
