{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">功能</h3>

<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('manage/function') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group search-list ">
            <label for="name" class="">功能名称&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="function_name" value="" >
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">图标</label>
            <input type="file" name="function_icon" value="">
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">路由</label>
            <input type="text" name="function_route" value="">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">添加</button>
        </div>
        <div class="space"></div>
       
        <div class="">
    
        </div>
    </form>
</div>


<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                <label>
                    编号
                </label>
            </th>
            <th>功能名称</th>
            <th>图标</th>
            <th>路由</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
            @if(!empty($function))
            @foreach($function as $item)
                <tr>
                    <td>{!! $item['id'] !!}</td>
                    <td>{!! $item['function_name'] !!}</td>
                    <td><img src="/{!! $item['function_icon'] !!}" style="height:30px;"></td>
                    <td>{!! $item['function_route'] !!}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="functionDetail/{{ $item['id'] }}">
                            <i class="fa fa-edit bigger-120"></i>编辑
                        </a>
                        <a  href="functionDel/{{ $item['id'] }}" title="删除" class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
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
           {!! $function->render() !!}
        </ul>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}