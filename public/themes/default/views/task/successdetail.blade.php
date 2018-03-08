
<div class="col-lg-12 col-sm-12 col-xs-12 case-col-md-12 col-left">
    <!-- 所在位置 -->
    <div class="now-position text-size14">
        您的位置：首页>成功案例>详情页
    </div>
</div>
@if(isset($user_data) && $success_case['type']==1)
<div class="col-lg-12 col-md-12  col-sm-12 col-xs-12 col-left">
    <div class="personal-info personal-uesrimg" style="background: url('{{ !empty($user_detail['backgroundurl'])?$user_detail['backgroundurl']:Theme::asset()->url('images/personal_back.png') }}') center no-repeat #000;">
        <!-- 切换背景 -->
        <img class="img-circle personal-info-pic" src="{{ $domain.'/'.$user_detail['avatar'] }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
        <div class="personal-info-block clearfix">
            <div class="personal-info-block-name clearfix">
                <h3>{{ $user_data['name'] }}</h3>
                @if(CommonClass::getUserAuthData($user_data['id'],'bank'))
                <span class="bank-attestation"></span>
                @else
                <span class="bank-attestation-no"></span>
                @endif
                @if(CommonClass::getUserAuthData($user_data['id'],'realname'))
                <span class="cd-card-attestation"></span>
                @else
                <span class="cd-card-attestation-no"></span>
                @endif
                @if(CommonClass::checkEmailAuth($user_data['id']) == 2)
                    <span class="email-attestation"></span>
                @else
                    <span class="email-attestation-no"></span>
                @endif
                @if(CommonClass::getUserAuthData($user_data['id'],'alipay'))
                <span class="alipay-attestation"></span>
                @else
                <span class="alipay-attestation-no"></span>
                @endif
                @if(CommonClass::focusCheck(Auth::user()['id'],$user_data['id'])==1 && Auth::check())
                    <a class="followed-me" id="focus_uid" focus_uid = {{ $user_data['id'] }}><i class="glyphicon glyphicon-minus"></i>已关注</a>
                @else
                    <a class="follow-me" id="focus_uid" focus_uid = {{ $user_data['id'] }}><i class="glyphicon glyphicon-plus"></i>加关注</a>
                @endif
                <a class="contact-me hidden-lg follow-contact-me"  data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-envelope"></i>联系我</a>
            </div>
            <p class="personal-tag hidden-md hidden-sm hidden-xs">标签：
                @if(!empty($tags))
                    @foreach($tags as $v)
                        <span tag_num="{{ count($tags) }}">{{ $v['tag_name'] }}</span>
                    @endforeach
                    @if(!empty($user_detail['city']))
                        <span style="display:none;">
                            {{ $region = CommonClass::getRegion($user_detail['city']) }}
                        </span>
                        <span>{{ $region }}</span>
                    @endif
                    @if(empty($user_detail['city']) && count($tags)==0)
                        这个人很懒什么都没有留下
                    @endif
                    <a class="contact-me"  data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-envelope"></i>联系我</a>
                @endif
            </p>
            <div class="personal-about">
                <span>简介：</span>
                <p>{{ !empty($user_detail['introduce'])?$user_detail['introduce']:'这个人很懒什么都没有留下' }}</p>
            </div>
        </div>
    </div>
</div>
@endif
<div class="space"></div>
<!-- 成功案例 -->
<div class=" case-detail clearfix">
    <!-- main -->
    <div class="col-lg-9 col-md-12  col-sm-12 col-xs-12 col-left">
        <!-- 案例内容 -->
        <div class="col-md-12 case-detail-main-area case-container-main">
            <div class="case-detail-title-name">
                <h4>{{ $success_case['title'] }}</h4>
                <p>
                    行业标签：
                    <span class="case-detail-tags">{{ $success_case['name'] }}</span>
                    <span class="case-detail-time">发布时间：{{ date('Y年m月d天',strtotime($success_case['created_at'])) }}</span>
                </p>
            </div>
            <div class="case-detail-info-words clearfix">
               {!! htmlspecialchars_decode($success_case['desc']) !!}
                {{--分享--}}
                <div class="clearfix">
                    <div class="bdsharebuttonbox pull-right" data-tag="share_1">
                        <div class="shop-sharewrap">
                            <!-- JiaThis Button BEGIN -->
                            <div class="jiathis_style">
                                <span class="jiathis_txt">分享：&nbsp;</span>
                                <a class="jiathis_button_tsina"></a>
                                <a class="jiathis_button_weixin"></a>
                                <a class="jiathis_button_qzone"></a>
                                <a class="jiathis_button_tqq"></a>
                                <a class="jiathis_button_cqq"></a>
                                <a class="jiathis_button_douban"></a>
                            </div>
                            <script type="text/javascript" >
                                var jiathis_config={
                                    summary:"",
                                    shortUrl:false,
                                    hideMore:false
                                }
                            </script>
                            <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
                            <!-- JiaThis Button END --></div>
                        <div class="shop-share"></div>
                    </div>
                </div>
            </div>
        </div>
        @if(count($ad))
            <div class="personal-case-detail-info-img">
                <a href="{!! $ad[0]['ad_url'] !!}"><img src="{!! URL($ad[0]['ad_file']) !!}" alt="" class="img-responsive"></a>
            </div>
        @endif

    </div>
    <!-- side -->
    <div class="col-lg-3 case-detail-side hidden-xs hidden-sm hidden-md col-left">
        <div class="case-detail-side-img">
            <div>
                @if(count($rightAd))
                <a href="{!! $rightAd[0]['ad_url'] !!}"><img src="{!! URL($rightAd[0]['ad_file']) !!}" /></a>
                @else
                <img src="{{ Theme::asset()->url('images/news_pic_side.png') }}" />
                @endif
            </div>
        </div>

        <div class="space-8"></div>
        @if(count($hotList))
        <div class="case-detail-about">
            <div class="clearfix case-detail-about-title"><b class="pull-left cor-gray51 text-size14">{!! $targetName !!}</b><a class="pull-right" href="{!! URL('task/successCase') !!}">More></a></div>
            <ul>
                @foreach($hotList as $v)
                <li class="clearfix">
                    <div class="pull-left">{{--<img src="../../images/mybg.png">--}}<a href="{!!$v['url']!!}"><img src="{!! URL($v['recommend_pic']) !!}"></a></div>
                    <div class="pull-left case-detail-about-info">
                        <a class="cor-gray51 case-detail-about-info-name" href="{!!$v['url']!!}">{!! $v['recommend_name'] !!}</a>
                        <div class="space-4"></div>
                        <p class="cor-gray87">任务分类：{!! $v['cate_name'] !!}</p>
                        <p class="cor-gray87">浏览人数：{!! $v['view_count'] !!}人</p>
                        <a class="cor-gray87" href="{!!$v['url']!!}">详情>></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="space-14"></div>
    </div>
</div>
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
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                            <strong>标题：</strong> </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-1" name="title" class="col-xs-10 col-sm-5 title">
                            <input type="hidden" name="js_id" class="js_id" @if(!empty($user_data['id']))value="{{ $user_data['id'] }}@endif">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                            <strong>内容：</strong> </label>

                        <div class="col-sm-9">
                            <textarea class="form-control col-xs-10 col-sm-5 content" id="form-field-8" name="content"></textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="btn_primary" data-dismiss="modal">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>
{!! Theme::widget('popup')->render() !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('case','css/case.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('serivcecase','css/serivceCase.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('successdetail','js/doc/successdetail.js') !!}