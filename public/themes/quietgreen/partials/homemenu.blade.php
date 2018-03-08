<div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
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
                <div class="item active">
                    <a href=""><img src="{!! Theme::asset()->url('images/mb1/banner1.jpg') !!}" alt="..." class="img-responsive"></a>
                </div>
                <div class="item">
                    <a href=""><img src="{!! Theme::asset()->url('images/mb1/banner1.jpg') !!}" alt="..." class="img-responsive"></a>
                </div>
                <div class="item">
                    <a href=""><img src="{!! Theme::asset()->url('images/mb1/banner1.jpg') !!}" alt="..." class="img-responsive"></a>
                </div>
            @endif

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="fa fa-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="fa fa-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>





