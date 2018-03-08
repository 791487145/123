<div class="g-main g-releasetask g-usershop">
    <h4 class="text-size16 cor-blue2f u-title">企业认证</h4>
    <div class="space-22"></div>
    <div class="cor-orange text-size14 g-usershopi"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 用于提升客户对公司的信任度，请仔细填写相关信息，认证后不可修改</div>
    <div class="space-8"></div>
    <form method="post" action="/user/enterpriseAuth" enctype="multipart/form-data" id="enterprise">
        {{csrf_field()}}
        <div class="g-userimgup profile-users g-usershopform">
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">公司名称</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <input class="inputxt Validform_error input-large" datatype="*" nullmsg="请填写公司名称！" type="text"  name="company_name" value="">&nbsp;&nbsp;&nbsp;
                </p>
            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">所属行业</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <select name="cate_first" id="cate_first" datatype="n" nullmsg="请选择行业归类！">
                        <option value="">-行业归类-</option>
                        @if($cate_first)
                            @foreach($cate_first as $item)
                                <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                            @endforeach
                        @endif
                    </select>
                    <select name="cate_second" id="cate_second" datatype="n" nullmsg="请选择行业子类！">
                        <option value="">-行业子类-</option>
                        @if($cate_second)
                            @foreach($cate_second as $item)
                                <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                            @endforeach
                        @endif
                    </select>
                </p>
            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">员工人数</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <input class="inputxt Validform_error input-large" datatype="n" nullmsg="请填写员工人数！"
                           type="text" name="employee_num" value="">&nbsp;&nbsp;&nbsp;
                </p>
            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">营业执照</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <input class="inputxt Validform_error input-large" datatype="*" nullmsg="请填写营业执照！"
                           type="text" placeholder="请填写您的营业执照号" name="business_license" value="">&nbsp;&nbsp;&nbsp;
                </p>
            </div>

            <div class="clearfix g-userimgupbor task-casehid g-userimguptime"><p class="pull-left h5 cor-gray51">经营年数</p>
                <p class="input-daterange input-group g-userimgupbor-validform">
                    <span class="ass-icore ass-icore163">
                        <input type="text"  id="datepiker-begin" class="input-sm form-control" name="start" value=""
                                                   datatype="*" nullmsg="请填写开始经营时间！"/>
                        <i class="fa fa-calendar ass-icoabr"></i>
                        <span class="Validform_checktip position-validform"></span>
                    </span>
                    <span class="ass-icore text-size14"> -&nbsp;&nbsp;&nbsp;至今

                    </span>
                </p>
            </div>

            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">企业网址</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <input class="inputxt Validform_error input-large" type="text" name="website" value="">&nbsp;&nbsp;&nbsp;
                </p>
            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">经营地址</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <select name="province" id="province" datatype="n" nullmsg="请选择省！">
                        <option value="">-请选择省-</option>
                        @if(isset($province) && is_array($province))
                            @foreach($province as $k => $v)
                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                            @endforeach
                        @endif
                    </select>
                    <select name="city" id="city" datatype="n" nullmsg="请选择市！">
                        <option value="">-请选择市-</option>
                    @if(isset($city) && is_array($city))
                            @foreach($city as $k => $v)
                                <option value="{{$v['id']}}" >{{$v['name']}}</option>
                            @endforeach
                        @endif
                    </select>
                    <select name="area" id="area" datatype="n" nullmsg="请选择区！">
                        <option value="">-请选择区-</option>
                    @if(isset($area) && is_array($area))
                            @foreach($area as $k => $v)
                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                            @endforeach
                        @endif
                    </select>
                </p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <input class="inputxt Validform_error input-large" datatype="*" nullmsg="请填写经营地址！"
                           type="text" placeholder="街道、大厦、门牌号"  name="address" value="">&nbsp;&nbsp;&nbsp;

            </div>
            <div class="clearfix g-userimgupbor task-casehid g-usershopup"><p class="pull-left h5 cor-gray51">相关资质</p>
                <div class="g-userimgupinp g-userimgupbor-validform">
                    <!--文件上传-->
                    <div  class="dropzone clearfix" id="dropzone"  url="{{ URL('user/fileUpload')}}" deleteurl="{{ URL('user/fileDelete') }}">
                        <div class="fallback">
                            <input name="file" type="file" multiple="" />
                        </div>
                    </div>
                    <div class="space-6" id="file_update" ></div>

                    <div class="cor-orange text-size14 g-usershopi">
                        <i class="fa fa-exclamation-circle cor-orange text-size18"></i>
                        公司营业执照副本，相关获奖证书等，我们将保护您的隐私
                    </div>
                    <div id="file_error"></div>
                </div>
            </div>
            <div class="space-20"></div>
            <button class="btn btn-primary btn-imp btn-blue g-usershopbtn">保存</button>
            <a class="text-size14 g-usershopback text-under" href="/user/shop">返回</a>
        </div>
    </form>
</div>


{!! Theme::asset()->container('specific-css')->usePath()->add('webui-css', 'plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('usercenter-css', 'css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-min-js', 'plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-elements-js', 'plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('realname-js', 'js/realnameauth.js') !!}

{!! Theme::asset()->container('specific-css')->usepath()->add('froala_editor', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('bootstrap-datepicker','plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('assetdetail','js/assetdetail.js') !!}

{!! Theme::asset()->container('specific-css')->usepath()->add('issuetask','plugins/ace/css/dropzone.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('dropzone','plugins/ace/js/dropzone.min.js') !!}
{!! Theme::widget('fileUpload')->render() !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('enterprise','js/doc/enterprise.js') !!}
