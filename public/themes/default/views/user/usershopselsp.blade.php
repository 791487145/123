<div class="g-main g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">我卖出的作品</h4>
    <div class="space-12"></div>
    <div class="clearfix g-reletaskhd hidden-xs">
        <form action="/user/mySellGoods" method="get">
            <div class="pull-left">
                <div class="pull-left">
                    <select class="form-control" name="status">
                        <option value="0">全部状态</option>
                        {{--<option value="1" @if(isset($merge['status']) && $merge['status'] == 1) selected="selected" @endif>待付款</option>--}}
                        <option value="2" @if(isset($merge['status']) && $merge['status'] == 2) selected="selected" @endif>已付款</option>
                        <option value="3" @if(isset($merge['status']) && $merge['status'] == 3) selected="selected" @endif>交易完成</option>
                        <option value="4" @if(isset($merge['status']) && $merge['status'] == 4) selected="selected" @endif>维权中</option>
                        <option value="5" @if(isset($merge['status']) && $merge['status'] == 5) selected="selected" @endif>维权结束</option>
                    </select>
                </div>
                <div class="pull-left">
                    <select class="form-control" name="sometime">
                        <option value="0">全部时间</option>
                        <option value="1" @if(isset($merge['sometime']) && $merge['sometime'] == 1) selected="selected" @endif>一个月内</option>
                        <option value="2" @if(isset($merge['sometime']) && $merge['sometime'] == 2) selected="selected" @endif>三个月内</option>
                        <option value="3" @if(isset($merge['sometime']) && $merge['sometime'] == 3) selected="selected" @endif>六个月内</option>
                    </select>
                </div>
                <button type="submit">
                    <i class="fa fa-search text-size16 cor-graybd"></i> 搜索
                </button>
            </div>
        </form>
    </div>
    <div class="space-6"></div>
    @if(!empty($goods_list) && !empty($goods_list->toArray()['data']))
        <ul id="useraccept">
            @foreach($goods_list as $item)
                <li class="row width590">
                    <div class="col-sm-1 col-xs-2 usercter">
                        <img src="{!! url($item->cover) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                    </div>
                    <div class="col-sm-11 col-xs-10 usernopd">
                        <div class="col-sm-9 col-xs-8">
                            <div class="text-size14 cor-gray51">
                                <span class="cor-orange">￥{!! $item->cash !!}</span>&nbsp;&nbsp;
                                <a class="cor-blue42" href="/shop/buyGoods/{!! $item->object_id !!}" target="_blank">{!! $item->title  !!}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                @if($item->status == 0 )待付款
                                @elseif($item->status == 1 )已付款
                                @elseif($item->status == 2 || $item->status == 4 )交易完成
                                @elseif($item->status == 3 )维权中
                                @elseif($item->status == 5 )维权结束
                                @endif
                            </div>
                            <div class="space-6"></div>
                            <p class="cor-gray87">
                                <i class="fa fa-user cor-grayd2"></i>{!! $item->name !!}&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-clock-o cor-grayd2"></i> {!! date('Y-m-d',strtotime($item->created_at)) !!}
                            </p>
                            <div class="space-6"></div>
                            <p class="cor-gray51 p-space">{!! strip_tags(htmlspecialchars_decode($item->desc)) !!}</p>
                            <div class="space-2"></div>
                            @if($item->cate_name)<div class="g-userlabel"><a href="">{!! $item->cate_name !!}</a></div>@endif
                        </div>
                        <div class="col-sm-3 col-xs-4 text-right hiden590">
                            <a class="btn-big bg-blue bor-radius2 hov-blue1b" target="_blank" href="/shop/buyGoods/{!! $item->object_id !!}">查看</a>
                        </div>
                        <div class="col-xs-12"><div class="g-userborbtm"></div></div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="space-20"></div>
        <div class="dataTables_paginate paging_bootstrap">
            <ul class="pagination">
                {!! $goods_list->appends($merge)->render() !!}
            </ul>
        </div>
    @else
        <div class="g-nomessage">暂无信息哦 ！</div>
    @endif
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}

