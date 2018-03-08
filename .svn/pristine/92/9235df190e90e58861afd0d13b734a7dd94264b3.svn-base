
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="">
                <a  @if($upID == 1) href="/manage/article/{!! $upID !!}" @elseif($upID == 3) href="/manage/articleFooter/{!! $upID !!}" @endif>文章管理</a>
            </li>

            <li class="active">
                <a  @if($upID == 1) href="/manage/addArticle/{!! $upID !!}" @elseif($upID == 3) href="/manage/addArticleFooter/{!! $upID !!}" @endif>文章新建</a>
            </li>
        </ul>
    </div>
</div>

<form class="form-horizontal" action="/manage/addArticle" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">文章标题</label>
            <div class="text-left col-sm-9">
                <input type="text" name="title" id="title" value="">
                {{ $errors->first('title') }}
                <input type="hidden" name="upID" value="{!! $upID !!}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <lebel class="col-sm-1 text-right">文章分类</lebel>
            <div class="text-left col-sm-9">
                <select name="catID">
                    <option value="{!! $upID !!}">{!! $parent_cate->cate_name !!}</option>
                    @if($category)
                        @foreach($category as $item)
                            <option value="{{$item['id']}}"@if(isset($upID) && $upID == $item['id'])selected="selected"@endif>{{  str_repeat("&nbsp;&nbsp;", $item['level']+1).str_repeat('  ', $item['level']).str_repeat('--', $item['level']+1).$item['cate_name'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">排序</label>
            <div class="text-left col-sm-9">
                <input type="text" name="displayOrder" id="displayOrder" value="">
                {{ $errors->first('displayOrder') }}
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">作者</label>
            <div class="text-left col-sm-9">
                <input type="text" name="author" id="author" value="">
                {{ $errors->first('author') }}
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">文章简介</label>
            <div class="text-left col-sm-9">
                <input type="text" name="summary" id="summary" value="">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">文章内容</label>
            <div class="text-left col-sm-8">
                <!--编辑器-->
                <div class="clearfix">
                    <script id="editor" name="content"  type="text/plain" style="width:100%;height:300px;" >{!! old('description') !!}</script>
                    {{--<div class="wysiwyg-editor" id="editor1"></div>--}}
                    {{--<textarea name="content" id="content" style="display: none"></textarea>--}}
                    {{ $errors->first('content') }}
                </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">SEO标题</label>
            <div class="text-left col-sm-9">
                <textarea name="seotitle" id="seotitle"></textarea>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">SEO关键词</label>
            <div class="text-left col-sm-9">
                <textarea name="keywords" id="keywords"></textarea>
            </div>
        </div>
        <div class="interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">SEO描述</label>
            <div class="text-left col-sm-9">
                <textarea name="description" id="description"></textarea>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                </div>
            </div>
        </div>
        {{-- <tr>
             <td class="text-right col-sm-3"></td>
             <td class="text-left col-sm-9">
                 <button class="btn btn-primary sub_article btn-sm" type="submit">提交</button>
             </td>
         </tr>--}}
    </div>
</form>


{{--<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <!-- /section:basics/sidebar -->
    <div class="main-content">
        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content-area">
            <div class="">
                <div class="col-xs-12 widget-container-col ui-sortable">
                    <div class="widget-box transparent ui-sortable-handle">
                        <div class="widget-header">
                            <div class="widget-toolbar no-border">
                                <ul class="nav nav-tabs" id="myTab2">
                                    <li class="">
                                        <a  @if($upID == 1) href="/manage/article/{!! $upID !!}" @elseif($upID == 3) href="/manage/articleFooter/{!! $upID !!}" @endif>文章管理</a>
                                    </li>

                                    <li class="active">
                                        <a  @if($upID == 1) href="/manage/addArticle/{!! $upID !!}" @elseif($upID == 3) href="/manage/addArticleFooter/{!! $upID !!}" @endif>文章新建</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                                <div id="flow" class="tab-pane row">
                                    <div class="col-sm-12">
                                        <div class="widget-box">
                                            <div class="widget-header widget-header-flat">
                                                <h5 class="widget-title">文章新建</h5>
                                            </div>


                                            <div class="widget-body">
                                                <div class="widget-main row">
                                                    <div class="table-responsive">
                                                        <form action="/manage/addArticle" method="post" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                            <table class="table table-hover">
                                                            <tbody>
                                                            <tr>
                                                                <td class="text-right col-sm-3">文章标题：</td>
                                                                <td class="text-left col-sm-9">
                                                                    <input type="text" name="title" id="title" value="">
                                                                    {{ $errors->first('title') }}
                                                                    <input type="hidden" name="upID" value="{!! $upID !!}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right col-sm-3">文章分类：</td>
                                                                <td class="text-left col-sm-9">
                                                                    <select name="catID">
                                                                        <option value="{!! $upID !!}">{!! $parent_cate->cate_name !!}</option>
                                                                        @if($category)
                                                                        @foreach($category as $item)
                                                                        <option value="{{$item['id']}}"@if(isset($upID) && $upID == $item['id'])selected="selected"@endif>{{  str_repeat("&nbsp;&nbsp;", $item['level']+1).str_repeat('  ', $item['level']).str_repeat('--', $item['level']+1).$item['cate_name'] }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right col-sm-3">排序：</td>
                                                                <td class="text-left col-sm-9">
                                                                    <input type="text" name="displayOrder" id="displayOrder" value="">
                                                                    {{ $errors->first('displayOrder') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right col-sm-3">作者：</td>
                                                                <td class="text-left col-sm-9">
                                                                    <input type="text" name="author" id="author" value="">
                                                                    {{ $errors->first('author') }}
                                                                </td>
                                                            </tr>
                                                            --}}{{--<tr>--}}{{--
                                                                --}}{{--<td class="text-right">是否推荐：</td>--}}{{--
                                                                --}}{{--<td class="text-left">--}}{{--
                                                                    --}}{{--<label class="">--}}{{--
                                                                        --}}{{--<input type="radio"  name="is_recommended" value="1" checked/>--}}{{--
                                                                        --}}{{--<span class="lbl"></span>是--}}{{--
                                                                        --}}{{--<input type="radio" name="is_recommended" value="2"/>--}}{{--
                                                                        --}}{{--<span class="lbl"></span>否--}}{{--
                                                                    --}}{{--</label>--}}{{--
                                                                --}}{{--</td>--}}{{--
                                                            --}}{{--</tr>--}}{{--
                                                            --}}{{--<tr>--}}{{--
                                                                --}}{{--<td class="text-right"></td>--}}{{--
                                                                --}}{{--<td class="text-left">--}}{{--
                                                                    --}}{{--<div class="memberdiv pull-left">--}}{{--
                                                                        --}}{{--<div class="position-relative">--}}{{--
                                                                            --}}{{--<input multiple="" type="file" id="id-input-file-3" name="pic" />--}}{{--
                                                                        --}}{{--</div>--}}{{--
                                                                    --}}{{--</div>--}}{{--
                                                                --}}{{--</td>--}}{{--
                                                            --}}{{--</tr>--}}{{--
                                                            <tr>
                                                                <td class="text-right col-sm-3">文章简介：</td>
                                                                <td class="text-left col-sm-9">
                                                                    <input type="text" name="summary" id="summary" value="">
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-right col-sm-3">文章内容：</td>
                                                                <td class="text-left col-sm-9">
                                                                    <!--编辑器-->
                                                                    <div class="clearfix">
                                                                        <script id="editor" name="content"  type="text/plain" style="width:100%;height:300px;" >{!! old('description') !!}</script>
                                                                        --}}{{--<div class="wysiwyg-editor" id="editor1"></div>--}}{{--
                                                                        --}}{{--<textarea name="content" id="content" style="display: none"></textarea>--}}{{--
                                                                        {{ $errors->first('content') }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right col-sm-3">SEO标题：</td>
                                                                <td class="text-left col-sm-9">
                                                                    <textarea name="seotitle" id="seotitle"></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right col-sm-3">SEO关键词：</td>
                                                                <td class="text-left col-sm-9">
                                                                    <textarea name="keywords" id="keywords"></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right col-sm-3">SEO描述：</td>
                                                                <td class="text-left col-sm-9">
                                                                    <textarea name="description" id="description"></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right col-sm-3"></td>
                                                                <td class="text-left col-sm-9">
                                                                    <button class="btn btn-primary sub_article btn-sm" type="submit">提交</button>
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
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content-area -->
    </div><!-- /.main-content -->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->--}}
{!! Theme::widget('ueditor')->render() !!}
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
