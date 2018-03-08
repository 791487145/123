
<div class="container">
    <div class="row">
        <div class="col-md-12 col-left">
            <!-- 所在位置 -->
            <div class="now-position text-size12">
                您的位置：首页 > {{$cate['cate_name']}}
            </div>
        </div>
    </div>
    <div class="row footer-link-area">
        <!-- side -->
        <div class="col-md-3 help-center-side col-left">
            <div class="help-center-list help-minheg690">
                <h3>帮助中心</h3>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if(!empty($childrenCate) && is_array($childrenCate))
                        @foreach($childrenCate as $key => $val)
                            <div class="panel panel-default">
                                <div data-id="{{$val['id']}}" @if($val['id'] == $upID)class="panel-heading help-center-active" aria-expanded="true" @else class="panel-heading" aria-expanded="false" @endif role="tab"
                                     id="heading_{{$key}}"  href="#collapse_{{$key}}" aria-controls="collapse_{{$key}}" data-toggle="collapse" data-parent="#accordion">
                                    <h4 class="panel-title">
                                        <a  role="button">
                                            {{$val['cate_name']}}
                                            <i class="pull-right fa fa-angle-right" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_{{$key}}" aria-labelledby="heading_{{$key}}"  @if($val['id'] == $upID) class="panel-collapse collapse in"
                                     @else class="panel-collapse collapse" @endif role="tabpanel" >
                                <div class="panel-body">
                                    @if(!empty($val['children']))
                                    @foreach($val['children'] as $ke => $value)
                                    <a href="/article/helpCenter/{{$value['id']}}/{{$val['id']}}" title="" data-id="{{$value['id']}}" @if($value['id'] == $catID)class="help-center-help-link help-center-help-link-active"@else class="help-center-help-link"@endif>{{$value['cate_name']}}</a>
                                    @endforeach
                                    @endif
                                </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- main -->
        <div class="col-md-9 col-left">
            <!-- 帮助搜索 -->

        <form method="get" action="/article/helpCenter/{{$catID}}/{{$upID}}">
            <div class="col-md-12 help-center-search hidden-xs hidden-sm">
                <div class="input-group">
                    <span class="input-group-addon "> <i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" name="search" placeholder="输入您想搜索的帮助主题关键字" value="{{$search}}">
                </div>
                {{--<div class=" help-center-search-btn">--}}
                    <button type="submit" class=" help-center-search-btn">搜索</button>
                {{--</div>--}}
                {{--<div class="hot-search">--}}
                    {{--<span>热门搜索：</span>--}}
                    {{--<a href="">发布任务</a>--}}
                    {{--<a href="">提现</a>--}}
                    {{--<a href="">充值</a>--}}
                    {{--<a href="">发布作品</a>--}}
                {{--</div>--}}
            </div>
        </form>
            <!-- 问题解答 -->
            <div class="col-md-12 help-center-answers help-minheg538">
                <h3>
                    @if(!empty($searchArticle))
                        {{$searchArticle['title']}}
                    @elseif(!empty($article))
                        {{$article['title']}}
                    @endif
                </h3>
                <div class="news-detail-info-words">
                    @if(!empty($searchArticle))
                        {!! htmlspecialchars_decode($searchArticle['content']) !!}
                    @elseif(!empty($article))
                        {!! htmlspecialchars_decode($article['content']) !!}
                    @else
                        <div class="row close-space-tip center">
                            <div class="col-md-12">
                                <div class="space"></div>
                                <div class="space"></div>
                                <div class="space"></div>
                                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                                <p>没有相关文章</p>
                            </div>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="space-8"></div>
                        <p class="col-md-10 col-md-offset-1">
                            @if(!empty($pre))
                                @if(!empty($search))
                                    <a href="/article/helpCenter/{!! $catID !!}/{!! $upID !!}?article_id={!! $pre !!}&search={!! $search !!}">上一篇</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                @else
                                    <a href="/article/helpCenter/{!! $catID !!}/{!! $upID !!}?article_id={!! $pre !!}">上一篇</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif
                            @endif
                            @if(!empty($next))
                                @if(!empty($search))
                                    <a href="/article/helpCenter/{!! $catID !!}/{!! $upID !!}?article_id={!! $next !!}&search={!! $search !!}">下一篇</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                @else
                                    <a href="/article/helpCenter/{!! $catID !!}/{!! $upID !!}?article_id={!! $next !!}">下一篇</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                @endif
                            @endif
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('footerLink','css/footerLink.css') !!}