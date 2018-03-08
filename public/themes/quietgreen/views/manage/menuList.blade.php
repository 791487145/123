
                                        <h3 class="header smaller lighter blue mg-top12 mg-bottom20">菜单管理</h3>
                                        <div class="well blue">
                                            {{--<h4>菜单列表</h4>--}}

                                            <select onchange="window.location=this.value;">
                                                @foreach($first_level_munus as $v)
                                                <option value="/manage/menuList/{{ $v['id'] }}/{{ $v['level'] }}" {{ ($id!=0 && $id==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                                                @endforeach
                                            </select>

                                        </div>
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
                                                    <th>菜单名</th>
                                                    <th>菜单路由</th>
                                                    <th>所属模块</th>
                                                    <th>排序</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" class="ace" name="chk"/>
                                                                    <span class="lbl"></span>
                                                                    {{ $menu_data['id'] }}
                                                                </label>
                                                            </td>

                                                            <td>
                                                                {{ $menu_data['name'] }}
                                                            </td>

                                                            <td>
                                                                {{ $menu_data['route'] }}
                                                            </td>


                                                            <td>
                                                                {{ $menu_data['name'] }}
                                                            </td>
                                                            <td>
                                                                {{ $menu_data['sort'] }}
                                                            </td>

                                                            <td>
                                                                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                                    <a class="btn btn-xs btn-info" href="/manage/menuUpdate/{{ $menu_data['id'] }}">
                                                                        <i class="fa fa-edit bigger-120"></i>编辑
                                                                    </a>
                                                                    <a  href="/manage/menuDelete/{{ $menu_data['id'] }}" title="删除" class="btn btn-xs btn-danger">
                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                                                    </a>
                                                                    <a  href="/manage/addMenu/{{ $menu_data['id'] }}" title="添加" class="btn btn-xs btn-orange">
                                                                        <i class="fa fa-edit bigger-120"></i>添加
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @if(!empty($menu_data['_child']))
                                                            @foreach($menu_data['_child'] as $v)
                                                                <tr>
                                                                    <td class="center">
                                                                        <label>
                                                                            <input type="checkbox" class="ace" name="chk"/>
                                                                            <span class="lbl"></span>
                                                                            {{ $v['id'] }}
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <a href="/manage/menuList/{{ $v['id'] }}/{{ $v['level'] }}">|-{{ $v['name'] }}</a>
                                                                    </td>

                                                                    <td>
                                                                        {{ $v['route'] }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $menu_data['name'] }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $v['sort'] }}
                                                                    </td>
                                                                    <td>
                                                                        <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                                            <a class="btn btn-xs btn-info" href="/manage/menuUpdate/{{ $v['id'] }}">
                                                                                <i class="fa fa-edit bigger-120"></i>编辑
                                                                            </a>
                                                                            <a  href="/manage/menuDelete/{{ $v['id'] }}" title="删除" class="btn btn-xs btn-danger">
                                                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                                                            </a>
                                                                            <a  href="/manage/addMenu/{{ $v['id'] }}" title="添加" class="btn btn-xs btn-orange">
                                                                                <i class="fa fa-edit bigger-120"></i>添加
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @if(!empty($v['_child']))
                                                                    @foreach($v['_child'] as $value)
                                                                        <tr>
                                                                            <td class="center">
                                                                                <label>
                                                                                    <input type="checkbox" class="ace" name="chk"/>
                                                                                    <span class="lbl"></span>
                                                                                    {{ $value['id'] }}
                                                                                </label>
                                                                            </td>

                                                                            <td>
                                                                                <a href="/manage/menuList/{{ $value['id'] }}/{{ $value['level'] }}">|-|-{{ $value['name'] }}</a>
                                                                            </td>

                                                                            <td>
                                                                                {{ $value['route'] }}
                                                                            </td>

                                                                            <td>
                                                                                {{ $menu_data['name'] }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $value['sort'] }}
                                                                            </td>
                                                                            <td>
                                                                                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                                                    <a class="btn btn-xs btn-info" href="/manage/menuUpdate/{{ $value['id'] }}">
                                                                                        <i class="fa fa-edit bigger-120"></i>编辑
                                                                                    </a>
                                                                                    <a  href="/manage/menuDelete/{{ $value['id'] }}" title="删除" class="btn btn-xs btn-danger">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                                                                    </a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="dataTables_info" id="sample-table-2_info">
                                                    <a href="/manage/addMenu" class="btn  btn-primary btn-sm">添加模块</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="dataTables_paginate paging_bootstrap text-right">
                                                    <ul class="pagination">

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        {!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}