<div class="col-xs-12">
    <div class="row">
        <div class="needs">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="">
                    <form class="registerform" action="{{ url('employ/update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="employee_uid" value="{{ $employ_data['uid'] }}">
                        <input type="hidden" name="service_id" value="{{ (isset($service['id']))?$service['id']:'0' }}">
                        <div class="needs-section">
                            <h4>您将雇佣  {{ $employ_data['user_name'] }}</h4>
                            <div class="needs-section-module">
                                <div class="needs-section-wwrap1">
                                    <p>一句话说明TA需要干什么：</p>
                                    @if($service==0)
                                    <input type="text" class="needs-input" datatype="*1-25" name="title" value="{!! old('title') !!}" nullmsg="需求标题不能为空" errormsg="不能超过25个字符"/>
                                    @else
                                    <input type="text" class="needs-input" datatype="*1-25" name="title" value="{{ $service['title'] }}" nullmsg="需求标题不能为空" errormsg="不能超过25个字符"/>
                                    @endif
                                    @if($errors->first('title'))
                                    <span class="Validform_checktip Validform_wrong">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class="needs-section-wwrap2">
                                    <p>详细描述下您的需求：</p>
                                    <!--编辑器-->
                                    <div class="clearfix needs-section-editor ">
                                        @if($service==0)
                                            <script id="editor"  type="text/plain">{!! old('desc') !!}</script>
                                        @else
                                            <script id="editor"  type="text/plain">{!! $service['desc'] !!}</script>
                                        @endif
                                        @if($service==0)
                                            <input type="hidden" name="desc" id="discription-edit" class="inputxt" datatype="*1-5000"  nullmsg="需求描述不能为空" errormsg="字数超过限制" value="{!! old('desc') !!}">
                                        @else
                                            <div style="display:none;">
                                            <input type="hidden" name="desc" id="discription-edit" class="inputxt" datatype="*1-5000"  nullmsg="需求描述不能为空" errormsg="字数超过限制" value="{!! $service['desc'] !!}">
                                            </div>
                                        @endif
                                        <span class="Validform_checktip Validform_wrong">需求不能为空</span>
                                        @if($errors->first('desc'))
                                        <span class="Validform_checktip Validform_wrong">{{ $errors->first('desc') }}</span>
                                        @endif
                                    </div>
                                    <div class="annex needs-section-annex">
                                        <!--文件上传-->
                                        <div action=" " class="dropzone clearfix" id="dropzone" url="{{ URL('task/fileUpload')}}" deleteurl="{{ URL('task/fileDelet') }}">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div id="file_update"></div>
                                </div>
                                <div class="needs-section-wwrap3">
                                    <p>填写联系方式：</p>
                                    <input type="text" class="needs-input inputxt" name="phone" datatype="m"  nullmsg="您的手机号不能为空！" errormsg="手机号错误！" value="{!! old('phone') !!}"/>
                                    @if($errors->first('phone'))
                                        <span class="Validform_checktip Validform_wrong">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="needs-section-wwrap4">
                                    <p>您的预算：</p>
                                    <div class="form-group">
                                        @if(isset($service['id']))
                                        <input type="text" class=" wwrap4-input" id="exampleInputName2" placeholder="" ajaxurl="{{ URL('employ/validBounty') }}" datatype="decimal" name="bounty" value="{!! (old('bounty'))?old('bounty'):$service['cash'] !!}" nullmsg="您的预算不能为空！" errormsg="请填写数子,最多保留两位小数！">
                                        @else
                                        <input type="text" class=" wwrap4-input" id="exampleInputName2" placeholder="" ajaxurl="{{ URL('employ/validBounty') }}" datatype="decimal" name="bounty" value="{!! old('bounty') !!}" nullmsg="您的预算不能为空！" errormsg="请填写数子,最多保留两位小数！">
                                        @endif
                                        <label for="exampleInputName2">元</label>　
                                        @if($errors->first('bounty'))
                                            <span class="Validform_checktip Validform_wrong">{{ $errors->first('bounty') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="needs-section-wwrap5">
                                    <p>雇佣截止日期：</p>
                                    <div class="input-group wwrap5-input">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                        <input class="form-control date-picker" type="text" name="delivery_deadline" value="{!! old('delivery_deadline') !!}" id="datepiker-begin" datatype="*"  placeholder="截止时间"  nullmsg="设置日期不能为空！"/>
                                        @if($errors->first('delivery_deadline'))
                                            <span class="Validform_checktip Validform_wrong">{{ $errors->first('delivery_deadline') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <input type="submit" value="下一步" class="btn btn-primary bor-radius2 btn-big3" id="formsubmit"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 hidden-xs hidden-md hidden-sm col-left">
                <div class="needs-sidebar">
                    <h4 class="text-center">被雇佣服务商信息</h4>
                    <div class="needs-sidebar-wrap">
                        <div class="wrap1">
                            <img src="{{ $domain.'/'.$employ_data['avatar'] }}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" alt=""/>
                        </div>
                        <div class="wrap2">
                            <p class="tit">{{ $employ_data['user_name'] }}</p>
                            <p class="beyond clearfix beyond-a">
                                <span>认证：</span>
                                <a  class="ico2 {{ (in_array('bank',$employ_data['auth']))?'u-ico2':'' }}" title="银行卡认证"></a>
                                <a  class="ico1  {{ (in_array('realname',$employ_data['auth']))?'u-ico1':'' }}" title="实名认证"></a>
                                <a class="ico3 {{ ($employ_data['email_status']==2)?'u-ico3':'' }}" title="邮箱认证">
                                </a><a  class="ico4 {{ (in_array('alipay',$employ_data['auth']))?'u-ico4':'' }}" title="支付宝认证"></a>
                                <a  class="ico5 {{ (in_array('enterprise',$employ_data['auth']))?'u-ico5':'' }}" title="企业认证"></a>
                            </p>
                            <p class="beyond">
                                <span>地区：</span>
                                @if(!empty($employ_data['province_name']) && !empty($employ_data['city_name']))
                                {{ $employ_data['province_name'].$employ_data['city_name'] }}
                                @else
                                    暂无地区
                                @endif
                            </p>
                            <p class="beyond beyond-s clearfix">
                                <span>标签：</span>
                                @if(!empty($employ_data['tags']))
                                    @foreach($employ_data['tags'] as $v)
                                    <a href="javascript:;">{{ $v['tag_name'] }}</a>
                                    @endforeach
                                @else
                                    <a href="javascript:;">暂无标签</a>
                                @endif
                            </p>
                        </div>
                        <div class="wrap3">
                            <ul class="list-inline">
                                <li>
                                    <p class="text-center">好评数</p>
                                    <p class="text-center text-color">{{ $employ_data['employee_praise_rate'] }}</p>
                                </li>
                                <li>
                                    <p class="text-center">好评率</p>
                                    <p class="text-center text-color">{{ $employ_data['good_rate'] }}%</p>
                                </li>
                                <li>
                                    <p class="text-center">
                                        月雇佣
                                    </p>
                                    <p class="text-center text-color">92</p>
                                </li>
                            </ul>
                        </div>
                        <div class="wrap4 employworkico" >
                            @if(Auth::check() && Auth::User()->id != $employ_data['uid'])
                            <a href="javascript:;" title="联系TA" class="ico1 taskconico icogz" data-toggle="modal" data-target="#myModalgz" data-values="{{ $employ_data['uid'] }}" data-id="{{$contact}}" ><i></i>联系TA</a>
                            @endif
                            @if(!$user_shop)
                                <a href="{{ URL('bre/serviceCaseList/'.$user_data['uid']) }}" target="_blank" class="ico2"><i></i>进入空间</a>
                            @else
                                <a href="{{ URL('shop/'.$user_shop['id']) }}" target="_blank" class="ico3"><i></i>进入店铺</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($contact == 2 && Auth::check() && Auth::User()->id != $employ_data['uid'])
    <div class="modal fade" id="myModalgz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog  contact-me-modal" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">联系TA</h4>
                </div>
                <form class="form-horizontal" action="seriveceCaseDetail_submit" method="post" accept-charset="utf-8">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                                <strong>标题：</strong> </label>

                            <div class="col-sm-9">
                                <input type="text" id="form-field-1" name="title" class="col-xs-10 col-sm-5 title">
                                <input type="hidden" name="js_id" class="js_id" id="contactMeId" value="{{ $employ_data['uid'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                                <strong>内容：</strong>
                            </label>

                            <div class="col-sm-9">
                                <textarea class="form-control col-xs-10 col-sm-5 content" id="form-field-8" name="content"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="contactMe">确定</button>
                        <button type="button" class="btn btn-default" id="contactMeCancel" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('datepicker','plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('datepicker-zh-CN', 'plugins/ace/js/date-time/locales/bootstrap-datepicker.zh-CN.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('Validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::widget('editor',['plugins'=>CommonClass::getEditorInit(['insertImage'])])->render() !!}
{!! Theme::widget('fileUpload')->render() !!}

@if(isset($service['id']))
{!! Theme::asset()->container('custom-js')->usepath()->add('employvalid','js/doc/employvalid.js') !!}
@else
{!! Theme::asset()->container('custom-js')->usepath()->add('employ','js/doc/employ.js') !!}
@endif
{!! Theme::widget('ueditor')->render() !!}




