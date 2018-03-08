<h3 class="header smaller lighter blue mg-bottom20 mg-top12">网站流水</h3>

<div class="  well">
    <form class="form-inline search-group" role="form" method="get" action="/manage/financeList">
        <div class="form-group search-list">
            <a href="/manage/financeList?action=3">查看收入</a>
            <a href="/manage/financeList?action=4">查看支出 </a>　
        </div>
        <div class="form-group search-list">
            <label for="">选择时间　</label>
            <div class="input-daterange input-group">
                <input type="text" name="start" class="input-sm form-control" value="@if(isset($start)){!! $start !!}@endif">
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end" class="input-sm form-control" value="@if(isset($end)){!! $end !!}@endif">
            </div>
        </div>
        <button class="btn btn-primary btn-sm">搜索</button>　　
        <a href="#" onclick="financeExport()"> 导出Excel</a>
    </form>
</div>

<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover" style="vertical-align:middle; ">
        <thead>
        <tr>
            <th>编号</th>
            <th>渠道类型</th>
            <th>收入/支出</th>
            <th>用户</th>
            <th>金额</th>

            <th>时间</th>
        </tr>
        </thead>

        <tbody>
        @if(!empty($finance))
        @foreach($finance as $item)
        <tr>
            <td>
                {!! $item->id !!}
            </td>
            <td>@if($item->pay_type == 2)支付宝@elseif($item->pay_type == 3)微信@elseif($item->pay_type == 4)银联@else余额@endif</td>
            <td>@if(in_array($item->action, [2, 3, 7,8,9,10,11]))支出@else收入@endif</td>
            <td>{!! $item->username !!}</td>
            <td>
                ￥{!! $item->cash !!}元
            </td>

            <td>
                {!! $item->created_at !!}
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6">暂无数据</td>
        </tr>
        @endif
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="dataTables_info" id="sample-table-2_info">收入总计：￥ {!! $cashcount !!} 元</div>
    </div>
    <div class="space col-xs-12"></div>
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap text-right row">
            @if(!empty($finance)){!! $finance->appends($search)->render() !!}@endif
        </div>
    </div>
</div>


{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}