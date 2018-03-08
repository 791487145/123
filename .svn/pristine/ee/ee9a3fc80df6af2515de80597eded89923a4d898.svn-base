{{--banner--}}
<div class="g-banner hidden-sm hidden-xs hidden-md">
    <div id="carousel-example-generic" class="carousel slide carousel-fade bannner-carousel" data-ride="carousel">
        <!-- Indicators -->
        @if(!empty($ad))
            <ol class="carousel-indicators">
                @foreach($ad as $k => $v)
                    <li data-target="#carousel-example-generic" data-slide-to="{!! $k !!}" @if($k == 0) class="active" @endif></li>
                @endforeach
            </ol>
        @else
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                <li data-target="#carousel-example-generic" data-slide-to="5"></li>
            </ol>
            @endif

                    <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                    @forelse($ad as $key => $value)
                        <div  class="item @if($key == 0)active @endif item-banner{!! $key+1 !!}" >
                            <a href="{!! $value['ad_url'] !!}" target="_blank">
                                <div>
                                    <img src="{!!  URL($value['ad_file'])  !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='{!! $key+1 !!}'>
                                </div>
                            </a>
                        </div>
                    @empty
                    <div  class="item active item-banner1" >
                        <a href="javascript:;">
                            <div>
                                <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='1'>
                            </div>
                        </a>
                    </div>
                    <div class="item item-banner2">
                        <a href="javascript:;">
                            <div>
                                <img src="{!! Theme::asset()->url('images/banner2.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='2'>
                            </div>
                        </a>
                    </div>
                    <div class="item item-banner3">
                        <a href="javascript:;">
                            <div>
                                <img src="{!! Theme::asset()->url('images/banner3.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='3'>
                            </div>
                        </a>
                    </div>
                    <div class="item item-banner4">
                        <a href="javascript:;">
                            <div>
                                <img src="{!! Theme::asset()->url('images/banner4.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='4'>
                            </div>
                        </a>
                    </div>
                    <div class="item item-banner5">
                        <a href="javascript:;">
                            <div>
                                <img src="{!! Theme::asset()->url('images/banner5.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='5'>
                            </div>
                        </a>
                    </div>
                    <div class="item item-banner6">
                        <a href="javascript:;">
                            <div>
                                <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='6'>
                            </div>
                        </a>
                    </div>
                    @endforelse
            </div>
            <div class="container-position">
                <div class="scutcheon text-center">
                    <img class="Img" src="{!! Theme::get('vip_touch')['logo2'] !!}" alt="">
                    <a class="href" href="{{url('vipshop/payvip')}}">开通VIP商铺服务</a>
                </div>
            </div>
    </div>
</div>
</div>
<div class="space-6 hidden-lg hidden-md hidden-sm visible-xs-block "></div>
<div class="container hidden-lg visible-md-block visible-sm-block visible-xs-block ">
    <div class="row">
        <div class="col-xs-12 col-left col-right">
            <div class="g-banner">
                <div id="carousel-example-generic1" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Indicators -->
                    @if(!empty(Theme::get('banner')))
                        <ol class="carousel-indicators">
                            @foreach(Theme::get('banner') as $k => $v)
                                <li data-target="#carousel-example-generic" data-slide-to="{!! $k !!}"  @if($k == 0) class="active" @endif></li>
                            @endforeach
                        </ol>
                    @else
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="5"></li>
                        </ol>
                        @endif

                                <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @if(!empty(Theme::get('banner')))
                                @foreach(Theme::get('banner') as $key => $value)
                                    <div  class="item @if($key == 0)active @endif" >
                                        <a href="{!! $value['ad_url'] !!}" target="_blank">
                                            <div>
                                                <img src="{!!  URL($value['ad_file'])  !!}" alt="..."class="img-responsive">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="item active">
                                    <a href="javascript:;" class="u-item1">
                                        <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" alt="..." class="img-responsive">
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="javascript:;">
                                        <img src="{!! Theme::asset()->url('images/banner2.jpg') !!}" height="460" width="100%" alt="..." class="img-responsive">
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="javascript:;">
                                        <img src="{!! Theme::asset()->url('images/banner3.jpg') !!}" height="460" width="100%" alt="..." class="img-responsive">
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="javascript:;" class="u-item1">
                                        <img src="{!! Theme::asset()->url('images/banner4.jpg') !!}" alt="..." class="img-responsive">
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="javascript:;">
                                        <img src="{!! Theme::asset()->url('images/banner5.jpg') !!}" height="460" width="100%" alt="..." class="img-responsive">
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="javascript:;">
                                        <img src="{!! Theme::asset()->url('images/banner1.jpg') !!}" height="460" width="100%" alt="..." class="img-responsive">
                                    </a>
                                </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--vip套餐--}}
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-left col-right m-vip">
            <h1 class="text-size30 text-center cor-gray51">VIP套餐</h1>
            <ul class="mg-margin list-inline">
                @forelse($package_list as $item)
                <li class="cor-gray45 text-center">
                    <img src="{{url($item['logo'])}}" alt="">
                    <div class="space-10"></div>
                    <p class="text-size20 mg-margin">{{$item['title']}}</p>
                    <p><span class="text-size26 cor-orange">{{$item['price']}}</span>元起</p>
                </li>
                @empty

                @endforelse
            </ul>
        </div>
    </div>
</div>
{{--特权内容--}}
<div class="Privilege">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-left col-right">
                <h1 class="text-size30 text-center cor-gray51">特权内容</h1>
                <ul class="mg-margin clearfix">
                    @forelse($privilege_list as $item)
                    <li class="cor-gray51 col-lg-4">
                        <img class="pull-left" src="{{$item->ico}}" alt="">
                        <div class="wrap">
                            <h4 class="mg-margin text-size20">{{$item->title}}</h4>
                            <div class="space-6"></div>
                            <p>{{$item->desc}}</p>
                        </div>
                    </li>
                    @empty
                    @endforelse
                </ul>
                <div class="text-center">
                    <a class="more" href="{{url('vipshop/vipinfo')}}">更多详情</a>
                </div>
                <div class="space-20"></div>
                <div class="space-20"></div>
            </div>
        </div>
    </div>
</div>
{{--加入TA们--}}
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-left col-right m-join">
            <h1 class="text-size30 text-center cor-gray51">加入TA们</h1>
            <div id="myJoin" class="carousel slide"   data-interval="2000">{{--
                data-ride="carousel"--}}
                <!-- 轮播（Carousel）指标 -->
                <ol class="carousel-indicators">
                    <li data-target="#myJoin" data-slide-to="0" class="active"></li>
                    @if(count($vishop_list) > 5)
                    <li data-target="#myJoin" data-slide-to="1"></li>
                    @endif
                    @if(count($vishop_list) > 10)
                    <li data-target="#myJoin" data-slide-to="2"></li>
                    @endif
                </ol>
                <!-- 轮播（Carousel）项目 -->
                <div class="carousel-inner">
                    <div class="item active">
                        <ul class="mg-margin list-inline">
                            @forelse($vishop_list as $k => $item)
                                @if($k < 5)
                            <li class="cor-gray51 text-center">
                                <div class="box-shadow clearfix">
                                    <img src="{{$item->shop_pic}}" alt="">
                                    <div class="tit">
                                        <div class="vip-ico">
                                            <a href="{{url('shop/' . $item->id)}}"><img src="{{url($item['logo'])}}"></a>
                                        </div>
                                        <div class="space-10"></div>
                                        <p class="text-size14 mg-margin p-space">{{$item->shop_name}}</p>
                                        <div class="space-10"></div>
                                    </div>
                                </div>
                            </li>
                                @endif
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    @if(count($vishop_list) > 5)
                    <div class="item">
                        @forelse($vishop_list as $key => $item)
                            @if($key >= 5 && $key <= 10 )
                            <li class="cor-gray51 text-center">
                                <div class="box-shadow clearfix">
                                    <img src="{{$item->shop_pic}}" alt="">
                                    <div class="tit">
                                        <div class="vip-ico"></div>
                                        <div class="space-10"></div>
                                        <p class="text-size14 mg-margin p-space">{{$item->shop_name}}</p>
                                        <div class="space-10"></div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @empty
                        @endforelse
                    </div>
                    @endif
                    @if(count($vishop_list) > 10)
                    <div class="item">
                        @forelse($vishop_list as $key => $item)
                            @if($key >= 11)
                            <li class="cor-gray51 text-center">
                                <div class="box-shadow clearfix">
                                    <img src="{{$item->shop_pic}}" alt="">
                                    <div class="tit">
                                        <div class="vip-ico"></div>
                                        <div class="space-10"></div>
                                        <p class="text-size14 mg-margin p-space">{{$item->shop_name}}</p>
                                        <div class="space-10"></div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @empty
                        @endforelse
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
{{--vip访谈--}}
<div class="interview">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-left col-right">
                <h1 class="text-size30 text-center cor-gray51">vip访谈</h1>
                <ul class=" clearfix row">
                    @forelse($interview_list as $item)
                    <li class="cor-gray51 col-lg-6">
                        <div class="classify clearfix">
                            <div class="pull-left img">
                                <a href="{{url('vipshop/details/' . $item->vid)}}"><img class="pull-left" src="{{$item->shop_pic}}" alt=""></a>
                                <div class="tit">
                                    <h4 class="text-center"><a class="text-size16 cor-white" href="{{url('vipshop/details/' . $item->vid)}}">{{$item->shop_name}}</a></h4>
                                </div>
                            </div>
                            <div class="wrap">
                                <a href="{{url('vipshop/details/' . $item->vid)}}"><h4 class="p-space text-size16">{{$item->title}}</h4></a>
                                <p>{{str_limit($item->desc, 50)}}</p>
                                <a class="a aBtn" href="{{url('employ/create/'. $item->uid)}}">雇佣TA</a><a class="aBtn" href="{{url('shop/' . $item->id)}}">进入店铺</a>
                            </div>
                        </div>
                    </li>
                    @empty
                    @endforelse
                </ul>
                <div class="space-10"></div>
                <div class="text-center">
                    <a class="more" href="{{url('vipshop/page')}}">更多详情</a>
                </div>
                <div class="space-20"></div>
                <div class="space-20"></div>
            </div>
        </div>
    </div>
</div>

{!! Theme::asset()->container('specific-js')->usepath()->add('SuperSlide','plugins/jquery/superSlide/jquery.SuperSlide.2.1.1.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('homepage','js/doc/homepage.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('adaptive','plugins/jquery/adaptive-backgrounds/jquery.adaptive-backgrounds.js') !!}
