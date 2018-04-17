
    <h3 class="header smaller lighter blue mg-top12 mg-bottom20">道具管理</h3>
    <div class="well blue">
        {{--<h4>道具列表</h4>--}}

        

        <div style="float:left;margin-left:100px" >
            <div class="dataTables_info" id="sample-table-2_info">
                <a href="addProp" class="btn  btn-primary btn-sm">增加道具</a>
            </div>
        </div>


    </div>
    <div>
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>

            <tr>
                <th>ID</th>
                <th>道具名称</th>
                <th>道具类别</th>
                <th>道具图标</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
                <tbody>

                    @if(!empty($daojus))
                        @foreach($daojus as $d)
                            <tr>
                                <td class="center">

                                      {{ $d['id'] }}

                                </td>
								<td>
                                    {{ $d['pname'] }}
                                </td>
								 <td>
								 @if($d['type'] == 1)装备
								 @elseif($d['type']==2)武功秘籍
								 @else 消耗品
								 @endif
                                    
                                </td>
                                
                                <td>
                                    <img src="/{{ $d['icon'] }}" style="width:50px"/>
                                </td>
                                <td>
                                    {{ $d['created_at'] }}
                                </td>

                              

                               
                                <td>
                                    <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                        <a class="btn btn-xs btn-info" href="/manage/updateProp/{{ $d['id'] }}">
                                            <i class="fa fa-edit bigger-120"></i>编辑
                                        </a>
                                        <a  href="/manage/propDel/{{ $d['id'] }}" title="删除" class="btn btn-xs btn-danger">
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