<div class="g-main g-releasetask g-usershop">
    <h4 class="text-size16 cor-blue2f u-title">发布服务</h4>
    <div class="space-22"></div>
    <div class="g-userimgup profile-users g-usershopform">
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">服务分类</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <select name="" id="">
                    <option value="">分类一</option>
                </select>
                <select name="" id="">
                    <option value="">分类一</option>
                </select>
            </p>
        </div>
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">服务名称</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <input class="inputxt Validform_error input-large" type="text" datatype="idcard" name="card_number" value="">&nbsp;&nbsp;&nbsp;
            </p>
        </div>
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">服务描述</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <textarea></textarea>
            </p>
        </div>
        <div class="clearfix g-userimgupbor g-usershopprice"><p class="pull-left h5 cor-gray51">服务价格</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <input class="inputxt Validform_error input-large" type="text" datatype="idcard" name="card_number" value="">
                &nbsp;&nbsp;元
            </p>
        </div>
        <div class="clearfix g-userimgupbor" data-placement="right" href="#">
            <p class="pull-left h5 cor-gray51"><span>服务封面</span></p>

            <div class="memberdiv pull-left">
                <div class="position-relative">
                    <input name="card_front_side" type="file" id="id-input-file-6"/>
                </div>
            </div>
            <div class="pull-left cor-gray87 hidden-xs">
                <p>1. 封面是店铺展示方式的重要入口</p>

                <p>2. 优秀的作品封面更能吸引客户关注</p>

                <p>3. 尺寸必须为450*450像素,大小不超过3M，请保持图片清晰，能够体现卖点</p>

            </div>

        </div>
        <div class="clearfix g-userimgupbor g-usershopup g-usershopbts"><p class="pull-left h5 cor-gray51">上传附件</p>
            <div class="g-userimgupinp g-userimgupbor-validform">
                <!--文件上传-->
                <div  class="dropzone clearfix" id="dropzone"  url="{{ URL('task/fileUpload')}}" deleteurl="{{ URL('task/fileDelet') }}">
                    <div class="fallback">
                        <input name="file" type="file" multiple="" />
                    </div>
                </div>
            </div>
            <div class="space-4"></div>
        </div>
        <div class="clearfix g-userimgupbor g-usershoptj"><p class="pull-left h5 cor-gray51">推荐设置</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <label>
                    <input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox">
                    <span class="lbl"> 推荐到威客商城（增值服务 ￥ **.**元）</span>
                </label>
            </p>
        </div>
        <div class="space-20"></div>
        <button class="btn btn-primary btn-imp btn-blue g-usershopbtn">提交服务</button><a class="text-size14 g-usershopback text-under" href="">返回</a>

    </div>
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