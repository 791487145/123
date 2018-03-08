<section>
    <!--<div class="container">
        <div class="row">-->
        <div class="col-md-12 col-sm-12 col-xs-12 case-col-md-12 col-left">
            <!-- 所在位置 -->
            <div class="now-position text-size12">
                您的位置：首页 > 服务商 > 成功案例
            </div>
        </div>

        <!-- 个人简介 -->
        <div class="col-md-12 col-sm-12 col-xs-12 col-left">
            <div class="personal-info clearfix">
                @if($introduce['backgroundurl']=="")
                    {{--<img src="{!! Theme::asset()->url('images/personal_back.png') !!}" alt="" class="personal-info-back-pic" id="backgroud-img2">--}}
                @else
                    <img src="{!!  $domain.'/'.$introduce['backgroundurl'] !!}" class="personal-info-back-pic" id="backgroud-img2"/>@endif()
                <!-- 切换背景 -->
                <div class="personal-info-words clearfix">
                    @if($introduce['avatar']=="")
                        <img src="{!! Theme::asset()->url('images/default_avatar.png') !!}" alt="" class="img-circle personal-info-pic">
                    @else
                        <img src="{!!  $domain.'/'.$introduce['avatar'] !!}" class="img-circle personal-info-pic"/>
                    @endif

                    <div class="personal-info-block clearfix">
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
                            @if(CommonClass::checkEmailAuth($uid) == 2)
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
                        <p class="personal-tag hidden-md hidden-sm hidden-xs">
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
                        <div class="personal-about clearfix">
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
    @if($introduce['shop_status'] == 1)
        <!-- 成功案例和评价详情 -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="personal-case-detail-list">
                    <a href="{!! URL('bre/serviceCaseList/'.$uid) !!}" title="" class="personal-case-list personal-active">成功案例</a>
                    <a href="{!! URL('bre/serviceEvaluateDetail/'.$uid) !!}" title="" class="personal-evaluate-detail">评价详情</a>
                </div>
            </div>
        </div>
        <!-- 服务商  成功案例-->
        <div class="serivce-caseList">
            @if($listCount > 0)
                @foreach($list as $v)
                    <div class="col-lg-3 col-md-4 col-xs-6 col-sm-4 case-list-item col-left">

                            @if(!$v['pic'])
                                <a href="{!! URL('bre/serviceCaseDetail/'.$v['id'].'/'.$uid) !!}" title="">

                                    <img src="{!! Theme::asset()->url('images/case_back.png') !!}" class="img-responsive"/>
                                </a>
                            @else
                                <a href="{!! URL('bre/serviceCaseDetail/'.$v['id'].'/'.$uid) !!}" title="">
                                    <img src="{!!  $domain.'/'.$v['pic'] !!}" class="img-responsive">
                                </a>
                            @endif
                        <div class="case-list-item-name">
                            <a class="cor-gray51" href="{!! URL('bre/serviceCaseDetail/'.$v['id'].'/'.$uid) !!}" title="">
                            <p>{{ $v['title'] }}</p>
                                </a>
                        </div>
                        <div class="case-list-item-admin">
                            <span class="pull-right"><i class="fa fa-eye"></i> {{ $v['view_count'] }}人浏览</span>
                            <span class="case-tag pull-left"> <i class="fa fa-tag "></i> {{ $v['cate_name']}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pull-right">
                {!! $list->render() !!}
            </div>
        @else
        <div class="row">
            <div class="col-md-12  close-space-tip center">
                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <p>暂无成功案例哦！</p>
            </div>
        </div>
        @endif
    @else($introduce['shop_status] == 2)
        <div class="col-md-12 center">
            <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}">
            <p>该空间已经关闭，请等候服务商开启 ！</p>
        </div>

        @endif

<!--</div>
</div>-->
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
                            <span>标题：</span> </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-1" name="title" class="col-xs-10 col-sm-12 title">
                            <input type="hidden" name="js_id" class="js_id" value="{{$uid}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                            <span>内容：</span> </label>

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


{!! Theme::asset()->container('custom-css')->usepath()->add('serviceCase','css/serivceCase.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('serviceCase','js/doc/serviceCase.js') !!}