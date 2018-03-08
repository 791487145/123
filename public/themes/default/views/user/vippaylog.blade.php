<div class="g-main g-releasetask g-usershop viplog">
    <h4 class="text-size16 cor-blue2f u-title">购买记录</h4>
    <div class="space-12"></div>
    @if($packageInfo)
    <div class="g-usershoptype clearfix well">
        <div class="space-6"></div>
        <div class="clearfix">
            <div class="g-usershopico vippaylog-bg">
                <img src="{{url($packageInfo['package_ico'])}}" alt="">
            </div>
            <div class="pull-left cor-gray51">
                <p class="text-size16 ">
                    <span class="cor-orange">￥{{$packageInfo['price']}}</span>&nbsp;&nbsp;&nbsp;<span>{{$packageInfo['package_name']}}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;@if($packageInfo['status'])已过期@else使用中@endif</span></p>
                <p class="cor-gray89  text-size14 mg-margin"><span>购买时间：</span>&nbsp;&nbsp;<span>{{$packageInfo['start_time']}}</span>&nbsp;&nbsp;&nbsp;
                    <span>购买时长：{{$packageInfo['duration']}}个月</span>&nbsp;&nbsp;到期时间：{{$packageInfo['end_time']}}</p>
            </div>
        </div>
        <div class="space-6"></div>
    </div>
    <div class="space-8"></div>
    <p class="cor-gray51 text-size14">特权内容：</p>
    <div class="">

        <table class="table table-hover table-bordered text-size14 center">
            <thead>
            <tr>
                <th class="center">特权名</th>
                <th class="center">描述</th>
            </tr>
            </thead>
            <tbody>
            @forelse($privileges as $item)
            <tr>
                <td class="cor-gray51">{{$item['title']}}</td>
                <td class="cor-gray51">
                    {{str_limit($item['desc'], 10)}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2">该套餐无特权</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @endif
    <div class="space-12"></div>
    <div><a class="btn-big bg-blue bor-radius2 hov-blue1b no-margin-top" href="javascript:history.back()">返回</a></div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}