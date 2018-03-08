<div class="g-main g-main-right">
    <h4 class="text-size16 cor-blue2f u-title">实名认证</h4>

    <div class="space-20"></div>
    <div class="tab-pane g-userimgup">
        <form class="registerform" enctype="multipart/form-data" method="post"
              action="{!! url('user/realnameAuth') !!}">
            {!! csrf_field() !!}
            <div class="row profile-users" id="user-profile-2">
                <div class="col-md-12 realimg">
                    <div class="clearfix g-userimgupbor task-casehid">
                        <p class="pull-left h5 cor-gray51">真实姓名</p>
                        <p class="g-userimgupinp g-userimgupbor-validform">
                            <input type="text" name="realname" class="inputxt input-large" datatype="zh2-4" errormsg="请输入2到4位中文字符" nullmsg="请填写真实姓名！"/>&nbsp;&nbsp;&nbsp;
                        </p>
                    </div>
                    <div class="clearfix g-userimgupbor task-casehid"><p class="pull-left h5 cor-gray51">身份证号</p>
                        <p class="g-userimgupinp g-userimgupbor-validform">
                            <input class="inputxt Validform_error input-large" type="text" errormsg="您填写的身份证号码不对！" nullmsg="请填写身份证号码！" datatype="idcard" name="card_number" value="">&nbsp;&nbsp;&nbsp;
                        </p>
                    </div>
                    <div class="clearfix g-userimgupbor" data-placement="right" href="#"><p
                                class="pull-left h5 cor-gray51"><span>证件正面</span></p>

                        <div class="memberdiv pull-left">
                            <div class="position-relative">
                                <input name="card_front_side" type="file" id="id-input-file-3"/>
                            </div>
                        </div>
                        <div class="pull-left cor-gray87 hidden-xs">
                            <p>1.必须看清证件信息，且证件信息不能被遮挡；</p>

                            <p>2.仅支持.jpg .bmp .png .gif 的图片格式，<b class="cor-gray51">图片大小不超过3M</b>；</p>

                            <p>3.您提供的照片信息将予以保护，不会用于其他用途。</p>

                            <p>4. <a class="cor-blue2f" data-toggle="modal" href="#g-userzmimg">[示例：查看身份证正面照]</a></p>
                        </div>
                        <div class="modal fade" id="g-userzmimg" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <img src="{!! Theme::asset()->url('images/userimgzm.png') !!}">
                                    <button class="close" aria-label="Close" data-dismiss="modal"
                                            type="button"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix g-userimgupbor" data-placement="right" href="#"><p
                                class="pull-left h5 cor-gray51">
                            <span>证件反面</span></p>

                        <div class="memberdiv pull-left">
                            <div class="position-relative">
                                <input name="card_back_dside" type="file" id="id-input-file-4"/>
                            </div>
                        </div>
                        <div class="pull-left cor-gray87 hidden-xs">
                            <p>1.必须看清证件信息，且证件信息不能被遮挡；</p>

                            <p>2.仅支持.jpg .bmp .png .gif 的图片格式，<b class="cor-gray51">图片大小不超过3M</b>；</p>

                            <p>3.您提供的照片信息将予以保护，不会用于其他用途。</p>

                            <p>4. <a class="cor-blue2f" data-toggle="modal" data-toggle="modal" href="#g-userfmimg">[示例：查看身份证反面照]</a>
                            </p>
                        </div>
                        <div class="modal fade" id="g-userfmimg" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <img src="{!! Theme::asset()->url('images/userimgfm.png') !!}">
                                    <button class="close" aria-label="Close" data-dismiss="modal"
                                            type="button"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix g-userimgupbor" data-placement="right" href="#">
                        <p class="pull-left h5 cor-gray51"><span>示范图片</span></p>

                        <div class="memberdiv pull-left">
                            <div class="position-relative">
                                <input name="validation_img" type="file" id="id-input-file-5"/>
                            </div>
                        </div>
                        <div class="pull-left cor-gray87 hidden-xs">
                            <p>1.清上传本人手持身份证正面头部照片和上半身照片；</p>

                            <p>2.照片为免冠、未化妆的数码照片原始图片，请勿编辑修改；</p>

                            <p>3.必须看清证件信息，且证件信息不能被遮挡，持证人五官清晰可见；</p>

                            <p>4.仅支持.jpg .bmp .png .gif 的图片格式，<b class="cor-gray51">图片大小不超过3M</b>;</p>

                            <p>5.您提供的照片信息将予以保护，不会用于其他用途。</p>

                            <p>6. <a class="cor-blue2f" data-toggle="modal" href="#g-userscimg">[示例：查看手持身份证图片]</a></p>
                        </div>
                        <div class="modal fade" id="g-userscimg" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <img src="{!! Theme::asset()->url('images/userimgdf.png') !!}">
                                    <button class="close" aria-label="Close" data-dismiss="modal"
                                            type="button"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div class="space-20"></div>
                <button id="btn_sub" type="button" class="u-userimgupbtn btn-imp">立即申请</button>
                <div class="space-10"></div>
            </div>
        </form>
    </div>
</div>

{!! Theme::asset()->container('specific-css')->usePath()->add('webui-css', 'plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-min-js', 'plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('ace-elements-js', 'plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('realname-js', 'js/realnameauth.js') !!}
{!! Theme::widget('avatar')->render() !!}
{{--{!! Theme::asset()->container('specific-js')->usePath()->add('common-js', 'js/common.js') !!}--}}