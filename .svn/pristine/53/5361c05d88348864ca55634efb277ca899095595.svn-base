
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">导航管理</h3>
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
            <th>排序</th>
            <th>操作</th>
        </tr>
        </thead>
            <tbody>
            @foreach($app_navigations as $app_navigation)
                <tr id="tr_{{$app_navigation->id}}">
                    <td class="center">
                        <label>
                            <input type="checkbox" class="ace" name="chk"/>
                            <span class="lbl"></span>
                            {{ $app_navigation->id }}
                        </label>
                    </td>
                    <td>
                        {{ $app_navigation->name}}
                    </td>


                    <td>
                        {{$app_navigation->url }}
                    </td>
                    <td>
                        {{ $app_navigation->sort }}
                    </td>

                    <td>
                        <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-info" href="/manage/appSetting/{{ $app_navigation->id }}/navigationEdit">
                                <i class="fa fa-edit bigger-120"></i>编辑
                            </a>
                            <a  href="javascript:void(0)" title="删除" class="btn btn-xs btn-danger" onclick="del({{$app_navigation->id}})" >
                                <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_info" id="sample-table-2_info">
            <a href="/manage/appSetting/navigationAdd" class="btn  btn-primary btn-sm">添加导航</a>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate paging_bootstrap text-right">
            <ul class="pagination">

            </ul>
        </div>
    </div>
</div>
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}

<script>
    function del(id){
       var _token = $("#_token").val();
        $.post('/manage/appSettingDel',{id:id,_token:_token}, function (msg){
            if(msg){
                $("#tr_"+msg).remove();
            }
        })
    }
</script>