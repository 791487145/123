<div class="g-main g-usershop">
    <h4 class="text-size16 cor-blue2f u-title">发布服务</h4>
    <div class="space-22"></div>
    @if($is_shop_open ==1)
        @if($trade_rate != 0)
            <div class="alert g-alertreal clearfix" role="alert">
                <i class="fa fa-lightbulb-o pull-left no-height"></i>
                <span class="text-size12">小贴士：服务佣金是{!! $trade_rate !!}%，成功上架后也会有提示哦！</span>
            </div>
        @endif
    <form action="{{ URL('user/serviceUpdate') }}" method="post" enctype="multipart/form-data" id="form">
        {{ csrf_field() }}
        <div class="g-userimgup profile-users g-usershopform">
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">服务分类</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <select name="firstCate" onchange="getCate(this.value, 'secondCate')">
                    @if(!empty($arr_cate))
                        @foreach($arr_cate as $item)
                            <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                        @endforeach
                    @endif
                </select>
                <select name="secondCate"  id="secondCate">
                    @if(!empty($arrCateSecond))
                        @foreach($arrCateSecond as $item)
                        <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                        @endforeach
                    @endif
                </select>
            </p>
        </div>
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">服务名称</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <input class="inputxt Validform_error input-large" type="text"  name="title" value="" datatype="*5-25" nullmsg="服务名称不能为空" errormsg="请填写5-25个字符">&nbsp;&nbsp;&nbsp;
            </p>
        </div>
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">服务描述</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <script id="editor"  type="text/plain"></script>
                <input type="hidden" name="desc" id="discription-edit" datatype="*1-5000" nullmsg="服务描述不能为空" errormsg="字数超过限制,最多500字" >
            </p>
        </div>
        <div class="clearfix g-userimgupbor g-usershopprice"><p class="pull-left h5 cor-gray51">服务价格</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <input class="inputxt Validform_error input-large" type="text" datatype="decimal" name="cash"  value=""  nullmsg="请填写服务价格" ajaxurl="{{ URL('user/servicecashvalid') }}" id="bounty">
                &nbsp;&nbsp;元
            </p>
        </div>
        <div class="clearfix g-userimgupbor" data-placement="right" href="#">
            <p class="pull-left h5 cor-gray51"><span>服务封面</span></p>

            <div class="memberdiv pull-left">
                <div class="position-relative">
                    <input name="cover" type="file" id="id-input-file-6"/>
                </div>
            </div>
            <div class="pull-left cor-gray87 visible-lg-block">
                <p>1. 封面是店铺展示方式的重要入口</p>

                <p>2. 优秀的服务封面更能吸引客户关注</p>

                <p>3. 尺寸必须为450*450像素,大小不超过3M，请保持图片清晰，能够体现卖点</p>

            </div>

        </div>
        {{--<div class="clearfix g-userimgupbor g-usershopup g-usershopbts"><p class="pull-left h5 cor-gray51">上传附件</p>--}}
            {{--<div class="g-userimgupinp g-userimgupbor-validform">--}}
                {{--<!--文件上传-->--}}
                {{--<div  class="dropzone clearfix" id="dropzone"  url="{{ URL('task/fileUpload')}}" deleteurl="{{ URL('task/fileDelet') }}">--}}
                    {{--<div class="fallback">--}}
                        {{--<input name="file" type="file" multiple="" />--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div id="file_update"></div>--}}
            {{--<div class="space-4"></div>--}}
        {{--</div>--}}
        @if($is_open ==1)
        <div class="clearfix g-userimgupbor g-usershoptj"><p class="pull-left h5 cor-gray51">推荐设置</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <label>
                    <input name="is_recommend" class="ace ace-checkbox-2" type="checkbox" value="{{ $service['id'] }}">
                    <span class="lbl"> 推荐到威客商城 <span class="cor-orange">（增值服务 {{ $service['price'].'元'.'/'.$map[$recommend_service_unit] }}）</span></span>
                </label>
            </p>
        </div>
        @endif
        <div class="space-20"></div>
        <button type="submit" class="btn btn-primary btn-imp btn-blue g-usershopbtn">提交服务</button><a class="text-size14 g-usershopback text-under" href="{{ URL('user/serviceList') }}">返回</a>
    </div>
    </form>
    @elseif($is_shop_open == 2)
        <div class="row close-space-tip">
            <div class="col-md-12 text-center">
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <div class="space-10"></div>
                <p class="text-size16 cor-gray87">您的店铺已关闭，暂不能发布服务！<a href="/shop/manage/{!! $shop_id!!}">开启店铺</a></p>
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
                <p class="text-size16 cor-gray87">您的店铺还没设置，暂不能发布服务！<a href="/user/shop">店铺设置</a></p>
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
@if($is_shop_open==1)
{!! Theme::asset()->container('specific-css')->usepath()->add('issuetask','plugins/ace/css/dropzone.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('dropzone','plugins/ace/js/dropzone.min.js') !!}

{!! Theme::widget('ueditor')->render() !!}
@endif
{!! Theme::asset()->container('custom-js')->usepath()->add('serviceCreate','js/doc/serviceCreate.js') !!}