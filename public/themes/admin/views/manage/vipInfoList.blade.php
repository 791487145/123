
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="{!! URL('/manage/vipInfoList') !!}">特权列表</a>
            </li>
            <li>
                <a href="{!! URL('/manage/addPrivilegesPage') !!}">添加特权</a>
            </li>
        </ul>
    </div>
</div><!-- <div class="dataTables_borderWrap"> -->

<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('/manage/vipInfoList') }}" method="get">
        <div class="form-group search-list ">
            <label for="name" class="">特权名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="title" @if(isset($merge['title']))value="{!! $merge['title'] !!}" @endif>
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">推荐展示　</label>
            <select name="is_recommend" id="">
                <option value="0">全部</option>
                <option value="1" @if(isset($merge['is_recommend']) && $merge['is_recommend'] == 1) selected="selected" @endif>是</option>
                <option value="2" @if(isset($merge['is_recommend']) && $merge['is_recommend'] == 2) selected="selected" @endif>否</option>
            </select>
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">状态　</label>
            <select name="status" id="">
                <option value="0">全部</option>
                <option value="1" @if(isset($merge['status']) && $merge['status'] == 1) selected="selected" @endif>启用</option>
                <option value="2" @if(isset($merge['status']) && $merge['status'] == 2) selected="selected" @endif>停用</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
        </div>
    </form>
</div>


<table id="sample-table-1" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>
            <label>
                编号
            </label>
        </th>
        <th>特权名</th>
        <th>说明</th>
        <th>排序</th>
        <th>推荐展示</th>

        <th>
            状态
        </th>
        <th>操作</th>
    </tr>
    </thead>

    <tbody>
            @foreach($privileges as $v)
            <tr>
                <td>{!! $v->id !!}</td>
                <td>{!! $v->title !!}</td>
                <td>{!! $v->desc !!}</td>
                <td>{!! $v->list !!}</td>
                <td>
                    @if($v->is_recommend == 0)
                    否
                    @else
                    是
                    @endif
                </td>
                <td>
                    @if($v->status == 0)
                    <span class="label label-sm label-success">启用</span>
                    @else
                    <span class="label label-sm label-success">停用</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-xs btn-info" href="{!! URL('/manage/editPrivilegesPage/'.$v->id) !!}">
                        <i class="fa fa-edit bigger-120"></i>编辑
                    </a>
                    @if($v->type == 0)
                    <a href="{!! URL('/manage/privilegesDelete/'.$v->id) !!}" title="删除" class="btn btn-xs btn-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                    </a>
                    @endif
                    @if($v->status == 0)
                        @if($v->is_recommend == 0)
                        <a class="btn btn-xs btn-success" href="{!! URL('/manage/updateRecommend/'.$v->id) !!}">
                            推荐
                        </a>
                        <a href="{!! URL('/manage/updateStatus/'.$v->id) !!}" class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-ban bigger-120"></i>停用
                        </a>
                        @endif
                        @if($v->is_recommend == 1)
                        <a class="btn btn-xs btn-success" href="{!! URL('/manage/updateRecommend/'.$v->id) !!}">
                            取消推荐
                        </a>
                        @endif
                    @endif
                    @if($v->status == 1)
                    <a class="btn btn-xs btn-success" href="{!! URL('/manage/updateStatus/'.$v->id) !!}">
                        启用
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
            {!! $privileges->appends($merge)->render() !!}
        </div>
    </div>
</div>
{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/css/bootstrap-datetimepicker/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('jquery.webui-popover', '/plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
