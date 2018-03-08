<div class="g-main cashiergray-box">
    <h4 class="text-size16 cor-blue u-title">收支明细</h4>
    <div class="space"></div>
    <div class="well z-active text-size14 clearfix cashiergray-bg">
        <div class="pull-left">我的资产：<span class="cor-orange text-size20">{!! $balance !!}</span>元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="space-2"></div></div>
        <div class="pull-left"><a href="{!! url('finance/cash') !!}" class="bg-orange f-pay bor-radius2 inlineblock hov-bgorg88">充值</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{!! url('finance/cashout') !!}" class="f-pay bg-gary bor-radius2 inlineblock hov-bggryb0">提现</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="pull-left detailmore">
            <a class="text-under" href="{!! url('finance/assetDetail') !!}" >查看详情</a>
        </div>
    </div>
    <div class="space-4"></div>
    <div class="text-size14 cor-gray51">
        最近交易记录 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="inlineblock">
            <div class="space-2"></div>
        <a href="{!! url('finance/list?type=cash') !!}" class="cor-blue167 inlineblock text-under">充值记录</a> &nbsp;&nbsp;<span class="cor-blue">|</span> &nbsp;&nbsp;
        <a href="{!! url('finance/list?type=cashout') !!}" class="cor-blue167 inlineblock text-under">提现记录</a></span>
    </div>
    <div class="space-10"></div>
    <div class="f-table">
        <table class="table table-hover text-size14 cor-gray51 table638">
            @if(!$type)
            <thead>
            <tr>
                <th class="tab-txtcenter">编号</th>
                <th>流水</th>
                <th>项目收支 <a href="javascript:;"><i class="fa fa-question-circle cor-gray87 tooltip-error" data-toggle="tooltip" data-placement="top" title="+表示收入，-表示支出"></i></a></th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($list))
                @foreach($list as $item)
                <tr>
                    <td class="cor-blue167 tab-txtcenter">{!! $item->id !!}</td>
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
                    <td class="cor-green">@if(in_array($item->action, array(2, 3, 7, 8,9,10,11,13,14))) + @else - @endif{!! $item->cash !!}</td>
                    <td>{!! $item->created_at !!}</td>
                </tr>
                @endforeach
                @else
                <div class="g-nomessage g-nofinancelist">暂无消息哦 ！</div>
            @endif
            </tbody>
            @elseif($type == 'cash')
                <thead>
                <tr>
                    <th class="tab-txtcenter">编号</th>
                    <th>流水</th>
                    <th>项目收支 <a href="javascript:;"><i class="fa fa-question-circle cor-gray87 tooltip-error" data-toggle="tooltip" data-placement="top" title="+表示收入，-表示支出"></i></a></th>
                    <th>时间</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($list))
                    @foreach($list as $item)
                        <tr>
                            <td class="tab-txtcenter">{!! $item->id !!}</td>
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
                            <td class="cor-green">@if(in_array($item->action, array(2, 3, 7, 8,9,10,11,13,14))) + @else - @endif{!! $item->cash !!}</td>
                            <td>{!! $item->created_at !!}</td>
                        </tr>
                    @endforeach
                    @else
                    <div class="g-nomessage g-nofinancelist">暂无消息哦 ！</div>
                @endif
                </tbody>
            @elseif($type == 'cashout')
                <thead>
                <tr>
                    <th class="tab-txtcenter">编号</th>
                    <th>提现类型</th>
                    <th>提现金额</th>
                    <th>到账金额</th>
                    <th>时间</th>
                    <th>状态</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($list))
                    @foreach($list as $item)
                        <tr>
                            <td class="tab-txtcenter">{!! $item->id !!}</td>
                            <td>@if($item->cashout_type == 1)支付宝@elseif($item->cashout_type == 2)银行卡@endif</td>
                            <td class="cor-green">{!! $item->cash !!}</td>
                            <td class="cor-green">{!! $item->real_cash !!}</td>
                            <td>{!! $item->created_at !!}</td>
                            <td>@if($item->status == 0)待处理@elseif($item->status == 1)已成功@else已失败@endif</td>
                        </tr>
                    @endforeach
                    @else
                    <div class="g-nomessage g-nofinancelist">暂无消息哦 ！</div>
                @endif
                </tbody>
            @endif
        </table>
    </div>
    <div class="clearfix text-right">
        {!! $list->appends($_GET)->render() !!}
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('finacelist', 'css/usercenter/finance/finance-detail.css') !!}