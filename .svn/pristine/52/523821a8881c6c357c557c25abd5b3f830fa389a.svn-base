
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">推荐位列表</h3>

            <div class="well">
                <form class="form-inline"  role="form" action="/advertisement/serverList" method="get">

                    <div class="form-group search-list ">
                        <label for="">推荐名称　　　</label>
                        <input type="text" id="recommend_name" name="recommend_name" value="@if(isset($recommend_name)){!! $recommend_name !!}@endif">
                    </div>
                    <div class="form-group search-list width285">
                        <label for="">位置　　　</label>
                        <select name="position_id">
                            <option value="0">全部</option>
                            @foreach($positionInfo as $positionInfoV)
                                <option value="{!! $positionInfoV->id !!}" @if($positionInfoV->id == $id)selected="selected"@endif>{!! $positionInfoV->name !!}</option>
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
                    <div class="space"></div>
                    <div class="form-group search-list width285">
                        <label for="">结果排序　</label>
                        <select name="by">
                            <option value="sort" @if(isset($by) && $by == 'sort')selected="selected"@endif>默认排序</option>
                        </select>
                        <select name="order">
                            <option value="asc" @if(isset($order) && $order == 'asc')selected="selected"@endif>递增</option>
                            <option value="desc" @if(isset($order) && $order == 'desc')selected="selected"@endif>递减</option>
                        </select>
                    </div>
                    <div class="form-group search-list width285">
                        <label for="">显示条数　</label>
                        <select name="paginate">
                            <option value="10" @if(isset($paginate) && $paginate == 10)selected="selected"@endif>10条</option>
                            <option value="20" @if(isset($paginate) && $paginate == 20)selected="selected"@endif>20条</option>
                            <option value="30" @if(isset($paginate) && $paginate == 30)selected="selected"@endif>30条</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                </form>
            </div>
        {{--<div class="well h4 blue">推荐位列表</div>--}}
        <div>
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">
                        推荐名称
                    </th>
                    <th>位置</th>
                    <th>排序</th>
                    <th class="hidden-480">起始时间</th>
                    <th class="hidden-480">截止时间</th>
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
            <div class="col-sm-6">
                <div class="dataTables_info" id="sample-table-2_info">
                    <a href="/advertisement/insertRecommend" class="btn btn-sm btn-primary">添加推荐</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="dataTables_paginate paging_bootstrap">
                    {!! $serviceList->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}