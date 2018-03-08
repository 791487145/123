<div class="location">
    <div class="container">
        <i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;当前位置 > 服务商
    </div>
</div>
<article>
    <div class="container">
        <div class="classify">
            <label><i class=" fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;分类:</label>
            <span class="classify-wrap {!! (!isset($merge['category']) || $merge['category']==$pid)?'active':'' !!}">
                <a href="{!! URL('bre/service') !!}">全部</a>
            </span>
            @foreach($category as $v)
                <span class="classify-wrap {!! (isset($merge['category']) && $merge['category']==$v['id'])?'active':'' !!}">
                    <a href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                </span>
            @endforeach
        </div>
        <div class="sort clearfix">
            <div class="pull-left sort-l">
                <label class=""><i class="ico-sort-amount-desc"></i>&nbsp;&nbsp;&nbsp;排序 :&nbsp;&nbsp;&nbsp;</label>
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        @if( !isset($_GET['employee_praise_rate']))
                            <span>综合</span>
                        @elseif(isset($_GET['employee_praise_rate']) && $_GET['employee_praise_rate']=='1')
                            <span>好评数</span>
                        @endif
                        <b class="fa fa-angle-down"></b>
                    </span>
                    <ul class="dropdown-menu">
                        <li><a data-value="综合" href="{!! URL('bre/service').'?'.http_build_query(array_except($merge,['employee_praise_rate','service_name'])) !!}">综合</a></li>
                        <li><a data-value="好评数" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['employee_praise_rate'=>1]))!!}">好评数</a></li>
                    </ul>
                </label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label><i class="ico-sort-amount"></i>&nbsp;&nbsp;&nbsp;地区 :&nbsp;&nbsp;&nbsp;</label>

                    {{--省--}}
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        @if(isset($province_detail))
                            <span>{{ $province_detail }}</span>
                        @else
                            <span>全部</span>
                        @endif

                        <b class="fa fa-angle-down"></b>
                    </span>
                    <ul class="dropdown-menu dialogs">
                        <li><a data-value="全部"
                               href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['area','city','keywords','page']),['province'=>0])) !!}">全部</a></li>
                        @foreach($province as $v)
                            <li><a data-value="{{ $v['name'] }}"
                                   href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['city','area','page']),['province'=>$v['id']])) !!}">{{ $v['name'] }}</a></li>
                        @endforeach
                    </ul>
                </label>

                 {{--市--}}
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        @if(isset($city_detail))
                            <span>{{ $city_detail }}</span>
                        @else
                            <span>全部</span>
                        @endif

                        <b class="fa fa-angle-down"></b>
                    </span>
                    <ul class="dropdown-menu dialogs">
                        <li><a data-value="全部"
                               href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['area','city','keywords','page']),['province'=>0])) !!}">全部</a></li>
                        @foreach($city as $v)
                            <li><a data-value="{{ $v['name'] }}"
                                   href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['page','area']), ['city'=>$v['id']])) !!}">{{ $v['name'] }}</a></li>
                        @endforeach
                    </ul>
                </label>

                {{--区--}}
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        @if((isset($area_detail)))
                            <span>{{ $area_detail }}</span>
                        @else
                            <span>全部</span>
                        @endif
                        <b class="fa fa-angle-down"></b>
                    </span>
                    <ul class="dropdown-menu dialogs">
                        <li><a data-value="全部"
                               href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['area','city','keywords','page']),['province'=>0])) !!}">全部</a></li>
                        @foreach($area_add as $v)
                            <li><a data-value="{{ $v['name'] }}"
                                   href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a></li>
                        @endforeach
                    </ul>

                </label>
            </div>
            <div class="pull-right sort-search">
                <form class="form-inline" role="form" method="get" action="/bre/service">
                    <div class="form-group">
                        <button class="ico-search fa fa-search"></button>
                        <input type="text" name="service_name" class="form-control"  placeholder="输入关键词">
                    </div>
                </form>
            </div>
        </div>
    </div>
</article>
<section class="shop">
    <div class="container col-10">
        <div class="row col-10">
            <ul class="clearfix case-list witkey-list service-list">
                @if(!empty($list))
                    @foreach($list as $item)
                        <li class="col-xs-3 col-10">
                            <div class="wrap wrap-serivce2">
                                @if($item->is_recommend == 1 && $item->shop_status == 1 && $item->shopId)
                                <div class="witkey-label-tit clearfix">
                                    荐
                                </div>
                                @endif
                                <div class="img">
                                    <a href="@if($item->shop_status == 1 && $item->shopId) {!! url('shop/'.$item->shopId) !!}
                                    @else{!! URL('bre/serviceEvaluateDetail/'.$item->id) !!}@endif">
                                        <img class="img-responsive img-circle" src="@if($item->avatar){!! URL($item->avatar) !!}
                                        @else {!! Theme::asset()->url('images/default_avatar.png') !!} @endif" alt=""
                                             onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                                    </a>
                                </div>
                                <div class="txt text-center">
                                    <h2 class="p-space"><a href="@if($item->shop_status == 1 && $item->shopId) {!! url('shop/'.$item->shopId) !!}
                                        @else{!! URL('bre/serviceEvaluateDetail/'.$item->id) !!}@endif">
                                            {!! $item->name !!}</a>
                                    </h2>
                                    <div class=" bank-ico">
                                        @if(isset($item->auth) && $item->auth['bank'] == true)
                                            <span class="ico1 a-ico1"></span>
                                        @else
                                            <span class="ico1"></span>
                                        @endif
                                        @if(isset($item->auth) && $item->auth['alipay'] == true)
                                            <span class="ico2 a-ico2"></span>
                                        @else
                                            <span class="ico2"></span>
                                        @endif
                                        @if(isset($item->auth) && $item->auth['realname'] == true)
                                            <span class="ico3 a-ico3"></span>
                                        @else
                                            <span class="ico3"></span>
                                        @endif
                                        @if($item->email_status == 2)
                                            <span class="ico4 a-ico4"></span>
                                        @else
                                            <span class="ico4"></span>
                                        @endif

                                        @if(isset($item->auth) && $item->auth['enterprise'] == true)
                                            <span class="ico5 a-ico5"></span>
                                        @else
                                            <span class="ico5"></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="case-list-item-name clearfix">
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <a href="" target="_blank">@if($item->pre && $item->city)
                                                    {!! $item->pre.$item->city !!}
                                                @endif</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="row text-right">
                                            好评数 : <span class="bg-cor0a">{!! $item->employee_praise_rate !!}个</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="witkey-label-matter">
                                    <p class="p-space">
                                        服务范围：@if(empty($item->skill))
                                            暂无标签
                                        @else
                                            @foreach($item->skill as $value)
                                                {!! $value !!}&nbsp;&nbsp;
                                            @endforeach
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif

            </ul>
            <div class="clearfix">
                <div class=" paging_bootstrap text-center">
                    <ul class="pagination case-page-list">
                        {!! $list->appends($merge)->render() !!}

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
{!! Theme::asset()->container('specific-js')->usepath()->add('elements','plugins/ace/js/ace-elements.min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('ace','plugins/ace/js/ace.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('dialogs','js/dialogs.js') !!}
