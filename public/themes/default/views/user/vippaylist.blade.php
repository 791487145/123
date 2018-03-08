<div class="g-main g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">购买记录</h4>
    <div class="space-12"></div>
    <div class="clearfix g-reletaskhd hidden-xs">
        <form action="/user/vippaylist" method="get">
            <div class="pull-left">
                <div class="pull-left">
                    <select class="form-control" name="package_id">
                        <option value="0">全部套餐</option>
                        @forelse($change as $item)
                        <option value="{{$item['id']}}" @if($package_id == $item['id'])selected="selected"@endif>{{$item['title']}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <button type="submit">
                    <i class="fa fa-search text-size16 cor-graybd"></i> 搜索
                </button>
            </div>
        </form>
    </div>
    <div class="space-6"></div>
    @if($list->total())
        <ul id="useraccept">
            @foreach($list as $item)
                <li class="row width590">
                    <div class="col-sm-12 col-xs-12 usernopd g-vippaylist">
                        <div class="col-sm-9 col-xs-8">
                            <i class="vippayico vippayico-hg"><img src="{{url($item['logo'])}}" alt=""></i>
                            <div class="text-size14 cor-gray51">
                                <a class="cor-gray51" href="{{url('user/vippaylog/' . $item['id'])}}" target="_blank">{{$item['title']}}</a>&nbsp;
                                <span class="cor-orange">￥{{$item['price']}}</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                @if($item['status'])已过期@else使用中@endif
                            </div>
                            <div class="space-6"></div>
                            <p class="cor-gray87">
                                购买时间：{{$item['start_time']}}&nbsp;&nbsp;&nbsp;&nbsp;购买时长：{{$item['duration']}}个月&nbsp;&nbsp;&nbsp;&nbsp;到期时间：{{$item['end_time']}}
                            </p>
                        </div>
                        <div class="col-sm-3 col-xs-4 text-right hiden590">
                            <a class="btn-big bg-blue bor-radius2 hov-blue1b no-margin-top" href="{{url('user/vippaylog/' . $item['id'])}}">查看</a>
                        </div>
                        <div class="col-sm-12 space-8"></div>
                        <div class="col-xs-12"><div class="g-userborbtm no-padding-top"></div></div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="space-20"></div>
        <div class="dataTables_paginate paging_bootstrap">
            <ul class="pagination">
                {!! $list->render() !!}
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

