{{--列表--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">推广财务管理</h3>

<div class="well">
    <form class="form-inline search-group" role="form" action="{{ URL('manage/promoteFinance') }}" method="get">
        <div class="form-group search-list ">
            <label for="name" class="">推广人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="from_name" @if(isset($merge['from_name']))value="{!! $merge['from_name'] !!}" @endif>
        </div>
        <div class="form-group search-list">
            <label for="namee" class="">被推广人　</label>
            <input type="text" name="to_name" @if(isset($merge['to_name']))value="{!! $merge['to_name'] !!}"@endif>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
        </div>
        <div class="space"></div>
        <div class="form-group  ">
            <label for="namee" class="">推广时间　</label>
            <div class="input-daterange input-group">
                <input type="text" name="start" class="input-sm form-control" value="{{ (!empty($_GET['start']))?$_GET['start']:'' }}">
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end" class="input-sm form-control" value="{{ (!empty($_GET['end']))?$_GET['end']:'' }}">
            </div>
        </div>
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
            <th>推广人</th>
            <th>被推广人</th>

            <th>
                推广金额
            </th>
            <th>推广时间</th>
            <th>推广事件</th>
        </tr>
        </thead>

        <tbody>

        @if(!empty($list->toArray()['data']))
            @foreach($list as $item)
                <tr>
                    <td>{!! $item->id !!}</td>
                    <td>{!! $item->from_name !!}</td>
                    <td>{!! $item->to_name !!}</td>
                    <td>￥{!! $item->price !!}</td>
                    <td>
                        {!! $item->updated_at !!}
                    </td>
                    <td>@if($item->type == 1)邀请注册@endif</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap row">
            {!! $list->appends($merge)->render() !!}
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('questionlist', 'js/doc/questionlist.js') !!}