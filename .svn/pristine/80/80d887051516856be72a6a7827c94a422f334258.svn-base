
<div class="focusmain cpr">
    <div class="widget-box cmt">
        <div class="widget-header widget-header-flat"><h4 class="focustitle">用户头像</h4></div>
        <div class="form-group form-horizontal datum">
            <div class="row cm">
                <div class="row"><div class="col-md-offset-1 col-sm-3 fileimgtitle">选择上传方式</div></div>
                <form action='/user/ajaxHead' id="form" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group row skillabel">
                        <div class="col-md-offset-1 col-md-11">
                            <form action='/user/ajaxHead' id="form" method="post" enctype="multipart/form-data">
                                <div class="clearfix">
                                    <div class="localimg" >
                                        <input value="上传图片" type="file" id="file_upload" name="picture" imgurl="{!! Theme::asset()->url('img/localimg.gif') !!}" url="{!! Theme::asset()->url('uploadify_bak.swf') !!}">
                                    </div>
                                    <div class="takeimg" style="background:url({!! Theme::asset()->url('img/takeimg.gif') !!}) no-repeat;">
                                        <input class="takeimg" type="file">
                                    </div>
                                </div>
                            </form>
                            <div class="filehint">仅支持JPG、GIF、PNG格式，图片小于5MB。（使用高质量图片，可生成高清头像）</div>
                            <div class="row">
                                <div class="col-sm-5 fileleft">
                                    <div class="filebg">
                                        <div style="height:192px;margin-bottom: 8px;margin-left: -4px;">
                                            <img class="filebgimg cropper" src="{!! asset($avatar.md5($id.'large').'.jpg') !!}" id="headimg" alt="Picture" />
                                        </div>
                                        <div>
                                            <p>本地照片：选择一张本地的图片后上传为头像</p>
                                            <p>拍照照片：通过摄像头拍照编辑后上传头头像</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7 fileright">
                                    <div>
                                        <p class="text-orange"><span class="fa fa-exclamation-circle"></span> 您上传的图片将会自动生成三种尺寸头像，请注意小尺寸的头像是否清晰</p>
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <div class="filebg150 preview preview-lg" style="padding-top:0px;"></div>
                                                <p>大尺寸头像：150*150像素</p>
                                            </div>
                                            <div class="pull-left">
                                                <div>
                                                    <div class="filebg100 preview preview-md" style="padding-top:0px;float:none;">
                                                        {{--<div class="filebgimg100"></div>--}}
                                                    </div>
                                                    <p>大尺寸头像：100*100像素</p>
                                                </div>
                                                <div>
                                                    <div class="filebg50 preview preview-sm" style="padding-top:0px;float:none;">
                                                        <div class="filebgimg50"></div>
                                                    </div>
                                                    <p>大尺寸头像：50*50像素</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="skillbtn"><button type="button" id="uploadHead" token="{!! csrf_token() !!}" data-toggle="button" >保存裁剪</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('cropper','css/cropper.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('docs','css/docs.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('header','css/newindex/header.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('footer','css/newindex/footer.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('userimg','css/newindex/usercenter/userimg.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('uploadify', 'js/jquery.uploadify.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('cropper', 'js/cropper.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('docs', 'js/docs.js') !!}