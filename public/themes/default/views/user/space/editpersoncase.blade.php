
        <div class="row">
            <!-- 个人简介 -->
            <div class="col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="personal-info">
                    @if($introduce['backgroundurl']=="")
                        <img src="{!! Theme::asset()->url('images/personal_back.png') !!}" alt="" class="personal-info-back-pic" id="backgroud-img2">
                    @else
                        <img src="{!!  $domain.'/'.$introduce['backgroundurl'] !!}" class="personal-info-back-pic" id="backgroud-img2"/>
                        @endif
                    <!-- 切换背景 -->
                    {{--<span class="change-back-img-btn" data-toggle="modal" data-target="#myModal"></span>--}}
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
                            <p class="personal-tag hidden-xs hidden-sm">标签：@if(!empty($skill_tag))
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


        @if( $introduce['shop_status'] == 1)
        <div class="row">
            <div class="col-xs-12 col-left">
                <div class="add-case add-case992">
                        <form class="form-horizontal demoform" action="/user/editCase" method="post" enctype="multipart/form-data" id="success-case">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-1 col-xs-4 control-label no-padding-right" for="form-field-1"><strong>案例名称：</strong>  </label>
                            <div class="col-sm-11 col-xs-8">
                                <input type="text" id="form-field-1" name='title' class="col-xs-6 col-sm-3" placeholder="请填写案例名称" datatype="*" nullmsg="请填写案例名称！" value="{{$successCase['title']}}">
                                <input type="hidden" name="id" value="{{$id}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-1 col-xs-4  control-label no-padding-right" for="form-field-1"><strong>上传封面：</strong>  </label>
                            <div class="col-sm-4 col-xs-8">
                                <div class="memberdiv pull-left">
                                    <div class="position-relative">
                                        <div class="space-2"></div>
                                        <input type="file" id="id-input-file-9" name="pic" />
                                        @if(!empty($successCase['pic']))
                                            <img src="{!! url($successCase['pic']) !!}" width="152" height="126">
                                        @endif
                                        <!-- /section:custom/file-input -->
                                        <!--<img src="../../img/defaultfile.jpg"><p>上传示例图片</p> <input type="file">-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group task-r " style="padding: 0;border:0;">
                            <label class="col-sm-1 col-xs-12  control-label no-padding-right" for="form-field-1"><strong>案例分类：</strong>  </label>
                            <div class="col-sm-11 col-xs-12">
                                <div class="task-select" id="task-select">
                                    @foreach($hotcate as $v)
                                        <a url="{{ URl('task/getTemplate') }}" cate-id="{{ $v['id'] }}" class="chooseCate"  >{{ $v['name'] }}</a>
                                    @endforeach
                                    <span><a class="select-txt z-close text-under" href="javascript:;">更多>></a></span>
                                </div>
                                <div class="task-select1 collapse col-xs-3 col-sm-3" id="gd" >
                                    <div class="row">
                                        <select multiple="" class="chosen-select tag-input-style"  name="cate_id"  data-placeholder="选择一下您的标签吧" style="display:block;">
                                            @foreach($category_all as $v)
                                                <option value="{{ $v['id'] }}" cate-id="{{ $v['id'] }}" class="chooseCate"  @if($successCase['cate_id'] == $v['id']) selected="selected"@endif>{{ $v['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="task-Validform-filtersort">
                                    <input type="hidden" name="cate_id" id="task_category"  datatype="n" nullmsg="请选择需要做什么！" value="{{$successCase['cate_id']}}"/>
                                </div>
                            </div>
                        </div>
                        <!-- 案例描述 -->
                        <div class="form-group">
                            <label class="col-sm-1 col-xs-12 control-label no-padding-right" for="form-field-1"><strong>案例描述：</strong>  </label>
                            <div class="col-sm-11 col-xs-12">
                                <script id="editor" name="description" type="text/plain" style="height:300px;">{!! htmlspecialchars_decode($successCase['desc']) !!}</script>
                                {{--<div class="wysiwyg-editor" id="editor1">{!! htmlspecialchars_decode($successCase['desc']) !!}</div>--}}
                                <div style="display:none;">
                                <input type="hidden" name="description" id="discription-edit" datatype="*" nullmsg="案例描述不能为空" errormsg="字数超过限制" value="{!! htmlspecialchars_decode($successCase['desc']) !!}">
                                </div>
                                    <span class="Validform_checktip vilid-wrprg task-casepdb10"></span>
                                {{--<div class="text-right">提示:案例描述及图片大小不要超过10M，否则可能无法添加案例！</div>--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 col-xs-4 control-label no-padding-right" for="form-field-1"><strong>案例链接：</strong>  </label>
                            <div class="col-sm-11 col-xs-8">
                                <input type="text" id="form-field-1" name="url" class="col-xs-6 col-sm-3" datatype="url|empty" errormsg="请填写一个链接或为空" placeholder="请填写案例链接" value="{{$successCase['url']}}">
                            </div>
                        </div>
                    
                    <div class="form-group clearfix">
                        <div class="col-sm-11 col-xs-11 col-sm-offset-1 col-xs-offset-1">
                            <button type="submit" form="success-case" class="btn btn-primary btn-blue bor-radius2 btn-big1 subTask" >保存</button>
                            <a href="/user/personCase" title="" class="text-under add-case-concel" onclick = "back()">返回</a>
                        </div>
                    </div>
                        </form>
                </div>
            </div>
        </div><!-- /.row -->
        @else
            {{--空间关闭提示--}}
            <div class="row close-space-tip">
                <div class="col-md-12">
                    <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" />
                    <p>您的空间已关闭。请<a class="text-under" href="">开启</a>空间！</p>
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
                    @else
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

{!! Theme::asset()->container('specific-css')->usepath()->add('chosen','plugins/ace/css/chosen.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('chosen','plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('backstage', 'js/doc/successcase.js') !!}
{{--{!! Theme::asset()->container('custom-css')->usepath()->add('froala_editor', 'css/usercenter/usercenter.css') !!}--}}
{!! Theme::asset()->container('custom-css')->usepath()->add('userCase','css/usercenter/successCase/userCenterCase.css') !!}
{{--{!! Theme::widget('popup')->render() !!}--}}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('chosen', 'ace/chosen.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('personcase','js/doc/personcase.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('personcaseuploadpic','js/doc/personcaseuploadpic.js') !!}

