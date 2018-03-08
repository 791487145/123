<div class="row"><div class="col-left">
<div class="g-main">
    <div>
        <div class="s-iconword pull-left"></div>
        <h4 class="text-size22 cor-blue u-title">&nbsp;&nbsp;&nbsp;&nbsp;资产明细</h4>
    </div>
    <!--<h4 class="text-size22 cor-blue u-title">&nbsp;&nbsp;<i class="fa fa-file-text-o cor-orange"></i>&nbsp;&nbsp;收支明细</h4>-->
    <div class="space"></div>
    <div class="detailallinfo hidden-xs">
        <form method="get" action="{!! url('finance/assetDetail') !!}">
        <div class="clearfix">
            <div class="pull-left">时间：</div>
            <div class="input-daterange input-group pull-left">
                <span class="ass-icore"><input type="text" class="input-sm form-control" name="start" value="{!! $start !!}"/><i class="fa fa-calendar ass-icoabl"></i></span><span
                        class="input-group-addon"> - </span>
                <span class="ass-icore"><input type="text" class="input-sm form-control" name="end" value="{!! $end !!}"/><i class="fa fa-calendar ass-icoabl"></i></span></div>
            <div class="pull-left">类型：&nbsp;&nbsp;&nbsp;&nbsp;<select
                        name="type" id="" class="veraligntop">
                    <option value="">全部</option>
                    <option value="1" @if(isset($type) && $type == 1)selected="selected"@endif>发布任务</option>
                    <option value="2" @if(isset($type) && $type == 2)selected="selected"@endif>任务佣金</option>
                    <option value="3" @if(isset($type) && $type == 3)selected="selected"@endif>充值</option>
                    <option value="4" @if(isset($type) && $type == 4)selected="selected"@endif>提现</option>
                    <option value="5" @if(isset($type) && $type == 5)selected="selected"@endif>增值服务</option>
                    <option value="6" @if(isset($type) && $type == 6)selected="selected"@endif>购买作品</option>
                    <option value="7" @if(isset($type) && $type == 7)selected="selected"@endif>任务退款</option>
                    <option value="8" @if(isset($type) && $type == 8)selected="selected"@endif>提现退款</option>
                    <option value="9" @if(isset($type) && $type == 9)selected="selected"@endif>出售商品</option>
                    <option value="10" @if(isset($type) && $type == 10)selected="selected"@endif>维权退款</option>
                    <option value="11" @if(isset($type) && $type == 11)selected="selected"@endif>服务退款</option>
                    <option value="12" @if(isset($type) && $type == 12)selected="selected"@endif>问答打赏</option>
                    <option value="13" @if(isset($type) && $type == 13)selected="selected"@endif>问答被打赏</option>
                    <option value="14" @if(isset($type) && $type == 14)selected="selected"@endif>推广赏金</option>
                    <option value="15" @if(isset($type) && $type == 15)selected="selected"@endif>购买vip店铺</option>
                </select></div>
            <div class="pull-left">
                <button type="submit" class="detailallbtn">筛选</button>
            </div>
        </div>
        <div class="space-6"></div>
        <p></p>
        </form>
    </div>
    <div class="space-10"></div>
    <div class="detailall">
        <div>收入：<span class="cor-orange">{!! $cashIn !!}</span> 元</div>
        <div>支出：<span class="cor-green">{!! $cashOut !!}</span> 元</div>
        <div>余额：<span class="cor-blue">{!! $balance !!}</span> 元</div>
    </div>
    <div class="space-10"></div>
    <div class="f-table">
        <table class="table table-hover text-size14 cor-gray51 table638">
            <thead>
            <tr>
                <th class="tab-txtcenter">编号</th>
                <th>流水</th>
                <th>收入（元）</th>
                <th>支出（元）</th>
                <th>时间</th>
                <th>支付方式</th>
                <th>详情</th>
            </tr>
            </thead>
            <tbody>
            @if($list->total())
            @foreach($list as $item)
            <tr>
                <td class="cor-blue tab-txtcenter">{!! $item->id !!}</td>
                <td>
                    @if($item->action == 1)发布任务
                    @elseif($item->action == 2)任务佣金
                    @elseif($item->action == 3)充值
                    @elseif($item->action == 4)提现
                    @elseif($item->action == 5)增值服务
                    @elseif($item->action == 6)购买作品
                    @elseif($item->action == 7)任务退款
                    @elseif($item->action == 8)提现退款
                    @elseif($item->action == 9)出售商品
                    @elseif($item->action == 10)维权退款
                    @elseif($item->action == 11)服务退款
                    @elseif($item->action == 12)问答打赏
                    @elseif($item->action == 13)问答被打赏
                    @elseif($item->action == 14)推广赏金
                    @elseif($item->action == 15)购买vip店铺
                    @endif
                </td>
                <td>@if(in_array($item->action, array(2, 3, 7, 8,9,10,11,13,14))) + {!! $item->cash !!}@endif</td>
                <td class="cor-green">@if(!in_array($item->action, array(2, 3, 7, 8,9,10,11,13,14))) - {!! $item->cash !!}@endif</td>
                <td>{!! $item->created_at !!}</td>
                <td>
                    @if($item->pay_type == 1)余额
                    @elseif($item->pay_type == 2)支付宝
                    @elseif($item->pay_type == 3)微信
                    @elseif($item->pay_type == 4)银联
                    @endif
                </td>
                <td><a href="{!! url('finance/assetDetailminute/' . $item->id) !!}">查看</a></td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7" class="center">暂无数据</td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="space"></div>
    <div class="space"></div>
    <div class="dataTables_paginate paging_bootstrap">
        {!! $list->appends($merge)->render() !!}
    </div>
    <div class="space"></div>
</div></div></div>
{!! Theme::asset()->container('specific-css')->usepath()->add('froala_editor', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('bootstrap-datepicker','plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ace','plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ace-elements','plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('assetdetail','js/assetdetail.js') !!}