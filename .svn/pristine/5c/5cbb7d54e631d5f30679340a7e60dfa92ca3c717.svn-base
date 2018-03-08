{{--<div class="page-header">
    <h1>
        用户流水
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">用户流水</h3>
<div class="well">
    <form class="form-inline search-group" role="form" action="{!! url('manage/userFinance') !!}" method="get">
        <div class="form-group search-list ">
            <label for="namee" class="">用户名　　</label>
            <input type="text" name="username" value="@if(isset($username)){!! $username !!}@endif" />
        </div>
        <div class="form-group search-list ">
            <label for="namee" class="">财务类型　</label>
            <select name="action" id="action">
                <option value="">全部</option>
                <option value="1" @if(isset($action) && $action == 1)selected="selected"@endif>发布任务</option>
                <option value="2" @if(isset($action) && $action == 2)selected="selected"@endif>接受任务</option>
                <option value="3" @if(isset($action) && $action == 3)selected="selected"@endif>用户充值</option>
                <option value="4" @if(isset($action) && $action == 4)selected="selected"@endif>用户提现</option>
                <option value="5" @if(isset($action) && $action == 5)selected="selected"@endif>购买增值服务</option>
                <option value="6" @if(isset($action) && $action == 6)selected="selected"@endif>购买作品</option>
                <option value="7" @if(isset($action) && $action == 7)selected="selected"@endif>任务失败退款</option>
                <option value="8" @if(isset($action) && $action == 8)selected="selected"@endif>提现失败退款</option>
                <option value="9" @if(isset($action) && $action == 9)selected="selected"@endif>出售作品</option>
                <option value="10" @if(isset($action) && $action == 10)selected="selected"@endif>维权退款</option>
                <option value="11" @if(isset($action) && $action == 11)selected="selected"@endif>推荐到威客商城失败退款</option>
                <option value="12" @if(isset($action) && $action == 12)selected="selected"@endif>问答打赏</option>
                <option value="13" @if(isset($action) && $action == 13)selected="selected"@endif>问答被打赏</option>
                <option value="14" @if(isset($action) && $action == 14)selected="selected"@endif>推广赏金</option>
            </select>
        </div>
       {{-- <div class="form-group">
            <button class="btn btn-primary btn-sm">搜索</button>
        </div>--}}
        <div class="space"></div>
        <div class="form-inline search-group " >
            <div class="form-group search-list ">
                <label class="">时间　</label>
                <div class="input-daterange input-group">
                    <input type="text" name="start" class="input-sm form-control" value="@if(isset($start)){!! $start !!}@endif">
                    <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                    <input type="text" name="end" class="input-sm form-control" value="@if(isset($end)){!! $end !!}@endif">
                </div>
            </div>
            <div class="form-group"><button type="submit" class="btn btn-primary btn-sm">搜索</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" onclick="userFinanceExport()">导出Excel</a>
            </div>
        </div>
    </form>
</div>
<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                <label>
                    <span class="lbl"></span>
                    编号
                </label>
            </th>
            <th>财务类型</th>
            <th>用户</th>

            <th>
                金额
            </th>
            <th>用户余额</th>
            <th>时间</th>
        </tr>
        </thead>

        <tbody>
        @if(!empty($list))
        @foreach($list as $item)
        <tr>
            <td>
                <label>
                    <span class="lbl"></span>
                    {!! $item->id !!}
                </label>
            </td>

            <td>
                @if($item->action == 1)发布任务@elseif($item->action == 2)接受任务@elseif($item->action == 3)用户充值
                @elseif($item->action == 4)用户提现@elseif($item->action == 5)购买增值服务@elseif($item->action == 6)购买作品
                @elseif($item->action == 7)任务失败退款@elseif($item->action == 8)提现失败退款@elseif($item->action == 9)出售作品
                @elseif($item->action == 10)维权退款@elseif($item->action == 11)推荐到威客商城失败退款@elseif($item->action == 12)问答打赏
                @elseif($item->action == 13)问答被打赏@elseif($item->action == 14)推广赏金
                @endif
            </td>
            <td >{!! $item->name !!}</td>
            <td>￥{!! $item->cash !!}元</td>

            <td>
                ￥{!! $item->balance !!}元
            </td>

            <td>
                {!! $item->created_at !!}
            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap row">
            {!! $list->appends($search)->render() !!}
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}