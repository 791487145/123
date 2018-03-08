<div class="g-main g-usershop">
    <h4 class="text-size16 cor-blue2f u-title">发布案例</h4>
    <div class="space-22"></div>
    @if($is_open_shop == 1)
    <form method="post" action="/user/postAddShopSuccess" enctype="multipart/form-data" id="shopSuccess">
        {{csrf_field()}}
        <div class="g-userimgup profile-users g-usershopform">
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">案例分类</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <select name="cate_first" id="cate_first">
                        <option value="">-行业归类-</option>
                        @if(!empty($cate_first))
                            @foreach($cate_first as $item)
                                <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                            @endforeach
                        @endif
                    </select>
                    <select name="cate_id" id="cate_id">
                        <option value="">-行业子类-</option>
                    @if(!empty($cate_second))
                            @foreach($cate_second as $item)
                                <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                            @endforeach
                        @endif
                    </select>
                </p>
            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">案例名称</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <input class="inputxt Validform_error input-large" type="text" datatype="*1-30" nullmsg="请填写案例名称" errormsg="字数超过限制" name="title" value="">&nbsp;&nbsp;&nbsp;
                </p>
            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">案例描述</p>
                <div class="g-userimgupinp g-userimgupbor-validform clearfix">
                    <div class="clearfix  Validform-wysiwyg-editor">
                        <script id="editor"  type="text/plain"></script>
                        <input type="hidden" name="description" id="discription-edit"
                               datatype="*1-5000" nullmsg="案例描述不能为空" errormsg="字数超过限制" >
                        @if($errors->first('description'))
                            <p class="Validform_checktip Validform_wrong">{!! $errors->first('description') !!}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="clearfix g-userimgupbor" data-placement="right" href="#">
                <p class="pull-left h5 cor-gray51"><span>案例封面</span></p>

                <div class="memberdiv pull-left">
                    <div class="position-relative">
                        <input name="success_pic" type="file" id="id-input-file-6" datatype="*" nullmsg="案例封面不能为空"/>
                    </div>
                </div>
                <div class="pull-left cor-gray87 visible-lg-block">
                    <p>1. 封面是案例展示方式的重要入口</p>

                    <p>2. 优秀的案例封面更能吸引客户关注</p>

                    <p>3. 尺寸必须为450*450像素,大小不超过3M，请保持图片清晰，能够体现卖点</p>

                </div>

            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">案例链接</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <input class="inputxt Validform_error input-large" type="text"  name="success_url" value="">&nbsp;&nbsp;&nbsp;
                </p>
            </div>
            {{--<div class="clearfix g-userimgupbor g-usershoptj"><p class="pull-left h5 cor-gray51">推荐设置</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <label>
                        <input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox">
                        <span class="lbl"> 推荐到成功案例（增值服务 ￥ **.**元）</span>
                    </label>
                </p>
            </div>--}}
            <div class="space-20"></div>
            <button class="btn btn-primary btn-imp btn-blue g-usershopbtn">提交案例</button>
            <a class="text-size14 g-usershopback text-under" href="/user/myShopSuccessCase">返回</a>
        </div>
    </form>
    @elseif($is_open_shop == 2)
        <div class="row close-space-tip">
            <div class="col-md-12 text-center">
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <div class="space-10"></div>
                <p class="text-size16 cor-gray87">您的店铺已关闭，暂不能发布案例！<a href="/shop/manage/{!! $shop_id !!}">开启店铺</a></p>
            </div>
        </div>
    @else
        <div class="row close-space-tip">
            <div class="col-md-12 text-center">
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <div class="space-10"></div>
                <p class="text-size16 cor-gray87">您的店铺已关闭，暂不能发布案例！<a href="/user/shop">开启店铺</a></p>
            </div>
        </div>

    @endif

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
{!! Theme::widget('editor',['plugins'=>CommonClass::getEditorInit()])->render() !!}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('addshopSuccess','js/doc/addshopSuccess.js') !!}