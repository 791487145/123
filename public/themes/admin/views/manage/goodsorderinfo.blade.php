<h3 class="header smaller lighter blue mg-bottom20 mg-top12">订单管理</h3>
<div class="g-backrealdetails clearfix bor-border interface">
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">下单人</p>
        <p class="col-md-11">{!! $order_info->username !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">作品名称</p>
        <p class="col-md-11">{!! $order_info->goods_name !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">作品分类</p>
        <p class="col-md-11">
            {!! $order_info->cate_fir_name !!}&nbsp;&nbsp;&nbsp;&nbsp;{!! $order_info->cate_sec_name !!}
        </p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">金额</p>
        <p class="col-md-11">￥{!! $order_info->cash !!}</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">订单状态</p>
        <p class="col-md-11">
            @if($order_info->status == 0) 待付款
            @elseif($order_info->status == 1) 已支付
            @elseif($order_info->status == 2) 确认源文件
            @elseif($order_info->status == 3) 维权中
            @elseif($order_info->status == 4) 交易完成
            @elseif($order_info->status == 5) 维权结束
            @endif
        </p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">购买时间</p>
        <p class="col-md-11">
            {!! $order_info->pay_time !!}
        </p>
    </div>


    <div class="col-xs-12">
        <div class="space-8"></div>
        <p class="col-md-10 col-md-offset-1">

                <a href="/manage/shopOrderInfo/{!! $pre_id !!}">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <a href="/manage/shopOrderList">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="/manage/shopOrderInfo/{!! $next_id !!}">下一项</a>

        </p>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
