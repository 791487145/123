<div class="payvipbg">
    <div class="container col-left">
        <div class="space-10"></div>
            <p class="cor-gray89">当前位置：首页 > VIP首页 > 套餐购买</p>
        <div class="space-10"></div>
        <ul class="g-payvip clearfix">
            @forelse($list as $item)
            <li class="cor-gray45 text-center">
                <img src="{{url($item['logo'])}}" alt="{{$item['title']}}">
                <div class="space-8"></div>
                <p class="text-size16 mg-margin">{{$item['title']}}</p>
                <div class="space-4"></div>
                <p><span class="text-size14 cor-orange">{{$item['min_price']}}</span>元起</p>
            </li>
            @empty
            @endforelse
        </ul>
        <div class="space-14"></div>
        <div class="g-payvipmain">
            @forelse($list as $item)
            <form role="form" method="post" action="">
            {{csrf_field()}}
            <input type="hidden" name="packag_id" value="{{$item['id']}}">
            <div class="g-payvipwrap">
                <div>
                    <h4 class="text-size20 cor-gray51 no-margin totalname">{{$item['title']}}</h4>
                    <div class="space-12"></div>
                    <div>
                        <div class="g-payvipfnhd text-size18 cor-gray51 text-center">功能表</div>
                        <div class="row g-payvipfn">
                            <div class="col-md-3"><p><b>功能名</b></p></div>
                            <div class="col-md-3"><p><b>功能介绍</b></p></div>
                            <div class="col-md-3"><p><b>功能名</b></p></div>
                            <div class="col-md-3"><p><b>功能介绍</b></p></div>
                            @forelse($item['privileges'] as $k => $v)
                                @if(!empty($v))
                            <div class="col-md-3"><p>{{$v['title']}}</p></div>
                            <div class="col-md-3"><p>{{str_limit($v['desc'], 15)}}</p></div>
                                @endif
                            @empty
                            <div class="col-md-6"><p>暂无特权</p></div>
                            @endforelse
                        </div>
                    </div>
                    <div class="space-10"></div>
                    <div>
                        <div class="g-payvipfnhd text-size18 cor-gray51 text-center">购买时长</div>
                        <div class="row g-payvipfn">
                            <div class="col-md-6"><p><b>期限</b></p></div>
                            <div class="col-md-6"><p><b>费用</b></p></div>
                            @forelse($item['price_rules'] as $k => $v)
                            <div class="col-md-6">
                                <p>
                                    <label class="payvipradio" num="{{$v['cash']}}">
                                        <input class="ace" name="price_rule_id" num="{{$v['cash']}}" type="radio" @if($k == 0)checked="checked"@endif value="{{$k}}">
                                        <span class="lbl">{{$v['time_period']}}个月</span>
                                    </label>
                                </p>
                            </div>
                            <div class="col-md-6"><p><span class="cor-orange payvipnum">{{$v['cash']}}</span>元</p></div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="space-16"></div>
                    <div>
                        <h4 class="cor-gray51 no-margin">结算清单</h4>
                        @forelse($item['price_rules'] as $k => $v)
                        @if($k == 0)
                        <div class="space-10"></div>
                        <div class="g-payvipfnhd text-size14 cor-gray51">{{$item['title']}}（<span class="totalvip">{{$v['time_period']}}个月</span>）：<span class="cor-orange totalvipnum">{{$v['cash']}}</span>元</div>
                        <div class="space-20"></div>
                        <p class="text-right text-size16 cor-gray51">支付金额：<b class="cor-orange text-size24 totalvipnum">{{$v['cash']}}</b>元</p>
                        <div class="space-4"></div>
                        <div class="text-right"><button type="submit" class="u-payvipbtn">支付订单</button></div>
                        @endif
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            </form>
            @empty
            @endforelse
            </div>
        </div>
    </div>
    <div class="space-32"></div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('index','css/vipshop.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('SuperSlide','plugins/jquery/superSlide/jquery.SuperSlide.2.1.1.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('homepage','js/doc/homepage.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('adaptive','plugins/jquery/adaptive-backgrounds/jquery.adaptive-backgrounds.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('payvip','js/payvip.js') !!}