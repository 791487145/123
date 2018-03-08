
    <div class="g-taskposition col-lg-12 col-left text-size12">
            您的位置：首页 > 威客商城
    </div>
    <div class="col-lg-9 col-left">
            <div class="g-taskclassify g-serivceitem hidden-xs">
                <div class="col-md-12 col-xs-12 serivce-type">
                    <div class="col-md-1 col-xs-2 cor-gray51 text-size14">
                        <div class="row">
                            类型
                        </div>
                    </div>
                    {{--<div class="col-lg-11  col-xs-10">--}}
                    <div>
                        <a class="{!! !isset($merge['type'])?'bg-blue':'' !!}" href="{!! URl('bre/shop').'?'.http_build_query(array_except($merge,['page','type'])) !!}">全部</a>
                        {{--<a class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'keywords'),['category'=>0])) !!}">全部</a>--}}

                        <a class="{!! (isset($merge['type']) && $merge['type'] == '2')?'bg-blue':'' !!}" href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['type'=> 2])) !!}">服务</a>
                        <a class="{!! (isset($merge['type']) && $merge['type'] == '1')?'bg-blue':'' !!}" href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['type'=> 1])) !!}">作品</a>

                            {{--<div class="pull-right select-fa-angle-down">
                                <i class="fa fa-angle-down text-size14 show-next"></i>
                            </div>--}}
                    </div>
					
                </div>
				<div class="col-md-12 col-xs-12 serivce-type">
                    <div class="col-md-1 col-xs-2 cor-gray51 text-size14">
                        <div class="row">
                            分类
                        </div>
                    </div>
                    {{--<div class="col-lg-11  col-xs-10">--}}
                    <div>
                        <a class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'bg-blue':'' !!}" href="{!! URl('bre/shop').'?'.http_build_query(array_except($merge,['page','category'])) !!}">全部</a>
                        @foreach(array_slice($category,0,7) as $v)
                            <a class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('/bre/shop').'?'.http_build_query(array_merge($merge, ['category'=> $v['id']])) !!}">{{ $v['name'] }}</a>
                        @endforeach
                        @if(count($category)>7)
                            <div class="pull-right select-fa-angle-down">
                                <i class="fa fa-angle-down text-size14 show-next"></i>
                            </div>
                        @endif
						{{--<div class="pull-right select-fa-angle-down">
							<i class="fa fa-angle-down text-size14 show-next"></i>
						</div>--}}
                    </div>
					
                </div>
            </div>
            <div class="g-taskmain">
                <div class="clearfix g-taskmainhd">
                    <div class="pull-left">
                        <a href="{!! URL('bre/shop').'?'.http_build_query(array_except($merge,['page','desc'])) !!}" class="{!! !isset($merge['desc'])?'g-taskmact':'' !!}">综合</a>
                        <span>|</span>
                        <a class="{!! (isset($merge['desc']) && $merge['desc'] == 'cash')?'g-taskmact':'' !!}" href="{!! URL('bre/shop').'?'.http_build_query(array_merge($merge, ['desc'=> 'cash'])) !!}">
                            金额 <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>
                        <span>|</span>
                        <a class="{!! (isset($merge['desc']) && $merge['desc'] == 'sales_num')?'g-taskmact':'' !!}" href="{!! URL('bre/shop').'?'.http_build_query(array_merge($merge, ['desc'=> 'sales_num'])) !!}">
                            成交量 <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>
                        <span>|</span>
                        <a class="{!! (isset($merge['desc']) && $merge['desc'] == 'good_comment')?'g-taskmact':'' !!}" href="{!! URL('bre/shop').'?'.http_build_query(array_merge($merge, ['desc'=> 'good_comment'])) !!}">
                            好评数 <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>
                    </div>
                    <div class="pull-left g-taskmaininp">
                        <form method="get" action="/bre/shop">
                            <input type="text" name="title" placeholder="请输入关键字" value="{!! isset($merge['title'])?$merge['title']:'' !!}"/>
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                @if($goodsInfo->total())
                <ul class="g-shoplimain row">
                    @foreach($goodsInfo as $gv)
                    <li class="col-md-3 col-sm-4 col-xs-6">
                        <div class="g-shopliwrap">
                            <div class="g-shopliimg">
                                <a class="cor-gray51" @if($gv->type == 1) href="{!! URL('/shop/buyGoods/'.$gv->id) !!}"
                                   @elseif($gv->type == 2) href="{!! URL('/shop/buyservice/'.$gv->id) !!}" @endif>
                                    <img src="{!! $domain.'/'.$gv->cover !!}" alt=""
                                         onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                                </a>
                                <span>@if($gv->type == 1) 作品 @elseif($gv->type == 2) 服务 @endif</span></div>
                            <div>
                                <h5 class="text-size14 p-space"><a class="cor-gray51" @if($gv->type == 1) href="{!! URL('/shop/buyGoods/'.$gv->id) !!}" @elseif($gv->type == 2) href="{!! URL('/shop/buyservice/'.$gv->id) !!}" @endif>{!! $gv->title !!}</a></h5>
                                <p class="cor-gray87">好评数：@if($gv->good_comment) {!! $gv->good_comment !!} @else 0 @endif |  {!! $gv->sales_num !!}人购买</p>
                            </div>
                            <p class="clearfix"><span class="pull-left text-size16 cor-orange"><span class="text-size12">￥</span>{!! $gv->cash !!}</span><span class="pull-right cor-gray87 g-shoplipos"><i class="fa fa-map-marker"></i> {!! $gv->addr !!}</span></p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            <div class="clearfix">
                <div class="g-taskpaginfo">
                    @if($goodsInfo->currentPage() != $goodsInfo->lastPage())
                        显示 {{ $goodsInfo->perPage()*($goodsInfo->currentPage()-1)+1 }}~
                        {{ $goodsInfo->perPage()*$goodsInfo->currentPage() }}
                    @elseif($goodsInfo->currentPage() == $goodsInfo->lastPage() && $goodsInfo->perPage()*($goodsInfo->currentPage()-1)+1!=$goodsInfo->total())
                        显示{{ $goodsInfo->perPage()*($goodsInfo->currentPage()-1)+1 }}~
                        {{ $goodsInfo->total() }}
                    @else
                        显示{{ $goodsInfo->total() }}
                    @endif
                    项 共 {{ $goodsInfo->total() }} 项
                </div>
                <div class="paginationwrap">
                    {!! $goodsInfo->appends($_GET)->render() !!}

                </div>
            </div>
    </div>
    <div class="col-lg-3 g-secrivceside visible-lg-block g-secrivewrap col-left">
        <div class="g-tasksidemand">
            <div>

            </div>
            <div>
                <b class="text-size18 cor-gray51">快速发布作品or服务</b>
                <div class="space-4"></div>
                <p class="cor-gray87">快速发布，坐等服务商回复</p>
                <div class="space-4"></div>
                <div class="g-shoplisidebor">
                    <div class="space-2"></div>
                    <select readonly="true" name="type" {{--onchange="changeUrl(this)"--}} id="type">
                        <option value="2" >服务</option>
                        <option value="1" >作品</option>
                    </select>
                    <div class="space-6"></div>
                    <button class="btn btn-block btn-primary bor-radius2 text-size14 btn-blue push-goods-soon" rel="{{ $uid }}" type="button">立即发布</button>
                </div>
            </div>
        </div>
        <div class="space-10"></div>

        @if(!empty($workInfo))
        <div class="g-tasksidelist">
            <div class="clearfix g-tasksidelihd"><b class="pull-left cor-gray51 text-size14">人气作品</b></div>
            <ul>
                @foreach($workInfo as $wv)

                <li class="clearfix">
                    <div class="media-left">{{--<img src="../../images/mybg.png">--}}<a href="{!! URL('shop/buyGoods/'.$wv['id']) !!}"><img src="{!! $domain.'/'.$wv['cover'] !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"></a></div>
                    <div class="media-body g-tasksidelinfo g-shopsidelinfo">
                        <a class="cor-gray51 p-space text-size14" href="{!! URL('shop/buyGoods/'.$wv['id']) !!}"><b>{!! $wv['title'] !!}</b></a>
                        <div class="space-4"></div>
                        <p class="cor-red">￥{!! $wv['cash'] !!}</p>
                        <div class="space-8"></div>
                        <div class="clearfix"><a class="g-tasksidelinbtn pull-left" href="{!! URL('shop/buyGoods/'.$wv['id']) !!}">购买</a><a class="g-tasksidelinbtn pull-left" href="{!! URL('/shop/'.$wv['shop_id']) !!}">进入店铺</a></div>
                    </div>
                </li>
                @endforeach

            </ul>
        </div>

        <div class="space-14"></div>

    </div>
    @endif

    <!--广告位-->
    @if(count($ad))
    <div class="for-advertise col-md-12 visible-lg-block" >
            <a href="{!! $ad[0]['ad_url'] !!}"><img src="{!! URL($ad[0]['ad_file']) !!}" alt=""></a>
            <div class="space-10"></div>
    </div>
    @endif


{!! Theme::asset()->container('custom-css')->usePath()->add('service-task-css', 'css/taskbar/taskindex.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('service-css', 'css/service.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('changeurl-js', 'js/doc/changeurl.js') !!}
