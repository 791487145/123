
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
        <div class="col-lg-9 col-left">
            <!-- 顶部banner -->
            @if(count($ad))
            <div class="col-md-12 news-main-banner">

                <a href="{!! $ad[0]['ad_url'] !!}"><img src="{!! URL($ad[0]['ad_file']) !!}" alt=""></a>
            </div>
            @endif
            <!-- 安全交易 & 行业动态 -->
            <div class="col-md-12 news-main-area">
                <div class="news-main-area-wrap">
                    <ul class="news-title-list nav news-title-list-background">
                        @if(!empty($category->toArray()))
                        @foreach($category as $v)
                            <li class="news-title-list-item @if($catID == $v->id  ) news-title-active @endif  ">
                                <a href="{!! URL('article?catID='.$v->id) !!}">{{ $v['cate_name'] }}</a>
                            </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="news-detail-info">
                    @if(!empty($list['data']))
                    <ul class="news-detail-list">
                        @foreach($list['data'] as $v)
                        <li class="news-detail-list-item news-detail-time-text">
                            <h4 class="news-detail-title">
                                <a class="cor-gray3a" href="{!! URL('article/'.$v['id']) !!}" title="">
                                    {{  $v['title'] }}</a>
                            </h4>
                            <p class="news-detail-words">{{ $v['summary'] }}</p>
                            <p class="news-detail-time news-detail-time-text">
                                <span> 发表时间：{{ $v['created_at'] }}</span>
                                <span>关注度： @if(!empty( $v['view_times'])){{ $v['view_times'] }}@else 0 @endif</span>
                            </p>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            <!-- 底部分页 -->
            {{--<div class="row news-page">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="dataTables_paginate paging_bootstrap">--}}
                        {{--<ul class="pagination news-page-list">--}}

                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="col-sm-12">
                <div class=" paging_bootstrap row paginationwrap">
                    <ul class="pagination">
                        @if(!empty($list['prev_page_url']))
                            <li><a href="{!! URL('article').'?'.http_build_query(array_merge($merge,['page'=>$list['current_page']-1])) !!}">上一页</a></li>
                        @endif
                        @if($list['last_page']>1)
                            @for($i=1;$i<=$list['last_page'];$i++)
                                <li class="{{ ($i==$list['current_page'])?'active disabled':'' }}"><a href="{!! URL('article').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                            @endfor
                        @endif
                        @if(!empty($list['next_page_url']))
                            <li><a href="{!! URL('article').'?'.http_build_query(array_merge($merge,['page'=>$list['current_page']+1])) !!}">下一页</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- side -->
        <div class="col-md-3 g-taskside visible-lg-block col-left">
            <!-- 快速发布需求 -->
            <div class="g-tasksidemand">

                @if(count($rightAd))
                <a href="{!! $rightAd[0]['ad_url'] !!}"><img src="{!! URL($rightAd[0]['ad_file']) !!}" alt=""></a>
                @else
                <img src="{!! Theme::asset()->url('images/news_pic_side.png') !!}" alt="">
                @endif
                <form class="registerform" action="/task/create" method="get">
                <div class="release-form">
                    <div class="space-10"></div>
                    <b class="text-size16 cor-gray51">快速发布需求</b>
                    <div class="space-2"></div>
                    <p>快速发布，坐等服务商回复</p>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="news-icon news-icon-kind"></i>
                        </span>
                        <select class="form-control" id="form-field-select-1" readonly="true" name="type" disabled>
                            <option value="1">悬赏任务</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="news-icon news-icon-tag"></i>
                        </span>
                        <input class="form-control input-mask-phone" type="text"  name="title"  id="form-field-mask-2" placeholder="需求标题,如:logo设计">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="news-icon news-icon-phone"></i>
                        </span>
                        <input class="form-control input-mask-phone" type="text" name="phone" id="form-field-mask-2" placeholder="手机号码">
                    </div>

                    <div class="conmit-demand">
                        <button class="btn btn-primary conmit-demand-btn bor-radius2 btn-blue" type="submit">发布需求</button>
                    </div>
                </div>
                </form>
            </div>
            <!-- 最新动态 -->
            @if(count($hotlist))
            <div class="col-md-12 latest-news">
                <div class="latest-news-title">
                    <h5>{!! $targetName !!}</h5>
                    {{--<a href="{!! URL('article' ) !!}">More ></a>--}}

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