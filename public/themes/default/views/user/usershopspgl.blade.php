<div class="g-main g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">作品管理</h4>
    <div class="space-12"></div>
    @if($is_open_shop == 1)
        <div class="clearfix g-reletaskhd hidden-xs">
            <form action="/user/goodsShop" method="get">
                <div class="pull-left">
                    <div class="pull-left">
                        <select class="form-control" name="status">
                            <option value="0">全部状态</option>
                            <option value="1" @if(isset($merge['status']) && $merge['status'] == 1)selected="selected"@endif>待审核</option>
                            <option value="2" @if(isset($merge['status']) && $merge['status'] == 2)selected="selected"@endif>出售中</option>
                            <option value="3" @if(isset($merge['status']) && $merge['status'] == 3)selected="selected"@endif>下架</option>
                            <option value="4" @if(isset($merge['status']) && $merge['status'] == 4)selected="selected"@endif>审核未通过</option>
                        </select>
                    </div>
                    <div class="pull-left">
                        <select class="form-control" name="sometime">
                            <option value="0">全部时间</option>
                            <option value="1" @if(isset($merge['sometime']) && $merge['sometime'] == 1)selected="selected"@endif>一个月</option>
                            <option value="2" @if(isset($merge['sometime']) && $merge['sometime'] == 2)selected="selected"@endif>三个月</option>
                            <option value="3" @if(isset($merge['sometime']) && $merge['sometime'] == 3)selected="selected"@endif>六个月</option>
                        </select>
                    </div>
                    <button type="submit">
                        <i class="fa fa-search text-size16 cor-graybd"></i> 搜索
                    </button>
                    <a class="g-usershopfbtn bg-blue hov-blue1b" href="/user/pubGoods"><i class="fa fa-plus text-size12" ></i>&nbsp;&nbsp;发布作品</a>
                </div>
            </form>
            <div class="pull-right">
                <div class="text-size14 g-usershopli g-releasechart visible-lg-block hidden-xs hidden-sm hidden-md" href="javascript:;">
                    <i class="usershoplico" data-toggle="tooltip" data-placement="bottom" title="统计"></i>
                    <div class="g-releasehidea"></div>
                    <div class="g-releasehide">
                        <div class="g-usershopdetail">
                            <div class="g-usershopdehd">交易明细</div>
                            <p>累积交易：  <span class="cor-orange">{!! $goods_statistics['buy_count'] !!}</span></p>
                            <p>正在交易：  <span class="cor-orange">{!! $goods_statistics['on_buy_count'] !!}</span></p>
                            <p>累计收入：  <span class="cor-orange">{!! $goods_statistics['buy_income'] !!}元</span></p>
                            <div class="g-usershopdebtn clearfix"><span class="pull-left noindent">可用提现：<span class="cor-orange">{!! $goods_statistics['balance'] !!}</span></span>
                                <a class="btn-big bg-gary bor-radius2 hov-bggryb0" href="/finance/cashout">提现</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-6"></div>
        @if(!empty($goods_list) && !empty($goods_list->toArray()['data']))
        <ul id="useraccept">
            @foreach($goods_list as $item)
            <!--上架-->
            <li class="row width590">
                <div class="col-sm-1 col-xs-2 usercter">
                    <img src="{!! url($item->cover) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                </div>
                <div class="col-sm-11 col-xs-10 usernopd">
                    <div class="col-sm-9 col-xs-8">
                        <div class="text-size14 cor-gray51">
                            <span class="cor-orange">￥{!! $item->cash !!}</span>&nbsp;&nbsp;
                            <a class="cor-blue42"  target="_blank" @if($item->status == 1 || $item->status == 2)href="/shop/buyGoods/{!! $item->id !!}"
                               @else href="/user/waitGoodsHandle/{!! $item->id !!}" @endif>
                                {!! $item->title !!}
                            </a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                            @if($item->status == 0)
                                待审核
                            @elseif($item->status == 1)
                                <span>
                                出售中
                                @if($item->recommend_end && strtotime($item->recommend_end) > time())
                                <span class="usernopd-aircle putaway-top">
                                    <span class="label label-warning position-absolute">顶</span>
                                    <div class="foc-hov">
                                        <div class="foc-arrow1"></div>
                                        <div class="foc-arrow2"></div>
                                        有效期{!! $item->recommend_end !!}
                                    </div>
                                </span>
                                @endif
                            </span>
                            @elseif($item->status == 2)
                                下架
                            @elseif($item->status == 3)
                            <span>
                                审核未通过
                                <span class="usernopd-aircle">
                                    <i class="fa fa-question-circle"></i>
                                    <div class="foc-hov">
                                        <div class="foc-arrow1"></div>
                                        <div class="foc-arrow2"></div>
                                        {!! $item->recommend_text !!}
                                    </div>
                                </span>
                            </span>
                            @endif
                        </div>
                        <div class="space-6"></div>
                        <p class="cor-gray87"><i class="fa fa-eye cor-grayd2"></i>
                            @if($item->view_num > 0){!! $item->view_num !!} @else 0 @endif人浏览/
                            @if($item->sales_num > 0){!! $item->sales_num !!} @else 0 @endif人购买&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-clock-o cor-grayd2"></i> {!! date('Y-m-d',strtotime($item->created_at)) !!}</p>
                        <div class="space-6"></div>
                        <p class="cor-gray51 p-space">{!!  strip_tags(htmlspecialchars_decode($item->desc)) !!}</p>
                        <div class="space-2"></div>
                        <div class="g-userlabel">@if($item->name)<a href="">{!! $item->name !!}</a>@endif</div>
                    </div>
                    <div class="col-sm-3 col-xs-4 text-right hiden590">
                        <a class="btn-big bg-blue bor-radius2 hov-blue1b" target="_blank" @if($item->status == 1 || $item->status == 2)
                        href="/shop/buyGoods/{!! $item->id !!}" @else href="/user/waitGoodsHandle/{!! $item->id !!}" @endif target="_blank">查看</a>
                        <p class="g-usershopshow" data-id="{!! $item->id !!}">
                            @if($item->status == 1)
                                <a class="g-usershopsmbtn" href="/finance/getpay/{!! $item->id !!}">置顶</a>
                                <a class="g-usershopsmbtn" href="javascript:;" data-values="2" onclick="changeGoodsStatus(this)">下架</a>
                            @elseif($item->status == 2)
                                <a class="g-usershopsmbtn" href="javascript:;" data-values="1" onclick="changeGoodsStatus(this)">上架</a>
                                <a class="g-usershopsmbtn delete_goods" href="javascript:;" data-values="5"  data-toggle="modal" data-target="#myModal"
                                   >删除</a>
                            @elseif($item->status == 0)

                                <a class="g-usershopsmbtn" href="/user/editGoods/{!! $item->id !!}" target="_blank">编辑</a>
                                <a class="g-usershopsmbtn delete_goods" href="javascript:;" data-values="5" data-toggle="modal" data-target="#myModal"
                                >删除</a>
                            @elseif($item->status == 3)

                                <a class="g-usershopsmbtn" href="/user/editGoods/{!! $item->id !!}" target="_blank">编辑</a>
                                <a class="g-usershopsmbtn delete_goods" href="javascript:;" data-values="5" data-toggle="modal" data-target="#myModal"
                                >删除</a>
                            @endif
                        </p>
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
            <div class="g-nomessage">暂无作品哦 ！</div>
        @endif


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




<!-- 删除模态框 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  contact-me-modal" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">确定删除该作品吗</h4>
            </div>
            <input type="hidden" name="goods_id" class="goods_id" id="goods_id" value="">
            <div class="space-20"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_primary">确定</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>


{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}

