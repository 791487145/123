
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">权限管理</h3>
<div>
    <div class="  well">
        <form  role="form" class="form-inline search-group" action="{!! url('manage/permissionsList') !!}" method="get">
            <div class="">
                <div class="form-group search-list ">
                    <label for="">权限编号　</label>
                    <input type="text" name="id" @if(isset($id))value="{!! $id !!}"@endif />
                </div>
                <div class="form-group search-list ">
                    　<label for="">权限名　</label>
                    <input type="text" name="display_name" @if(isset($display_name))value="{!! $display_name !!}"@endif/>
                </div>

            </div>
            <div class="space-10"></div>
            <div class="">
                <div class="form-group search-list ">
                    <label for="">权限路由　</label>
                    <input type="text" name="name" @if(isset($name))value="{!! $name !!}"@endif/>
                </div>
                <div class="form-group search-list width285">
                    <label for="">所属模块　</label>
                    <select name="module_type">
                        <option @if( !isset($module_type) )selected="selected"@endif value="">全部</option>
                        @foreach($type as $v)
                             <option @if(isset($module_type) && $module_type == $v->id )selected="selected"@endif value="{{ $v->id }}"> {{ $v['module_type'] }}</option>
                        @endforeach
                    </select>
                    <select name="order">
                        <option @if(isset($order) && $order == 'desc')selected="selected"@endif value="desc">递减</option>
                        <option @if(isset($order) && $order == 'asc')selected="selected"@endif value="asc">递增</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm">搜索</button>
                </div>
            </div>
        </form>
    </div>

</div>

                                {{--<div class="well h4 blue">权限列表</div>--}}
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
                    <th>权限</th>
                    <th>权限路由</th>
                    <th>所属模块</th>
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
                        {{ $v['name'] }}
                    </td>
                    <td>
                        {{ $v['menu_name'] }}
                    </td>
                    <td>
                        <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-info" href="permissionsDetail/{{ $v['id'] }}">
                                <i class="fa fa-edit bigger-120"></i>编辑
                            </a>
                            <a  href="permissionsDel/{{ $v['id'] }}" title="删除" class="btn btn-xs btn-danger">
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
                    <a href="permissionsAdd" class="btn  btn-primary btn-sm">添加权限</a>
                </div>
            </div>
            <div class="space-10 col-xs-12"></div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_bootstrap row">
                    <ul class="pagination">
                        {!! $list->appends($_GET)->render() !!}
                    </ul>
                </div>
            </div>
        </div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}