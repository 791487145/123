
<form action="#" method="post">
    {{csrf_field()}}
    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">协议列表</h3>
    <div>
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th class="center">编号</th>
                <th>协议名称代号</th>
                <th>协议名称</th>
                <th>发布时间</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            @if(!empty($agree_list))
                @foreach($agree_list as $item)
                    <tr>
                        <td class="center id" data-id="{!! $item->id !!}">
                            {!! $item->id !!}
                        </td>
                        <td>
                            {!! $item->code_name !!}
                        </td>
                        <td>
                            {!! $item->name !!}
                        </td>
                        <td>
                            {!! $item->updated_at !!}
                        </td>

                        <td>
                            <div class="hidden-sm hidden-xs btn-group">
                                <a title="浏览" class="btn btn-xs btn-success" href="/bre/agree/{!! $item->code_name!!}">
                                    <i class="ace-icon fa fa-search bigger-120"></i>浏览
                                </a>
                                <a class="btn btn-xs btn-info" href="/manage/editAgreement/{!! $item->id !!}">
                                    <i class="fa fa-edit bigger-120"></i>编辑
                                </a>
                                {{--<a title="删除" class="btn btn-xs btn-danger" href="/manage/deleteAgreement/{!! $item->id !!}" >
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
        {{--<div class="col-sm-6">
            <div class="dataTables_info" id="sample-table-2_info">
                <a href="/manage/addAgreement">添加</a>
            </div>
        </div>--}}
        <div class="col-xs-6">
            <div class="dataTables_paginate paging_bootstrap text-right" id="dynamic-table_paginate">
                @if(!empty($agree_list)){!! $agree_list->render() !!}@endif
            </div>
        </div>
    </div>
</form>
<!-- basic scripts -->

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
