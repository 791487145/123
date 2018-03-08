<div class="g-main g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">我承接的服务</h4>
    <div class="space-12"></div>
    <div class="clearfix g-reletaskhd hidden-xs">
        <form action="/user/serviceMyJob" method="get">
            <div class="pull-left">
                <div class="pull-left">
                    <select class="form-control" name="employ_type">
                        <option value="all">全部类型</option>
                        <option value="0" {{ (isset($_GET['employ_type']) && $_GET['employ_type']=='0')?'selected':'' }}>雇佣</option>
                        <option value="1" {{ (isset($_GET['employ_type']) && $_GET['employ_type']=='1')?'selected':'' }}>服务</option>
                    </select>
                </div>
                <div class="pull-left">
                    <select class="form-control" name="time">
                        <option value="all">全部时间</option>
                        <option value="1" {{ (isset($_GET['time']) && $_GET['time']==1)?'selected':'' }}>最近一个月</option>
                        <option value="3" {{ (isset($_GET['time']) && $_GET['time']==3)?'selected':'' }}>最近三个月</option>
                        <option value="6" {{ (isset($_GET['time']) && $_GET['time']==6)?'selected':'' }}>最近六个月</option>
                    </select>
                </div>
                <div class="pull-left">
                    <select class="form-control" name="status">
                        <option value="all">全部状态</option>
                        <option value="0" {{ (isset($_GET['status']) && $_GET['status']=='0')?'selected':'' }}>待受理</option>
                        <option value="1" {{ (isset($_GET['status']) && $_GET['status']==1)?'selected':'' }}>工作中</option>
                        <option value="2" {{ (isset($_GET['status']) && $_GET['status']==2)?'selected':'' }}>验收中</option>
                        <option value="3" {{ (isset($_GET['status']) && $_GET['status']==3)?'selected':'' }}>待评价</option>
                        <option value="4" {{ (isset($_GET['status']) && $_GET['status']==4)?'selected':'' }}>交易完成</option>
                        <option value="5,6" {{ (isset($_GET['status']) && $_GET['status']=='5,6')?'selected':'' }}>交易失败</option>
                        <option value="7,8" {{ (isset($_GET['status']) && $_GET['status']=='7,8')?'selected':'' }}>交易维权</option>
                    </select>
                </div>
                <button type="submit">
                    <i class="fa fa-search text-size16 cor-graybd"></i> 搜索
                </button>
            </div>
        </form>
    </div>
    <div class="space-6"></div>
    @if(count($employ)>0)
        <ul id="useraccept">
            @foreach($employ as $v)
                <li class="row width590">
                    <div class="col-sm-1 col-xs-2 usercter">
                        <img src="{{ $domain.'/'.$v['avatar'] }}"  onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                    </div>
                    <div class="col-sm-11 col-xs-10 usernopd">
                        <div class="col-sm-9 col-xs-8">
                            <div class="text-size14 cor-gray51"><span class="cor-orange">￥{{ $v['bounty'] }}</span>&nbsp;&nbsp;<a class="cor-blue42" target="_blank" href="{{ URL('employ/workin',['id'=>$v['id']]) }}">{{ $v['title'] }}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;{{ $map[$v['status']] }}</div>
                            <div class="space-6"></div>
                            <p class="cor-gray87"><i class="fa fa-user cor-grayd2"></i> {{ $v['user_name'] }}&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o cor-grayd2"></i>{{ date('Y-m-d',strtotime($v['created_at'])) }}</p>
                            <div class="space-6"></div>
                            <div style="word-wrap: break-word;">
                            <p class="cor-gray51 p-space">{!! $v['desc'] !!}</p>
                            </div>
                            <div class="space-2"></div>
                            {{--<div class="g-userlabel"><a href="">{{ $all_cate[$v['cate_id']] }}</a></div>--}}
                            @if($v['employ_type']==1)
                            <i class="fa fa-exclamation-circle"></i>此服务来源于：{{ $employ_goods[$v['id']]['title'] }}
                            @endif
                        </div>
                        <div class="col-sm-3 col-xs-4 text-right hiden590">
                            <a class="btn-big bg-blue bor-radius2 hov-blue1b" target="_blank" href="{{ URL('employ/workin',['id'=>$v['id']]) }}">查看</a>
                        </div>
                        <div class="col-xs-12"><div class="g-userborbtm"></div></div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="g-nomessage">暂无信息哦 ！</div>
    @endif
    <div class="space-20"></div>
    <div class="dataTables_paginate paging_bootstrap">
        {!! $employ->appends($_GET)->render() !!}
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}

