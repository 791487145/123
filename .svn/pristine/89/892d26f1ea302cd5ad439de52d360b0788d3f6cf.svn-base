
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">失物招领</h3>
<form class="form-inline" action="/manage/lastAndFound" method="get">
    <div class="well">

        <div class="form-group search-list width285">
            <label class="">物品类型　</label>
            <select name="class">
                <option value="">全部</option>
                @foreach($class as $item)
                    <option value="{{ $item['id'] }}" @if(isset($request['class']) && $item['id']==$request['class']) selected="selected" @endif>{{$item['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group search-list width285">
            <label class="">类型　</label>
            <select name="type">
                <option value="">不限</option>
                @foreach($type as $item)
                    <option value="{{ $item['id'] }}" @if(isset($request['type']) && $item['id']==$request['type']) selected="selected" @endif>{{$item['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="space"></div>
        <div class="form-group search-list width285">
            <label class="">状态　</label>
            <select name="status">
                <option value="">不限</option>
                @foreach($status as $item)
                    <option value="{{ $item['id'] }}" @if(isset($request['status']) && $item['id']==$request['status']) selected="selected" @endif>{{$item['name']}}</option>
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
                <th>标题</th>
                <th>物品名称</th>
                <th>物品类型</th>
                <th>丢失时间</th>
                <th>类型</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            @if(!empty($goods))
            @foreach($goods as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['title']}}</td>
                <td>{{$item['goods_name']}}</td>
                <td>{{$item['class_name']}}</td>
                <td>{{$item['last_or_found_time']}}</td>
                <td>
                    @if($item['type'] == 1) 寻物
                    @elseif($item['type'] == 2) 招领
                    @endif
                </td>
                <td>
                    @if($item['status'] == 'valid') 寻找中
                    @elseif($item['status'] == 'invalid') 已关闭
                    @endif
                </td>
                <td>
                    <div class="hidden-sm hidden-xs btn-group">
                        <a title="浏览" class="btn btn-xs btn-success" href="/manage/lastAndFoundDet/{{$item['id']}}">
                            <i class="ace-icon fa fa-search bigger-120"></i>查看
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
<div class="col-xs-12">
    <div class="dataTables_paginate paging_bootstrap row">
        <ul class="pagination">
            {!! $goods->render() !!}
        </ul>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}


