<div class="g-main g-releasetask g-usershop">
    <h4 class="text-size16 cor-blue2f u-title">编辑作品</h4>
    <div class="space-22"></div>
    <form method="post" action="{!! url('user/postEditGoods') !!}" enctype="multipart/form-data" id="shop_info">
        {!! csrf_field() !!}
        <input type="hidden" name="id" value="{!! $goods_info->id !!}">
        <input type="hidden" name="status" value="{!! $goods_info->status !!}">
        <div class="g-userimgup profile-users g-usershopform">
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">作品分类</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <select name="first_cate" id="firstCate" onchange="getCate(this.value, 'secondCate')" datatype="*" nullmsg="请选择作品归类！">
                    <option value="">-作品归类-</option>
                @if(!empty($cate_first))
                    @foreach($cate_first as $item)
                    <option value="{!! $item['id'] !!}" @if($goods_info->cate_pid == $item['id'])selected="selected"@endif>
                        {!! $item['name'] !!}
                    </option>
                    @endforeach
                    @endif
                </select>
                <select name="second_cate" id="secondCate" datatype="*" nullmsg="请选择作品子类！">
                    <option value="">-作品子类-</option>
                @if(!empty($cate_second))
                        @foreach($cate_second as $item)
                            <option value="{!! $item['id'] !!}" @if($goods_info->cate_id == $item['id'])selected="selected"@endif>
                                {!! $item['name'] !!}
                            </option>
                        @endforeach
                    @endif
                </select>
                {!! $errors->first('first_cate') !!}
            </p>

        </div>
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">作品名称</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <input class="inputxt Validform_error input-large" type="text" name="title" datatype="*" nullmsg="请填写作品名称！"
                       value="{!! $goods_info->title !!}">&nbsp;&nbsp;&nbsp;
                {!! $errors->first('title') !!}
            </p>
        </div>
        <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">作品描述</p>
            <div class="g-userimgupinp g-userimgupbor-validform">
                <!--编辑器-->
                <div class="clearfix">
                    <script id="editor" name="desc" type="text/plain">{!! htmlspecialchars_decode($goods_info->desc) !!}
                    </script>
                    {!! $errors->first('desc') !!}
                </div>
            </div>
        </div>
        <div class="clearfix g-userimgupbor g-usershopprice"><p class="pull-left h5 cor-gray51">作品价格</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <input class="inputxt Validform_error input-large" type="text" datatype="*" nullmsg="请填写作品价格！"
                       name="cash" value="{!! $goods_info->cash !!}"  ajaxurl="{{ URL('user/goodsCashValid') }}" id="bounty">
                &nbsp;&nbsp;元 /&nbsp;&nbsp;
                <select name="unit" id="">
                    <option value="0" @if($goods_info->unit == 0)selected="selected"@endif>件</option>
                    <option value="1" @if($goods_info->unit == 1)selected="selected"@endif>时</option>
                    <option value="2" @if($goods_info->unit == 2)selected="selected"@endif>份</option>
                    <option value="3" @if($goods_info->unit == 3)selected="selected"@endif>个</option>
                    <option value="4" @if($goods_info->unit == 4)selected="selected"@endif>张</option>
                    <option value="5" @if($goods_info->unit == 5)selected="selected"@endif>套</option>
                </select>
                {!! $errors->first('cash') !!}
            </p>
        </div>
        <div class="clearfix g-userimgupbor" data-placement="right" href="#">
            <p class="pull-left h5 cor-gray51"><span>作品封面</span></p>

            <div class="memberdiv pull-left">
                <div class="position-relative">
                    <input name="cover" type="file" id="id-input-file-6"/>
                </div>
            </div>
            @if(isset($goods_info->cover) && !empty($goods_info->cover))
                <div class="pull-left" style="width: 158px;height: 120px">
                    <img src=" {!!  url($goods_info->cover) !!}" class="img-responsive"/>
                </div>
            @endif
            <div class="pull-left cor-gray87 visible-lg-block">
                <p>1. 封面是店铺展示方式的重要入口</p>

                <p>2. 优秀的作品封面更能吸引客户关注</p>

                <p>3. 尺寸必须为450*450像素,大小不超过3M，请保持图片清晰，<br>能够体现卖点</p>

            </div>

        </div>
        <div class="clearfix g-userimgupbor g-usershopup g-usershopbts"><p class="pull-left h5 cor-gray51">上传附件</p>
            <div class="g-userimgupinp g-userimgupbor-validform">
                <!--文件上传-->
                <div  class="dropzone clearfix" id="dropzone"  url="{{ URL('user/fileUpload')}}">
                    @foreach($attachment_data as $v)
                        <div class="dz-preview dz-processing dz-image-preview dz-success">
                            <div class="dz-details">
                                <div class="dz-filename"><span data-dz-name="">{{ $v['name'] }}</span></div>
                                <div class="dz-size" data-dz-size=""><strong>{{ $v['size'] }}</strong> MB</div>
                                @if(matchImg($v['type'])=='img')
                                    <img data-dz-thumbnail src="{{ $domain.'/'.$v['url'] }}" alt="">
                                @endif
                            </div>
                            <div class="dz-success-mark"><span>✔</span></div>
                            <div class="dz-error-mark"><span>✘</span></div>
                            <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                            <a class="dz-remove" href="javascript:;" onclick="deletefile($(this))" attachment_id="{{ $v['id'] }}" data-dz-remove>删除文件</a>
                        </div>
                    @endforeach
                </div>
                <div class="space-6" id="file_update">
                    @foreach($attachment_data as $v)
                        <input type='hidden'  name='file_id[]' id='file-{{ $v['id'] }}' value='{{ $v['id'] }}'/>
                    @endforeach
                </div>
            </div>
            <div class="space-4"></div>

        </div>

        @if($is_open == 1 && (($goods_info->status == 0 && $is_service == false) || $goods_info->status == 3))
        <div class="clearfix g-userimgupbor g-usershoptj"><p class="pull-left h5 cor-gray51">推荐设置</p>
            <p class="g-userimgupinp g-userimgupbor-validform">
                <label>
                    <input name="is_recommend" class="ace ace-checkbox-2" type="checkbox" value="1">
                    <span class="lbl"> 推荐到威客商城（增值服务 ￥ {!! $price !!}元/
                        @if($recommend_unit == 0)天
                        @elseif($recommend_unit == 1)月
                        @elseif($recommend_unit == 2)三个月
                        @elseif($recommend_unit == 3)六个月
                        @elseif($recommend_unit == 4)年
                        @endif）</span>
                </label>
            </p>
        </div>
        @endif
        <div class="space-20"></div>
        <button type="submit" class="btn btn-primary btn-imp btn-blue g-usershopbtn">提交作品</button>
            <a class="text-size14 g-usershopback text-under" href="/user/goodsShop">返回</a>

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
{!! Theme::asset()->container('custom-js')->usepath()->add('pubgoods','js/pubgoods.js') !!}
{!! Theme::widget('fileUpload')->render() !!}
{!! Theme::widget('ueditor')->render() !!}