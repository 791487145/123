{{--<div class="page-header">
    <h1>
        行业详情
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">行业详情</h3>

<div class="g-backrealdetails clearfix bor-border">
                <!-- PAGE CONTENT BEGINS -->
                <form class="form-inline" role="form" method="post" action="/manage/industryInfo" enctype="multipart/form-data">
                    {!!  csrf_field() !!}
                            <!-- #section:elements.form -->
                    <div class="bankAuth-bottom clearfix col-xs-12">
                        <p class="col-sm-1 text-right" for="form-field-1"> 当前分类： </p>

                        <p class="col-sm-4" for="form-field-1"> {!! $cate['name'] !!} </p>
                        <input name="id" type="hidden" value="{!! $cate['id'] !!}">
                        <input name="pid" type="hidden" value="{!! $cate['pid'] !!}">
                    </div>

                    <div class="bankAuth-bottom clearfix col-xs-12">
                        <p class="col-sm-1 text-right" for="form-field-1"> 所属分类： </p>

                        <p class="col-sm-4 no-padding-right" for="form-field-1"> @if($cate['pid'] == 0)全部@else{!! $parent_cate['name'] !!}@endif </p>
                    </div>
                    <div class="bankAuth-bottom clearfix col-xs-12">
                        <p class="col-sm-1 text-right" for="form-field-1"> 当前logo： </p>

                        <div class="col-sm-4">
                            <div class="memberdiv pull-left">
                                <div class="position-relative">
                                    <input multiple="" type="file" id="id-input-file-3" name="pic"/>
                                    @if($cate['pic'])
                                    <img src="{!! url($cate['pic']) !!} " width="152" height="126">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p class="col-sm-3 no-padding-right text-left red" for="form-field-1"> 该图标适用于APP端，与PC端无关联 <br>(建议上传图标尺寸大小为64px*64px)</p>
                        <div class="space-6 col-xs-12"></div>
                    </div>

                    {{--<div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <div class="row">
                                <button class="btn btn-info btn-sm" type="submit">
                                    提交
                                </button>
                            </div>

                        </div>
                    </div>--}}
                    <div class="col-xs-12">
                        <div class="clearfix row bg-backf5 padding20 mg-margin12">
                            <div class="col-xs-12">
                                <div class="col-md-1 text-right"></div>
                                <div class="col-md-10"><button type="submit" class="btn btn-primary btn-sm">提交</button></div>
                            </div>
                        </div>
                    </div>
                    <div class="space col-xs-12"></div>
                    <div class="col-xs-12">
                        <div class="col-md-1 text-right"></div>
                        <div class="col-md-10"><a href="">上一项</a>　　<a href="">下一项</a></div>
                    </div>
                    <div class="col-xs-12 space">

                    </div>

                </form>
            </div><!-- /.col -->


{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--上传图片--}}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('touch-punch', 'plugins/ace/js/jquery.ui.touch-punch.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('autosize', 'plugins/ace/js/jquery.autosize.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('inputlimiter', 'plugins/ace/js/jquery.inputlimiter.1.3.1.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('maskedinput', 'plugins/ace/js/jquery.maskedinput.min.js') !!}


{!! Theme::asset()->container('custom-js')->usepath()->add('configsite', 'js/doc/configsite.js') !!}