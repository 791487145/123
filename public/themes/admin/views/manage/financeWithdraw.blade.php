
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="">
                <a href="/manage/financeStatement">网站收支</a>
            </li>

            <li class="">
                <a href="/manage/financeRecharge">充值记录</a>
            </li>
            <li class="active">
                <a href="/manage/financeWithdraw">提现记录</a>
            </li>
            <li class="">
                <a href="/manage/financeProfit">利润统计</a>
            </li>
        </ul>
    </div>
</div>

<form class="form-inline" method="get" action="{!! url('manage/financeWithdraw') !!}">
    <div class="well">
        <div class="form-group search-list">
            <label for="">提现　</label>
            <select name="type" id="type">
                <option value="">全部方式</option>
                <option @if(isset($type) && $type == 'alipay')selected="selected"@endif value="alipay">支付宝</option>
                <option @if(isset($type) && $type == 'bank')selected="selected"@endif value="bank">银行卡</option>
            </select>
        </div>
        <div class="form-group search-list">
            <label class="">时间　</label>
            <div class="input-daterange input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                        </span>
                <input type="text" class="input-sm form-control" name="start" @if(isset($start))value="{!! $start !!}" @endif />
                        <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                <input type="text" class="input-sm form-control" name="end" @if(isset($end))value="{!! $end !!}" @endif/>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary">搜索</button>
            <span>
                <a href="#" onclick="financeWithdrawExport()">导出excel</a>
            </span>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                编号
            </th>
            <th>用户名</th>
            <th>提现方式</th>
            <th>提现账号</th>
            <th>提现金额</th>
            <th>到账金额</th>
            <th>手续费</th>
            <th>提现时间</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($list))
        @foreach($list as $item)
        <tr>
            <td>{!! $item->id !!}</td>
            <td>{!! $item->name !!}</td>
            <td>@if($item->cashout_type == 1)支付宝@elseif($item->cashout_type == 2)银行卡@endif</td>
            <td>{!! $item->cashout_account !!}</td>
            <td>{!! $item->cash !!}</td>
            <td>{!! $item->real_cash !!}</td>
            <td>{!! $item->fees !!}</td>
            <td>{!! $item->created_at !!}</td>
        </tr>
        @endforeach

        @endif
        <tr>
            <td> 总计</td>
            <td></td>
            <td>{!! $count !!}次</td>
            <td></td>
            <td>{!! $cashSum !!}</td>
            <td>{!! $realCashSum !!}</td>
            <td>{!! $feesSum !!}</td>
            <td></td>
        </tr>

        </tbody>
    </table>
</div>
<div>
    <div class="dataTables_paginate paging_bootstrap pull-right text-right row">{!! $list->appends($search)->render() !!}</div>
</div>

{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('statement-js', 'js/statement.js') !!}