<h3 class="header smaller lighter blue mg-bottom20 mg-top12">热词搜索管理</h3>

    <div class="well">
        <form  role="form" action="/manage/hotwordsList" method="get" class="form-inline search-group">
            <div class="form-group search-list width285">
                <label for="">请输入编号　</label>
                <input type="text" name="id" value="@if(isset($id)){!! $id !!}@endif">
            </div>
            <div class="form-group search-list width285">
                <label for="">请输入名称　</label>
                <input type="text" name="words" value="@if(isset($words)){!! $words !!}@endif">
            </div>
            <div class="form-group search-list">
                <label for="">排序　</label>
                <select name="listorder">
                    <option value="1" @if($listorder == '1')selected="selected"@endif>按编号升序</option>
                    <option value="2" @if($listorder == '2')selected="selected"@endif>按编号降序</option>
                    <option value="3" @if($listorder == '3')selected="selected"@endif>搜索量升序</option>
                    <option value="4" @if($listorder == '4')selected="selected"@endif>搜索量降序</option>
                </select>
                {{--<button type="submit" class="btn btn-primary btn-sm">搜索</button>--}}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">搜索</button>
            </div>
        </form>

        <div class="space"></div>
        <form  role="form" action="/manage/hotwordsCreate" method="post" class="form-inline search-group">
            {{ csrf_field() }}
            <div class="form-group search-list width285">
                <label for="">热词名称　　</label>
                <div class="form-group">
                    <input type="text" name="words">
                    <p class="red position-absolute">{!! $errors->first('words') !!}</p>
                </div>
            </div>
            <div class="form-group search-list width285">
                    <label for="">次数　　　　</label>
                <div class="form-group">
                    <input type="text" name="count">
                    <p class="red position-absolute">{!! $errors->first('count') !!}</p>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">添加</button>
            </div>
            {{--<td class="col-md-4">
               　　　　　　　　　　<button type="submit" class="btn btn-primary btn-sm">添加</button>
                <p></p>
            </td>--}}
        </form>
    </div>

<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">

                    {{--<input type="checkbox"  name="" class="ace allcheck"/>
                    <span class="lbl"></span>--}}
                    编号

            </th>
            <th>排序</th>
            <th>词语搜索</th>
            <th>总搜索量</th>
            <th>最近搜索时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($HotwordsList as $v)
            <tr>
                <td class="center">
                    <label>
                        <input type="checkbox" class="ace checkbox" name="chk[]" value="{!! $v->id !!}"/>
                        <span class="lbl"></span>
                        {!! $v->id !!}
                    </label>
                </td>

                <td>
                    <input type="text" name="sort" value="{!! $v->sort !!}" rel="{{ $v->id }}" onblur="changeSort(this)">
                </td>
                <td class="hidden-480">
                    {!! $v->words !!}
                </td>
                <td>
                    {!! $v->count !!}
                </td>
                <td>
                    {!! $v->time !!}
                </td>
                <td>
                    <div class="btn-group">
                        <a href="/manage/hotwordsDelete/{!! $v->id !!}">
                            <button title="删除" class="btn btn-xs btn-danger">
                                <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                            </button>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_info" id="sample-table-2_info">
            <label>
                <input type="checkbox" class="ace allcheck"/><span class="lbl"></span>
                全选
            </label>
            <button class="btn btn-primary btn-sm" id="largeDel">批量删除</button>
        </div>
    </div>
    <div class="space-10 col-xs-12"></div>
    <div class="col-sm-6">
        @if($HotwordsList->total()){!! $HotwordsList->currentPage() !!}@else 0 @endif / {!! $HotwordsList->lastPage() !!}页
    </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate paging_bootstrap text-right">
            {!! $HotwordsList->render() !!}
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('listorderedit-js', 'js/doc/listorderedit.js') !!}