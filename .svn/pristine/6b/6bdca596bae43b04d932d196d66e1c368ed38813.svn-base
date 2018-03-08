<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="">
                <a href="/advertisement/adTarget">广告位管理</a>
            </li>
            <li class="active">
                <a href="/advertisement/adList">广告列表</a>
            </li>
        </ul>
    </div>
</div>




<form class="form-inline"  role="form" action="/advertisement/adList" method="get">
    <div class="  well">
        <div class="form-group search-list width285">
            广告名称：<input type="text" id="ad_name" name="ad_name" value="@if(isset($ad_name)){!! $ad_name !!}@endif">
        </div>
        <div class="form-group search-list width285">
            广告位置：<select name="target_id">
                <option value="0">全部</option>
                @foreach($adTargetInfo as $adTargetInfoV)
                    <option value="{!! $adTargetInfoV->target_id !!}" @if($adTargetInfoV->target_id == $target_id)selected="selected"@endif>{!! $adTargetInfoV->name !!}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group search-list width285">
            广告类型：<select name="is_open">
                <option value="0">全部</option>
                <option value="1">开启</option>
                <option value="2">关闭</option>
            </select>
        </div>
        <div class="form-group search-list">
            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
        </div>
    </div>
</form>
<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                广告名称
            </th>
            <th>光告位置</th>
            <th class="hidden-480">起始时间</th>
            <th class="hidden-480">截止时间</th>
            <th>编辑时间</th>
            <th>是否可用</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
        @foreach($adList as $adListV )
            <tr>
                <td class="center">
                    {!! $adListV->ad_name !!}
                </td>

                <td>
                    {!! $adListV->name !!}
                </td>
                <td class="hidden-480">
                    @if($adListV->start_time != '0000-00-00 00:00:00')
                    {!! $adListV->start_time !!}
                    @else
                    永久有效
                    @endif
                </td>
                <td>
                    @if($adListV->end_time == '0000-00-00 00:00:00')
                        永久有效
                    @elseif(strtotime($adListV->end_time) <= time())
                        {!! $adListV->end_time !!}(<span style="color:red">已过期</span>)
                    @else
                        {!! $adListV->end_time !!}
                    @endif
                </td>
                <td>
                    {!! $adListV->created_at !!}
                </td>
                <td>
                    @if($adListV->is_open == '1')
                    开启
                    @elseif($adListV->is_open == '2')
                    关闭
                    @endif
                </td>
                <td>
                    <div class="hidden-sm hidden-xs btn-group">
                        <a class="btn btn-xs btn-info" href="/advertisement/update/{!! $adListV->id !!}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a title="删除" class="btn btn-xs btn-danger" href="/advertisement/deleteInfo/{!! $adListV->id !!}">
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
            <a href="/advertisement/insert"><button class="btn btn-sm btn-primary">添加广告</button></a>
        </div>
    </div>
    <div class="space-10 col-xs-12"></div>
    <div class="col-xs-12">
        <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
            {{--{!! $task->render() !!}--}}
            {!! $adList->appends($search)->render() !!}
        </div>
    </div>
</div>
{{--<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_info" id="sample-table-2_info">
            <a href="/advertisement/insert"><button class="btn btn-sm btn-primary">添加广告</button></a>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate paging_bootstrap text-right">
            {!! $adList->appends($search)->render() !!}
        </div>
    </div>
</div>--}}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}