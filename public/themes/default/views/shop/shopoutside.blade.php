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
                    @if((Auth::check() && Auth::id() != $shopInfo['uid']) || !Auth::check()))
                    <a @if(Auth::check()) href="{!! URL('/employ/create/'.$shopInfo['uid']) !!}" @else href="{!! URL('/login') !!}" @endif class="shop-gybtn bg-blue"><i class="shop-gybtnico"></i>立即雇佣</a>
                    @endif
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
                            @if($emailStatus == 2)
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

                        </div>
                        <p class="hidden-xs cor-gray51">地&nbsp;&nbsp;&nbsp;址：&nbsp;
                            @if($shopInfo['province_name'])
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
                        <div class="clearfix">
                            @if(Auth::check())
                                @if(Auth::id() != $shopInfo['uid'] && Theme::get('is_IM_open') == 2)
                                <a class="shop-callme" data-toggle="modal" data-target="#myModalshop" href="javascript:;">联系我</a>
                                @elseif(Auth::id() != $shopInfo['uid'] && Theme::get('is_IM_open') == 1)
                                <a class="shop-callme shop-im"  href="javascript:;" data-values="{{ $shopInfo['uid'] }}">联系我</a>
                                @endif
                            @else
                            <a class="shop-callme" href="{!! URL('/login') !!}">联系我</a>
                            @endif
                            @if(Auth::check())
                                @if(empty($isFocus) && $shopInfo['uid'] != Auth::id())
                                <a class="shop-collect" href="" id="shop_id" shop_id="{!! $shopId !!}">收藏店铺</a>
                                @elseif($shopInfo['uid'] != Auth::id())
                                <span href="" class="shop-collectatv">已收藏</span>
                                @endif
                            @else
                                <a class="shop-collect" href="{!! URL('/login') !!}" >收藏店铺</a>
                            @endif
                        </div>

                        <div class="bdsharebuttonbox" data-tag="share_1">
                            <span class="pull-left cor-gray51">分享：&nbsp;</span>
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
                            <!-- JiaThis Button END -->
                        </div>
                    </div>
                </div>
            </div>
        </div></div>
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModalshop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog  contact-me-modal" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-size14 shop-modal-title" id="myModalLabel"><b>联系我</b></h4>
                </div>
                    <div class="modal-body shop-modal-shopbody">
                        <input type="hidden" name="js_id" class="js_id" id="contactMeId" value="{!! $shopInfo['uid'] !!}">
                        <textarea name="content" id="content" class="shop-modalarea"></textarea>
                        <div class="space-6"></div>
                        <div class="text-right"><button class="btn btn-primary btn-blue shop-modalbtn" id="contactMe">发送</button></div>
                    </div>
                <div class="modal-shopfooter g-shopabnum">
                    其他联系方式&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @if($contactInfo['mobile_status'])
                    <span class="g-shopabnumph text-size12">{!! $contactInfo['mobile'] !!}</span>
                    @endif
                    @if($contactInfo['qq_status'])
                    <span class="g-shopabnumqq text-size12">{!! $contactInfo['qq'] !!}</span>
                    @endif
                    @if($contactInfo['wechat_status'])
                    <span class="g-shopabnumwx text-size12">{!! $contactInfo['wechat'] !!}</span>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- 模态框（Modal）end -->
    @if(!empty($workInfo))
        <div class="col-sm-12 col-left"><div class="shop-wares">
                <div class="shop-evalhd clearfix">
                    <h4 class="pull-left text-size20">作品</h4>
                    <a href="{!! URL('/shop/work/'.$shopId) !!}" class="pull-right">More></a>
                </div>
                <div class="shop-mainlistwrap">
                    <ul class="row shop-mainlist">
                        @foreach($workInfo as $wv)
                            <li class="col-md-3 col-sm-4 col-xs-6">
                                <div class="shop-mainimg shop-mainimg234"><a href="{!! URL('/shop/buyGoods/'.$wv['id']) !!}"> <img src="{!! $domain.'/'.$wv['cover'] !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"> </a> </div>
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
    @endif
    @if(!empty($goodsInfo))
        <div class="col-sm-12 col-left"><div class="shop-service">
                <div class="shop-evalhd clearfix">
                    <h4 class="pull-left text-size20">服务</h4>
                    <a href="{!! URL('/shop/serviceAll/'.$shopId) !!}" class="pull-right">More></a>
                </div>
                <div class="shop-mainlistwrap">
                    <ul class="row shop-mainlist">
                        @foreach($goodsInfo as $gv)
                            <li class="col-md-3 col-sm-4 col-xs-6">
                                <div class="shop-mainimg shop-mainimg234"><a href="{!! URL('/shop/buyservice/'.$gv['id']) !!}"> <img src="{!! $domain.'/'.$gv['cover'] !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"
                                        > </a> </div>
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
    @endif
    <div class="col-sm-12"><div class="shop-casewrap row">
            @if(!empty($caseInfo))
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
            @endif
            @if(!empty($commentInfo) )
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
                                            <img class="img-responsive" src="{!! $domain.'/'.$v['avatar'] !!}"  onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" alt="...">
                                            <div class="g-valuimgbg"></div>
                                        </div>
                                        <div class="space-6"></div>
                                        <p class="text-center g-valuin p-space"><a href="javascript:;" class=" cor-blue2f">{!! $v['name'] !!}</a></p>
                                    </div>
                                </div>
                                <div class="col-sm-11 col-xs-10 s-myborder">
                                    <div class="clearfix">
                                        <span class=" pull-left text-muted text-size12 cor-gray87 s-myname">@if($v['sort'] == 1) 作品 @elseif($v['sort'] == 2) 服务 @endif ：<a class="cor-blue42" @if($v['sort'] == 1) href="{!! URL('/shop/buyGoods/'.$v['goodId']) !!}" @elseif($v['sort']) href="{!! URL('/shop/buyservice/'.$v['goodId']) !!}" @endif>  {!! $v['title'] !!} </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;成交价：￥{!! $v['cash'] !!}</span>
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
            @endif
        </div></div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shopContact','js/doc/shopContact.js') !!}