<div class="location">
    <div class="container">
        <i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;当前位置 > 威客商城
    </div>
</div>
<article>
    <div class="container">
	    <div class="classify">
            <label><i class=" fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;类型:</label>
            <a href="{!! URl('bre/shop').'?'.http_build_query(array_except($merge,['page','type'])) !!}"><span class="classify-wrap {!! !isset($merge['type'])?'active':'' !!}">
                全部
            </span></a>
            <a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['type'=> 2])) !!}"><span class="classify-wrap {!! (isset($merge['type']) && $merge['type'] == 2) ?'active':'' !!}">
                服务
            </span></a>
            <a href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['type'=> 1])) !!}"><span class="classify-wrap {!! (isset($merge['type']) && $merge['type'] == 1)?'active':'' !!}">
                作品
            </span></a>
        </div>
        <div class="classify">
            <label><i class=" fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;分类:</label>
           <a href="{!! URl('bre/shop').'?'.http_build_query(array_except($merge,['page','category'])) !!}"><span class="classify-wrap {!! (!isset($merge['category']) || $merge['category']==$pid)?'active':'' !!}">全部</span></a>
                        @foreach(array_slice($category,0,7) as $v)
                            <a  href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['category'=> $v['id']])) !!}"><span class="classify-wrap {!! (isset($merge['category']) && $merge['category']==$v['id'])?'active':'' !!}">{{ $v['name'] }}</span></a>
                        @endforeach
                        @if(count($category)>7)
                            <div class="pull-right select-fa-angle-down">
                                <i class="fa fa-angle-down text-size14 show-next"></i>
                            </div>
                        @endif
        </div>
        <div class="sort clearfix">
            <div class="pull-left sort-l">
                {{--<label class="sort-select"><i class="ico-sort-amount-desc"></i>&nbsp;&nbsp;&nbsp;排序 :&nbsp;&nbsp;&nbsp;</label>--}}
                <label><i class="fa fa-sort-amount-desc"></i>&nbsp;&nbsp;&nbsp;排序:&nbsp;&nbsp;&nbsp;</label>

                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        @if(isset($merge['desc']) && $merge['desc'] == 'cash')
                            <span>金额</span>
                        @elseif(isset($merge['desc']) && $merge['desc'] == 'sales_num')
                            <span>成交量</span>
                        @elseif(isset($merge['desc']) && $merge['desc'] == 'good_comment')
                            <span>好评数</span>
                        @else
                            <span>综合</span>
                        @endif
                            <b class="fa fa-angle-down"></b>
                    </span>
                    <ul class="dropdown-menu">
                        <li><a data-value="综合" href="{!! URL('bre/shop') !!}">综合</a></li>
                        <li><a data-value="金额" href="{!! URL('bre/shop').'?'.http_build_query(array_merge($merge, ['desc'=> 'cash'])) !!}">金额</a></li>
                        <li><a data-value="成交量" href="{!! URL('bre/shop').'?'.http_build_query(array_merge($merge, ['desc'=> 'sales_num'])) !!}">成交量</a></li>
                        <li><a data-value="好评数" href="{!! URL('bre/shop').'?'.http_build_query(array_merge($merge, ['desc'=> 'good_comment'])) !!}">好评数</a></li>
                    </ul>
                </label>
            </div>
            <div class="pull-right sort-search">
                <form class="form-inline" role="form" method="get" action="/bre/shop">
                    <div class="form-group">
                        <button class="ico-search fa fa-search"></button>
                        <input type="text" name="title" placeholder="输入关键词">
                    </div>
                </form>
            </div>
        </div>
    </div>
</article>
<section class="shop">
    <div class="container col-10">
        <div class="row col-10">
            <ul class="clearfix case-list witkey-list">
                @if($goodsInfo->total())
                    @foreach($goodsInfo as $gv)
                        <li class="col-xs-3 col-10">
                            <div class="wrap">
                                <div class="img">
                                    <a @if($gv->type == 1) href="{!! URL('/shop/buyGoods/'.$gv->id) !!}"
                                       @elseif($gv->type == 2) href="{!! URL('/shop/buyservice/'.$gv->id) !!}" @endif>
                                        <img src="{!! $domain.'/'.$gv->cover !!}" alt=""
                                             onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" alt="">
                                    </a>
                                    <div class="witkey-label-tit clearfix">
                                    <span>@if($gv->type == 1) 作品
                                        @elseif($gv->type == 2) 服务 @endif
                                    </span>
                                    </div>
                                    <div class="witkey-label-matter">
                                        <p>
                                            好评数：@if($gv->good_comment) {!! $gv->good_comment !!} @else 0 @endif  |  购买人：{!! $gv->sales_num !!}人
                                        </p>
                                    </div>
                                </div>
                                <div class="txt text-center">
                                    <h2 class="p-space">
                                        <a @if($gv->type == 1) href="{!! URL('/shop/buyGoods/'.$gv->id) !!}"
                                           @elseif($gv->type == 2) href="{!! URL('/shop/buyservice/'.$gv->id) !!}" @endif>
                                            {!! $gv->title !!}
                                        </a>
                                    </h2>
                                    <div class="num">
                                        <span class=""></span>
                                    </div>
                                </div>
                                <div class="case-list-item-name clearfix">
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <a href="">{!! $gv->addr !!}</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="row text-right">
                                            <i class="fa fa-cny"></i> 金额：<b>￥{!! $gv->cash !!}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="clearfix">
                <div class=" paging_bootstrap text-center">
                    <ul class="pagination case-page-list">
                        {!! $goodsInfo->appends($_GET)->render() !!}
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>