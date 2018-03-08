
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="/manage/forumList">贴吧列表</a>
            </li>

            <li class="">
                <a  href="/manage/addForum">发布新贴</a>
            </li>
        </ul>
    </div>
</div>


<form class="form-inline" action="/manage/forumList" method="get">
    <div class="well">

        <div class="form-group search-list width285">
            <label class="">分类　</label>
            <select name="class">
                <option value="">全部</option>
                @foreach($class as $item)
                    <option value="{{ $item['id'] }}" @if(isset($request['class']) && $item['id']==$request['class']) selected="selected" @endif>{{$item['name']}}</option>
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
                <th>用户名</th>
                <th>标题</th>
                <th>分类</th>
                <th>发布类型</th>
                <th>访问量</th>
                <th>发布时间</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            @if(!empty($forum))
            @foreach($forum as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['user_name']}}</td>
                <td>{{$item['title']}}</td>
                <td>{{$item['class']}}</td>
                <td>@if($item['type'] == 1)官方发布 @else 用户发布 @endif</td>
                <td>{{$item['reading_volume']}}</td>
                <td>{{$item['created_at']}}</td>
                <td>
                    <div class="hidden-sm hidden-xs btn-group">
                        <a title="浏览" class="btn btn-xs btn-success" href="/article/{{$item['id']}}">
                            <i class="ace-icon fa fa-search bigger-120"></i>查看
                        </a>
                        @if($item['type'] == 1)
                        <a class="btn btn-xs btn-info" href="/manage/updateForum/{{$item['id']}}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
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
                    {!! $forum->render() !!}
                </ul>
            </div>
        </div>
    </div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}


