{{--<div class="space-10 hidden-md hidden-sm hidden-xs"></div>
<div class="col-sm-12 col-left col-right">
    <div class="clearfix u-grayico hidden-md hidden-sm hidden-xs">
        <div class="col-md-3 s-ico clearfix">
            <div class="pull-right">
                <h4 class="text-size16 cor-gray51">有需求？</h4>
                <p class="cor-gray97">万千威客为您出谋划策</p>
            </div>
        </div>
        <div class="col-md-3 s-ico s-ico2">
            <div class="pull-right">
                <h4 class="text-size16 cor-gray51">找任务</h4>
                <p class="cor-gray97">海量需求任你来挑</p>
            </div>
        </div>
        <div class="col-md-3 s-ico s-ico3">
            <div class="pull-right">
                <h4 class="text-size16 cor-gray51">快速交易</h4>
                <p class="cor-gray97">轻松交易快速解决</p>
            </div>
        </div>
        <div class="col-md-3 s-ico s-ico4">
            <div class="pull-right">
                <h4 class="text-size16 cor-gray51">畅无忧</h4>
                <p class="cor-gray97">快速接单畅通无阻</p>
            </div>
        </div>
    </div>
    <div class="space-10"></div>
</div>

<div class="space-10"></div>
<!--最新任务-->
<div class="clearfix">
    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 m-task col-left col-right">
        <div class="clearfix">
            <h4 class="pull-left text-size24 cor-gray45">最新任务</h4>
            <a class="pull-right cor-gray97 u-more" href="/task" target="_blank">More></a>
        </div>
        <div class="space-4"></div>
        <div class="g-taskleft b-border clearfix">
            <div class="space"></div>
            <ul class=" clearfix text-size14 m-homelist cor-grayC2 mg-margin col-sm-12">
                @if($task)
                    @foreach($task as $k1 => $v1)
                        <li class="col-md-4 col-sm-5 col-xs-6 g-taskItem">
                            <p class="p-space"><a class="cor-gray51 s-hometit" href="/task/{{$v1['id']}}" target="_blank">{{$v1['title']}}</a></p>
                            <p class="p-space mg-margin">
                                <span class="cor-orange s-homewrap1 p-space">@if($v1['show_cash'])￥{{$v1['show_cash']}}@else ￥0 @endif</span>
                                <span class="s-homewrap1 p-space">{{$v1['name']}}发布</span>
                                <span class="s-homewrap1 p-space">{{$v1['delivery_count']}}投标</span>
                            </p>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>

    <!--最新动态-->
    <div class="col-lg-3  g-taskright hidden-md hidden-sm hidden-xs col-left col-right">
        <h4 class=" text-size24 cor-gray45">最新动态</h4>
        <div class="space-8"></div>
        <div class="b-border txtMarquee-top u-rightwrap1 clearfix">
            <div class="bd clearfix">
                <ul class="mg-margin  clearfix">
                    @if($active)
                        @foreach($active as $k2 => $v2)
                            <li class="u-rlistitem clearfix">
                                <p class="text-size14 s-hometit">
                                    <i class="fa fa-circle-thin cor-grayC2 text-size12"></i>
                                    <a href="/bre/serviceCaseList/{{$v2['uid']}}" class="cor-blue2f" target="_blank">{{$v2['name']}}</a>
                                    接受了任务：<a href="/task/{{$v2['task_id']}}" target="_blank">{{$v2['title']}}</a>
                                </p>

                                <div class="clearfix cor-grayC2">
                                    <span class="pull-left">赏金：<span class="cor-orange">@if($v2['show_cash'])
                                                ￥{{$v2['show_cash']}}@else ￥0 @endif</span>
                                    </span>
                                    <span class="pull-right">@if(intval((time() - strtotime($v2['created_at']))/60) > 60)
                                            1小时前 @else {{intval((time() - strtotime($v2['created_at']))/60)}}
                                            分钟前 @endif
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>


--}}{{--<div class="space-10"></div>
<!--推荐服务商-->
<div class="clearfix">
    <div class="col-sm-12 col-left col-right">
        @if($recommend)
        <div class="clearfix">
            <h4 class="pull-left text-size24 cor-gray45">{{$recommend_position['name']}}</h4>
            <a class="pull-right cor-gray97 u-more u-more-nopd" href="/bre/service" target="_blank">More></a>
        </div>
        @endif
        <div class="space-4"></div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <ul class="clearfix mg-margin g-servicer clearfix g-serv row">
                @if($recommend)
                    @foreach($recommend as $m => $n)
                        <li class="col-lg-3 col-md-4 col-sm-4 col-xs-6 u-listitem1 p-space col-left col-right">
                            <div @if($m == 0) id="myCarousel"  @elseif($m == 1) id="myCarousel1" @elseif($m == 2) id="myCarousel2" @elseif($m == 3) id="myCarousel3"
                                 @endif  class="carousel slide g-servicer-wrap1" data-ride="carousel">
                                <!-- 轮播（Carousel）指标 -->
                                <ol class="carousel-indicators">
                                    @if($m == 0)
                                        <li data-target="#myCarousel" data-slide-to="0" class="active slide-one"></li>
                                        <li data-target="#myCarousel" data-slide-to="1" class=" slide-two"></li>
                                    @elseif($m == 1)
                                        <li data-target="#myCarousel1" data-slide-to="0" class="active slide-three"></li>
                                        <li data-target="#myCarousel1" data-slide-to="1" class=" slide-four"></li>
                                    @elseif($m == 2)
                                        <li data-target="#myCarousel2" data-slide-to="0" class="active slide-five"></li>
                                        <li data-target="#myCarousel2" data-slide-to="1" class=" slide-six"></li>
                                    @elseif($m == 3)
                                        <li data-target="#myCarousel3" data-slide-to="0" class="active slide-seven"></li>
                                        <li data-target="#myCarousel3" data-slide-to="1" class=" slide-eighth"></li>
                                    @endif
                                </ol>
                                <!-- 轮播（Carousel）项目 -->
                                <div class="carousel-inner">
                                    @foreach($n as $k3 => $v3)
                                        <div @if($k3 == 0)class="item active"@else class="item" @endif data-id="{{$v3['id']}}" data-values="{{$k3}}">
                                            <h4 class="cor-gray51 text-size16 text-center mg-margin p-space"><a class="cor-gray51" target="_blank" href="{{$v3['url']}}">@if(!empty($v3['recommend_name'])){{$v3['recommend_name']}}@else 这是服务商名称 @endif </a></h4>
                                            <div class="space-20"></div>
                                            <div class="f-pr">
                                                <a href="{{$v3['url']}}" target="_blank">
                                                    <img src="{{url($v3['recommend_pic'])}}" alt="First slide" class="j-img img-responsive">
                                                </a>
                                            </div>
                                            <div class="clearfix u-wrap1 p-space">
                                                <span class="pull-left text-size14 p-space">好评率：<span class="cor-blue2f text-size14">{{$v3['good_comment_rate']}}%</span></span>
                                                <span class="pull-right">
                                                    --}}{{----}}{{--<span class="s-servicericon"></span><span class="s-servicericon s-ico1"></span><span class="s-servicericon s-ico2" ></span>--}}{{----}}{{--
                                                    @if($v3['bank_auth'] == true)
                                                        <span class="s-servicericon bank-attestation"></span>
                                                    @else
                                                        <span class="s-servicericon bank-attestation-no"></span>
                                                    @endif
                                                    @if($v3['realname_auth'] == true)
                                                        <span class="s-servicericon cd-card-attestation"></span>
                                                    @else
                                                        <span class="s-servicericon cd-card-attestation-no"></span>
                                                    @endif
                                                    @if($v3['email_status'] == 2)
                                                        <span class="s-servicericon email-attestation"></span>
                                                    @else
                                                        <span class="s-servicericon email-attestation-no"></span>
                                                    @endif
                                                    @if($v3['alipay_auth'] == true)
                                                        <span class="s-servicericon alipay-attestation"></span>
                                                    @else
                                                        <span class="s-servicericon alipay-attestation-no"></span>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="space-6"></div>
                                            <div class="p-space">
                                                <p class="p-space">
                                                    <span class="s-homewrap1 cor-blue2f">@if(!empty($v3['success']) && is_array($v3['success'])){{$v3['success'][0]['name']}}@endif</span>
                                                    <span class="s-homewrap1">@if(!empty($v3['success']) && is_array($v3['success']))<a class="cor-gray51" href="/task/successDetail/{{$v3['success'][0]['id']}}" target="_blank">{{$v3['success'][0]['title']}}</a>@endif</span>
                                                </p>
                                                <p class="mg-margin p-space">
                                                    <span class="s-homewrap1 cor-blue2f">@if(!empty($v3['success'][1]) && is_array($v3['success'])){{$v3['success'][1]['name']}}@endif</span>
                                                    <span class="s-homewrap1">@if(!empty($v3['success'][1]) && is_array($v3['success']))<a class="cor-gray51" href="/task/successDetail/{{$v3['success'][1]['id']}}" target="_blank">{{$v3['success'][1]['title']}}@endif</a></span>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>--}}{{--


<div class="space-10"></div>
<!--推荐店铺-->
<div class="clearfix">
    <div class="col-sm-12 col-left col-right">
        @if($shop)
            <div class="clearfix">
                <h4 class="pull-left text-size24 cor-gray45">{{$recommend_shop['name']}}</h4>
                <a class="pull-right cor-gray97 u-more u-more-nopd" href="/bre/service" target="_blank">More></a>
            </div>
        @endif
        <div class="space-4"></div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <ul class="clearfix mg-margin g-servicer clearfix g-serv row">
                @if($shop)
                    @foreach($shop as $m => $n)
                        <li class="col-lg-3 col-md-4 col-sm-4 col-xs-6 u-listitem1 p-space col-left col-right">
                            <div @if($m == 0) id="myCarousel"  @elseif($m == 1) id="myCarousel1" @elseif($m == 2) id="myCarousel2" @elseif($m == 3) id="myCarousel3"
                                 @endif  class="carousel slide g-servicer-wrap1" data-ride="carousel">
                                <!-- 轮播（Carousel）指标 -->
                                <ol class="carousel-indicators">
                                    @if($m == 0)
                                        <li data-target="#myCarousel" data-slide-to="0" class="active slide-one"></li>
                                        <li data-target="#myCarousel" data-slide-to="1" class=" slide-two"></li>
                                    @elseif($m == 1)
                                        <li data-target="#myCarousel1" data-slide-to="0" class="active slide-three"></li>
                                        <li data-target="#myCarousel1" data-slide-to="1" class=" slide-four"></li>
                                    @elseif($m == 2)
                                        <li data-target="#myCarousel2" data-slide-to="0" class="active slide-five"></li>
                                        <li data-target="#myCarousel2" data-slide-to="1" class=" slide-six"></li>
                                    @elseif($m == 3)
                                        <li data-target="#myCarousel3" data-slide-to="0" class="active slide-seven"></li>
                                        <li data-target="#myCarousel3" data-slide-to="1" class=" slide-eighth"></li>
                                    @endif
                                </ol>
                                <!-- 轮播（Carousel）项目 -->
                                <div class="carousel-inner">
                                    @foreach($n as $k3 => $v3)
                                        <div @if($k3 == 0)class="item active"@else class="item" @endif data-id="{{$v3['id']}}" data-values="{{$k3}}">
                                            <h4 class="cor-gray51 text-size16 text-center mg-margin p-space">
                                                <a class="cor-gray51" target="_blank" href="{{$v3['url']}}">
                                                    @if(!empty($v3['recommend_name'])){{$v3['recommend_name']}}
                                                    @else 这是店铺名称
                                                    @endif
                                                </a>
                                            </h4>
                                            <div class="space-20"></div>
                                            <div class="f-pr">
                                                <a href="{{$v3['url']}}" target="_blank">
                                                    <img src="{{url($v3['shop_pic'])}}" alt="First slide" class="j-img img-responsive">
                                                </a>
                                            </div>
                                            <div class="clearfix u-wrap1 p-space">
                                                <span class="pull-left text-size14 p-space">好评率：<span class="cor-blue2f text-size14">{{$v3['good_comment_rate']}}%</span></span>
                                                <span class="pull-right">
                                                    --}}{{--<span class="s-servicericon"></span><span class="s-servicericon s-ico1"></span><span class="s-servicericon s-ico2" ></span>--}}{{--
                                                    @if($v3['bank_auth'] == true)
                                                        <span class="s-servicericon bank-attestation"></span>
                                                    @else
                                                        <span class="s-servicericon bank-attestation-no"></span>
                                                    @endif
                                                    @if($v3['realname_auth'] == true)
                                                        <span class="s-servicericon cd-card-attestation"></span>
                                                    @else
                                                        <span class="s-servicericon cd-card-attestation-no"></span>
                                                    @endif
                                                    @if(isset($v3['email_status']) && $v3['email_status'] == 2)
                                                        <span class="s-servicericon email-attestation"></span>
                                                    @else
                                                        <span class="s-servicericon email-attestation-no"></span>
                                                    @endif
                                                    @if($v3['alipay_auth'] == true)
                                                        <span class="s-servicericon alipay-attestation"></span>
                                                    @else
                                                        <span class="s-servicericon alipay-attestation-no"></span>
                                                    @endif
                                                    @if($v3['enterprise_auth'] == true)
                                                        <span class="s-servicericon com-attestation"></span>
                                                    @else
                                                        <span class="s-servicericon com-attestation-no"></span>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="space-6"></div>
                                            <div class="p-space">
                                                <p class="p-space">
                                                    <span class="s-homewrap1 cor-blue2f">
                                                        @if(!empty($v3['success']) && is_array($v3['success']))
                                                            {{$v3['success'][0]['name']}}
                                                        @endif
                                                    </span>
                                                    <span class="s-homewrap1">
                                                        @if(!empty($v3['success']) && is_array($v3['success']))
                                                            <a class="cor-gray51"
                                                               @if($v3['success'][0]['type'] == 1)
                                                               href="/shop/buyGoods/{{$v3['success'][0]['id']}}"
                                                               @elseif($v3['success'][0]['type'] == 2)
                                                               href="/shop/buyservice/{{$v3['success'][0]['id']}}"
                                                               @endif
                                                               target="_blank">{{$v3['success'][0]['title']}}</a>
                                                        @endif
                                                    </span>
                                                </p>
                                                <p class="mg-margin p-space">
                                                    <span class="s-homewrap1 cor-blue2f">
                                                        @if(!empty($v3['success'][1]) && is_array($v3['success']))
                                                            {{$v3['success'][1]['name']}}
                                                        @endif
                                                    </span>
                                                    <span class="s-homewrap1">
                                                        @if(!empty($v3['success'][1]) && is_array($v3['success']))
                                                            <a class="cor-gray51"
                                                               @if($v3['success'][0]['type'] == 1)
                                                               href="/shop/buyGoods/{{$v3['success'][1]['id']}}"
                                                               @elseif($v3['success'][0]['type'] == 2)
                                                               href="/shop/buyservice/{{$v3['success'][1]['id']}}"
                                                               @endif
                                                               target="_blank">{{$v3['success'][1]['title']}}</a>
                                                        @endif
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>


<div class="space-10"></div>

<!-- 推荐作品 -->
<div class="clearfix ">
    <div class="col-sm-12 col-left col-right">
        @if($work)
        <div class="clearfix">
            <h4 class="pull-left text-size24 cor-gray45">{{$recommend_work['name']}}</h4>
            <a class="pull-right cor-gray97 u-more u-more-nopd" href="/bre/shop" target="_blank">More></a>
        </div>
        @endif
        <div class="space-4"></div>
    </div>
    <ul class="clearfix mg-margin g-servicer  g-servicer-list">
        @if($work)
            @foreach($work as $kk => $vv)
            <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1 col-left col-right">
                <div class="u-index">
                    <div class="f-pr f-pr-shop">
                        <a href="{{$vv['url']}}">
                            <img @if($vv['recommend_pic'])src="{!! URL($vv['recommend_pic']) !!}"
                                 @else src="{!! URL($vv['cover']) !!}"
                                 @endif
                                 alt="First slide" width="100%" class="img-responsive j-img">
                        </a>
                        <span>作品</span>
                    </div>
                    <div class="g-scueeitem1 clearfix p-space">
                        <h4 class="text-size14 mg-margin p-space">
                            <a href="{{$vv['url']}}" class="cor-gray51">
                                {{  $vv['title'] }}
                            </a>
                        </h4>
                        <div class="space-2"></div>
                        <p class="cor-gray89">好评率：
                            @if(!empty($vv['comments_num']))
                                {!! intval(($vv['good_comment']/ $vv['comments_num']))*100 !!}%
                            @else
                                0%
                            @endif
                            |@if(!empty($vv['sales_num']))
                                {!! $vv['sales_num'] !!}
                            @else
                                0
                            @endif人购买
                        </p>
                        <div class="space-6"></div>
                        <p class="cor-gray89 mg-margin">
                            <span class="cor-orange text-size16 ">
                                <span class="text-size12">￥</span>
                                {!! $vv['cash'] !!}
                            </span>
                            --}}{{--<span class="pull-right">
                                <i class="fa fa-map-marker">

                                </i> 湖北-武汉
                            </span>--}}{{--
                        </p>
                    </div>
                </div>
            </li>
            @endforeach
        @endif
    </ul>
</div>


<div class="space-10"></div>

<!-- 推荐服务 -->
<div class="clearfix ">
    <div class="col-sm-12 col-left col-right">
        @if($server)
            <div class="clearfix">
                <h4 class="pull-left text-size24 cor-gray45">{{$recommend_server['name']}}</h4>
                <a class="pull-right cor-gray97 u-more u-more-nopd" href="/bre/shop" target="_blank">More></a>
            </div>
        @endif
        <div class="space-4"></div>
    </div>
    <ul class="clearfix mg-margin g-servicer  g-servicer-list">
        @if($server)
            @foreach($server as $kk => $vv)
                <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1 col-left col-right">
                    <div class="u-index">
                        <div class="f-pr f-pr-shop">
                            <a href="{{$vv['url']}}">
                                <img @if($vv['recommend_pic'])src="{!! URL($vv['recommend_pic']) !!}"
                                     @else src="{!! URL($vv['cover']) !!}"
                                     @endif
                                     alt="First slide" width="100%" class="img-responsive j-img">
                            </a>
                            <span>服务</span>
                        </div>
                        <div class="g-scueeitem1 clearfix p-space">
                            <h4 class="text-size14 mg-margin p-space">
                                <a href="{{$vv['url']}}" class="cor-gray51">
                                    {{  $vv['title'] }}
                                </a>
                            </h4>
                            <div class="space-2"></div>
                            <p class="cor-gray89">好评率：
                                @if(!empty($vv['comments_num']))
                                    {!! intval(($vv['good_comment']/ $vv['comments_num']))*100 !!}%
                                @else
                                    0%
                                @endif
                                |@if(!empty($vv['sales_num']))
                                    {!! $vv['sales_num'] !!}
                                @else
                                    0
                                @endif人购买</p>
                            <div class="space-6"></div>
                            <p class="cor-gray89 mg-margin">
                            <span class="cor-orange text-size16 ">
                                <span class="text-size12">￥</span>
                                {!! $vv['cash'] !!}
                            </span>
                            --}}{{--<span class="pull-right">
                                <i class="fa fa-map-marker">

                                </i> 湖北-武汉
                            </span>--}}{{--
                            </p>
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>

<div class="space-10"></div>
<!-- 成功案例 -->
<div class="clearfix ">
    <div class="col-sm-12 col-left col-right">
        @if($success)
        <div class="clearfix">
            <h4 class="pull-left text-size24 cor-gray45">{{$recommend_success['name']}}</h4>
            <a class="pull-right cor-gray97 u-more u-more-nopd" href="/task/successCase" target="_blank">More></a>
        </div>
        @endif
        <div class="space-4"></div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <ul class="clearfix mg-margin g-servicer g-succ  g-servicer-list">
                @if($success)
                    @foreach($success as $k4 => $v4)
                        <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1 col-left col-right">
                            <div class="u-index">
                                <div class="f-pr">
                                    <a href="{{$v4['url']}}" target="_blank">
                                        <img src="{!! URL($v4['recommend_pic']) !!}" alt="First slide" width="100%" class="img-responsive j-img">
                                    </a>
                                </div>
                                <div class="g-scueeitem1 clearfix  p-space">
                                    <h4 class="text-size14 mg-margin p-space">
                                        <a href="{{$v4['url']}}" target="_blank" class="cor-gray51">
                                            {{$v4['title']}}
                                        </a>
                                    </h4>
                                    <div class="space-12"></div>
                                    <div class="clearfix p-space">
                                        <a href="{{$v4['url']}}" target="_blank" class="pull-left">
                                            <img src="@if(!empty($v4['avatar'])){{url($v4['avatar'])}}
                                            @else {!! Theme::asset()->url('images/default_avatar.png') !!}@endif"
                                                 height="37" width="37" alt="" class="img-circle">
                                        </a>
                                        <div class="clearfix u-pd p-space">
                                            <a href="{{$v4['url']}}" target="_blank" class="pull-left cor-gray51 p-space">{{$v4['username']}}</a>
                                            <div class="pull-right p-space">
                                                <i class="fa fa-tag fa-rotate-90 cor-gray87 text-size18"></i>&nbsp;
                                                <a href="{{$v4['url']}}" target="_blank" class="cor-gray87">{{$v4['name']}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>


<div class="space-10"></div>
<!-- 资讯 -->
<div class="clearfix g-info">
    <div class="col-sm-12 col-left col-right">
        @if(!empty($article))
        <div class="clearfix">
            <h4 class="pull-left text-size24 cor-gray45">{{$recommend_article['name']}}</h4>
            <a class="pull-right cor-gray97 u-more u-more-nopd" href="/article" target="_blank">More></a>
        </div>
        @endif
        <div class="space-4"></div>
    </div>

    <div class="clearfix">

        <div class="col-lg-4 hidden-xs hidden-md hidden-sm col-left col-right">
            @if(!empty($article) && is_array($article))
            <div class="f-pr">
                <a href="{{$article[0]['url']}}" target="_blank">
                    <img src="{{url($article[0]['recommend_pic'])}}" alt="" class="img-responsive j-img">
                </a>
                <div class="f-prwarp">
                    <h5>
                        <a href="{{$article[0]['url']}}" target="_blank" class="cor-white">
                            {{$article[0]['recommend_name']}}
                        </a>
                    </h5>
                </div>
            </div>
            @endif
        </div>
        @if($articleArr)
        <div class="col-lg-8 col-md-12 ">
            <div class="row">
                @foreach($articleArr as $k5 => $v5)
                <div class="col-md-6 col-sm-6 col-xs-12 g-infoitem f-pd clearfix col-left col-right" >
                    <div class="clearfix b-border">
                        <div class="pull-left u-infowrap">
                            <a href="{{$v5['url']}}" target="_blank" class="cor-gray51">
                                <img src="{{url($v5['recommend_pic'])}}" alt="" class="j-img img-responsive pull-left">
                            </a>
                        </div>
                        <div class="u-infoItm clearfix">
                            <h4 class="text-size16 p-space">
                                <a href="{{$v5['url']}}" class="cor-gray51">
                                    {{$v5['recommend_name']}}
                                </a>
                            </h4>
                            <div class="space-2"></div>
                            <p class="cor-gray97">
                                @if(mb_strlen($v5['summary']) > 45)
                                    {!! mb_substr($v5['summary'],0,45,'utf-8') !!}...
                                @else
                                    {!! $v5['summary'] !!}
                                @endif
                            </p>
                            <div class="space-4 hidden-sm hidden-xs"></div>
                            <div class="clearfix text-right">
                                <a href="{{$v5['url']}}" class="cor-gray97 p-space">{{$v5['cate_name']}} ·  详情</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
            @endif
    </div>
</div>
<!-- 友情链接 -->
<div class="clearfix g-lk">
    <div class="col-sm-12 col-left col-right">
        <div class="clearfix">
            <h4 class="text-size24 cor-gray45">友情链接</h4>
        </div>
        <div class="space-4"></div>
        <div class="clearfix u-gray g-lkroll">
            <div class="clearfix">
                <a class="z-btn1 next " href="javascript:;"><i class="fa fa-angle-left text-size24"></i></a>
                <a class="z-btn2 prev" href="javascript:;" ><i class="fa fa-angle-right text-size24"></i></a>
            </div>
            <div class="bd">
                <ul class="mg-margin picList">
                    @if($friendUrl)
                        @foreach($friendUrl as $k6 => $v6)
                            <li class=" text-center u-item">
                                <div class="">
                                    <a target="_blank" href="{{url($v6['content'])}}">
                                        <img src="{{url($v6['pic'])}}" alt="kppw">
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="space-10"></div>

<div class="col-sm-12 col-left col-right">
    <div class="space-10"></div>
    <!--广告位-->
    @if(count($ad))
        <div class="for-advertise">
            <a  target="_blank" href="{{url($ad[0]['ad_url'])}}"><img src="{{url($ad[0]['ad_file'])}}" alt=""></a>
        </div>
    @endif
    <div class="space-10"></div>
</div>--}}

<div class="col-xs-12">
    <div class="row">
        <div class="col-lg-3 g-stationside visible-lg-block col-left">
            <div class="g-stationmenu">
                <div class="g-stationmenuhd">全部任务分类</div>
                <ul>
                    <li class="text-size12 claerfix"><span class="text-size14">IT互联网</span> / 移动开发 <i class="fa fa-angle-right pull-right"></i></li>
                    <li class="text-size12 claerfix"><span class="text-size14">IT互联网</span> / 移动开发 <i class="fa fa-angle-right pull-right"></i></li>
                    <li class="text-size12 claerfix"><span class="text-size14">IT互联网</span> / 移动开发 <i class="fa fa-angle-right pull-right"></i></li>
                    <li class="text-size12 claerfix"><span class="text-size14">IT互联网</span> / 移动开发 <i class="fa fa-angle-right pull-right"></i></li>
                    <li class="text-size12 claerfix"><span class="text-size14">IT互联网</span> / 移动开发 <i class="fa fa-angle-right pull-right"></i></li>
                    <li class="text-size12 claerfix"><span class="text-size14">IT互联网</span> / 移动开发 <i class="fa fa-angle-right pull-right"></i></li>
                    <li class="text-size12 claerfix"><span class="text-size14">IT互联网</span> / 移动开发 <i class="fa fa-angle-right pull-right"></i></li>
                    <li class="text-size12 claerfix"><span class="text-size14">IT互联网</span> / 移动开发 <i class="fa fa-angle-right pull-right"></i></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-7 pd-padding7">
            <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item  item-banner1 active">
                        <a href="http://bbs.kppw.cn/thread-35450-1-1.html" target="_blank">
                            <img src="http://demo.kppw.cn/attachment/sys/86fa2c8c5ea8290a3b67653d2230a338.jpg" alt="..." class="img-responsive itm-banner" data-adaptive-background="1" data-ab-color="rgb(172,201,207)">

                        </a>
                    </div>
                    <div class="item  item-banner2">
                        <a href="http://www.kppw.cn/" target="_blank">
                            <img src="http://demo.kppw.cn/attachment/sys/757ac2eb5b26da378f035b0a8e007522.jpg" alt="..." class="img-responsive itm-banner" data-adaptive-background="2" data-ab-color="rgb(75,172,77)">

                        </a>
                    </div>
                    <div class="item  item-banner3">
                        <a href="http://bbs.kppw.cn/thread-35240-1-1.html" target="_blank">
                            <img src="http://demo.kppw.cn/attachment/sys/024ff2c850478d93779c96be4f9d1d60.jpg" alt="..." class="img-responsive itm-banner" data-adaptive-background="3" data-ab-color="rgb(98,195,238)">

                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix u-subtation hidden-md hidden-sm hidden-xs">
                <div class="col-md-4 s-ico clearfix">
                    <div class="space-10"></div>
                    <div class="">
                        <h4 class="text-size16 cor-gray51">有需求？</h4>
                        <p class="cor-gray97">万千威客为您出谋划策</p>
                    </div>
                </div>
                <div class="col-md-4 s-ico s-ico2">
                    <div class="space-10"></div>
                    <div class="">
                        <h4 class="text-size16 cor-gray51">找任务</h4>
                        <p class="cor-gray97">海量需求任你来挑</p>
                    </div>
                </div>
                <div class="col-md-4 s-ico s-ico3">
                    <div class="space-10"></div>
                    <div class="">
                        <h4 class="text-size16 cor-gray51">快速交易</h4>
                        <p class="cor-gray97">轻松交易快速解决</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 pd-padding7">
            <div class="sidetation-r hidden-sm hidden-xs hidden-md">
                <div class="tab-content tab-top">
                    <div class="clearfix">
                        <!--未登录状态-->
                        <div class="pull-left">
                            <img src="/themes/default/assets/images/defauthead.png " height="70" width="70" class="img-responsive img-circle" alt="">
                        </div>
                        <div class="p-mgl">
                            <p>您还未登录</p>
                            <p><a class="text-under" href="http://kppw31.io/login">点击登录</a>，更多精彩</p>
                            <p><a class="text-under cor-gray8f" href="http://kppw31.io/register">去注册»</a></p>
                        </div>
                    </div>
                </div>
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#home" class="z-tit1">公告</a>
                            <i class="fa fa-sort-desc icon-down text-size18 cor-blue2f"></i>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#messages" class="z-tit1 z-tititm">中标通知</a>
                            <i class="fa fa-sort-desc icon-down text-size18 cor-blue2f"></i>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#messages1" class="z-tit1">提现</a>
                            <i class="fa fa-sort-desc icon-down text-size18 cor-blue2f"></i>
                        </li>
                    </ul>
                    <div class="tab-content tab-content-wrap">
                        <div id="home" class="tab-pane fade in active">
                            <ul class="mg-margin">
                                <li>
                                    <p><a class="text-under cor-gray8f" href="/article/81">· 1654634</a></p>
                                </li>
                            </ul>
                        </div>
                        <div id="messages" class="tab-pane fade">
                            <ul class="mg-margin">
                                <li>
                                    <p class="text-size14 s-hometit">
                                        <a href="/bre/serviceCaseList/359" class="cor-blue2f" target="_blank">zzzz</a>
                                        中标：<a href="/task/1171" target="_blank">厦门小吃餐厅logo和VI设计s</a>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-size14 s-hometit">
                                        <a href="/bre/serviceCaseList/361" class="cor-blue2f" target="_blank">2508</a>
                                        中标：<a href="/task/1231" target="_blank">审核</a>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-size14 s-hometit">
                                        <a href="/bre/serviceCaseList/361" class="cor-blue2f" target="_blank">2508</a>
                                        中标：<a href="/task/1235" target="_blank">。。</a>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-size14 s-hometit">
                                        <a href="/bre/serviceCaseList/361" class="cor-blue2f" target="_blank">2508</a>
                                        中标：<a href="/task/1232" target="_blank">SEGV</a>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-size14 s-hometit">
                                        <a href="/bre/serviceCaseList/341" class="cor-blue2f" target="_blank">chengzi</a>
                                        中标：<a href="/task/1159" target="_blank">实打实大苏打撒旦</a>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div id="messages1" class="tab-pane fade">
                            <ul class="mg-margin">
                                <li>
                                    <p class="text-size14 s-hometit">
                                        kekezu456提现10.00元
                                    </p>
                                </li>
                                <li>
                                    <p class="text-size14 s-hometit">
                                        kekezu456提现600.00元
                                    </p>
                                </li>
                                <li>
                                    <p class="text-size14 s-hometit">
                                        kekezu123提现8000.00元
                                    </p>
                                </li>
                                <li>
                                    <p class="text-size14 s-hometit">
                                        kekezu789提现10.00元
                                    </p>
                                </li>
                                <li>
                                    <p class="text-size14 s-hometit">
                                        kekezu456提现100.00元
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
{{--最新动态--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left">
            <div class="b-border clearfix m-new">
                <div class="col-lg-2 text-center">
                    <div class="space"></div>
                    <div class="space"></div>
                    <img src="{{ Theme::asset()->url('images/zxdt.png')}}" alt="">
                </div>
                <div class="col-lg-10 col-left col-right">
                    <div class="row">
                        <div class="space"></div>
                        <ul class="mg-margin list-inline">
                            <li class="col-lg-3 p-space">
                                <p>水馒头 接受了任务： 智能电动门窗外观结构   </p>
                                <p>水馒头 接受了任务：商城类的APP开发.</p>
                            </li>
                            <li class="col-lg-3 p-space">
                                <p>水馒头 接受了任务： 智能电动门窗外观结构   </p>
                                <p>水馒头 接受了任务：商城类的APP开发.</p>
                            </li>
                            <li class="col-lg-3 p-space">
                                <p>水馒头 接受了任务： 智能电动门窗外观结构   </p>
                                <p>水馒头 接受了任务：商城类的APP开发.</p>
                            </li>
                            <li class="col-lg-3 p-space">
                                <p>水馒头 接受了任务： 智能电动门窗外 </p>
                                <p>水馒头 接受了任务：商城类的APP开发.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
{{--推荐店铺--}}
<div class="col-xs-12">
     <div class="row">
         <div class="col-xs-12 col-left m-shop">
             <div class="bg-white b-border">
                 <div class="tit">
                     <h4 class=" text-size16 cor-gray51">推荐店铺</h4>
                 </div>
                 <ul class="clearfix mg-margin g-servicer clearfix g-serv row ">
                     <li class="col-lg-2 col-md-4 col-sm-4 col-xs-6 u-listitem1 p-space">
                         <div class="carousel slide g-servicer-wrap1 text-center">
                             <div class="carousel-inner">
                                 <div class="item active">
                                     <div class="f-pr">
                                         <a href="http://dev.kekezu.net/shop/5" target="_blank">
                                             <img src=".." alt="First slide" class="j-img img-responsive">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                             <div class="space-6"></div>
                             <p class="text-size14 cor-gray51 p-space text-center">
                                 信达装饰设计有...
                             </p>
                             <p class="text-size12 cor-gray51 p-space text-center">
                                 <span>好评率：</span><span class="cor-orange">89%</span>
                             </p>
                             <a href="javascript:;" class="a-btn">进入店铺</a>
                         </div>
                     </li>
                     <li class="col-lg-2 col-md-4 col-sm-4 col-xs-6 u-listitem1 p-space">
                         <div class="carousel slide g-servicer-wrap1 text-center">
                             <div class="carousel-inner">
                                 <div class="item active">
                                     <div class="f-pr">
                                         <a href="http://dev.kekezu.net/shop/5" target="_blank">
                                             <img src=".." alt="First slide" class="j-img img-responsive">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                             <div class="space-6"></div>
                             <p class="text-size14 cor-gray51 p-space text-center">
                                 信达装饰设计有...
                             </p>
                             <p class="text-size12 cor-gray51 p-space text-center">
                                 <span>好评率：</span><span class="cor-orange">89%</span>
                             </p>
                             <a href="javascript:;" class="a-btn">进入店铺</a>
                         </div>
                     </li>
                     <li class="col-lg-2 col-md-4 col-sm-4 col-xs-6 u-listitem1 p-space">
                         <div class="carousel slide g-servicer-wrap1 text-center">
                             <div class="carousel-inner">
                                 <div class="item active">
                                     <div class="f-pr">
                                         <a href="http://dev.kekezu.net/shop/5" target="_blank">
                                             <img src=".." alt="First slide" class="j-img img-responsive">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                             <div class="space-6"></div>
                             <p class="text-size14 cor-gray51 p-space text-center">
                                 信达装饰设计有...
                             </p>
                             <p class="text-size12 cor-gray51 p-space text-center">
                                 <span>好评率：</span><span class="cor-orange">89%</span>
                             </p>
                             <a href="javascript:;" class="a-btn">进入店铺</a>
                         </div>
                     </li>
                     <li class="col-lg-2 col-md-4 col-sm-4 col-xs-6 u-listitem1 p-space">
                         <div class="carousel slide g-servicer-wrap1 text-center">
                             <div class="carousel-inner">
                                 <div class="item active">
                                     <div class="f-pr">
                                         <a href="http://dev.kekezu.net/shop/5" target="_blank">
                                             <img src=".." alt="First slide" class="j-img img-responsive">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                             <div class="space-6"></div>
                             <p class="text-size14 cor-gray51 p-space text-center">
                                 信达装饰设计有...
                             </p>
                             <p class="text-size12 cor-gray51 p-space text-center">
                                 <span>好评率：</span><span class="cor-orange">89%</span>
                             </p>
                             <a href="javascript:;" class="a-btn">进入店铺</a>
                         </div>
                     </li>
                     <li class="col-lg-2 col-md-4 col-sm-4 col-xs-6 u-listitem1 p-space">
                         <div class="carousel slide g-servicer-wrap1 text-center">
                             <div class="carousel-inner">
                                 <div class="item active">
                                     <div class="f-pr">
                                         <a href="http://dev.kekezu.net/shop/5" target="_blank">
                                             <img src=".." alt="First slide" class="j-img img-responsive">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                             <div class="space-6"></div>
                             <p class="text-size14 cor-gray51 p-space text-center">
                                 信达装饰设计有...
                             </p>
                             <p class="text-size12 cor-gray51 p-space text-center">
                                 <span>好评率：</span><span class="cor-orange">89%</span>
                             </p>
                             <a href="javascript:;" class="a-btn">进入店铺</a>
                         </div>
                     </li>
                     <li class="col-lg-2 col-md-4 col-sm-4 col-xs-6 u-listitem1 p-space">
                         <div class="carousel slide g-servicer-wrap1 text-center">
                             <div class="carousel-inner">
                                 <div class="item active">
                                     <div class="f-pr">
                                         <a href="http://dev.kekezu.net/shop/5" target="_blank">
                                             <img src=".." alt="First slide" class="j-img img-responsive">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                             <div class="space-6"></div>
                             <p class="text-size14 cor-gray51 p-space text-center">
                                 信达装饰设计有...
                             </p>
                             <p class="text-size12 cor-gray51 p-space text-center">
                                 <span>好评率：</span><span class="cor-orange">89%</span>
                             </p>
                             <a href="javascript:;" class="a-btn">进入店铺</a>
                         </div>
                     </li>
                 </ul>
                 <div class="space-14"></div>
             </div>
         </div>
     </div>
</div>
<div class="space-8 col-xs-12"></div>
{{--服务作品--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left m-serve">
            <div class="bg-white b-border">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                        <a class="text-size16 cor-gray51" href="#serve" data-toggle="tab">服务</a>
                    </li>
                    <li>
                        <a class="text-size16 cor-gray51" href="#works" data-toggle="tab">作品</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="serve">
                        <ul class="mg-margin list-inline clearfix">
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                     <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="works">
                        <ul class="mg-margin list-inline clearfix">
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                            <li class="clearfix list-category col-lg-3">
                                <div class="pull-left ">
                                    <img src=".." alt="">
                                </div>
                                <div class="space-2"></div>
                                <div class="text-size14 cor-gray51">
                                    <p class="p-space">信达装饰设有限公司</p>
                                    <p class="cor-orange p-space">￥1000</p>
                                    <p class="text-size12 p-space">好评率：<span class="cor-orange">89%</span> |  <span class="cor-orange">4</span>人购买</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
{{--最新任务--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left m-shop">
            <div class="bg-white b-border">
                <div class="tit">
                    <h4 class=" text-size16 cor-gray51">最新任务</h4>
                </div>
                <div class=" clearfix">
                    <ul class=" clearfix text-size14 cor-grayC2 mg-margin col-sm-12">
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                        <li class="col-lg-3 col-md-4 col-sm-5 col-xs-6 g-taskItem text-size14">
                            <p class="p-space mg-margin pull-left">
                                <span class="cor-orange s-homewrap1 p-space">￥3000</span>
                            </p>
                            <div class="p-space list-group">
                                <p class="p-space">
                                    <a class="cor-gray51 s-hometit" href="/task/1435" target="_blank">汇编microship芯片源码</a>
                                </p>
                                <p class="p-space ">
                                    <a class="cor-grayC2 s-hometit" href="/task/1435" target="_blank">敗者就是亡发布</a>
                                    <a class="cor-grayC2 s-hometit" href="javascript:;">26投标</a>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
{{--成功案例--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left m-shop u-case">
            <div class="bg-white b-border">
                <div class="tit">
                    <h4 class=" text-size16 cor-gray51">成功案例</h4>
                </div>
                <ul class="clearfix mg-margin g-servicer g-succ  g-servicer-list">
                    <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1">
                        <div class="u-index">
                            <div class="f-pr">
                                <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank">
                                    <img src="http://demo.kppw.cn/attachment/sys/0740689250329c5a9dea33159ae019b6.png" alt="First slide" width="100%" class="img-responsive j-img">
                                </a>
                            </div>
                            <div class="g-scueeitem1 clearfix  p-space">
                                <h4 class="text-size14 mg-margin p-space">
                                    <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray51">
                                        法兰质品-浓缩蜂蜜含片
                                    </a>
                                </h4>
                                <div class="space-2"></div>
                                <div class="clearfix p-space">
                                    <div class="p-space">
                                        <i class="fa fa-tag fa-rotate-90 cor-gray87 text-size12"></i>&nbsp;
                                        <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray97">包装设计</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1">
                        <div class="u-index">
                            <div class="f-pr">
                                <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank">
                                    <img src="http://demo.kppw.cn/attachment/sys/0740689250329c5a9dea33159ae019b6.png" alt="First slide" width="100%" class="img-responsive j-img">
                                </a>
                            </div>
                            <div class="g-scueeitem1 clearfix  p-space">
                                <h4 class="text-size14 mg-margin p-space">
                                    <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray51">
                                        法兰质品-浓缩蜂蜜含片
                                    </a>
                                </h4>
                                <div class="space-2"></div>
                                <div class="clearfix p-space">
                                    <div class="p-space">
                                        <i class="fa fa-tag fa-rotate-90 cor-gray87 text-size12"></i>&nbsp;
                                        <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray97">包装设计</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1">
                        <div class="u-index">
                            <div class="f-pr">
                                <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank">
                                    <img src="http://demo.kppw.cn/attachment/sys/0740689250329c5a9dea33159ae019b6.png" alt="First slide" width="100%" class="img-responsive j-img">
                                </a>
                            </div>
                            <div class="g-scueeitem1 clearfix  p-space">
                                <h4 class="text-size14 mg-margin p-space">
                                    <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray51">
                                        法兰质品-浓缩蜂蜜含片
                                    </a>
                                </h4>
                                <div class="space-2"></div>
                                <div class="clearfix p-space">
                                    <div class="p-space">
                                        <i class="fa fa-tag fa-rotate-90 cor-gray87 text-size12"></i>&nbsp;
                                        <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray97">包装设计</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1">
                        <div class="u-index">
                            <div class="f-pr">
                                <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank">
                                    <img src="http://demo.kppw.cn/attachment/sys/0740689250329c5a9dea33159ae019b6.png" alt="First slide" width="100%" class="img-responsive j-img">
                                </a>
                            </div>
                            <div class="g-scueeitem1 clearfix  p-space">
                                <h4 class="text-size14 mg-margin p-space">
                                    <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray51">
                                        法兰质品-浓缩蜂蜜含片
                                    </a>
                                </h4>
                                <div class="space-2"></div>
                                <div class="clearfix p-space">
                                    <div class="p-space">
                                        <i class="fa fa-tag fa-rotate-90 cor-gray87 text-size12"></i>&nbsp;
                                        <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray97">包装设计</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1">
                        <div class="u-index">
                            <div class="f-pr">
                                <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank">
                                    <img src="http://demo.kppw.cn/attachment/sys/0740689250329c5a9dea33159ae019b6.png" alt="First slide" width="100%" class="img-responsive j-img">
                                </a>
                            </div>
                            <div class="g-scueeitem1 clearfix  p-space">
                                <h4 class="text-size14 mg-margin p-space">
                                    <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray51">
                                        法兰质品-浓缩蜂蜜含片
                                    </a>
                                </h4>
                                <div class="space-2"></div>
                                <div class="clearfix p-space">
                                    <div class="p-space">
                                        <i class="fa fa-tag fa-rotate-90 cor-gray87 text-size12"></i>&nbsp;
                                        <a href="http://demo.kppw.cn/task/successDetail/58" target="_blank" class="cor-gray97">包装设计</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="space-14"></div>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
{{--资讯--}}
<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12 col-left m-shop m-serve">
            <div class="bg-white b-border">
                <div class="tit">
                    <h4 class=" text-size16 cor-gray51">资讯</h4>
                </div>
                <ul class="mg-margin clearfix">
                    <li class="clearfix list-category col-lg-4">
                        <div class="pull-left ">
                            <img src=".." alt="">
                        </div>
                        <div class="space-2"></div>
                        <div class="text-size14 cor-gray97">
                            <p class="p-space text-size16 cor-gray51">威客行业现状解析</p>
                            <p class="mg-margin">为防止抢票软件破解，12306网站不12306网站不断将登录...</p>
                            <p class="text-size12 p-space">
                                <a href="http://demo.kppw.cn/article/46" class="cor-gray97 p-space">行业资讯 ·  详情</a>
                            </p>
                        </div>
                    </li>
                    <li class="clearfix list-category col-lg-4">
                        <div class="pull-left ">
                            <img src=".." alt="">
                        </div>
                        <div class="space-2"></div>
                        <div class="text-size14 cor-gray97">
                            <p class="p-space text-size16 cor-gray51">威客行业现状解析</p>
                            <p class="mg-margin">为防止抢票软件破解，12306网站不12306网站不断将登录...</p>
                            <p class="text-size12 p-space">
                                <a href="http://demo.kppw.cn/article/46" class="cor-gray97 p-space">行业资讯 ·  详情</a>
                            </p>
                        </div>
                    </li>
                    <li class="clearfix list-category col-lg-4">
                        <div class="pull-left ">
                            <img src=".." alt="">
                        </div>
                        <div class="space-2"></div>
                        <div class="text-size14 cor-gray97">
                            <p class="p-space text-size16 cor-gray51">威客行业现状解析</p>
                            <p class="mg-margin">为防止抢票软件破解，12306网站不12306网站不断将登录...</p>
                            <p class="text-size12 p-space">
                                <a href="http://demo.kppw.cn/article/46" class="cor-gray97 p-space">行业资讯 ·  详情</a>
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="space-8 col-xs-12"></div>
{!! Theme::asset()->container('custom-css')->usepath()->add('index','css/index.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('station-css', 'css/station.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('SuperSlide','plugins/jquery/superSlide/jquery.SuperSlide.2.1.1.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('homepage','js/doc/homepage.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('adaptive','plugins/jquery/adaptive-backgrounds/jquery.adaptive-backgrounds.js') !!}


