<div class="g-main g-usershop">
    <h4 class="text-size16 cor-blue2f u-title">发布作品</h4>
    <div class="space-16"></div>
    @if($is_open_shop == 1)
        @if($trade_rate != 0)
        <div class="alert g-alertreal clearfix" role="alert">
            <i class="fa fa-lightbulb-o pull-left no-height"></i>
            <span class="text-size12">小贴士：作品佣金是{!! $trade_rate !!}%，成功上架后也会有提示哦！</span>
        </div>
        @endif
    <form method="post" action="{!! url('user/pubGoods') !!}" enctype="multipart/form-data" id="shop_info">
        {!! csrf_field() !!}
    <div class="g-userimgup profile-users g-usershopform">
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">作品分类</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <select name="first_cate" id="firstCate" onchange="getCate(this.value, 'secondCate')" datatype="*" nullmsg="请选择作品归类！">
                    <option value="">-作品归类-</option>
                    @if(!empty($arr_cate))
                    @foreach($arr_cate as $item)
                    <option value="{!! $item->id !!}">{!! $item->name !!}</option>
                    @endforeach
                    @endif
                </select>
                <select name="second_cate" id="secondCate" datatype="*" nullmsg="请选择作品子类！">
                    <option value="">-作品子类-</option>
                </select>
                {!! $errors->first('first_cate') !!}
            </p>

        </div>
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">作品名称</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <input class="inputxt Validform_error input-large" type="text"  name="title" value="{{old('title')}}"
                       datatype="*" nullmsg="请填写作品名称！">&nbsp;&nbsp;&nbsp;
                {!! $errors->first('title') !!}
            </p>
        </div>
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">作品描述</p>
            <div class="g-userimgupinp g-userimgupbor-validform">
                <!--编辑器-->
                <div class="clearfix">
                    <script id="editor" name="desc" type="text/plain"></script>
                {!! $errors->first('desc') !!}
                </div>
            </div>
        </div>
        <div class="clearfix g-userimgupbor g-usershopprice"><p class="pull-left h5 cor-gray51">作品价格</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <input class="inputxt Validform_error input-large" type="text"  name="cash" value="" datatype="*" nullmsg="请填写作品价格！"
                       ajaxurl="{{ URL('user/goodsCashValid') }}" id="bounty">
                &nbsp;&nbsp;元 /&nbsp;&nbsp;
                <select name="unit" id="">
                    <option value="0">件</option>
                    <option value="1">时</option>
                    <option value="2">份</option>
                    <option value="3">个</option>
                    <option value="4">张</option>
                    <option value="5">套</option>
                </select>
                {!! $errors->first('cash') !!}
            </p>
        </div>
        <div class="clearfix g-userimgupbor" data-placement="right" href="#">
            <p class="pull-left h5 cor-gray51"><span>作品封面</span></p>

            <div class="memberdiv pull-left">
                <div class="position-relative">
                    <input name="cover" type="file" id="id-input-file-6"  datatype="*" nullmsg="作品封面不能为空"/>
                </div>
            </div>
            <div class="pull-left cor-gray87 visible-lg-block">
                <p>1. 封面是作品展示方式的重要入口</p>

                <p>2. 优秀的作品封面更能吸引客户关注</p>

                <p>3. 尺寸必须为450*450像素,大小不超过3M，请保持图片清晰，能够体现卖点</p>

            </div>

        </div>
        <div class="clearfix g-userimgupbor g-usershopup g-usershopbts"><p class="pull-left h5 cor-gray51">上传附件</p>
            <div class="g-userimgupinp g-userimgupbor-validform">
                <!--文件上传-->
                <div  class="dropzone clearfix" id="dropzone"  url="{{ URL('user/fileUpload')}}" deleteurl="{{ URL('user/fileDelete') }}">
                    <div class="fallback">
                        <input name="file" type="file" multiple="" />
                    </div>
                </div>
                <div class="space-6" id="file_update"></div>
            </div>
            <div class="space-4"></div>
        </div>
        @if($is_open == 1)
        <div class="clearfix g-userimgupbor g-usershoptj"><p class="pull-left h5 cor-gray51">推荐设置</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <label>
                    <input name="is_recommend" class="ace ace-checkbox-2" type="checkbox" value="1">
                    <span class="lbl"> 推荐到威客商城
                        <span class="cor-orange">（增值服务 ￥ {!! $price !!}元/
                        @if($recommend_unit == 0)天
                        @elseif($recommend_unit == 1)月
                        @elseif($recommend_unit == 2)三个月
                        @elseif($recommend_unit == 3)六个月
                        @elseif($recommend_unit == 4)年
                        @endif）
                        </span>
                    </span>
                </label>
            </p>
        </div>
        @endif
        <div class="space-20"></div>
        <button type="submit" class="btn btn-primary btn-imp btn-blue g-usershopbtn">提交作品</button>
        <a class="text-size14 g-usershopback text-under" href="/user/goodsShop">返回</a>

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
            <p class="text-size16 cor-gray87">您的店铺已关闭，暂不能发布作品！<a href="/shop/manage/{!! $shop_id!!}">开启店铺</a></p>
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
            <p class="text-size16 cor-gray87">您的店铺还没设置，暂不能发布作品！<a href="/user/shop">店铺设置</a></p>
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
@if($is_open_shop == 1)
{!! Theme::asset()->container('specific-css')->usepath()->add('issuetask','plugins/ace/css/dropzone.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('dropzone','plugins/ace/js/dropzone.min.js') !!}
{!! Theme::widget('fileUpload')->render() !!}
{!! Theme::widget('ueditor')->render() !!}
@endif
{!! Theme::asset()->container('custom-js')->usepath()->add('pubgoods','js/pubgoods.js') !!}

