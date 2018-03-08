<section>
    <!--<div class="container">
        <div class="row">-->
                <!-- 所在位置 -->
                <div class="now-position text-size12 col-sm-12 col-xs-12 col-left">
                    您的位置：首页 > 服务商 > 个人空间 > 评价详情
                </div>
            <!-- 个人简介 -->
            <div class="col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="personal-info">
                    @if($introduce['backgroundurl']=="")
                        <img src="{!! Theme::asset()->url('images/personal_back.png') !!}" alt="" class="personal-info-back-pic" id="backgroud-img2">
                    @else
                        <img src="{!!  $domain.'/'.$introduce['backgroundurl'] !!}" class="personal-info-back-pic" id="backgroud-img2"/>
                        @endif
                                <!-- 切换背景 -->
                        <div class="personal-info-words">
                            @if($introduce['avatar']=="")
                                <img src="{!! Theme::asset()->url('images/default_avatar.png') !!}" alt="" class="img-circle personal-info-pic">
                            @else
                                <img src="{!!  $domain.'/'.$introduce['avatar'] !!}" class="img-circle personal-info-pic"/>
                            @endif
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
                        <p class="personal-tag">标签：
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

        <!-- 服务商  成功案例 案例详情-->


            <div class="col-md-12 col-sm-12 col-xs-12 col-left">
                <!-- 案例内容 -->
                <div class="personal-case-detail-main-area">
                    <div class="personal-case-detail-title-name">
                        <h4>{{ $successCase['title'] }}</h4>
                        <p>
                            行业标签：
                            <span class="personal-case-detail-tags">{{ $successCase['name'] }}</span>

                            <span class="personal-case-detail-time">发布时间：{{ date('Y年m月d日',strtotime($successCase['created_at'])) }}</span>
                        </p>
                    </div>
                    <div class="personal-case-detail-info-words">
                        {!! htmlspecialchars_decode($successCase['desc']) !!}
                        {{--<div class="personal-case-detail-info-img">--}}
                            {{--<img src="../../images/news_pic_banner.png" alt="" class="img-responsive">--}}
                          {{--  @if($successCase['pic'])
                                <img src="{{$domain.'/'.$successCase['pic'] }}" alt="" class="img-circle">
                            @endif
                        </div>--}}
                            {{--<img src="../../images/news_pic_banner.png" alt="" class="img-responsive">--}}
                            <!-- img 使用模板 只需要替换src即可 class保持不变 用完即删
                            <img src="{!! Theme::asset()->url('images/personal_pic.png') !!}" alt="" class="img-circle personal-info-pic"> -->
                        {{--</div>--}}
                    </div>
                </div>
            </div>

    <!--</div>
    </div>-->
</section>

<!-- 联系我模态框 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  contact-me-modal" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">联系TA</h4>
            </div>
            <form class="form-horizontal" action="seriveceCaseDetail_submit" method="post" accept-charset="utf-8">

                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-3 col-xs-3 control-label no-padding-right" for="form-field-1">
                            <strong>标题：</strong> </label>

                        <div class="col-sm-9 col-xs-9">
                            <input type="text" id="form-field-1" name="title" class="col-xs-10 col-sm-5 title">
                            <input type="hidden" name="js_id" class="js_id" value="{{$uid}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-xs-3 control-label no-padding-right" for="form-field-1">
                            <strong>内容：</strong> </label>

                        <div class="col-sm-9 col-xs-9">
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


{!! Theme::asset()->container('custom-css')->usepath()->add('serviceCase','css/serivceCase.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('serviceCase','js/doc/serviceCase.js') !!}