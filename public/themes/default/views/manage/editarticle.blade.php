
                        <div class="widget-header mg-bottom20 mg-top12 widget-well">
                            <div class="widget-toolbar no-border pull-left no-padding">
                                <ul class="nav nav-tabs">
                                    <li class="">
                                        <a  @if($upID == 1) href="/manage/article/{!! $upID !!}" @elseif($upID == 3) href="/manage/articleFooter/{!! $upID !!}" @endif>文章管理</a>
                                    </li>

                                    <li class="active">
                                        <a  href="#">文章编辑</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <form class="form-horizontal" method="post" action="/manage/editArticle"  enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="g-backrealdetails clearfix bor-border interface">
                                <div class="space-8 col-xs-12"></div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 text-right">文章标题</label>
                                    <div class="text-left col-sm-9">
                                        <input type="text" name="title" value="{!! $article->title !!}">
                                        <input type="hidden" name="artID" value="{!! $article->id !!}">
                                        <input type="hidden" name="upID" value="{!! $upID !!}">
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <lebel class="col-sm-1 text-right">文章分类</lebel>
                                    <div class="text-left col-sm-9">
                                        <select name="catID">
                                            <option value="{!! $upID !!}">{!! $parent_cate->cate_name !!}</option>
                                            @if($cate)
                                            @foreach($cate as $item)
                                            <option value="{{$item['id']}}"@if(isset($article->cat_id) && $article->cat_id == $item['id'])selected="selected"@endif>{{  str_repeat("&nbsp;&nbsp;", $item['level']+1).str_repeat('  ', $item['level']).str_repeat('--', $item['level']+1).$item['cate_name'] }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 text-right">排序</label>
                                    <div class="text-left col-sm-9">
                                        <input type="text" name="displayOrder" value="{!! $article->display_order !!}">
                                        <span class="red">{{ $errors->first('displayOrder') }}</span>
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 text-right">作者</label>
                                    <div class="text-left col-sm-9">
                                        <input type="text" name="author" value="{!! $article->author !!}">
                                        <span class="red">{{ $errors->first('author') }}</span>
                                    </div>
                                </div>
                                {{--<tr>--}}
                                    {{--<td class="text-right">是否推荐：</td>--}}
                                    {{--<td class="text-left">--}}
                                        {{--<label class="">--}}
                                            {{--<input type="radio"  name="is_recommended" value="1" @if($article->is_recommended == 1)checked="checked"@endif/>--}}
                                            {{--<span class="lbl"></span>是--}}
                                            {{--<input type="radio"  name="is_recommended" value="2"@if($article->is_recommended == 2)checked="checked"@endif/>--}}
                                            {{--<span class="lbl"></span>否--}}
                                        {{--</label>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td class="text-right"></td>--}}
                                    {{--<td class="text-left">--}}
                                        {{--<div class="memberdiv pull-left">--}}
                                            {{--<div class="position-relative">--}}
                                                {{--<input multiple="" type="file" id="id-input-file-3" name="pic"/>--}}
                                                {{--@if(!empty($article->pic))<img src="{!! url($article->pic) !!}">@endif--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 text-right">文章简介</label>
                                    <div class="text-left col-sm-9">
                                        <input type="text" name="summary" id="summary" value="{{$article['summary']}}">
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 text-right">文章内容</label>
                                    <div class="text-left col-sm-8">
                                        <!--编辑器-->
                                        <div class="clearfix">
                                            <script id="editor" name="content" type="text/plain">{!! htmlspecialchars_decode($article['content']) !!}</script>
                                            {{--<div class="wysiwyg-editor" id="editor1">{!! htmlspecialchars_decode($article['content']) !!}</div>
                                            <textarea name="content" id="content" style="display: none">{!! htmlspecialchars_decode($article['content']) !!}</textarea>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 text-right">SEO标题</label>
                                    <div class="text-left col-sm-9">
                                        <textarea name="seotitle">{!! $article->seotitle !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 text-right">SEO关键词</label>
                                    <div class="text-left col-sm-9">
                                        <textarea name="keywords">{!! $article->keywords !!}</textarea>
                                    </div>
                                </div>
                                <div class="interface-bottom col-xs-12">
                                    <label class="col-sm-1 text-right">SEO描述</label>
                                    <div class="text-left col-sm-9">
                                        <textarea name="description">{!! $article->description !!}</textarea>
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
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
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
{!! Theme::widget('ueditor')->render() !!}