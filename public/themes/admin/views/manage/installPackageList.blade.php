{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">安装包列表</h3>

<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                <label>编号</label>
            </th>
            <th>版本号</th>
            <th>安装包名称</th>
            <th>更新说明</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
            @if(!empty($package))
            @foreach($package as $item)
                <tr>
                    <td>{!! $item['id'] !!}</td>
                    <td>{!! $item['version'] !!}</td>
                    <td>{!! $item['name'] !!}</td>
                    <td>{!! $item['describe'] !!}</td>
                    <td>{!! $item['create_at'] !!}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="installPackageDe/{{ $item['id'] }}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<div class="col-xs-12">
    <div class="dataTables_paginate paging_bootstrap row">
        <ul class="pagination">
           {!! $package->render() !!}
        </ul>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}