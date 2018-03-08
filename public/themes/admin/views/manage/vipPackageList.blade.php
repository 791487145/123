<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="{!! URL('/manage/vipPackageList') !!}">套餐列表</a>
            </li>
            <li class="">
                <a href="{!! URL('/manage/addPackagePage') !!}">添加套餐</a>
            </li>
        </ul>
    </div>
</div>

{{--注：前台套餐售卖显示始终只显示5个--}}

<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                编号
            </th>
            <th>套餐名</th>
            <th>最低价</th>
            <th>状态</th>
            <th>图标</th>
            <th>排序</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($package as $v)
        <tr>
            <td>{!! $v->id !!}</td>
            <td>{!! $v->title !!}</td>
            <td>{!! $v->price !!}</td>
            <td>
                @if($v->status == 0)
                售卖中
                @else
                已下架
                @endif
            </td>
            <td>
                @if($v->logo)
                <img src="{!! URL($v->logo) !!}" alt="..." width="30" height="30">
                @else
                <img src="" alt="..." width="30" height="30">
                @endif
            </td>
            <td>{!! $v->list !!}</td>
            <td>{!! $v->created_at !!}</td>
            <td>
                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

                   {{-- <a alt="编辑" href="/task/successDetail/218" class="btn btn-xs btn-success" target="_blank">
                        <i class="fa fa-search bigger-120"></i>下架
                    </a>--}}
                    <a alt="编辑" href="/manage/editPackagePage/{!! $v->id !!}" class="btn btn-xs btn-info" >
                        <i class="fa fa-edit bigger-120"></i>编辑
                    </a>

                    <a alt="删除" href="/manage/packageDelete/{!! $v->id !!}" class="btn btn-xs btn-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                    </a>
                    @if($v->status == 1)
                    <a alt="删除" href="/manage/packageStatus/{!! $v->id !!}" class="btn btn-xs btn-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>上架
                    </a>
                    @elseif($v->status == 0)
                    <a alt="删除" href="/manage/packageStatus/{!! $v->id !!}" class="btn btn-xs btn-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>下架
                    </a>
                    @endif
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
                                            <i class="fa fa-search bigger-120"></i>
                                        </span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
                                        <span class="green">
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
        @endforeach
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
            {!! $package->render() !!}
        </div>
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
