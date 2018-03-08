<h3 class="header smaller lighter blue mg-top12 mg-bottom20">VIP首页</h3>
<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="/manage/config/vip">
    {{--<input type="hidden" name="_token" value="3X6WmccLGWW9rzmJhqXkkH8tc2bzW6FhJoO1oOr7">--}}
    {!!  csrf_field() !!}
    <!-- #section:elements.form -->
    <div class="g-backrealdetails clearfix bor-border interface">

        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">签约热线</label>

            <div class="col-sm-4">
                <input type="text" id="form-field-1" placeholder="" class="col-xs-10 col-sm-12" name="hot_line" @if($vipConfig && !empty($vipConfig['hot_line']))value="{!! $vipConfig['hot_line'] !!}"@endif>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">展示图片1</label>

            <div class="col-sm-4">
                <div class="memberdiv pull-left">
                    <div class="position-relative">

                        <div id="imgdiv1">

                            <img id="imgShow1" width="120" height="120"  @if($vipConfig && !empty($vipConfig['logo1'])) src="{!! URL($vipConfig['logo1']) !!}" @endif>

                        </div>

                        <a class="filea btn btn-sm btn-primary btn-block" href="javascript:void(0);">
                            上传logo
                            <input class="btn-file" type="file" id="up_img1" name="logo1">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 该图片展示位置为VIP首页签约热线上方（建议尺寸126*32px）</div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">展示图片2</label>

            <div class="col-sm-4">
                <div class="memberdiv pull-left">
                    <div class="position-relative">

                        <div id="imgdiv2">
                            <img id="imgShow2" width="120" height="120" @if($vipConfig && !empty($vipConfig['logo2'])) src="{!! URL($vipConfig['logo2']) !!}" @endif>
                        </div>

                        <a class="filea btn btn-sm btn-primary btn-block" href="javascript:void(0);">
                            上传logo
                            <input class="btn-file" type="file" id="up_img2" name="logo2">
                        </a>
                    </div></div>
            </div>
            <div class="col-sm-5 cor-gray87"><i class="fa fa-exclamation-circle cor-orange text-size18"></i> 该图片展示位置为VIP首页轮播图开通购买区域处（建议尺寸300*240px） </div>
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

{!! Theme::asset()->container('specific-js')->usepath()->add('jquery.webui-popover', '/plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('uploadimg', 'js/doc/uploadimg.js') !!}
{!! Theme::widget('uploadimg')->render() !!}