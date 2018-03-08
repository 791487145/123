
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="/manage/bookList">书籍管理</a>
            </li>

            <li class="">
                <a  href="/manage/addBook">发布新书</a>
            </li>
        </ul>
    </div>
</div>


<form class="form-inline" action="/manage/bookList" method="get">
    <div class="well">
        <div class="form-group search-list ">
            <label for="">书名　</label>
            <input type="text" name="book_name" value="@if(isset( $request['book_name'])){!! $request['book_name'] !!}@endif">
        </div>
        <div class="form-group search-list">
            <label for="">作者　</label>
            <input type="text"name="author" value="@if(isset( $request['author'])){!! $request['author'] !!}@endif">
        </div>
        <div class="form-group search-list width285">
            <label class="">书籍类型　</label>
            <select name="book_type">
                <option value="">全部</option>
                @foreach($book_type as $item)
                    <option value="{{ $item['id'] }}" @if(isset($request['book_type']) && $item['id']==$request['book_type']) selected="selected" @endif>{{$item['name']}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group search-list width285">
            <label class="">状态　</label>
            <select name="book_status">
                <option value="">不限</option>
                @foreach($book_status as $item)
                    <option value="{{ $item['id'] }}" @if(isset($request['book_status']) && $item['id']==$request['book_status']) selected="selected" @endif>{{$item['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="space"></div>
        <div class="form-group search-list width285">
            <label class="">发布类型　</label>
            <select name="type">
                <option value="">不限</option>
                @foreach($type as $item)
                    <option value="{{ $item['id'] }}" @if(isset($request['type']) && $item['id']==$request['type']) selected="selected" @endif>{{$item['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group search-list">
            <label for="">发布时间　</label>
            <div class="input-daterange input-group">
                <input type="text" name="start" class="input-sm form-control" value="@if(isset($request['start'])){!! $request['start'] !!}@endif">
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end" class="input-sm form-control" value="@if(isset($request['end'])){!! $request['end'] !!}@endif">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary">搜索</button>
        </div>
    </div>
</form>
<div>
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>序号</th>
                <th>作者</th>
                <th>书籍名称</th>
                <th>封面</th>
                <th>书籍类型</th>
                <th>状态</th>
                <th>阅读量</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            @if(!empty($book))
            @foreach($book as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['author']}}</td>
                <td>{{$item['book_name']}}</td>
                <td><img src="/{{$item['book_cover']}}" alt="" height="30px"></td>
                <td>{{$item['book_type']}}</td>
                <td>
                    @if($item['book_status'] == 1) 待审核
                    @elseif($item['book_status'] == 2) 未通过
                    @elseif($item['book_status'] == 3) 未支付
                    @elseif($item['book_status'] == 4) 创作中
                    @elseif($item['book_status'] == 5) 已完成
                    @endif
                </td>
                <td>{{$item['reading_volume']}}</td>
                <td>
                    <div class="hidden-sm hidden-xs btn-group">
                        <a title="浏览" class="btn btn-xs btn-success" href="/article/{{$item['id']}}">
                            <i class="ace-icon fa fa-search bigger-120"></i>查看
                        </a>
                        @if($item['type'] == 1)
                        <a class="btn btn-xs btn-info" href="/manage/updateBook/{{$item['id']}}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        {{--<a title="删除" class="btn btn-xs btn-danger" href="/manage/articleDelete/{{$item['id']}}" >--}}
                            {{--<i class="ace-icon fa fa-trash-o bigger-120"></i>删除--}}
                        {{--</a>--}}
                        @endif

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
            <div class="dataTables_paginate paging_bootstrap text-right">
                <ul class="pagination">
                    {!! $book->render() !!}
                </ul>
            </div>
        </div>
    </div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}


