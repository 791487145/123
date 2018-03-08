<div class="g-main cashiergray-box">
    <h4 class="text-size16 cor-blue u-title">推广收益</h4>
    <div class="space"></div>
    <div class="space-10"></div>
    <div class="f-table">
        @if(!empty($profit->toArray()['data']))
        <table class="table table-hover text-size14 cor-gray51 table638">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>事件类型</th>
                    <th>推广下线</th>
                    <th>推广金额</th>
                    <th>推广时间</th>
                    <th>事项状态</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profit as $item)
                <tr>
                    <td class="cor-blue167">{!! $item->id !!}</td>
                    <td>
                        @if($item->finish_conditions == 1)完成实名认证
                        @elseif($item->finish_conditions == 2)完成邮箱认证
                        @elseif($item->finish_conditions == 3)完成支付认证
                        @endif
                    </td>
                    <td>{!! $item->to_name !!}</td>
                    <td class="cor-orange">￥@if($item->price){!! $item->price !!}@else 0.00 @endif</td>
                    <td>{!! date('Y-m-d',strtotime($item->updated_at)) !!}</td>
                    <td>已结算</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="g-nomessage g-nofinancelist">暂无收益哦 ！</div>
        @endif
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('froala_editor', 'css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('finacelist', 'css/usercenter/finance/finance-detail.css') !!}