<div class="g-banner hidden-sm hidden-xs hidden-md">
    <div id="carousel-example-generic" class="carousel slide carousel-fade bannner-carousel" data-ride="carousel">
        <!-- Indicators -->
        @if(!empty(Theme::get('banner')))
            <ol class="carousel-indicators">
                @foreach(Theme::get('banner') as $k => $v)
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
                @if(!empty(Theme::get('banner')))
                    @foreach(Theme::get('banner') as $key => $value)
                        <div  class="item @if($key == 0)active @endif item-banner{!! $key+1 !!}" >
                            <a href="{!! $value['ad_url'] !!}" target="_blank">
                                <div>
                                    <img src="{!!  URL($value['ad_file'])  !!}" alt="..." class="img-responsive itm-banner" data-adaptive-background='{!! $key+1 !!}'>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
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
                @endif
            </div>
            <div class="scutcheon">
                <h4 class="cor-gray51 text-center text-size28">开启您的VIP品牌</h4>
                <a href="javascript:;">开通VIP商铺服务</a>
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
