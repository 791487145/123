<div class="container">
        <div class="row">
            <div class="col-md-12 col-left">
                <!-- 所在位置 -->
                <div class="now-position text-size12">
                    您的位置：首页 > 资讯中心
                </div>
            </div>
        </div>
        <div class="row">
            <!-- main -->
            <div class="col-md-9 col-left">
                <!-- 顶部banner -->
                @if(count($ad))
                <div class="col-md-12 news-main-banner">
                    {{--<img src="{!! Theme::asset()->url('images/news_pic_banner.png') !!}" alt="">--}}
                    <a href="{!! $ad[0]['ad_url'] !!}"><img src="{!! URL($ad[0]['ad_file']) !!}" alt=""></a>
                </div>
                @endif
                <!-- 新闻内容 -->
                <div class="col-md-12 news-main-area">
                    <div class="news-detail-title-name">
                        <h2>{{ $info['title'] }}</h2>
                        <div>
                            <span>发布时间：{{ $info['created_at'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>阅读量：@if(!empty( $info['view_times'])){{ $info['view_times'] }}@else 0 @endif次</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="bdsharebuttonbox" data-tag="share_1" style="display: inline-block;vertical-align: bottom;">
                                <div class="shop-sharewrap">
                                    <!-- JiaThis Button BEGIN -->
                                    <div class="jiathis_style">
                                        <span class="jiathis_txt">分享：&nbsp;</span>
                                        <a class="jiathis_button_tsina"></a>
                                        <a class="jiathis_button_weixin"></a>
                                        <a class="jiathis_button_qzone"></a>
                                        <a class="jiathis_button_tqq"></a>
                                        <a class="jiathis_button_cqq"></a>
                                        <a class="jiathis_button_douban"></a>
                                    </div>
                                    <script type="text/javascript" >
                                        var jiathis_config={
                                            summary:"",
                                            shortUrl:false,
                                            hideMore:false
                                        }
                                    </script>
                                    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
                                    <!-- JiaThis Button END --></div>
                                <div class="shop-share"></div>
                            </div>
                        </div>
                    </div>
                    <div class="news-detail-info-words">
                        {!! htmlspecialchars_decode($info['content']) !!}
                        <div class="news-line"></div>
                    </div>

                    <div class="col-md-12 news-up-down-page">
                        <div class="col-md-6 news-up-page">
                            <span>上一篇：</span>
                            <a href="{!! URL('article/'.$prev['id']) !!}" title="">{{ $prev['title'] }}</a>
                        </div>
                        <div class="col-md-6 news-down-page">
                            <a href="{!! URL('article/'.$next['id']) !!}" title="">{{ $next['title'] }}</a>
                            <span>下一篇：</span>
                        </div>
                    </div>
                </div>
                <!-- 相关资讯 -->
                <div class="col-md-12 relevant-news">
                    <div class="relevant-news-title">
                        <h5>相关资讯</h5>
                        <a href="{!! URL('article') !!}"> More ></a>
                    </div>
                    <ul class="relevant-news-list">
                        @if(!empty($relatedList))
                        @foreach($relatedList as $v)
                        <li>
                            <a href="{!! URL('article/'.$v->id) !!}" title="" class="relevant-news-words">
                                {{ $v['title'] }}
                            </a>
                            <span class="relevant-news-time">{{ $v['created_at'] }}</span>
                        </li>
                       @endforeach
                            @endif
                    </ul>
                </div>

            </div>
            <!-- side -->
            <div class="col-md-3 g-taskside visible-lg-block visible-md-block col-left">
                <!-- 快速发布需求 -->

                <div class="g-tasksidemand">
                    @if(count($rightAd))
                    <a href="{!! $rightAd[0]['ad_url'] !!}"><img src="{!! URL($rightAd[0]['ad_file']) !!}" alt=""></a>
                    @else
                    <img src="{!! Theme::asset()->url('images/news_pic_side.png') !!}" alt="">
                    @endif
                    </div>
                <!-- 最新动态 -->
                @if(count($hotlist))
                <div class="col-md-12 latest-news">
                    <div class="latest-news-title">
                        <h5>{!! $targetName !!}</h5>
                        <a href="{!! URL('article') !!}">More ></a>
                    </div>
                    <ul class="latest-news-list">
                        @foreach($hotlist as $v)
                        <li><a href="{!! $v['url'] !!}" title=""class="latest-news-words">
                                {{ $v['recommend_name'] }}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </div>
                @endif
                <div class="space-10 col-md-12"></div>
            </div>
        </div>
    </div>
{!! Theme::asset()->container('custom-css')->usepath()->add('news','css/news.css') !!}