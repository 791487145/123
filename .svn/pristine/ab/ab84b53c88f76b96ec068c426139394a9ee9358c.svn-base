<!--威客商城-->
@if($work || $server)
<div class="container shop">
    <h1 class="title">威客商城</h1>
    <div class="clearfix row">
        <ul class="clearfix">
            {{--作品--}}
            @forelse($work as $k => $v)
                @if($k < 4)
                <li class="col-xs-3 ">
                    <div class="wrap">
                        <div class="img">
                            <a href="{{$v['url']}}" target="_blank">
                                <img @if($v['recommend_pic'])src="{!! URL($v['recommend_pic']) !!}"
                                     @else src="{!! URL($v['cover']) !!}"
                                     @endif
                                     alt="First slide">
                            </a>
                            <div class="label-tit clearfix">
                                <span><i class="fa fa-cny"></i></span>
                                <span><i class="fa fa-cny"></i>{{$v['cash']}}</span>
                            </div>
                        </div>
                        <div class="txt text-center">
                            <h2 class="p-space"><a href="{{$v['url']}}" target="_blank">{{ $v['title'] }}</a></h2>
                            <div class="num">
                                <span class="">@if(!empty($v['sales_num']))
                                        {!! $v['sales_num'] !!}
                                    @else
                                        0
                                    @endif人购买
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
                @endif
            @empty
            @endforelse

            {{--服务--}}
            @forelse($server as $k => $v)
                @if($k < 4)
                    <li class="col-xs-3 ">
                        <div class="wrap">
                            <div class="img">
                                <a href="{{$v['url']}}" target="_blank">
                                    <img @if($v['recommend_pic'])src="{!! URL($v['recommend_pic']) !!}"
                                         @else src="{!! URL($v['cover']) !!}"
                                         @endif
                                         alt="First slide">
                                </a>
                                <div class="label-tit clearfix">
                                    <span><i class="fa fa-cny"></i></span>
                                    <span><i class="fa fa-cny"></i>{{$v['cash']}}</span>
                                </div>
                            </div>
                            <div class="txt text-center">
                                <h2 class="p-space"><a href="{{$v['url']}}" target="_blank">{{ $v['title'] }}</a></h2>
                                <div class="num">
                                <span class="">@if(!empty($v['sales_num']))
                                        {!! $v['sales_num'] !!}
                                    @else
                                        0
                                    @endif人购买
                                </span>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            @empty
            @endforelse
        </ul>
        @if(!Auth::check())
        <div class="text-center hov-btn">
            <a class="" href="{!! url('register') !!}" target="_blank">立即注册</a>
        </div>
        @endif
    </div>
</div>
@endif
<!--热门任务-->
@if($task)
<div class="task">
    <div class="container">
        <h1 class="title">热门任务</h1>
        <div class="row">
            @forelse($task as $k => $v)
                @if($k < 4)
                    <div class=" col-xs-6 list">
                        <div class="wrap">
                            <div class="money">
                                <span><i class="fa fa-cny"></i></span>
                                <span>@if($v['show_cash']){{$v['show_cash']}}@else 0 @endif</span>
                                <span>任务金额</span>
                            </div>
                            <h3 class="p-space">
                                <a href="/task/{{$v['id']}}" style="color: #404040;" target="_blank">
                                    {{ $v['title'] }}
                                </a>
                            </h3>
                            <div class="content clearfix">
                                <div class="content">
                                    {!! htmlspecialchars_decode($v['desc']) !!}
                                </div>
                            </div>
                            <div class="num">
                                <span>{{$v['delivery_count']}}人投标</span>
                                <span class="pull-right p-space">
                                    <img @if($v['avatar'])src="{!! URL($v['avatar']) !!}"
                                         @else src="{!! Theme::asset()->url('images/bg1.png') !!}"
                                         @endif alt=""/>
                                    <p class="p-space">{{$v['name']}}</p>
                                </span>
                            </div>
                            <a class="hov-btn" href="/task/{{$v['id']}}" target="_blank">去参与</a>
                        </div>
                    </div>
                @endif
            @empty
            @endforelse
        </div>
        <div class="text-center hov-btn">
            <a class="" href="{!! url('task') !!}" target="_blank">查看全部任务</a>
        </div>
    </div>
</div>
@endif



<!--推荐店铺-->
@if($shop_before)
<div class="store">
    <div class="container">
        <h1 class="title">推荐店铺</h1>

        <div class="poster-main A_Demo">
            <div class="poster-btn poster-prev-btn"><i class="fa fa-angle-left"></i></div>
            <ul class="poster-list ">

                @forelse($shop_before as $k => $v)
                    @if($k < 5)
                        <li class="poster-item">
                            <div class="img">
                                <a href="{{$v['url']}}" target="_blank">
                                    <img class="img-gray img-responsive" src="{{url($v['shop_pic'])}}" alt="">
                                </a>
                            </div>
                            <div class="investor-info p-space text-center">
                                <div class="investor-name p-space">
                                    <a href="{{$v['url']}}" style="color: #404040;" target="_blank">
                                    {{$v['shop_name']}}
                                    </a>
                                </div>
                                <div class="investor-position p-space">@if($v['skill_name'])服务范围：{{$v['skill_name']}}@endif</div>
                                <div class="investor-desc p-space">好评率：<i>{{$v['good_comment_rate']}}%</i></div>
                            </div>
                        </li>
                    @endif
                @empty
                @endforelse

            </ul>
            <div class="poster-btn poster-next-btn">
                <i class="fa fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>
@endif

<!--成功案例-->
@if($success)
<div class="case">
    <div class="container">
        <h1 class="title">成功案例</h1>
        <div class="row">
            @if($success[0])
                <div class="col-xs-3">
                    <div class="list">
                        <a class="img" href="{{$success[0]['url']}}" target="_blank">
                            <img @if($success[0]['recommend_pic'])src="{!! URL($success[0]['recommend_pic']) !!}"
                                                    @else src="{!! URL($success[0]['success_pic']) !!}"
                                                    @endif alt=""/>
                        </a>
                        <div class="wrap">
                            <h6 class="p-space">
                                <a href="{{$success[0]['url']}}" target="_blank">
                                    {{$success[0]['title']}}
                                </a>
                            </h6>
                            <p class="p-space"><i></i>{{$success[0]['name']}}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-xs-9">
                <div class="row">
                    <ul>
                        @forelse($success as $k => $v)
                            @if($k != 0 && $k <7)
                                <li class=" col-xs-4">
                                    <div class="list ">
                                        <div class="list-wrap">
                                            <a href="{{$v['url']}}" target="_blank">
                                                <img @if($v['recommend_pic'])
                                                     src="{!! URL($v['recommend_pic']) !!}"
                                                     @else src="{!! URL($v['success_pic']) !!}"
                                                     @endif alt=""/>
                                            </a>
                                            <div class="wrap">
                                                <h6 class="p-space"><a href="{{$v['url']}}" target="_blank">
                                                        {{$v['title']}}
                                                    </a></h6>
                                                <p class="p-space"><i></i>{{$v['name']}}</p>
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
    </div>
</div>
@endif

<!--友情链接-->
@if($friendUrl)
<div class="link">
    <div class="container">
        <h1 class="title">友情链接</h1>
        <div class="logo">
            <ul>
                @forelse($friendUrl as $k => $v)
                    @if($k < 12)
                        <li class="list">
                            <a target="_blank" href="{{url($v['content'])}}">
                                <img src="{{url($v['pic'])}}" alt=""/>
                            </a>
                        </li>
                    @endif
                @empty
                @endforelse

            </ul>
        </div>
    </div>
</div>
@endif
        <!--top-->
<div class="go-top dn" id="go-top">
    <div class="uc-2vm u-hov">
        {{--<a href="javascript:;" class="uc-2vm u-hov"></a>--}}
        <form class="form-horizontal" action="/bre/feedbackInfo" method="post" enctype="multipart/form-data" id="complain">
            {!! csrf_field() !!}
            <div class="u-pop dn clearfix">
                <input type="text" name="uid" @if(!empty(Theme::get('complaints_user'))) value="{!! Theme::get('complaints_user')->uid !!}"@endif style="display:none">
                <h2 class="mg-margin text-size12 cor-gray51">一句话点评</h2>
                <div class="space-4"></div>
                <textarea class="form-control" rows="3" name="desc" placeholder="期待您的一句话点评，不管是批评、感谢还是建议，我们都将会细心聆听，及时回复"></textarea>
                {!! $errors->first('desc') !!}
                <div class="space-4"></div>
                <input type="text" name="phone" @if(!empty(Theme::get('complaints_user'))) value="{!! Theme::get('complaints_user')->mobile !!}" readonly="readonly" @endif placeholder="填写手机号">
                {!! $errors->first('phone') !!}
                <button type="submit" class="btn-blue btn btn-sm btn-primary">提交</button>
                <div class="arrow">
                    <div class="arrow-sanjiao"></div>
                    <div class="arrow-sanjiao-big"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="feedback u-hov">
        {{--<a href="" target="_blank" class="feedback u-hov"></a>--}}
        <div class="dn dnd">
            <h2 class="mg-margin text-size12 cor-gray51">在线时间：09:00 -18:00</h2>
            <div class="space-4"></div>
            <div>
                <a href="{!! CommonClass::contactClient(Theme::get('basis_config')['qq']) !!}" target="_blank"><img src="{!! Theme::asset()->url('images/pa.jpg') !!}" alt=""></a>
                {{--<a href="javscript:;"><img src="{!! Theme::asset()->url('images/pa.jpg') !!}" alt=""></a>--}}
            </div>
            <div class="hr"></div>
            <div class="iss-ico1">
                <p class="cor-gray51 mg-margin">全国免长途电话：</p>
                <p class="text-size20 cor-gray51">{!! Theme::get('site_config')['phone'] !!}</p>
            </div>
            <div class="arrow">
                <div class="arrow-sanjiao feedback-sanjiao"></div>
                <div class="arrow-sanjiao-big feedback-sanjiao-big"></div>
            </div>
        </div>
    </div>
    <a href="javascript:;" class="go u-hov"></a>
</div>
{!! Theme::asset()->container('specific-js')->usepath()->add('sliderBox','plugins/jquery/sliderBox.js') !!}


