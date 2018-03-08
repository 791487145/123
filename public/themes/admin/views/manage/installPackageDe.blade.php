
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">详情</</h3>

    <div class="g-backrealdetails clearfix bor-border">

        <form class="form-horizontal clearfix registerform" role="form"  action="{!! url('manage/installPackageUp') !!}" method="post" enctype="multipart/form-data">
            <input type="hidden" @if(isset($package['id']))value="{!! $package['id'] !!}"@endif name="id">
            {!! csrf_field() !!}

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 版本号：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="version" @if(isset($package['version']))value="{!! $package['version'] !!}"@endif>
                </p>
            </div>

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 上传安装包：</p>
                <p class="col-sm-4">
                    <input type="file" id="form-field-1"  class="col-xs-10 col-sm-5" name="name">
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 更新说明：</p>
                <p class="col-sm-4">
                    <textarea name="describe" cols="100" rows="5">@if(isset($package['describe'])){!! $package['describe'] !!} @endif</textarea>
                </p>
            </div>

            <div class="col-xs-12">
                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                    <div class="col-xs-12">
                        <div class="col-md-1 text-right"></div>
                        <div class="col-md-10">
                            <button class="btn btn-primary" type="submit">修改</button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>


{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}