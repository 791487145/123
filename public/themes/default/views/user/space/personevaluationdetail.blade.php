
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

        <div class="row">
            <div class="col-md-12 col-left">
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
                        {!!  htmlspecialchars_decode($successCase['desc']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-left text-center">
                <div class="space"></div>
                <a href="/user/personCase" class="btn btn-primary btn-blue bor-radius2">返回</a>
            </div>
        </div>
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

