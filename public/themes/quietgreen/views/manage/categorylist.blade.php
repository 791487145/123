
                    <div class="widget-header mg-bottom20 mg-top12 widget-well">
                        <div class="widget-toolbar no-border pull-left no-padding">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a  href="/manage/categoryList/{!! $upID !!}">文章分类</a>
                                </li>

                                <li class="">
                                    <a  href="/manage/add/{!! $upID !!}">分类新建</a>
                                </li>
                            </ul>
                        </div>
                    </div>


                                <form action="/manage/categoryAllDelete" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="upID" value="{!! $upID !!}">
                                    {{--<div class="well h4 blue">分类列表</div>--}}
                                    <div>
                                        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>
                                                    分类名称
                                                </th>
                                                <th>显示顺序</th>
                                                <th>修改时间</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if(!empty($category_data))
                                                @foreach($category_data as $item)
                                            <tr>
                                                <td class="center">
                                                    <label class="position-relative">
                                                        <input type="checkbox" name="catID_{!! $item->id !!}" class="ace" value="{!! $item->id !!}"/>
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        {!! $item->cate_name !!}
                                                        <span><a class="btn btn-xs btn-info" href="/manage/categoryAdd/{!! $item->id !!}">添加子分类</a></span>
                                                        <span><a class="btn btn-xs btn-info" href="/manage/getChildCateList/{!! $item->id !!}">查看子分类</a></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    {!! $item->display_order !!}
                                                </td>
                                                <td>
                                                    {!! $item->updated_at !!}
                                                </td>
                                                <td>
                                                    <div class="hidden-sm hidden-xs btn-group">
                                                        <a class="btn btn-xs btn-info" href="/manage/edit/{!! $item->id !!}/{!! $upID !!}">
                                                            <i class="fa fa-edit bigger-120"></i>编辑
                                                        </a>
                                                        <a title="删除" class="btn btn-xs btn-danger" href="/manage/categoryDelete/{!! $item->id !!}/{!! $upID !!}" >
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="dataTables_info" id="sample-table-2_info">
                                                <label>
                                                    <input type="checkbox" class="ace" id="allcheck"/>
                                                     <span class="lbl"></span>全选
                                                </label>
                                                {{--<button>新增分类</button>--}}
                                                <button type="submit" class="btn btn-sm btn-primary">批量删除</button>
                                            </div>
                                        </div>
                                        <div class="col-xs-12"></div>
                                        <div class="col-xs-12">
                                            <div class="dataTables_paginate paging_bootstrap text-right" id="dynamic-table_paginate">
                                                @if(!empty($category_data)){!! $category_data->render() !!}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
<!-- basic scripts -->
{!! Theme::asset()->container('custom-js')->usepath()->add('categorylist', 'js/doc/categorylist.js') !!}