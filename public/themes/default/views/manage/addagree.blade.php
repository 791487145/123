<!-- /section:basics/sidebar -->
<div class="main-content">
    <!-- #section:basics/content.breadcrumbs -->
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li class="">
                <i class="ace-icon fa fa-tasks home-icon"></i>
                <a href="#">模版标签</a>
            </li>
            <li class="active">协议管理</li>
        </ul><!-- /.breadcrumb -->
        <!-- /section:basics/content.searchbox -->
    </div>

    <!-- /section:basics/content.breadcrumbs -->
    <div class="page-content-area">
        <div class="">
            <div class="col-xs-12 widget-container-col ui-sortable">
                    <div id="flow" class="tab-pane row">
                        <div class="col-sm-12">
                            <div class="widget-box">
                                <div class="widget-header widget-header-flat">
                                    <h5 class="widget-title">添加协议</h5>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="table-responsive">
                                            <form action="/manage/addAgreement" method="post">
                                                {{ csrf_field() }}
                                                <table class="table table-hover">
                                                <tbody>
                                                <tr>
                                                    <td class="text-right">协议名称：</td>
                                                    <td class="text-left">
                                                       <input type="text" name="name" id="name" value="">
                                                        {{ $errors->first('name') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">协议代号：</td>
                                                    <td class="text-left">
                                                        <input type="text" name="code_name" id="code_name" value="">
                                                        {{ $errors->first('code_name') }}
                                                    </td>
                                                </tr>
                                                {{--<tr>--}}
                                                    {{--<td class="text-right">协议内容：</td>--}}
                                                    {{--<td class="text-left">--}}
                                                        {{--<textarea name="content" class="content"></textarea>--}}
                                                        {{--{{ $errors->first('content') }}--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}

                                                <tr>
                                                    <td class="text-right">协议内容：</td>
                                                    <td class="text-left">
                                                        <!--编辑器-->
                                                        <div class="clearfix">
                                                            <div class="wysiwyg-editor" id="editor1"></div>
                                                            <textarea name="content" id="content" style="display: none"></textarea>
                                                            {{ $errors->first('content') }}
                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td class="text-right"></td>
                                                    <td class="text-left">
                                                        <button class="btn btn-primary sub_article" type="submit">提交</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->
</div><!-- /.main-content -->

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
<!-- basic scripts -->
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('touch-punch', 'plugins/ace/js/jquery.ui.touch-punch.min.js') !!}

{!! Theme::asset()->container('specific-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('autosize', 'plugins/ace/js/jquery.autosize.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('inputlimiter', 'plugins/ace/js/jquery.inputlimiter.1.3.1.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('maskedinput', 'plugins/ace/js/jquery.maskedinput.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('hotkeys', 'plugins/ace/js/jquery.hotkeys.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('wysiwyg', 'plugins/ace/js/bootstrap-wysiwyg.min.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('dataTab', 'plugins/ace/js/dataTab.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_dataTables', 'plugins/ace/js/jquery.dataTables.bootstrap.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('addarticle', 'js/doc/addarticle.js') !!}