
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="{!! URL('/manage/vipDetailsList') !!}">访谈列表</a>
            </li>
            <li>
                <a href="{!! URL('/manage/vipDetailsAuth') !!}">添加访谈</a>
            </li>
        </ul>
    </div>
</div><!-- <div class="dataTables_borderWrap"> -->

<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('manage/vipDetailsList') }}" method="get">
        <div class="form-group search-list ">
            <label for="name" class="">用户名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="username" @if(isset($merge['username']))value="{!! $merge['username'] !!}" @endif>
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">店铺名　</label>
            <input type="text" name="shop_name" @if(isset($merge['shop_name']))value="{!! $merge['shop_name'] !!}"@endif>
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
        <th>用户</th>
        <th>店铺名</th>
        <th>排序</th>
        <th>
            发布时间
        </th>
        <th>操作</th>
    </tr>
    </thead>

    <tbody>
            @foreach($interview as $v)
            <tr>
                <td>{!! $v->id !!}</td>
                <td>{!! $v->username !!}</td>
                <td>{!! $v->shop_name !!}</td>
                <td>{!! $v->list !!}</td>
                <td>{!! $v->created_at !!}</td>
                <td>
                    <a class="btn btn-xs btn-info" href="{!! URL('/manage/editInterviewPage/'.$v->id) !!}">
                        <i class="fa fa-edit bigger-120"></i>编辑
                    </a>
                    <a href="{!! URL('/manage/interviewDelete/'.$v->id) !!}" title="删除" class="btn btn-xs btn-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                    </a>
                </td>
            </tr>
            @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap row">

        </div>
    </div>
</div>
{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/css/bootstrap-datetimepicker/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('jquery.webui-popover', '/plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
