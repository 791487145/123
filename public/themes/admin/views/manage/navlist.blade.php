
<form action="#" method="post">
    {{csrf_field()}}
        {{--<div class="space-6"></div>--}}
       {{-- <div class="well h4 blue">自定义导航</div>--}}
        <h3 class="header smaller lighter blue mg-bottom20 mg-top12">自定义导航</h3>
        <div>
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="">
                        {{--<label>--}}
                        {{--<input type="checkbox" class="ace" />--}}
                        {{--<span class="lbl"></span>--}}
                        标题
                        {{--</label>--}}
                    </th>
                    <th>链接</th>
                    <th>排序</th>
                    <th>新窗口打开</th>
                    <th>显示模式</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                @if(!empty($nav_list))
                    @foreach($nav_list as $item)
                        <tr>
                            <td class="">
                                {{--<label>--}}
                                {{--<input type="checkbox" name="id_{!! $item->id !!}" class="ace" value="{!! $item->id !!}"/>--}}
                                {{--<span class="lbl"></span>--}}
                                {!! $item->title !!}
                                {{--</label>--}}
                            </td>

                            <td>
                                {!! $item->link_url !!}
                            </td>
                            <td>
                                {!! $item->sort !!}
                            </td>
                            <td>
                                @if($item->is_new_window == 1)是@else否@endif
                            </td>
                            <td>
                                @if($item->is_show == 1)显示@else隐藏@endif
                            </td>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <a class="btn btn-xs btn-info" href="/manage/editNav/{!! $item->id !!}">
                                        <i class="fa fa-edit bigger-120"></i>编辑
                                    </a>
                                    <a title="删除" class="btn btn-xs btn-danger" href="/manage/deleteNav/{!! $item->id !!}" >
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                    </a>
                                    {{--<a title="设为首页" class="btn btn-xs btn-success" href="/manage/isFirst/{!! $item->id !!}" >
                                        <i class="ace-icon fa fa-search bigger-120"></i>设为首页
                                    </a>--}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

    <div class="col-xs-12">
        <div class="dataTables_info row" id="sample-table-2_info">
            <a href="/manage/addNav" class="btn btn-primary btn-sm">添加</a>
        </div>
    </div>
    <div class="space-10 col-xs-12"></div>
    <div class="col-xs-12">
        {{-- <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
            {!! $realname->render() !!}
        </div>--}}
        <div class="dataTables_paginate paging_bootstrap row" id="dynamic-table_paginate">
            @if(!empty($nav_list)){!! $nav_list->render() !!}@endif
        </div>
    </div>
        {{--<div class="row">
            <div class="col-sm-6">
                <div class="dataTables_info" id="sample-table-2_info">
                    <a href="/manage/addNav" class="btn btn-primary btn-sm">添加</a>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="dataTables_paginate paging_bootstrap" id="dynamic-table_paginate">
                    @if(!empty($nav_list)){!! $nav_list->render() !!}@endif
                </div>
            </div>
        </div>--}}
</form>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
<!-- basic scripts -->
