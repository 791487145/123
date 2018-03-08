
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">系统日志</h3>
<div class="well">
    <form class="form-inline" role="form" action="/manage/systemLogList" method="get">
        <div class="form-group search-list ">
            <label for="">操作员　　</label>
            <input type="text" name="username" value="@if(isset($username)){!! $username !!}@endif">
        </div>
        <div class="form-group search-list ">
            <label for="">日志内容　</label>
            <input type="text" name="log_content" value="@if(isset($log_content)){!! $log_content !!}@endif">
        </div>
        <div class="space"></div>
        <div class="form-group search-list">
            <label for="">生成时间　</label>
            <div class="input-daterange input-group">
                <input type="text" name="start" class="input-sm form-control" value="@if(isset($search['start'])){!! $search['start'] !!}@endif">
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end" class="input-sm form-control" value="@if(isset($search['end'])){!! $search['end'] !!}@endif">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
        </div>
    </form>
</div>

<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                <label>
                    {{--<input type="checkbox"  name="" class="ace allcheck"/>
                    <span class="lbl"></span>--}}
                    编号
                </label>
            </th>
            <th>操作员</th>
            <th>用户组</th>
            <th>内容</th>
            <th>生成时间</th>
            <th>IP</th>
        </tr>
        </thead>
        @if(isset($systemLog))
        <tbody>
        @foreach($systemLog as $v)
            <tr>
                <td class="center">
                    <label>
                        <input type="checkbox" class="ace checkbox" name="chk[]" value="{!! $v->id !!}"/>
                        <span class="lbl"></span>
                        {!! $v->id !!}
                    </label>
                </td>

                <td>
                    {!! $v->username !!}
                </td>
                <td>
                    {!! $v->type_name !!}
                </td>
                <td>
                    {!! $v->log_content !!}
                </td>
                <td>
                    {!! $v->created_at !!}
                </td>
                <td>
                    {!! $v->IP !!}
                </td>
            </tr>
        @endforeach
        </tbody>
        @endif
    </table>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap row">
            {!! $systemLog->appends($search)->render() !!}
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

{!! Theme::asset()->container('custom-js')->usePath()->add('backstage', 'js/doc/multidelete.js') !!}