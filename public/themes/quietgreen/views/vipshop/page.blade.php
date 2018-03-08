<main class="content">

    {{--banner--}}
    <div class="container ">
        <div class="row">
            <div class="g-taskposition col-lg-12 col-left">当前位置：首页 &gt; VIP首页 &gt; VIP访谈</div>
            <div class="col-xs-12 col-left col-right">
                <div class="g-banner">
                    <div id="carousel-example-generic1" class="carousel slide carousel-fade bannner-carousel" data-ride="carousel">
                        <!-- Indicators -->
                        @if(!empty($ad))
                            <ol class="carousel-indicators">
                                @foreach($ad as $k => $v)
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
                                @if(!empty($ad))
                                    @foreach($ad as $key => $value)
                                        <div  class="item @if($key == 0)active @endif item-banner{!! $key+1 !!}" >
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
                            <div class="scutcheon cor-gray51 text-center">
                                <h4 class=" text-size20">开启您的VIP品牌</h4>
                                <a href="{{url('vipshop/payvip')}}">开通VIP商铺服务</a>
                                <hr style="border-color:#e1e5eb;margin:10px 0">
                                <h6 class="text-size16 mg-margin">有不明白的马上咨询我们吧</h6>
                                <div class="space-8"></div>
                                <form action="/vipshop/feedback"  method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <input type="text" name="uid" @if(count($userDetail)) value="{!! $userDetail['uid'] !!}"@endif style="display:none">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="2" name="desc" placeholder="输入"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="您输入的手机号码" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="form-control" value="免费咨询">
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-10"></div>
    {{--page--}}
    <div class="interview u-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class=" clearfix row">
                        @forelse($list as $item)
                        <li class="cor-gray51 col-lg-4 col-left">
                            <div class="classify clearfix">
                                <div class="pull-left img">
                                    <a href="{{url('vipshop/details/' . $item->vid)}}"><img class="pull-left" src="{{url($item['shop_pic'])}}" alt="{{$item['shop_name']}}"></a>
                                    <div class="tit">
                                        <h4 class="text-center"><a class="text-size16 cor-white" href="{{url('vipshop/details/' . $item->vid)}}">{{$item['shop_name']}}</a></h4>
                                    </div>
                                </div>
                                <div class="wrap">
                                    <a href="{{url('vipshop/details/' . $item->vid)}}"><h4 class="p-space text-size16">{{$item['title']}}</h4></a>
                                    <p>{{str_limit($item['desc'], 50)}}</p>
                                    <a class="a aBtn" href="{{url('employ/create/'. $item->uid)}}">雇佣TA</a><a class="aBtn" href="{{url('shop/' . $item['id'])}}">进入店铺</a>
                                </div>
                            </div>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                    {{--分页--}}
                    <div class="clearfix">
                        <div class="g-taskpaginfo">
                            显示 {{($page - 1) * $per_page + 1}}~
                            {{($page * $per_page)}}
                            项 共 {{$count}} 个任务
                        </div>
                        <div class="paginationwrap">
                            <ul class="pagination mg-margin">
                                {{$list->render()}}
                            </ul>
                        </div>
                    </div>
                    <div class="space"></div>
                </div>
            </div>
        </div>
    </div>
</main>
