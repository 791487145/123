<div class="g-main g-releasetask g-usershop">
    <h4 class="text-size16 cor-blue2f u-title">店铺设置</h4>
    <div class="space-12"></div>
    <div class="g-usershoptype clearfix">
        @if($is_company_auth == true)
        {{--企业--}}
            <div class="g-usershopico1">企</div>
            <div class="pull-left">
                <h5 class="text-size16 cor-gray51">店铺类型</h5>
                {{--企业--}}
                <p>恭喜，您当前为企业店铺！</p>
            </div>
        @else
            <div class="g-usershopico">个</div>
            <div class="pull-left">
                <h5 class="text-size16 cor-gray51">店铺类型</h5>
                <p>你当前为个体店铺，进行<a href="/user/enterpriseAuth">企业认证</a>可升级为企业店铺</p>
            </div>
        @endif

    </div>
    <form method="post" action="/user/shop" enctype="multipart/form-data" id="shop_info">
        {{csrf_field()}}
        <input type="hidden" name="id"
               @if(isset($shop_info->id) && !empty($shop_info->id))value="{!! $shop_info->id !!}"@endif>
        <input type="hidden" name="type" @if($is_company_auth == true) value="2" @else value="1"@endif>
        <div class="g-userimgup profile-users g-usershopform ">
            <div class="clearfix g-userimgupbor" data-placement="right" href="#">
                <p class="pull-left h5 cor-gray51"><span>上传封面</span></p>
                <div class="memberdiv pull-left">
                    <div class="position-relative">
                        <input name="shop_pic" type="file" id="id-input-file-6"/>
                    </div>
                </div>
                @if(isset($shop_info->shop_pic) && !empty($shop_info->shop_pic))
                <div class="pull-left" style="width: 158px;height: 120px">
                    <img src=" {!!  url($shop_info->shop_pic) !!}" class="img-responsive"/>
                </div>
                @endif
                <div class="pull-right cor-gray87 visible-lg-block">
                    <p>1. 封面是店铺展示方式的重要入口</p>

                    <p>2. 优秀的作品封面更能吸引客户关注</p>

                    <p>3. 尺寸必须为450*450像素,大小不超过3M，请保持图片清晰，<br>　能够体现卖点</p>

                </div>

            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">店铺名称</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <input class="inputxt Validform_error input-large" type="text" name="shop_name"
                           @if(isset($shop_info->shop_name) && !empty($shop_info->shop_name))value="{!! $shop_info->shop_name !!}" @endif
                           datatype="*2-10" nullmsg="请填写店铺名称！" errormsg="店铺名称字数超过限制">
                </p>
            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">店铺介绍</p>
                <div class="g-userimgupinp g-userimgupbor-validform">
                    <textarea name="shop_desc" datatype="*" nullmsg="请填写店铺介绍！">@if(isset($shop_info->shop_desc) && !empty($shop_info->shop_desc)){!! htmlspecialchars_decode($shop_info->shop_desc) !!}@endif</textarea>
                    <span class="Validform_checktip position-validform"></span>
                </div>
            </div>
            <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">店铺地址</p>
                <p class="g-userimgupinp g-userimgupbor-validform">
                    <select name="province" id="province">
                        <option value="">-请选择省-</option>
                        @if(isset($province) && is_array($province))
                            @foreach($province as $k => $v)
                                <option value="{{$v['id']}}" @if(isset($shop_info->province) && $shop_info->province == $v['id']) selected="selected" @endif>
                                    {{$v['name']}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <select name="city" id="city">
                        <option value="">-请选择市-</option>
                        @if(isset($city) && is_array($city))
                            @foreach($city as $k => $v)
                                <option value="{{$v['id']}}" @if(isset($shop_info->city) && $shop_info->city == $v['id']) selected="selected" @endif>
                                    {{$v['name']}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </p>
            </div>
            <div class="clearfix g-userimgupbor task-casehid g-usershoplab"><p class="pull-left h5 cor-gray51">店铺标签</p>
                <div class="g-userimgupinp g-userimgupbor-validform">
                    <input placeholder="点击空白处输入标签" name="tags" id="tags" type="hidden" value="">
                    <select multiple="" class="chosen-select tag-input-style" id="form-field-select-4" data-placeholder="请选择标签...">
                        @if($all_tag)
                            @foreach($all_tag as $v)
                                <option value="{{ $v['id'] }}" @if(isset($tags)){{ in_array($v['id'],$tags)?'selected':'' }} @endif>{{ $v['tag_name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="cor-orange text-size14 g-usershopi">
                        <i class="fa fa-exclamation-circle cor-orange text-size18"></i>
                        添加技能标签，让更多人找到你，最多设置三个标签
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-imp btn-blue g-usershopbtn">保存</button>

        </div>
    </form>
</div>


{!! Theme::asset()->container('specific-css')->usePath()->add('webui-css', 'plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('usercenter-css', 'css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('chosen','plugins/ace/css/chosen.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('chosen','plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-min-js', 'plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-elements-js', 'plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('realname-js', 'js/realnameauth.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('skill','js/doc/skill.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shop','js/doc/shop.js') !!}
{!! Theme::widget('avatar')->render() !!}