
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a  @if($upID == 1) href="/manage/article/{!! $upID !!}" @elseif($upID == 3) href="/manage/articleFooter/{!! $upID !!}" @endif>文章管理</a>
            </li>

            <li class="">
                <a  @if($upID == 1) href="/manage/addArticle/{!! $upID !!}" @elseif($upID == 3) href="/manage/addArticleFooter/{!! $upID !!}" @endif>文章新建</a>
            </li>
        </ul>
    </div>
</div>


<form class="form-inline" @if($upID == 1) action="/manage/article/{{$upID}}" @elseif($upID == 3) action="/manage/articleFooter/{{$upID}}" @endif method="get">
    <div class="well">
        <div class="form-group search-list ">
            <label for="">文章标题　</label>
            <input type="text" name="title" value="@if(isset($title)){!! $title !!}@endif">
        </div>
        <div class="form-group search-list ">
            <label for="">文章编号　</label>
            <input type="text" name="artID" value="@if(isset( $artID)){!! $artID !!}@endif">
        </div>
        <div class="form-group search-list">
            <label for="">作者　　　</label>
            <input type="text"name="author" value="@if(isset( $author)){!! $author !!}@endif">
        </div>
        <div class="space"></div>
        <div class="form-group search-list width285">
            <label class="">文章分类　</label>
            <select name="catID">
                <option value="{{$upID}}">全部</option>
                @foreach($category as $items)
                    <option value="{{ $items['id'] }}" @if((isset($catID) && $catID == $items['id']) || ($items['id'] == $upID) && empty($catID))selected="selected"@endif>{{ str_repeat("&nbsp;&nbsp;", $items['level']).str_repeat('--', $items['level']).$items['cate_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group search-list">
            <label for="">发布时间　</label>
            <div class="input-daterange input-group">
                <input type="text" name="start" class="input-sm form-control" value="@if(isset($search['start'])){!! $search['start'] !!}@endif">
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end" class="input-sm form-control" value="@if(isset($search['end'])){!! $search['end'] !!}@endif">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary">搜索</button>
        </div>
    </div>
</form>
<form action="/manage/allDelete" method="post">
    {{csrf_field()}}
    <div>
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th class="center">
                    {{--<label>
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                        UID
                    </label>--}}
                </th>
                <th>文章分类</th>
                <th>文章标题</th>
                <th>发布时间</th>
                <th>访问量</th>
                <th>作者</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            @if(!empty($article_data))
            @foreach($article_data['data'] as $item)
            <tr>
                <td class="center">
                    <label>
                        <input type="checkbox" name="artID_{{$item['id']}}" class="ace" value="{{$item['id']}}"/>
                        <span class="lbl"></span>
                        {{$item['id']}}
                    </label>
                </td>

                <td>
                    {{$item['cate_name']}}
                </td>
                <td>
                    {{$item['title']}}
                </td>
                <td>
                    {{$item['created_at']}}
                </td>
                <td>
                    {{$item['view_times'] ? $item['view_times'] : "0"}}
                </td>
                <td>
                    {{$item['author']}}
                </td>
                <td>
                    <div class="hidden-sm hidden-xs btn-group">
                        <a title="浏览" class="btn btn-xs btn-success" href="/article/{{$item['id']}}">
                            <i class="ace-icon fa fa-search bigger-120"></i>浏览
                        </a>
                        <a class="btn btn-xs btn-info"
                           @if($upID == 1)href="/manage/editArticle/{{$item['id']}}/{!! $upID !!}"
                           @elseif($upID == 3) href="/manage/editArticleFooter/{{$item['id']}}/{!! $upID !!}" @endif target="_blank">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a title="删除" class="btn btn-xs btn-danger" href="/manage/articleDelete/{{$item['id']}}/{!! $upID !!}" >
                            <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="dataTables_info" id="sample-table-2_info">
                <label><input type="checkbox" class="ace" id="allcheck"/>
                    <span class="lbl"></span>全选
                </label>
                <button id="all_delete" type="submit" class="btn btn-sm btn-primary ">批量删除</button>
            </div>
        </div>
        <div class="space col-xs-12"></div>
        <div class="col-xs-12">
            <div class="dataTables_paginate paging_bootstrap text-right">
                <ul class="pagination">
                    {{--@if(!empty($article_data['prev_page_url']))
                        <li><a href="{!! URL('manage/article').'/'.$upID.'?'.http_build_query(array_merge($merge,['page'=>$article_data['current_page']-1])) !!}">上一页</a></li>
                    @endif
                    @if($article_data['last_page']>1)
                        @for($i=1;$i<=$article_data['last_page'];$i++)
                            <li class="{{ ($i==$article_data['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/article').'/'.$upID.'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                        @endfor
                    @endif
                    @if(!empty($article_data['next_page_url']))
                        <li><a href="{!! URL('manage/article').'/'.$upID.'?'.http_build_query(array_merge($merge,['page'=>$article_data['current_page']+1])) !!}">下一页</a></li>
                    @endif--}}
                    {!! $article->appends($merge)->render() !!}
                </ul>
            </div>
        </div>
    </div>
</form>
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

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('articlelist', 'js/doc/articlelist.js') !!}


