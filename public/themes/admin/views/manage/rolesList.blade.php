<!-- #section:basics/content.breadcrumbs -->
{{--<div class="breadcrumbs" id="breadcrumbs">--}}
    {{--<script type="text/javascript">--}}
        {{--try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}--}}
    {{--</script>--}}

    {{--<ul class="breadcrumb">--}}
        {{--<li>--}}
            {{--<i class="ace-icon fa fa-tasks home-icon"></i>--}}
            {{--<a href="#">用户管理</a>--}}
        {{--</li>--}}
        {{--<li class="active">系统组管理</li>--}}
    {{--</ul><!-- /.breadcrumb -->--}}
    {{--<!-- /section:basics/content.searchbox -->--}}
{{--</div>--}}

<!-- /section:basics/content.breadcrumbs -->

                                {{--<div class="well h4 blue">系统组列表</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">系统组列表</h3>
<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                <label>
                    <input type="checkbox" class="ace allcheck"/>
                    <span class="lbl"></span>
                    编号
                </label>
            </th>
            <th>组名</th>
            <th class="hidden-480">更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $v)
        <tr>
            <td class="center">
                <label>
                    <input type="checkbox" class="ace" name="chk"/>
                    <span class="lbl"></span>
                    {{ $v['id'] }}
                </label>
            </td>

            <td>
                {{ $v['display_name'] }}
            </td>
            <td>
                {{ $v['updated_at'] }}
            </td>

            <td>
                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                    <a class="btn btn-xs btn-info" href="rolesDetail/{{ $v['id'] }}">
                        <i class="fa fa-edit bigger-120"></i>编辑
                    </a>
                    <a  href="rolesDel/{{ $v['id'] }}" title="删除" class="btn btn-xs btn-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                    </a>
                </div>
                <div class="visible-xs visible-sm hidden-md hidden-lg">
                    <div class="inline position-relative">
                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-caret-down icon-only bigger-120"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-left dropdown-caret dropdown-close">
                            <li>
                                <a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View">
                                    <span class="blue">
                                        <i class="fa fa-edit bigger-120"></i>
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
                                    <span class="red">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach()
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="dataTables_info" id="sample-table-2_info">
            <a href="rolesAdd" class="btn  btn-primary btn-sm">添加用户组</a>
        </div>
    </div>
    <div class="space-10 col-xs-12"></div>
    <div class="col-xs-12">
        {{-- <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
            {!! $realname->render() !!}
        </div>--}}
        <div class="dataTables_paginate paging_bootstrap row">
            <ul class="pagination">
                {!! $list->render() !!}
            </ul>
        </div>
    </div>
</div>
{{--<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_info" id="sample-table-2_info">
            <a href="rolesAdd" class="btn  btn-primary btn-sm">添加用户组</a>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate paging_bootstrap text-right">
            <ul class="pagination">
                {!! $list->render() !!}
            </ul>
        </div>
    </div>
</div>--}}

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}