
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#basic">案例列表</a>
            </li>

            <li class="">
                <a  href="/manage/successCaseAdd">添加案例</a>
            </li>
        </ul>
    </div>
</div>

<div class="well">
    <form role="form" class="form-inline search-group" action="/manage/successCaseList" method="get">
        <div class="form-group search-list width285">
            <label for="">发布人　</label>
            <input type="text" name="commentname" >
        </div>
        <div class="form-group search-list ">
            <label for="">标题　　　</label>
            <input type="text" name="title">　
        </div>
        <div class="form-group search-list width285">
            <label for="">来源　</label>
            <select name="from" >
                <option value="0" {!! (!isset($merge['from']) || $merge['from']==0)?'selected':'' !!}>全部</option>
                <option value="1" {!!(isset($merge['from']) && $merge['from']==1)?'selected':'' !!}>来自系统</option>
                <option value="2" {!!(isset($merge['from']) && $merge['from']==2)?'selected':'' !!}>来自威客</option>
            </select>　
        </div>
        <div class="space"></div>
        <div class="form-group search-list">
            <label for="">发布时间　</label>
            <div class="input-daterange input-group">
                <input type="text" name="start" class="input-sm form-control" value="@if(isset($merge['start'])){!! $merge['start'] !!}@endif">
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end" class="input-sm form-control" value="@if(isset($merge['end'])){!! $merge['end'] !!}@endif">
            </div>
        </div>
        <div class="form-group search-list">
            <button class="btn btn-primary btn-sm">搜索</button>
        </div>
    </form>
</div>
<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                编号
            </th>
            <th>案例名</th>
            <th>案例分类</th>
            <th>发布人</th>
            <th>来源</th>
            <th>发布时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['data'] as $v)
            <tr>
            <td>{{ $v['id'] }}</td>
            <td>{{ $v['title'] }}</td>
            <td>{{ $v['cate_name'] }}</td>
            <td>{{ $v['username'] }}</td>
            <td>{{ ($v['type']==1)?'用户添加':'系统添加' }}</td>
            <td>{{ date('Y-m-d H:i:s',strtotime($v['created_at'])) }}</td>
            <td>
                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

                    <a alt="编辑" href="/task/successDetail/{{ $v['id'] }}" class="btn btn-xs btn-success" target="_blank">
                        <i class="fa fa-search bigger-120"></i>查看
                    </a>
                    <a alt="编辑" href="/manage/successCaseAdd?id={{ $v['id'] }}" class="btn btn-xs btn-info" target="_blank">
                        <i class="fa fa-edit bigger-120"></i>编辑
                    </a>

                    <a alt="删除" href="/manage/successCaseDel/{{ $v['id'] }}" class="btn btn-xs btn-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                    </a>
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
        <div class="dataTables_paginate paging_bootstrap row">
            <ul class="">
                {!! $comments_page->appends($_GET)->render() !!}
            </ul>
        </div>
    </div>
</div>


{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('articlelist', 'js/doc/articlelist.js') !!}