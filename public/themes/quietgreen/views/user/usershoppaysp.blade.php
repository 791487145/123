<div class="g-main g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">我购买的作品</h4>
    <div class="space-12"></div>
    <div class="clearfix g-reletaskhd hidden-xs">
        <form action="/user/myBuyGoods" method="get">
            <div class="pull-left">
                <div class="pull-left">
                    <select class="form-control" name="status">
                        <option value="0">全部状态</option>
                        <option value="1" @if(isset($merge['status']) && $merge['status'] == 1) selected="selected" @endif>待付款</option>
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
                            <div class="g-userlabel"><a href="">{!! $item->cate_name !!}</a></div>
                        </div>
                        <div class="col-sm-3 col-xs-4 text-right hiden590">
                            <a class="btn-big bg-blue bor-radius2 hov-blue1b" target="_blank" href="/shop/buyGoods/{!! $item->object_id !!}">查看</a>
                            <p class="g-usershopshow" data-id="{!! $item->id !!}">
                                @if($item->status == 1)
                                    <a class="g-usershoppaybtn confirm_doc" href="javascript:;" data-toggle="modal" data-target="#myModalgz">
                                        确认源文件
                                    </a>
                                    @if($legal_rights != 0 && (($legal_rights*3600+strtotime($item->pay_time)) > time()))
                                    <a class="g-usershoppaybtn apply_rights" href="javascript:;" data-toggle="modal" data-target="#myModalgzz">
                                        申请维权
                                    </a>
                                    @endif
                                @elseif($item->status == 2)
                                    <a class="g-usershoppaybtn comment_goods" href="javascript:;" data-toggle="modal"
                                       data-target="#myModalz" data-values="{!! $item->object_id !!}">
                                        评价
                                    </a>
                                @elseif($item->status == 0)
                                    <a class="g-usershoppaybtn" href="/shop/pay/{!! $item->id !!}">付款</a>
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
        <div class="g-nomessage">暂无信息哦 ！</div>
    @endif

</div>

<!--确认源文件modal-->
<div class="modal fade" id="myModalgz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  contact-me-modal" role="document">
        <form method="post" action="/shop/postConfirm">
            {{csrf_field()}}
            <input type="hidden" name="id" id="order_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-size14 cor-gray51" id="myModalLabel"><strong>确认源文件</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="space-2"></div>
                    <div class="text-center text-size16 cor-gray51">
                        确定您有收到真实有效的源文件！
                    </div>
                    <div class="space-8"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="contactMe">确定</button>
                    <button type="button" class="btn btn-default" id="contactMeCancel" data-dismiss="modal">取消</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!--维权 模态框（Modal） -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModalgzz" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="/shop/postRightsInfo">
            {{csrf_field()}}
            <input type="hidden" name="order_id" id="goods_order_id">
            <div class="modal-content">
                <div class="modal-header widget-header-flat">
                <span class="modal-title cor-gray51 text-size14 text-blod">
                    交易维权：
                </span>
                    <button type="button" class="bootbox-close-button close text-size14"
                            data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="space"></div>
                    <div class="clearfix">
                        <div class="form-group clearfix">
                            <label class="col-sm-3 control-label text-right">维权类型：</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <select name="type">
                                        <option value="1">违规信息</option>
                                        <option value="2">虚假交稿</option>
                                        <option value="3">涉嫌抄袭</option>
                                        <option value="4">其他</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-3 control-label text-right">维权原因：</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <textarea type="text" name="desc"  placeholder="请输入维权原因"  rows="3" cols="50"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix text-center">
                        <button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2" type="submit" >确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                    </div>
                    <div class="space"></div>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal -->
</div>

<!--评价 模态框（Modal） -->
<div class="modal fade buygoods-modal" id="myModalz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
    <div class="modal-dialog  add-case-modal usershop-radet" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-size14" id="myModalLabelz">发表评价</h4>
            </div>
            <form method="post" action="/shop/addGoodsComment" enctype="multipart/form-data" id="commentForm">
                {{csrf_field()}}
                <div class="record">
                    <div class="text-size14 cor-gray51 clearfix">
                        <div class="col-xs-12 task-mediaAssessR pd-padding0">
                            <input name="uid" type="hidden" @if(Auth::check())value="{!! Auth::id() !!}"@endif>
                            <input name="goods_id" id="goods_id" type="hidden" value="">
                            <p class="text-size14 cor-gray51">总体评价：</p>
                            <label class="evaluate-back">
                                <input name="type" type="radio" class="ace" checked value="0">
                                <span class="lbl"> <span class="flower4">好评</span></span>&nbsp;&nbsp;&nbsp;
                            </label>
                            <label class="evaluate-back">
                                <input name="type" type="radio" class="ace" value="1">
                                <span class="lbl"> <span class="flower5">中评</span></span>&nbsp;&nbsp;&nbsp;
                            </label>
                            <label>
                                <input name="type" type="radio" class="ace" value="2">
                                <span class="lbl"> <span class="flower6">差评</span></span>
                            </label>
                        </div>
                    </div>
                    <div class="space-8"></div>
                    <div class="star text-size14 cor-gray51 clearfix">
                        <div class="col-xs-12 shop-mediaAssessR pd-padding0">
                            <p class="text-size14 cor-gray51 mg-margin">质量评价：</p>
                            <div class="target-star starpd"> 工作速度 </div>
                            <div id="function-star1" class="target-star evaluate-back">
                                <input type="hidden" name="speed_score" id="speed-score" value="5">
                            </div>
                            <div class="target-star starpd">工作质量 </div>
                            <div id="function-star2" class="target-star evaluate-back">
                                <input type="hidden" name="quality_score" id="quality-score" value="5">
                            </div>
                            <div class="target-star starpd">工作态度 </div>
                            <div id="function-star3" class="target-star evaluate-back">
                                <input type="hidden" name="attitude_score" id="attitude-score" value="5">
                            </div>
                        </div>
                    </div>
                    <div class="space-8"></div>
                    <div class="text-size14 cor-gray51 clearfix">
                        <div class="col-xs-12 pd-padding0">
                            <p class="text-size14 cor-gray51">发表评论：</p>
                            <textarea name="comment" id="limit" class="col-xs-12" rows="5"></textarea>
                            <div class="cor-gray51 text-right">
                                <span class="cor-orange"><i class="fa fa-exclamation-circle"></i></span> 最多<span id="textCount">100</span>个字
                            </div>
                        </div>
                    </div>

                    <div class="space-6"></div>
                    <div class="clearfix text-center">
                        <button class="btn btn-primary btn-blue btn-big3 bor-radius2" id="goods_comment">发表评价</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_raty','plugins/jquery/raty/jquery.raty.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('mybuygoods','js/mybuygoods.js') !!}

