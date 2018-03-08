<div class="payvipbg">
    <div class="container col-left">
        <div class="space-10"></div>
            <p class="cor-gray89">当前位置：首页 > VIP首页 > 特权介绍</p>
        <div class="space-10"></div>
        <div class="clearfix g-vipinfomain">
            <ul class="pull-left">
                <li><span>价格</span></li>
                @forelse($privileges as $item)
                <li><span>{{$item['title']}}<i class="m-vipinfofa"></i></span><div>{{$item['desc']}}</div></li>
                @empty
                @endforelse
            </ul>
            <div class="pull-left g-vipinfotab">
                <div class="g-vipinfobg"></div>
                @if(!empty($packages))
                <table>
                    <tr>
                        @foreach($packages as $item)
                        <th><i class="m-vipinfoico"><img src="{{url($item['logo'])}}" alt="{{$item['title']}}"></i>{{$item['title']}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($packages as $item)
                        <td><span class="text-size22 cor-orange">{{$item['price']}}</span>元起</td>
                        @endforeach
                    </tr>
                    @foreach($arrStatus as $item)
                    <tr>
                        @foreach($item as $value)
                            @if($value)
                        <td><i class="m-vipinfosel m-vipinfo-yes"></i></td>
                            @else
                        <td><i class="m-vipinfosel m-vipinfo-no"></i></td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                    <tr>
                        @foreach($packages as $item)
                        <td><a class="u-vipinfobtn" href="{{url('vipshop/payvip')}}">购买</a></td>
                        @endforeach
                    </tr>
                </table>
                @endif
            </div>
        </div>
    </div>
    <div class="space-32"></div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('index','css/vipshop.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('SuperSlide','plugins/jquery/superSlide/jquery.SuperSlide.2.1.1.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('homepage','js/doc/homepage.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('adaptive','plugins/jquery/adaptive-backgrounds/jquery.adaptive-backgrounds.js') !!}
