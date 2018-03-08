
<form action="#" method="post">
    {{csrf_field()}}

  {{--  <div class="space-6"></div>
    <div class="well h4 blue">增值工具列表</div>--}}
        <h3 class="header smaller lighter blue mg-top12 mg-bottom20">增值工具列表</h3>
        <div>
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>工具名称</th>
                    <th>工具代号</th>
                    <th>工具类型</th>
                    <th>启用状态</th>
                    <th>服务费用</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                @if(!empty($service_list))
                @foreach($service_list as $item)
                <tr>
                    <td>
                            {!! $item->title !!}
                    </td>
                    <td>
                        {!! $item->identify !!}
                    </td>
                    <td>
                        @if($item->type == 1)任务@else 店铺 @endif
                    </td>
                    <td>
                       @if($item->status == 1)启用@else 禁用 @endif
                    </td>
                    <td>
                        {!! $item->price !!}/个
                    </td>
                    <td>
                        <div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-info" href="/manage/editService/{!! $item->id !!}">
                                <i class="fa fa-edit bigger-120"></i>编辑
                            </a>
                            {{--<a title="删除" class="btn btn-xs btn-danger" href="/manage/deleteService/{!! $item->id !!}" >
                                <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                            </a>--}}
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="dataTables_info" id="sample-table-2_info">
                    <a href="/manage/addService" class="btn btn-primary btn-sm">添加</a>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="dataTables_paginate paging_bootstrap" id="dynamic-table_paginate">
                    @if(!empty($service_list)){!! $service_list->render() !!}@endif
                </div>
            </div>
        </div>

</form>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}