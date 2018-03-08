<div class="g-main g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">服务管理</h4>
    <div class="space-12"></div>
    @if($is_open_shop == 1)
        <div class="clearfix g-reletaskhd hidden-xs">
            <form action="/user/serviceList" method="get">
                <div class="pull-left">
                    <div class="pull-left">
                        <select class="form-control" name="status">
                            <option value="all">全部状态</option>
                            @foreach($map as $k=>$v)
                            <option value="{{ $k }}" {{ (isset($_GET['status']) && $_GET['status']=="$k")?'selected':'' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pull-left">
                        <select class="form-control" name="time">
                            <option value="all">全部时间</option>
                            <option value="1" {{ (!empty($_GET['time']) && $_GET['time']==1)?'selected':'' }}>最近一个月</option>
                            <option value="3" {{ (!empty($_GET['time']) && $_GET['time']==3)?'selected':'' }}>最近三个月</option>
                            <option value="6" {{ (!empty($_GET['time']) && $_GET['time']==6)?'selected':'' }}>最近六个月</option>
                        </select>
                    </div>
                    <button type="submit">
                        <i class="fa fa-search text-size16 cor-graybd"></i> 搜索
                    </button>
                    <a class="g-usershopfbtn bg-blue hov-blue1b" href="{{ URL('user/serviceCreate') }}" target="_blank"><i class="fa fa-plus text-size12"></i>&nbsp;&nbsp;发布服务</a>
                </div>
            </form>
            <div class="pull-right">
                <div class="text-size14 g-usershopli g-releasechart visible-lg-block hidden-xs hidden-sm hidden-md" href="javascript:;">
                    <i class="usershoplico" data-toggle="tooltip" data-placement="bottom" title="统计"></i>
                    <div class="g-releasehidea"></div>
                    <div class="g-releasehide">
                        <div class="g-usershopdetail">
                            <div class="g-usershopdehd">交易明细</div>
                            <p>上架服务：  <span class="cor-orange">{{ $serviceStatistic['added_service'] }}</span></p>
                            <p>完成服务：  <span class="cor-orange">{{ $serviceStatistic['success_service'] }}</span></p>
                            <p>累计收入：  <span class="cor-orange">{{ $serviceStatistic['service_money'] }}元</span></p>
                            <div class="g-usershopdebtn clearfix"><span class="pull-left noindent">可用提现：<span class="cor-orange">{{ $serviceStatistic['balance'] }}</span></span>
                                <a class="btn-big bg-gary bor-radius2 hov-bggryb0" href="{{ URL('finance/cashout') }}" target="_blank">提现</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-6"></div>
        @if(count($service)>0)
        <ul id="useraccept">
            @foreach($service as $v)
            <li class="row width590">
                <div class="col-sm-1 col-xs-2 usercter">
                    @if(!empty($v['cover']))
                    <img src="{{ $domain.'/'.$v['cover'] }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                    @else
                    <img src="{{ Theme::asset()->url('images/defauthead.png')}}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                    @endif
                </div>
                <div class="col-sm-11 col-xs-10 usernopd">
                    <div class="col-sm-9 col-xs-8">
                        <div class="text-size14 cor-gray51">
                            <span class="cor-orange">￥{{ $v['cash'] }}</span>&nbsp;&nbsp;
                            <a target="_blank" class="cor-blue42" href="{{ URL('shop/buyservice',['id'=>$v['id']]) }}">{{ $v['title'] }}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                            <span>
                                {{ $map[$v['status']] }}
                                @if($v['status']==3 && !empty($v['recommend_text']))
                                <span class="usernopd-aircle">
                                    <i class="fa fa-question-circle"></i>
                                    <div class="foc-hov">
                                        <div class="foc-arrow1"></div>
                                        <div class="foc-arrow2"></div>
                                        {{ $v['recommend_text'] }}
                                    </div>
                                </span>
                                @endif
                                @if($v['status']==1 && $v['is_recommend']==1)
                                <span class="usernopd-aircle putaway-top">
                                    <span class="label label-warning position-absolute">顶</span>
                                    <div class="foc-hov">
                                        <div class="foc-arrow1"></div>
                                        <div class="foc-arrow2"></div>
                                        有效期至 {{ $v['recommend_end'] }}
                                    </div>
                                </span>
                                @endif
                            </span>
                        </div>
                        <div class="space-6"></div>
                        <p class="cor-gray87"><i class="fa fa-eye cor-grayd2"></i> {{ $v['view_num'] }}人浏览/{{ $v['sales_num'] }}人购买&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o cor-grayd2"></i> {{ date('Y-m-d',strtotime($v['created_at'])) }}</p>
                        <div class="space-6"></div>
                        <p class="cor-gray51 p-space">{!! $v['desc'] !!}</p>
                        <div class="space-2"></div>
                        <div class="g-userlabel">
                            @if(!empty($all_cate[$v['cate_id']]))
                            <a href="">{{ $all_cate[$v['cate_id']]['name'] }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-4 text-right hiden590">
                        @if($v['status']!=3)
                        <a class="btn-big bg-blue bor-radius2 hov-blue1b" target="_blank" href="{{ URL('shop/buyservice',['id'=>$v['id']]) }}">查看</a>
                        @elseif($v['status']==3)
                        <a class="btn-big bg-blue bor-radius2 hov-blue1b" target="_blank" href="{{ URL('user/serviceEditNew',['id'=>$v['id']]) }}">编辑</a>
                        <a class="btn-big bg-blue bor-radius2 hov-blue1b deleteService"  url="{{ URL('user/serviceDelete',['id'=>$v['id']]) }}" data-toggle="modal" data-target="#myModal">删除</a>
                        @endif
                        <p class="g-usershopshow">
                            @if($v['status']==1 )
                            <a class="g-usershopsmbtn" href="{{ URL('user/serviceAdded',['id'=>$v['id']]) }}">下架</a>
                            <a class="g-usershopsmbtn" href="{{ URL('user/serviceBounty',['id'=>$v['id']]) }}" target="_blank">置顶</a>
                            @elseif($v['status']==0)
                            <a class="g-usershopsmbtn" href="{{ URL('user/serviceEdit',['id'=>$v['id']]) }}">编辑</a>
                            <a class="g-usershopsmbtn deleteService" url="{{ URL('user/serviceDelete',['id'=>$v['id']]) }}" data-toggle="modal" data-target="#myModal">删除</a>
                            @elseif($v['status']==2)
                            <a class="g-usershopsmbtn" href="{{ URL('user/serviceAdded',['id'=>$v['id']]) }}">上架</a>
                            <a class="g-usershopsmbtn deleteService" url="{{ URL('user/serviceDelete',['id'=>$v['id']]) }}" data-toggle="modal" data-target="#myModal">删除</a>
                            @endif
                        </p>
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
            {!! $service->appends($_GET)->render() !!}
        </div>
    @elseif($is_open_shop == 2)
        <div class="row close-space-tip">
            <div class="col-md-12 text-center">
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <div class="space-10"></div>
                <p class="text-size16 cor-gray87">您的店铺已关闭，暂不能查看作品管理！<a href="/shop/manage/{!! $shop_id!!}">开启店铺</a></p>
            </div>
        </div>
    @else
        <div class="row close-space-tip">
            <div class="col-md-12 text-center">
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <div class="space-10"></div>
                <p class="text-size16 cor-gray87">您的店铺还没设置，暂不能查看作品管理！<a href="/user/shop">店铺设置</a></p>
            </div>
        </div>
    @endif
</div>
{{--删除模态框--}}
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog  contact-me-modal" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">确定删除该服务吗</h4>
            </div>
            <input type="hidden" name="goods_id" class="goods_id" id="goods_id" value="31">
            <div class="space-20"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_links" url="" data-dismiss="modal">确定</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}

