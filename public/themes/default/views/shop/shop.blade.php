@if(!empty($carouselPics) || $central_ad || $footer_ad)
    <div class="clearfix">
        @if(!empty($carouselPics))
            <div class="finish-banner">
                <div id="carousel-example-generic" class="carousel slide " data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @foreach($carouselPics as $ck=>$cv)
                            <li data-target="#carousel-example-generic" data-slide-to="{!! $ck !!}" @if($ck == 0) class="active" @else class="" @endif></li>
                        @endforeach
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        @foreach($carouselPics as $pk=>$pv)
                            <div @if($pk == 0) class="item active" @else  class="item" @endif>
                                <img class="img-responsive" src="{!! URL($pv['url']) !!}" alt="...">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if($central_ad)
            <div class="finish-banner2 col-sm-12 col-left">
                <img src="{!! URL($central_ad) !!}" alt="">
            </div>
        @endif
        @if($footer_ad)
            <div class="finish-banner3 col-sm-12 col-left">
                <img src="{!! URL($footer_ad) !!}" alt="">
                <div class="space-10"></div>
            </div>
        @endif
    </div>
@endif

<div class="shop-wrap clearfix">
<div class="col-sm-12 col-left"><div class="shop-main">
    <div class="personal-info">
        @if($shopInfo['shop_bg'])
        <img src="{!! $domain.'/'.$shopInfo['shop_bg'] !!}" name="" class="personal-info-back-pic" id="backgroud-img2" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
        @else
        <img src="{!! Theme::asset()->url('images/shop/bannerbg.jpg') !!}" name="" class="personal-info-back-pic" id="backgroud-img2">
        @endif
        <div class="personal-info-words">
            <img src="{!! $domain.'/'.$shopInfo['shop_pic'] !!}" alt="" class="img-circle personal-info-pic">
                <span class="change-back-img-btn" data-toggle="modal" data-target="#myModal">
                </span>
            <div class="personal-info-block">
                <div class="personal-info-block-name">
                    <h3 class="text-size20 cor-gray51">{!! $shopInfo['shop_name'] !!}</h3>
                        @if($authUser['bank'])
                        <span class="bank-attestation"></span>
                        @else
                        <span class="bank-attestation-no"></span>
                        @endif
                        @if($authUser['realname'])
                        <span class="cd-card-attestation"></span>
                        @else
                        <span class="cd-card-attestation-no"></span>
                        @endif
                        @if(Auth::user()->email_status == 2)
                        <span class="email-attestation"></span>
                        @else
                        <span class="email-attestation-no"></span>
                        @endif
                        @if($authUser['alipay'])
                        <span class="alipay-attestation"></span>
                        @else
                        <span class="alipay-attestation-no"></span>
                        @endif
                        @if($authUser['enterprise'])
                        <span class="firm-attestation"></span>
                        @else
                        <span class="firm-attestation-no"></span>
                        @endif
                    <label class="open-close-space-btn shop-mainlabel">
                        <input name="switch-field-1" autocomplete =off id="gritter-center" class="ace ace-switch" type="checkbox" {!! ($shopInfo['status']==1)?'checked':'' !!} shop_status="{!! $shopInfo['status'] !!}" shop_id="{!! $shopInfo['id'] !!}" {{--onchange="switchStatus($(this))"--}}>
                        <span class="lbl"></span>
                    </label>
                </div>
                <p class="hidden-xs cor-gray51">地&nbsp;&nbsp;&nbsp;址：&nbsp;
                    @if($shopInfo['province_name'] )
                        {!! $shopInfo['province_name'] !!}
                    @endif
                    @if($shopInfo['city_name'])
                        {!! $shopInfo['city_name'] !!}
                    @endif
                </p>
                @if(!empty($shopInfo['tags']))
                <p class="personal-tag hidden-xs cor-gray51">标&nbsp;&nbsp;&nbsp;签：&nbsp;
                    @foreach($shopInfo['tags'] as $tv)
                    <span class="cor-gray87">{!! $tv['tag_name'] !!}</span>
                    @endforeach
                </p>
                @endif
                <p class="cor-gray51">好评率：&nbsp;<span class="cor-orange">@if(!empty($shopInfo)) {!! $shopInfo['percent'] !!} @else 100 @endif %</span>&nbsp;&nbsp;&nbsp;好评数：<span class="cor-orange">@if($shopInfo['good_comment']) {!! $shopInfo['good_comment'] !!} @else 0 @endif</span>&nbsp;&nbsp;&nbsp;累计服务：<span class="cor-orange"> @if($shopInfo['serviceNum']) {!! $shopInfo['serviceNum'] !!} @else 0 @endif </span></p>
                <div class="personal-about cor-gray51 p-space">
                    简&nbsp;&nbsp;&nbsp;介：
                        @if($shopInfo['shop_desc'])
                        {!! $shopInfo['shop_desc'] !!}
                        @else
                        这家伙很懒什么也没留下！
                        @endif
                </div>
                <div class="space-6"></div>
            </div>
        </div>
    </div>
</div></div>
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModalclose" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog  add-case-modal" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                {{--<form action="/shop/ajaxShopPic" method="post" enctype="multipart/form-data" id="uploadpic">--}}
                    <div class="space"></div>
                    <div class="modal-body text-center text-size16 cor-gray51">
                        关闭店铺时商品会一同下架，确定关闭吗？
                        <div class="space"></div>
                        <button type="button" class="btn btn-primary " shop_id="{!! $shopInfo['id'] !!}" shop_status="{!! $shopInfo['status'] !!}" id="changeBackshop" data-dismiss="modal">确定</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                    <div class="space"></div>
                {{--</form>--}}
            </div>

        </div>
    </div>
    <!-- 切换背景模态框 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog  add-case-modal" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">个性化设置</h4>
                </div>
                <form action="/shop/ajaxShopPic" method="post" enctype="multipart/form-data" id="uploadpic">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        @if($shopInfo['shop_bg'])
                        <img src="{!!  $domain.'/'.$shopInfo['shop_bg'] !!}" class="img-responsive" id="backgroud-img"/>
                        @else
                        <img src="{!! Theme::asset()->url('images/shop/bannerbg.jpg') !!}" id="backgroud-img" class="img-responsive">
                        @endif


                        <div class="upload-case-back-btn-tips">
                            <a href="javascript:;" title="" class="upload-case-back-btn" id="addpic">上传图片
                                <input type="file" name="back" id="back">
                                <input type="hidden" name="id" value="{!! $shopInfo['id'] !!}">
                            </a>
                    <span class="upload-case-back-tips">
                        <i class="fa  fa-exclamation-circle"></i>
                        提示 最佳图片尺寸：1200*195像素
                    </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn restore-default-btn" shop_id="{!! $shopInfo['id'] !!}" onclick="delback($(this))">恢复默认</button>
                        <button type="button" class="btn btn-primary " id="changeBack" data-dismiss="modal">确定</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@if($shopInfo['status'] == 1 && !empty($workInfo))
    <div class="col-sm-12 col-left"><div class="shop-wares">
        <div class="shop-evalhd clearfix">
            <h4 class="pull-left text-size20">作品</h4>
            <a href="{!! URL('/shop/work/'.$shopId) !!}" class="pull-right">More></a>
        </div>
        <div class="shop-mainlistwrap">
            <ul class="row shop-mainlist">
                @foreach($workInfo as $wv)
                <li class="col-md-3 col-sm-4 col-xs-6">
                    <div class="shop-mainimg shop-mainimg234"><a href="{!! URL('/shop/buyGoods/'.$wv['id']) !!}"><img src="{!! $domain.'/'.$wv['cover'] !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"> </a> </div>
                    <div class="shop-maininfo">
                        <h5 class="text-size14 cor-gray51 p-space"><a href="{!! URL('/shop/buyGoods/'.$wv['id']) !!}"> {!! $wv['title'] !!} </a> </h5>
                        <div class="space-6"></div>
                        <p class="clearfix cor-gray89">
                            <span class="case-tag pull-left"> <i class="fa fa-tag cor-grayD3 text-size16"></i>&nbsp;&nbsp;{!! $wv['name'] !!}</span>
                            <span class="pull-right cor-orange">￥{!! $wv['cash'] !!}</span>
                        </p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
@elseif(Auth::id() == $shopInfo['uid'] && $shopInfo['status'] == 1)
    <div class="col-sm-12 col-left"><div class="shop-wares">
        <div class="shop-evalhd clearfix">
            <h4 class="pull-left text-size20">作品</h4>
        </div>
        <div class="shop-mainlistwrap">
            <div class="row close-space-tip">
                <div class="col-md-12 text-center">
                    <div class="space"></div>
                    <div class="space"></div>
                    <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                    <div class="space-10"></div>
                    <p class="text-size16 cor-gray87">您暂未添加作品 <a class="text-under" href="{!! URL('/user/pubGoods') !!}" >去添加</a></p>
                    <div class="space-32"></div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endif
@if($shopInfo['status'] == 1 && !empty($goodsInfo))
<div class="col-sm-12 col-left"><div class="shop-service">
    <div class="shop-evalhd clearfix">
        <h4 class="pull-left text-size20">服务</h4>
        <a href="{!! URL('/shop/serviceAll/'.$shopId) !!}" class="pull-right">More></a>
    </div>
    <div class="shop-mainlistwrap">
        <ul class="row shop-mainlist">
            @foreach($goodsInfo as $gv)
            <li class="col-md-3 col-sm-4 col-xs-6">
                <div class="shop-mainimg shop-mainimg234"><a href="{!! URL('/shop/buyservice/'.$gv['id']) !!}"><img src="{!! $domain.'/'.$gv['cover'] !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"> </a> </div>
                <div class="shop-maininfo">
                    <h5 class="text-size14 cor-gray51 p-space"><a href="{!! URL('/shop/buyservice/'.$gv['id']) !!}"> {!! $gv['title'] !!} </a> </h5>
                    <div class="space-6"></div>
                    <p class="clearfix cor-gray89">
                        <span class="case-tag pull-left"> <i class="fa fa-tag cor-grayD3 text-size16"></i>&nbsp;&nbsp;{!! $gv['name'] !!}</span>
                        <span class="pull-right cor-orange">￥{!! $gv['cash'] !!}</span>
                    </p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div></div>
@elseif(Auth::id() == $shopInfo['uid'] && $shopInfo['status'] == 1)
<div class="col-sm-12 col-left"><div class="shop-service">
    <div class="shop-evalhd clearfix">
        <h4 class="pull-left text-size20">服务</h4>
    </div>
    <div class="shop-mainlistwrap">
            <div class="row close-space-tip">
                <div class="col-md-12 text-center">
                    <div class="space"></div>
                    <div class="space"></div>
                    <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                    <div class="space-10"></div>
                    <p class="text-size16 cor-gray87">您暂未添加服务 <a class="text-under" href="{!! URL('/user/serviceCreate') !!}" >去添加</a></p>
                    <div class="space-32"></div>
                </div>
            </div>
    </div>
</div></div>
@endif
<div class="col-sm-12"><div class="shop-casewrap row">
    @if($shopInfo['status'] == 1 && !empty($caseInfo))
    <div class="col-md-12 col-left">
        <div class="shop-case">
            <div class="shop-evalhd clearfix">
                <h4 class="pull-left text-size20">案例</h4>
                <a href="{!! URL('/shop/successStory/'.$shopId) !!}" class="pull-right">More></a>
            </div>
            <div class="shop-mainlistwrap">
                <ul class="row shop-mainlist">
                    @foreach($caseInfo as $cv)
                    <li class="col-md-3 col-sm-4 col-xs-6">
                        <div class="shop-mainimg"><a href="{!! URL('/shop/successDetail/'.$cv['id']) !!}"><img src="{!! $domain.'/'.$cv['pic'] !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"> </a> </div>
                        <div class="shop-maininfo">
                            <h5 class="text-size14 cor-gray51 p-space"><a href="{!! URL('/shop/successDetail/'.$cv['id']) !!}"> {!! $cv['title'] !!} </a> </h5>
                            <p class="clearfix cor-gray89">
                                <span class="case-tag pull-left"> <i class="fa fa-tag cor-grayD3 text-size16"></i>&nbsp;&nbsp;{!! $cv['name'] !!}</span>
                                <span class="pull-right"><i class="fa fa-eye cor-grayD3"></i> @if($cv['view_count']) {!! $cv['view_count'] !!} @else 0 @endif 人浏览</span>
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @elseif(Auth::id() == $shopInfo['uid'] && $shopInfo['status'] == 1)
            <div class="col-md-12 col-left">
                <div class="shop-case">
                    <div class="shop-evalhd clearfix">
                        <h4 class="pull-left text-size20">案例</h4>
                    </div>
                    <div class="shop-mainlistwrap">
                            <div class="row close-space-tip">
                                <div class="col-md-12 text-center">
                                    <div class="space"></div>
                                    <div class="space"></div>
                                    <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                                    <div class="space-10"></div>
                                    <p class="text-size16 cor-gray87">您暂未添加案例 <a class="text-under" href="{!! URL('user/addShopSuccess') !!}" >去添加</a></p>
                                    <div class="space-32"></div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
    @endif
    @if($shopInfo['status'] == 1 && !empty($commentInfo) )
    <div class="col-md-12 col-left">
        <div class="shop-evaluate">
            <div class="shop-evalhd clearfix">
                <h4 class="pull-left text-size20">交易评价</h4>
                <a href="{!! URL('/shop/rated/'.$shopId) !!}" class="pull-right">More></a>
            </div>
            @foreach($commentInfo as $v)
            <div class="clearfix ">
                <div class="col-sm-1 col-xs-2">
                        <div class="row">
                            <div @if($v['type'] == 0) class="g-valugood" @elseif($v['type'] == 1) class="g-valuin" @elseif($v['type'] == 2) class="g-valupoor" @endif>
                                <img class="img-responsive" src="{!! $domain.'/'.$v['avatar'] !!}"  alt="..." onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                                <div class="g-valuimgbg"></div>
                            </div>
                            <div class="space-6"></div>
                            <p class="text-center g-valuin p-space"><a href="javascript:;" class=" cor-blue2f">{!! $v['name'] !!}</a></p>
                        </div>
                </div>
                <div class="col-sm-11 col-xs-10 s-myborder">
                                <div class="clearfix">
                                    <span class=" pull-left text-muted text-size12 cor-gray87 s-myname">@if($v['sort'] == 1) 作品 @elseif($v['sort'] == 2) 服务 @endif ：<a class="cor-blue42" @if($v['sort'] == 1) href="{!! URL('/shop/buyGoods/'.$v['goodId']) !!}" @elseif($v['sort'] == 2) href="{!! URL('/shop/buyservice/'.$v['goodId']) !!}" @endif>  {!! $v['title'] !!} </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;成交价：￥{!! $v['cash'] !!}</span>
                                    <a class="pull-right cor-gray87 text-size12" href="javascript:;">{!! date('Y-m-d',strtotime($v['created_at'])) !!}</a>
                                </div>
                                <div class="space-6"></div>
                                <div class="p-space">
                                    <p class="cor-gray51 text-size14">{!! $v['desc'] !!}</p>
                                </div>
                                <div class="space-2"></div>
                                <div class="clearfix">
                            <span class="cor-gray87 z-hov">
                                本次终合评分：<span class="cor-orange">{!! $v['total_score'] !!} </span><i class="u-evaico"></i>
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
                                            - 速度很快
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
                                            - 质量很快
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
                                            - 态度很好
                                    </div>
                                </div>
                            </span>
                        </div>
                        <div class="g-userborbtm"></div>
                    </div>
            </div>
            <div class="space"></div>
            @endforeach
        </div>
    </div>
    @elseif($shopInfo['status'] == 1 && Auth::id() == $shopInfo['uid'])
            <div class="col-md-12 col-left">
                <div class="shop-evaluate">
                    <div class="shop-evalhd clearfix">
                        <h4 class="pull-left text-size20">交易评价</h4>
                    </div>
                </div>
                <div class="row close-space-tip">
                    <div class="col-md-12 text-center">
                        <div class="space"></div>
                        <div class="space"></div>
                        <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                        <div class="space-10"></div>
                        <p class="text-size16 cor-gray87">暂无评价</p>
                        <div class="space-32"></div>
                    </div>
                </div>
            </div>

    @endif
</div></div>
    {{--<div class="col-sm-12 col-left"><div class="shop-wares">
            <div class="shop-mainlistwrap">
                <div class="row close-space-tip">
                    <div class="col-md-12 text-center">
                        <div class="space"></div>
                        <div class="space"></div>
                        <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                        <div class="space-10"></div>
                        <p class="text-size16 cor-gray87">您的店铺已关闭！</p>
                        <div class="space-32"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shopInfo','js/doc/shopInfo.js') !!}