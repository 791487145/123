
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
            <div class="help-center-list footer-link-list">
                @if(!empty($childrenCate))<h3>{{$cate['cate_name']}}</h3>@endif
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if(empty($childrenCate) && !empty($category))
                        <ul>
                        @foreach($category as $k => $v)
                            <li class="footer-link-list-item">
                                <a href="/article/aboutUs/{{$v['id']}}" @if($v['id'] == $catID)class="footer-link-list-item-active"@endif>
                                    {{$v['cate_name']}}
                                    <i class="pull-right fa fa-angle-right"></i>
                                </a>
                            </li>
                        @endforeach
                        </ul>
                        @else
                        @foreach($childrenCate as $key => $val)
                            <div class="panel panel-default">
                                <div @if($val['id'] == $catID)class="panel-heading help-center-active" aria-expanded="true"@else class="panel-heading" aria-expanded="false" @endif role="tab">
                                    <h4 class="panel-title">
                                        <a class="btn-block"
                                           id="heading_{{$key}}"  href="#collapse_{{$key}}" aria-controls="collapse_{{$key}}" data-toggle="collapse" data-parent="#accordion"
                                          role="button" data-parent="#accordion" data-toggle="collapse">
                                            {{$val['cate_name']}}
                                            <i class="pull-right ace-icon fa fa-angle-right" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_{{$key}}" aria-labelledby="heading_{{$key}}"
                                     @if($val['id'] == $catID)class="panel-collapse collapse in"
                                     @else class="panel-collapse collapse" @endif role="tabpanel" >
                                <div class="panel-body">
                                    @if(!empty($val['children']))
                                    @foreach($val['children'] as $ke => $value)
                                    <a href="/article/helpCenter/{{$value['id']}}/{{$val['id']}}" title="" @if($value['id'] == $catID)class="help-center-help-link help-center-help-link-active"@else class="help-center-help-link"@endif>{{$value['cate_name']}}</a>
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

            @if(!empty($childrenCate))
            <form method="get" action="/article/helpCenter/{{$catID}}/{{$catID}}">
                    {{csrf_field()}}
                <div class="col-md-12 help-center-search hidden-xs">
                    <div class="input-group">
                        <span class="input-group-addon "> <i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="输入您想搜索的帮助主题关键字">
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
            @endif
            <!-- 问题解答 -->
            <div class="col-md-12 help-center-answers help-minheg690">
                @if(!empty($article))
                <h3>{{$article['title']}}</h3>
                <div class="news-detail-info-words">
                    {!!  htmlspecialchars_decode($article['content']) !!}
                </div>

                <div class="col-xs-12">
                    <div class="space-8"></div>
                    <p class="col-md-10 col-md-offset-1">
                        @if(!empty($pre))
                            <a href="/article/aboutUs/{!! $catID !!}?article_id={!! $pre !!}">上一篇</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        @endif
                        @if(!empty($next))
                            <a href="/article/aboutUs/{!! $catID !!}?article_id={!! $next !!}">下一篇</a>
                        @endif
                    </p>
                </div>

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
            </div>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('footerLink','css/footerLink.css') !!}