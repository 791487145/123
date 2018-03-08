<div class="space-10 hidden-md hidden-sm hidden-xs"></div>
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
                @forelse($shop as $i => $v)
                    @if($i < 4)
                        <li class="col-lg-3 col-md-4 col-sm-4 col-xs-6 u-listitem1 p-space col-left col-right">
                            <div @if($i == 0) id="myCarousel"  @elseif($i == 1) id="myCarousel1" @elseif($i == 2) id="myCarousel2" @elseif($i == 3) id="myCarousel3"
                                 @endif  class="carousel slide g-servicer-wrap1" data-ride="carousel">
                                <!-- 轮播（Carousel）指标 -->
                                <ol class="carousel-indicators">
                                    @if($i == 0)
                                        <li data-target="#myCarousel" data-slide-to="0" class="active slide-one"></li>
                                        <li data-target="#myCarousel" data-slide-to="1" class=" slide-two"></li>
                                    @elseif($i == 1)
                                        <li data-target="#myCarousel1" data-slide-to="0" class="active slide-three"></li>
                                        <li data-target="#myCarousel1" data-slide-to="1" class=" slide-four"></li>
                                    @elseif($i == 2)
                                        <li data-target="#myCarousel2" data-slide-to="0" class="active slide-five"></li>
                                        <li data-target="#myCarousel2" data-slide-to="1" class=" slide-six"></li>
                                    @elseif($i == 3)
                                        <li data-target="#myCarousel3" data-slide-to="0" class="active slide-seven"></li>
                                        <li data-target="#myCarousel3" data-slide-to="1" class=" slide-eighth"></li>
                                    @endif
                                </ol>
                                <!-- 轮播（Carousel）项目 -->
                                <div class="carousel-inner">
                                    @foreach($v as $k3 => $v3)
                                        <div @if($k3 == 0)class="item active"@else class="item" @endif data-id="{{$v3['id']}}" data-values="{{$k3}}">
                                            <h4 class="cor-gray51 text-size16 text-center mg-margin p-space">
                                                <a class="cor-gray51" target="_blank" href="{{$v3['url']}}">
                                                    @if(!empty($v3['shop_name'])){{$v3['shop_name']}}
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
                    @endif
                @empty
                @endforelse
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
        @forelse($work as $k => $v)
            @if($k < 4)
                <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1 col-left col-right">
                    <div class="u-index">
                        <div class="f-pr f-pr-shop">
                            <a href="{{$v['url']}}">
                                <img @if($v['recommend_pic'])src="{!! URL($v['recommend_pic']) !!}"
                                     @else src="{!! URL($v['cover']) !!}"
                                     @endif
                                     alt="First slide" width="100%" class="img-responsive j-img">
                            </a>
                            <span>作品</span>
                        </div>
                        <div class="g-scueeitem1 clearfix p-space">
                            <h4 class="text-size14 mg-margin p-space">
                                <a href="{{$v['url']}}" class="cor-gray51">
                                    {{  $v['title'] }}
                                </a>
                            </h4>
                            <div class="space-2"></div>
                            <p class="cor-gray89">好评率：
                                @if(!empty($v['comments_num']))
                                    {!! intval(($v['good_comment']/ $v['comments_num']))*100 !!}%
                                @else
                                    0%
                                @endif
                                |@if(!empty($v['sales_num']))
                                    {!! $v['sales_num'] !!}
                                @else
                                    0
                                @endif人购买
                            </p>
                            <div class="space-6"></div>
                            <p class="cor-gray89 mg-margin">
                                <span class="cor-orange text-size16 ">
                                    <span class="text-size12">￥</span>
                                    {!! $v['cash'] !!}
                                </span>
                            </p>
                        </div>
                    </div>
                </li>
            @endif
        @empty
        @endforelse
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
        @forelse($server as $k => $v)
            @if($k < 4)
                <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1 col-left col-right">
                    <div class="u-index">
                        <div class="f-pr f-pr-shop">
                            <a href="{{$v['url']}}">
                                <img @if($v['recommend_pic'])src="{!! URL($v['recommend_pic']) !!}"
                                     @else src="{!! URL($v['cover']) !!}"
                                     @endif
                                     alt="First slide" width="100%" class="img-responsive j-img">
                            </a>
                            <span>服务</span>
                        </div>
                        <div class="g-scueeitem1 clearfix p-space">
                            <h4 class="text-size14 mg-margin p-space">
                                <a href="{{$v['url']}}" class="cor-gray51">
                                    {{ $v['title'] }}
                                </a>
                            </h4>
                            <div class="space-2"></div>
                            <p class="cor-gray89">好评率：
                                @if(!empty($v['comments_num']))
                                    {!! intval(($v['good_comment']/ $v['comments_num']))*100 !!}%
                                @else
                                    0%
                                @endif
                                |@if(!empty($v['sales_num']))
                                    {!! $v['sales_num'] !!}
                                @else
                                    0
                                @endif人购买</p>
                            <div class="space-6"></div>
                            <p class="cor-gray89 mg-margin">
                                <span class="cor-orange text-size16 ">
                                    <span class="text-size12">￥</span>
                                    {!! $v['cash'] !!}
                                </span>
                            </p>
                        </div>
                    </div>
                </li>
            @endif
        @empty
        @endforelse
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
                @forelse($success as $k => $v)
                    @if($k < 4)
                        <li class="col-lg-3  col-md-4 col-sm-4 col-xs-6 u-listitem1 col-left col-right">
                            <div class="u-index">
                                <div class="f-pr">
                                    <a href="{{$v['url']}}" target="_blank">
                                        <img @if($v['recommend_pic'])src="{!! URL($v['recommend_pic']) !!}"
                                             @else src="{!! URL($v['success_pic']) !!}"
                                             @endif alt="First slide" width="100%" class="img-responsive j-img">
                                    </a>
                                </div>
                                <div class="g-scueeitem1 clearfix  p-space">
                                    <h4 class="text-size14 mg-margin p-space">
                                        <a href="{{$v['url']}}" target="_blank" class="cor-gray51">
                                            {{$v['title']}}
                                        </a>
                                    </h4>
                                    <div class="space-12"></div>
                                    <div class="clearfix p-space">
                                        <a href="{{$v['url']}}" target="_blank" class="pull-left">
                                            <img src="@if(!empty($v['avatar'])){{url($v['avatar'])}}
                                            @else {!! Theme::asset()->url('images/default_avatar.png') !!}@endif"
                                                 height="37" width="37" alt="" class="img-circle">
                                        </a>
                                        <div class="clearfix u-pd p-space">
                                            <a href="{{$v['url']}}" target="_blank" class="pull-left cor-gray51 p-space">{{$v['username']}}</a>
                                            <div class="pull-right p-space">
                                                <i class="fa fa-tag fa-rotate-90 cor-gray87 text-size18"></i>&nbsp;
                                                <a href="{{$v['url']}}" target="_blank" class="cor-gray87">{{$v['name']}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @empty
                @endforelse
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
                            {{$article[0]['title']}}
                        </a>
                    </h5>
                </div>
            </div>
            @endif
        </div>
        @if($articleArr)
        <div class="col-lg-8 col-md-12 ">
            <div class="row">
                @forelse($articleArr as $k => $v)
                    @if($k < 4)
                        <div class="col-md-6 col-sm-6 col-xs-12 g-infoitem f-pd clearfix col-left col-right" >
                            <div class="clearfix b-border">
                                <div class="pull-left u-infowrap">
                                    <a href="{{$v['url']}}" target="_blank" class="cor-gray51">
                                        <img src="{{url($v['recommend_pic'])}}" alt="" class="j-img img-responsive pull-left">
                                    </a>
                                </div>
                                <div class="u-infoItm clearfix">
                                    <h4 class="text-size16 p-space">
                                        <a href="{{$v['url']}}" class="cor-gray51">
                                            {{$v['title']}}
                                        </a>
                                    </h4>
                                    <div class="space-2"></div>
                                    <p class="cor-gray97">
                                        @if(mb_strlen($v['summary']) > 45)
                                            {!! mb_substr($v['summary'],0,45,'utf-8') !!}...
                                        @else
                                            {!! $v['summary'] !!}
                                        @endif
                                    </p>
                                    <div class="space-4 hidden-sm hidden-xs"></div>
                                    <div class="clearfix text-right">
                                        <a href="{{$v['url']}}" class="cor-gray97 p-space">{{$v['cate_name']}} ·  详情</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                @endforelse
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
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('index','css/index.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('SuperSlide','plugins/jquery/superSlide/jquery.SuperSlide.2.1.1.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('homepage','js/doc/homepage.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('adaptive','plugins/jquery/adaptive-backgrounds/jquery.adaptive-backgrounds.js') !!}


