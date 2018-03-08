<div class="shop-wrap clearfix">
    {{--头部--}}
    <div class="col-md-12 col-left">
        <div class="shop-main buygoods-header">
            <div class="personal-info buygoods-info clearfix">
                <div class="personal-info-words clearfix buygoods-info-words">
                    <img src="{!! url($goods_info->cover )!!}" alt="" class="img-circle personal-info-pic buygoods-img" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                    <div class="personal-info-block shop-width772">
                        <div class="personal-info-block-name">
                            <h3 class="text-size18 cor-gray51"><strong>{!! $goods_info->title !!}</strong></h3>
                        </div>
                        <div class="alert alert-warning mg-bottom10">
                            <p class="text-size12 cor-gray51"><span class="cor-gray89">作品分类：</span>
                                {!! $goods_info->cate_pname !!} &nbsp;&nbsp;{!! $goods_info->cate_name !!}
                            </p>
                            <div class="space-8"></div>
                            <p class="text-size12 cor-orange31"><span class="cor-gray89">作品价格：</span>
                                @if($goods_info->status != 2 && $goods_info->is_delete == 0)
                                <span class="text-size16">￥</span><span class="text-size28">{!! $goods_info->cash !!}</span>
                                <span class="text-size16">/@if($goods_info->unit == 0)件@elseif($goods_info->unit == 1)时
                                    @elseif($goods_info->unit == 2)份
                                    @elseif($goods_info->unit == 3)个@elseif($goods_info->unit == 4)张
                                    @elseif($goods_info->unit == 5)套
                                    @endif</span>
                                @if($owner == true && $trade_rate)
                                    <span class="shop-hint">
                                        <i class="fa fa-lightbulb-o text-size16"></i> 小贴士：当前平台佣金是{!! $trade_rate !!}%
                                    </span>
                                @endif
                                @else
                                <b class="cor-orange31 text-size28">已下架</b>
                                @endif
                            </p>
                        </div>
                        <div class="personal-about buygoods-about cor-gray51 clearfix">

                                <div class="pull-left">
                                    <span class="text-size12 cor-gray89">好评率：<span class="cor-orange31">{!! $goods_info->comment_rate !!}%</span></span><span class="slow cor-gray89">|</span>
                                    <span class="text-size12 cor-gray89">综合评分：<span class="cor-orange31">{!! $goods_info->avg_score !!}</span></span><span class="slow cor-gray89">|</span>
                                    <span class="text-size12 cor-gray89">已购买：<span class="cor-orange31">
                                            @if($goods_info->sales_num){!! $goods_info->sales_num !!}@else 0 @endif次
                                        </span>
                                    </span>
                                </div>
                                <div class="pull-right shop-xs-show">
                                    <i class="fa fa-exclamation-circle cor-orange31 text-size14"></i> <span class="cor-gray89">购买完成之后即可下载，一次购买长期有效</span>
                                </div>
                        </div>
                        <div class="space-6"></div>
                        <div class="clearfix buygoods-btn-wrap">
                            @if($owner == false)
                                @if($is_buy == true)
                                    <a class="buygoods-btn bg-blue" data-toggle="modal" data-target="#myModalgz"  href="javascript:;">文件下载</a>
                                @else
                                    @if($is_rights == true)
                                        <a class="buygoods-btn bg-gary nopoint" href="javascript:;">维权中</a>
                                    @else
                                        @if($goods_info->status != 2 && $goods_info->is_delete == 0)
                                        <a class="buygoods-btn bg-blue" href="/shop/orders/{!! $goods_info->id !!}">购买作品</a>
                                        @else
                                        <a class="buygoods-btn bg-gary nopoint" href="javascript:;">购买作品</a>
                                        @endif
                                    @endif
                                @endif
                                @if($is_contract == true)
                                    @if(Auth::check())
                                        @if( Theme::get('is_IM_open') == 2)
                                             <a class="buygoods-callme shop-im hovim-orange" href="javascript:;" data-toggle="modal" data-target="#myModalshop">联系我</a>
                                        @elseif( Theme::get('is_IM_open') == 1)
                                            <a class="shop-callme shop-im hovim-orange"  href="javascript:;">联系我</a>
                                        @endif
                                    @else
                                        <a class="shop-callme hovim-orange" href="{!! URL('/login') !!}">联系我</a>
                                    @endif
                                @endif
                                @if($collect_shop == 1)
                                    <span href="" class="shop-collectatv">已收藏</span>
                                @elseif($collect_shop == 0)
                                    @if(Auth::check())
                                        <a class="buygoods-collect hov-orange" id="shop_id" href="javascript:;" shop_id="{!! $goods_info->shop_id !!}">收藏店铺</a>
                                    @else
                                        <a class="buygoods-collect hov-orange" href="{!! URL('/login') !!}">收藏店铺</a>
                                    @endif
                                @endif
                            @endif
                                {{--分享--}}
                                <div class="bdsharebuttonbox" data-tag="share_1">
                                    <div class="shop-sharewrap"><span class="pull-left cor-gray51">分享：&nbsp;</span>
                                        <!-- JiaThis Button BEGIN -->
                                        <div class="jiathis_style">
                                            <a class="jiathis_button_tsina"></a>
                                            <a class="jiathis_button_weixin"></a>
                                            <a class="jiathis_button_qzone"></a>
                                            <a class="jiathis_button_tqq"></a>
                                            <a class="jiathis_button_cqq"></a>
                                            <a class="jiathis_button_douban"></a>
                                        </div>
                                        <script type="text/javascript" >
                                            var jiathis_config={
                                                summary:"",
                                                shortUrl:false,
                                                hideMore:false
                                            }
                                        </script>
                                        <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
                                        <!-- JiaThis Button END --></div>
                                    <div class="shop-share"></div>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModalshop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog  contact-me-modal" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-size14 shop-modal-title" id="myModalLabel"><b>联系我</b></h4>
                </div>
                <div class="modal-body shop-modal-shopbody">
                    <input type="hidden" name="js_id" class="js_id" id="contactMeId" value="{!! $goods_info->uid !!}">
                    <textarea name="content" id="content" class="shop-modalarea"></textarea>
                    <div class="space-6"></div>
                    <div class="text-right"><button class="btn btn-primary btn-blue shop-modalbtn" id="contactMe">发送</button></div>
                </div>
                @if($contactInfo['mobile_status']== 1 || $contactInfo['qq_status'] == 1 || $contactInfo['wechat_status'] == 1)
                <div class="modal-shopfooter g-shopabnum">
                    其他联系方式&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @if($contactInfo['mobile_status'] == 1)
                        <span class="g-shopabnumph text-size12">{!! $contactInfo['mobile'] !!}</span>
                    @endif
                    @if($contactInfo['qq_status'] == 1)
                        <span class="g-shopabnumqq text-size12">{!! $contactInfo['qq'] !!}</span>
                    @endif
                    @if($contactInfo['wechat_status'] == 1)
                        <span class="g-shopabnumwx text-size12">{!! $contactInfo['wechat'] !!}</span>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div><!-- 模态框（Modal）end -->
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModalgz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog  contact-me-modal" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-size14 shop-modal-title" id="myModalLabel"><b>下载源文件</b></h4>
                </div>
                <form class="form-horizontal" action="seriveceCaseDetail_submit" method="post" accept-charset="utf-8">
                    <div class="modal-body shop-modal-body">
                        <ul class="text-size14">
                            <li class="row cor-gray87">
                                <div class="col-sm-10 col-xs-9">文件名称</div>
                                <div class="col-sm-2 col-xs-3 text-right">操作</div>
                            </li>
                            @if(!empty($attachment))
                                @foreach($attachment as $item)
                            <li class="row">
                                <div class="col-sm-10 col-xs-9 cor-gray51">{!! $item->name !!} </div>
                                <div class="col-sm-2 col-xs-3 text-right p-space">
                                    <a href="{{ URL('shop/download',['id'=>$item['id']]) }}" target="_blank">下载</a>
                                </div>
                            </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- 模态框（Modal）end -->
    {{--选项卡--}}
    <div class="col-lg-12 list-l col-md-12 col-left buygoods-wares">
        <ul class="buygoods-nav clearfix mg-margin nav nav-tabs">
            <li class="@if(empty($merge))active @endif">
                <a href="#home" data-toggle="tab" class="text-size16 " aria-expanded="false">作品描述</a>
            </li>
            <li class="@if(!empty($merge))active @endif">
                <a href="#home2" data-toggle="tab" class="text-size16 goods_comment" data-id="{!! $goods_info->id !!}" aria-expanded="false">作品评价</a>
            </li>
        </ul>
        <div class="tab-content b-border0 pd-padding0" >
            <!--商品描述-->
            <div id="home" class="tab-pane fade pd-padding30  bg-white b-border @if(empty($merge)) active in @endif">
                <!--描述-->
                <div class="bugoods-description cor-gray51 text-size14">
                    {!! htmlspecialchars_decode($goods_info->desc) !!}
                </div>
            </div>
            <!--商品评价-->
            <div id="home2" class="tab-pane fade @if(!empty($merge))pd-padding30  bg-white b-border active in @endif">
                <div class="personal-evaluate-area">
                    <!-- 总评 -->
                    <div class="personal-total-evaluate">
                        <!-- 总体评价数量 -->
                        <div class="personal-total-evaluate-num">
                            <span class="personal-evaluate-cicle-title">总体评价</span>
                            <div class="personal-good-evaluate">
                                <p>好评率：<span>{!! $goods_info->comment_rate !!}%</span></p>
                                <p>好评数量：<span>@if($goods_info->good_comment){!! $goods_info->good_comment !!}@else 0 @endif</span>个</p>
                            </div>
                        </div>
                        <!-- 总体评分 -->
                        <div class="personal-total-evaluate-point clearfix">
                            <span class="personal-evaluate-cicle-title">总体评分</span>
                            <div class="personal-evaluate-starts-list">
                                <div class="personal-evaluate-starts-item">
                                    <p>工作速度：{!! $comment_about['speed_score'] !!}分</p>
	                                <span class="personal-star">
                                        <span class="personal-evaluate-star-point-{{intval($comment_about['speed_score'])}}"></span>
	                                 </span>
                                </div>
                                <div class="personal-evaluate-starts-item">
                                    <p>工作质量：{!! $comment_about['quality_score'] !!}分</p>
	                                <span class="personal-star">
                                       <span class="personal-evaluate-star-point-{{intval($comment_about['quality_score'])}}"></span>
	                                </span>
                                </div>
                                <div class="personal-evaluate-starts-item">
                                    <p>工作态度：{!! $comment_about['attitude_score'] !!}分</p>
	                                <span class="personal-star">
	                                    <span class="personal-evaluate-star-point-{{intval($comment_about['attitude_score'])}}"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{--评价按钮--}}
                        @if($is_comment == true)
                            <button class="pull-right btn-edit" data-toggle="modal" data-target="#myModal">发表评论</button>
                        @endif
                    </div>
                    <!-- 商品评价列表 -->
                    <div class="personal-evaluate-list">
                        <div class="text-size14 cor-gray51 clearfix record">
                            <div class="col-xs-12 task-mediaAssessR pd-padding0">
                                <form method="get" action="/shop/buyGoods/{!! $goods_info->id !!}" id="screen_form">
                                    {{--<input type="hidden" name="shop_id" id="shop_id" value="{!! $goods_info->id !!}">--}}
                                    <label class="evaluate-back">
                                        <input name="comment_type" type="radio" class="ace choose screen" checked value="0">
                                        <span class="lbl"> <span class="flower4">好评</span></span>&nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label class="evaluate-back">
                                        <input name="comment_type" type="radio" class="ace choose screen" value="1"
                                                {{ (!empty($_GET['comment_type']) && $_GET['comment_type']==1)?'checked':'' }}>
                                        <span class="lbl"> <span class="flower5">中评</span></span>&nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label>
                                        <input name="comment_type" type="radio" class="ace choose screen" value="2"
                                                {{ (!empty($_GET['comment_type']) && $_GET['comment_type']==2)?'checked':'' }}>
                                        <span class="lbl"> <span class="flower6">差评</span></span>
                                    </label>
                                </form>
                            </div>
                        </div>
                        @if($comment_about['comment_list']->toArray()['data'] > 0)
                        <ul id="comment_list">
                            @foreach($comment_about['comment_list']->toArray()['data'] as $k => $v)
                            <li class="personal-evaluate-list-item">
                                <div class="personal-case-evaluate-words personal-shop-evaluate">
                                	<div class="g-valugood pull-left buygoods-Img-left">
		                                <img class="img-responsive" src="{!! url($v['avatar']) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" alt="...">
		                            </div>
                                    <div class="pull-left personal-shopwrap">
                                        <a class="text-size16" href="">{!! $v['name'] !!}</a>
                                        <p>评价：{!! $v['comment_desc'] !!}</p>
                                    </div>
                                </div>
                                <div class="personal-case-evaluate-person-time pull-right">
                                    <div class="z-hov text-right">
                                        @if($v['type'] == 1)
                                            <i class="evaluate-flowers evaluate-flowersin"></i>
                                            <span class="good-evaluate">中评</span>
                                        @elseif($v['type'] == 2)
                                            <i class="evaluate-flowers evaluate-flowersno"></i>
                                            <span class="good-evaluate">差评</span>
                                        @else
                                            <i class="evaluate-flowers"></i>
                                            <span class="good-evaluate">好评</span>
                                        @endif
                                        {!! round(($v['speed_score']+$v['quality_score']+$v['attitude_score'])/3,1) !!}分
                                        <i class="u-evaico"></i>
                                        <div class="u-recordstar b-border">
                                            <div>
                                                工作速度：
                                                @if($v['speed_score']>0 && $v['speed_score'] <= 1)
                                                    <span class="rec-active"></span>
                                                @elseif($v['speed_score']>1 && $v['speed_score'] <= 2)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @elseif($v['speed_score']>2 && $v['speed_score'] <= 3)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @elseif($v['speed_score']>3 && $v['speed_score'] <= 4)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @elseif($v['speed_score']>4 && $v['speed_score'] <= 5)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @endif
                                                <a class="cor-orange mg-left">{!! $v['speed_score'] !!}分 </a>
                                                - @if($v['speed_score']>0 && $v['speed_score'] <= 1)
                                                    速度很慢
                                                @elseif($v['speed_score']>1 && $v['speed_score'] <= 2)
                                                    速度慢
                                                @elseif($v['speed_score']>2 && $v['speed_score'] <= 3)
                                                    速度一般
                                                @elseif($v['speed_score']>3 && $v['speed_score'] <= 4)
                                                    速度快
                                                @elseif($v['speed_score']>4 && $v['speed_score'] <= 5)
                                                    速度很快
                                                @endif
                                            </div>
                                            <div class="space-8"></div>
                                            <div>
                                                工作质量：
                                                @if($v['quality_score']>0 && $v['quality_score'] <= 1)
                                                    <span class="rec-active"></span>
                                                @elseif($v['quality_score']>1 && $v['quality_score'] <= 2)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @elseif($v['quality_score']>2 && $v['quality_score'] <= 3)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @elseif($v['quality_score']>3 && $v['quality_score'] <= 4)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @elseif($v['quality_score']>4 && $v['quality_score'] <= 5)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @endif
                                                <a class="cor-orange mg-left">{!! $v['quality_score'] !!}分 </a>
                                                - @if($v['quality_score']>0 && $v['quality_score'] <= 1)
                                                    质量很低
                                                @elseif($v['quality_score']>1 && $v['quality_score'] <= 2)
                                                    质量低
                                                @elseif($v['quality_score']>2 && $v['quality_score'] <= 3)
                                                    质量一般
                                                @elseif($v['quality_score']>3 && $v['quality_score'] <= 4)
                                                    质量高
                                                @elseif($v['quality_score']>4 && $v['quality_score'] <= 5)
                                                    质量很高
                                                @endif
                                            </div>
                                            <div class="space-8"></div>
                                            <div>
                                                工作态度：
                                                @if($v['attitude_score']>0 && $v['attitude_score'] <= 1)
                                                    <span class="rec-active"></span>
                                                @elseif($v['attitude_score']>1 && $v['attitude_score'] <= 2)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @elseif($v['attitude_score']>2 && $v['attitude_score'] <= 3)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @elseif($v['attitude_score']>3 && $v['attitude_score'] <= 4)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @elseif($v['attitude_score']>4 && $v['attitude_score'] <= 5)
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                    <span class="rec-active"></span>
                                                @endif
                                                <a class="cor-orange mg-left">{!! $v['attitude_score'] !!}分 </a>
                                                - @if($v['attitude_score']>0 && $v['attitude_score'] <= 1)
                                                    态度很差
                                                @elseif($v['attitude_score']>1 && $v['attitude_score'] <= 2)
                                                    态度差
                                                @elseif($v['attitude_score']>2 && $v['attitude_score'] <= 3)
                                                    态度一般
                                                @elseif($v['attitude_score']>3 && $v['attitude_score'] <= 4)
                                                    态度好
                                                @elseif($v['attitude_score']>4 && $v['attitude_score'] <= 5)
                                                    态度很好
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-8"></div>
                                    <p class="text-right p-space">
                                    	评价于：{!! $v['created_at'] !!}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <!-- 底部分页 -->
                        <div class="space-6"></div>
                        <div class="row personal-evaluate-page">
                            <div class="col-md-12">
                                <div class="dataTables_paginate paging_bootstrap">
                                    <ul class="pagination news-page-list">
                                        {!! $comment_about['comment_list']->appends($merge)->render()!!}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="space-6"></div>
                        @else
                            <div class="g-nomessage">没有评论哦 ！</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--其他商品--}}
    @if(!empty($goods_list))
        <div class="col-sm-12 col-left">
            <div class="shop-wares buygoods-shop">
                <div class="shop-evalhd clearfix">
                    <h4 class="pull-left text-size16 cor-gray45">店铺其他作品</h4>
                    <a href="/shop/work/{!! $goods_info->shop_id !!}" class="pull-right">More></a>
                </div>
                <div class="shop-mainlistwrap">
                    <ul class="row shop-mainlist">
                        @foreach($goods_list as $item)
                        <li class="col-md-3 col-sm-4 col-xs-6">
                            <a href="/shop/buyGoods/{!! $item['id'] !!}">
                                <div class="shop-mainimg shop-mainimg234">
                                    <img src="{!! url($item['cover']) !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                                </div>
                                <div class="shop-maininfo">
                                    <h5 class="text-size14 cor-gray51 p-space">{!! $item['title'] !!}</h5>
                                    <div class="space-6"></div>
                                    <p class="clearfix cor-gray89">
                                        <span class="case-tag pull-left"> <i class="fa fa-tag cor-grayD3 text-size16"></i>&nbsp;&nbsp;{!! $item['name'] !!}</span>
                                        <span class="pull-right cor-orange">￥@if($item['cash']){!! $item['cash'] !!} @else 0 @endif</span>
                                    </p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- 发表评价模态框 -->
<div class="modal fade buygoods-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
    <div class="modal-dialog  add-case-modal" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-size14" id="myModalLabel">发表评价</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="/shop/addGoodsComment" enctype="multipart/form-data" id="commentForm">
                    {{csrf_field()}}
                    <div class="record pd-padding0">
                        <div class="text-size14 cor-gray51 clearfix">
                            <div class="col-xs-12 task-mediaAssessR pd-padding0">
                                <input name="uid" type="hidden" @if(Auth::check())value="{!! Auth::id() !!}"@endif>
                                <input name="goods_id" type="hidden" value="{!! $goods_info->id !!}">
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
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('userCenterCase','css/usercenter/successCase/userCenterCase.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('successstory','css/shop/successstory.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_raty','plugins/jquery/raty/jquery.raty.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('evaluate','js/buygoods.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shopContact','js/doc/shopContact.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ownercomment','js/doc/ownercomment.js') !!}
