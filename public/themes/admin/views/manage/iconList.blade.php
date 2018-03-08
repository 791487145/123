
    <h3 class="header smaller lighter blue mg-top12 mg-bottom20">菜单管理</h3>
    <div class="well blue">
        {{--<h4>菜单列表</h4>--}}

        <select onchange="window.location=this.value;" style="float:left">
            @foreach($icon_type as $v)
            <option value="/manage/icon/{{ $v['type_name'] }}" {{ ($type==$v['type_name'])?'selected':'' }}>{{ $v['describe'] }}</option>
            @endforeach
        </select>

        <div style="float:left;margin-left:100px" >
            <div class="dataTables_info" id="sample-table-2_info">
                <a href="/manage/addIcon" class="btn  btn-primary btn-sm">添加模块</a>
            </div>
        </div>


    </div>
    <div>
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>

            <tr>
                <th>编号</th>
                <th>菜单名</th>
                <th>菜单路由</th>
                <th>描述</th>
                <th>操作</th>
            </tr>
            </thead>
                <tbody>

                    @if(!empty($icon))
                        @foreach($icon as $v)
                            <tr>
                                <td class="center">

                                      {{ $v['id'] }}

                                </td>

                                <td>
                                    <img src="/{{ $v['icon_name'] }}" style="width:50px"/>
                                </td>

                                <td>
                                    {{ $v['route'] }}
                                </td>

                                <td>
                                    {{ $v['describe'] }}
                                </td>
                                <td>
                                    <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                        <a class="btn btn-xs btn-info" href="/manage/iconDetail/{{ $v['id'] }}">
                                            <i class="fa fa-edit bigger-120"></i>编辑
                                        </a>
                                        <a  href="/manage/iconDel/{{ $v['id'] }}" title="删除" class="btn btn-xs btn-danger">
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


    {!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}