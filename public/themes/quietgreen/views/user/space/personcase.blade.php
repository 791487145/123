
        <div class="row">
            <!-- 个人简介 -->
            <div class="col-md-12 col-left">
                <div class="personal-info">
                    @if($introduce['backgroundurl']=="")
                        <img src="{!! Theme::asset()->url('images/personal_back.png') !!}" name="" class="personal-info-back-pic" id="backgroud-img2">
                    @else
                        <img src="{!!  $domain.'/'.$introduce['backgroundurl'] !!}" name="" class="personal-info-back-pic" id="backgroud-img2"/>
                    @endif
                    <div class="personal-info-words">

                    <span class="change-back-img-btn" data-toggle="modal" data-target="#myModal">
                    </span>
                        @if($introduce['avatar']=="")
                            <img src="{!! Theme::asset()->url('images/default_avatar.png') !!}" alt="" class="img-circle personal-info-pic">
                        @else
                            <img src="{!!  $domain.'/'.$introduce['avatar'] !!}" class="img-circle personal-info-pic"/>
                        @endif
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
        <!-- 成功案例和评价详情 -->
        @if( $introduce['shop_status'] == 1)
            <div class="row">

                <div class="col-md-12 col-left">
                    <div class="personal-case-detail-list personal-case-detail-list-active">
                        {{--<a href="{!! URL('user/personCase') !!}" title="" class="personal-case-list personal-active personal-case-list-tit">成功案例</a>--}}
                        <a href="{!! URL('user/personevaluation') !!}" title="" class="personal-evaluate-detail personal-case-list-tit personal-active">评价详情</a>
                        {{--<a href="{!! URL('user/addpersoncase/1') !!}" title="" class="personal-add-case-btn hov-blue1b">添加案例</a>--}}
                    </div>
                </div>

                <!-- 成功案例-->
                <div class="case-list-box">

                @if($list['total'] > 0)
                    @foreach($list['data'] as $v)
                        <div class="col-md-3 col-xs-6 col-sm-4 case-list-item col-left">
                            <a class=" personCase-ico-edit" href="/user/editpersoncase/{{$v['id']}}"><i class="fa fa-edit"></i></a>
                            <i class="fa fa-times-circle personCase-ico-circle delete" data-toggle="modal" data-target="#ico-Modal" data-values="{{$v['id']}}"></i>
                            @if(!$v['pic'])
                                <a href="{!! URL('user/personevaluationdetail/'.$v['id']) !!}" title="">
                                <img src="{!! Theme::asset()->url('images/case_back.png') !!}" class="img-responsive"/>
                                </a>
                            @else
                                <a href="{!! URL('user/personevaluationdetail/'.$v['id']) !!}" title="">
                                <img src="{!!  $domain.'/'.$v['pic'] !!}" class="img-responsive">
                                </a>
                            @endif
                            <div class="case-list-item-name">
                                <a class="cor-gray51" href="{!! URL('user/personevaluationdetail/'.$v['id']) !!}" title="">
                                <p>{{ $v['title'] }}</p>
                                    </a>
                            </div>
                            <div class="case-list-item-admin">
                                <span><i class="fa fa-eye"></i> @if(!empty($v['view_count'])){{ $v['view_count'] }}@else 0 @endif人浏览</span>
                                <span class="case-tag"> <i class="fa fa-tag "></i> {{ $v['cate_name']}}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row close-space-tip">
                        <div class="col-md-12">
                            <div class="space"></div>
                            <div class="space"></div>
                            <div class="space"></div>
                            <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                            <p>您还未添加任何案例。请您先去<a class="text-under" href="{!! URL('user/addpersoncase/1') !!}" >添加</a></p>
                        </div>
                    </div>
                @endif
                </div>

                @if(!empty($list_ob))
                <div class="pull-right">
                    {!! $list_ob->render() !!}
                </div>
                    @endif

                @elseif($introduce['shop_status'] == 2)
                    {{--空间关闭提示--}}
                    <div class="row close-space-tip">
                        <div class="col-md-12">

                            <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                            <p>您的空间已关闭。请<a class="text-under" href="javascript:;" user_id="{{ $introduce['uid'] }}" onclick="switchStatus($(this))">开启</a>空间！</p>
                        </div>
                    </div>
                @endif
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
            {!! csrf_field() !!}
            <div class="modal-body">
                @if($introduce['backgroundurl']=="")
                <img src="{!! Theme::asset()->url('images/personal_back.png') !!}" id="backgroud-img" class="img-responsive">
                @else
                <img src="{!!  $domain.'/'.$introduce['backgroundurl'] !!}" class="img-responsive" id="backgroud-img"/>
                @endif

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

<!-- xx模态框 -->
<div class="modal fade" id="ico-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  add-case-modal" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5>删除案例</h5>
                <input type="hidden" name="success_case_id" id="success_case_id" value="">
            </div>
            <div class="modal-body text-center">
                <h5>您确认是否要删除该案例？</h5>
                <button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2" id="delete_success">确认</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('userCase','css/usercenter/successCase/userCenterCase.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('deletesuccesscase','js/doc/deletesuccesscase.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('personcase','js/doc/personcase.js') !!}
