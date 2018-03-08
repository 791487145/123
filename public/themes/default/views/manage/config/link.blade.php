<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li>
                <a href="/manage/config/site">站点配置</a>
            </li>
            <li class="active">
                <a href="/manage/config/link">关注链接</a>
            </li>
            <li>
                <a href="/manage/config/seo">SEO配置</a>
            </li>
            <li class="">
                <a href="/manage/config/email">邮箱配置</a>
            </li>
        </ul>
    </div>
</div>
<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="/manage/config/link">
    {{csrf_field()}}
    <div class="g-backrealdetails clearfix bor-border interface">

        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">新浪微博</label>

            <div class="col-sm-4">
                <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="sina_url"
                       @if($site['sina']['sina_url']) value="{{$site['sina']['sina_url']}}" @endif>
                <div class="col-xs-12 space-4"></div>
                <div class="">
                    <label><input class="ace" type="radio" name="sina_switch" value="2"
                                  @if($site['sina']['sina_switch'] && $site['sina']['sina_switch'] == 2)checked="checked"@endif>
                        <span class="lbl"> 关闭 </span>
                    </label>
                    <label><input class="ace" type="radio" name="sina_switch" value="1"
                                  @if($site['sina']['sina_switch'] && $site['sina']['sina_switch'] == 1)checked="checked"@endif>
                        <span class="lbl"> 开启</span>
                    </label>
                </div>
            </div>
            <div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 请输入完整链接（以http或https开头）</div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">腾讯微博</label>

            <div class="col-sm-4">
                <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="tencent_url"
                       @if($site['tencent']['tencent_url'])value="{{$site['tencent']['tencent_url']}}" @endif>
                <div class="col-xs-12 space-4"></div>
                <div class="">
                    <label><input class="ace" type="radio" name="tencent_switch" value="2"
                                  @if($site['tencent']['tencent_switch'] && $site['tencent']['tencent_switch'] == 2)checked="checked"@endif>
                        <span class="lbl"> 关闭 </span>
                    </label>
                    <label><input class="ace" type="radio" name="tencent_switch" value="1"
                                  @if($site['tencent']['tencent_switch'] && $site['tencent']['tencent_switch'] == 1)checked="checked"@endif>
                        <span class="lbl"> 开启</span>
                    </label>
                </div>
            </div>
            <div class="col-sm-5 h5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 请输入完整链接（以http或https开头）</div>
        </div>

        <div class="form-group  interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">微信</label>

            <div class="col-sm-4">
                <div class="memberdiv">
                    <div class="position-relative">
                        <label class="ace-file-input ace-file-multiple">
                            <input multiple="" type="file" id="id-input-file-4img" name="wechat_pic">
                        </label>
                        @if($site['wechat']['wechat_pic'])
                            <img src="{!! url($site['wechat']['wechat_pic']) !!}"  width="100px" height="100px">
                        @endif
                    </div>


                </div>
                <div class="space-4"></div>
                <div class="">
                    <label><input class="ace" type="radio" name="wechat_switch" value="2"
                                  @if($site['wechat']['wechat_switch'] && $site['wechat']['wechat_switch'] == 2)checked="checked"@endif>
                        <span class="lbl"> 关闭 </span>
                    </label>
                    <label><input class="ace" type="radio" name="wechat_switch" value="1"
                                  @if($site['wechat']['wechat_switch'] && $site['wechat']['wechat_switch'] == 1)checked="checked"@endif>
                        <span class="lbl"> 开启</span>
                    </label>
                </div>
            </div>
            <div class="col-sm-5 h5 cor-gray87">
                <i class="fa fa-exclamation-circle cor-orange text-size18"></i>
                图片大小100px*100px
            </div>
        </div>
        <div class="interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 第三方统计代码</label>

            <div class="col-sm-4">
                <textarea rows="5" class="col-xs-10 col-sm-12" name="third_party_code">@if(!empty($site['statistic_code'])){{$site['statistic_code']}}@endif</textarea>
            </div>
            <div class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 填写第三方流量统计JS代码</div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                </div>
            </div>
        </div>

    </div>
</form>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('configsite', 'js/doc/configlink.js') !!}