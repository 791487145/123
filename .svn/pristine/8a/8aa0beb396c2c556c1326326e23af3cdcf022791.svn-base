<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="">
                <a href="/advertisement/recommendList">推荐位管理</a>
            </li>
            <li class="active">
                <a href="/advertisement/serverList">推荐位列表</a>
            </li>
        </ul>
    </div>
</div>


<form class="form-inline"  role="form" action="/advertisement/serverList" method="get">
    <div class="well">
        <div class="form-group search-list ">
            <label for="">推荐名称　　　</label>
            <input type="text" id="recommend_name" name="recommend_name" value="@if(isset($recommend_name)){!! $recommend_name !!}@endif">
        </div>
        <div class="form-group search-list width285">
            <label for="">推荐位置　　　</label>
            <select name="position_id">
                <option value="0">全部</option>
                @foreach($positionInfo as $positionInfoV)
                    <option value="{!! $positionInfoV->id !!}" @if($positionInfoV->id == $position_id)selected="selected"@endif>{!! $positionInfoV->name !!}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group search-list width285">
            <label for="">类型　</label>
            <select name="is_open">
                <option value="0">全部</option>
                <option value="1">开启</option>
                <option value="2">关闭</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
        </div>
    </div>
</form>

<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                推荐名称
            </th>
            <th>推荐位置</th>
            <th>排序</th>
            <th>起始时间</th>
            <th>截止时间</th>
            <th>编辑时间</th>
            <th>是否可用</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
        @foreach($serviceList as $serviceListV )
            <tr>
                <td class="center">
                    {!! $serviceListV->recommend_name !!}
                </td>

                <td>
                    {!! $serviceListV->name !!}
                </td>
                <td>
                    {!! $serviceListV->sort !!}
                </td>
                <td class="hidden-480">
                    @if($serviceListV->start_time != '0000-00-00 00:00:00')
                        {!! $serviceListV->start_time !!}
                    @else
                        永久有效
                    @endif
                </td>
                <td>
                    @if($serviceListV->end_time == '0000-00-00 00:00:00')
                        永久有效
                    @elseif(strtotime($serviceListV->end_time) <= time())
                        {!! $serviceListV->end_time !!}(<span style="color:red">已过期</span>)
                    @else
                        {!! $serviceListV->end_time !!}
                    @endif
                </td>
                <td>
                    {!! $serviceListV->created_at !!}
                </td>
                <td>
                    @if($serviceListV->is_open == '1')
                        开启
                    @elseif($serviceListV->is_open == '2')
                        关闭
                    @endif
                </td>
                <td>
                    <div class="hidden-sm hidden-xs btn-group">
                        <a class="btn btn-xs btn-info" href="/advertisement/updateRecommend/{!! $serviceListV->id !!}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a title="删除" class="btn btn-xs btn-danger" href="/advertisement/deleteReInfo/{!! $serviceListV->id !!}">
                            <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="dataTables_info row" id="sample-table-2_info" role="status" aria-live="polite">
            <a href="/advertisement/insertRecommend"><button class="btn btn-sm btn-primary">添加推荐</button></a>
        </div>
    </div>
    <div class="space-10 col-xs-12"></div>
    <div class="col-xs-12">
        <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
            {{--{!! $task->render() !!}--}}
            {!! $serviceList->appends($search)->render() !!}
        </div>
    </div>
</div>
{{--<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_info" id="sample-table-2_info">
            <a href="/advertisement/insertRecommend"><button class="btn btn-sm btn-primary">添加推荐</button></a>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate paging_bootstrap">
            {!! $serviceList->appends($search)->render() !!}
        </div>
    </div>
</div>--}}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}