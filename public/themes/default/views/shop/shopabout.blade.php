<div class="col-xs-12">
    <div class="row">
        <div class="needs shop-wrap clearfix">
            <div class="col-lg-3 hidden-xs hidden-md hidden-sm col-left nedds-sidebar-left">
                <div class="needs-sidebar ">
                    <div class="needs-sidebar-wrap">
                        <div class="wrap1">
                            @if($shopInfo['shop_pic'])
                            <img src="{!! $domain.'/'.$shopInfo['shop_pic'] !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" />
                            @else
                            <img src="{!! Theme::asset()->url('images/employ/bg1.jpg') !!}" alt=""/>
                            @endif
                        </div>
                        <div class="wrap2">
                            <p class="tit">{!! $shopInfo['shop_name'] !!}</p>
                            <p class="beyond clearfix beyond-a">
                                <span>认证：</span>
                                @if($authUser['realname'])
                                <a href="" class="ico1 u-ico1"></a>
                                @else
                                <a href="" class="ico1"></a>
                                @endif
                                @if($authUser['bank'])
                                <a href="" class="ico2 u-ico2"></a>
                                @else
                                <a href="" class="ico2"></a>
                                @endif
                                @if($emailStatus == 2)
                                <a href="" class="ico3 u-ico3"></a>
                                @else
                                <a href="" class="ico3"></a>
                                @endif
                                @if($authUser['alipay'])
                                <a href="" class="ico4 u-ico4"></a>
                                @else
                                <a href="" class="ico4 "></a>
                                @endif
                                @if($authUser['enterprise'])
                                    <a href="" class="ico5 u-ico5"></a>
                                @else
                                    <a href="" class="ico5 "></a>
                                @endif
                            </p>
                            <p class="beyond">
                                <span>地址：</span>
                                @if($shopInfo['province_name'])
                                    {!! $shopInfo['province_name'] !!}
                                @endif
                                @if($shopInfo['city_name'])
                                    {!! $shopInfo['city_name'] !!}
                                @endif
                            </p>
                            @if(!empty($shopInfo['tags']))
                            <p class="beyond beyond-s">-
                                <span>标签：</span>
                                @foreach($shopInfo['tags'] as $tv)
                                <a href="">{!! $tv['tag_name'] !!}</a>
                                @endforeach
                            </p>
                            @endif
                        </div>
                        <div class="wrap3">
                            <ul class="list-inline">
                                <li>
                                    <p class="text-center">好评数</p>
                                    <div class="text-center text-color text-size14">@if($shopInfo['good_comment']) {!! $shopInfo['good_comment'] !!} @else 0 @endif</div>
                                </li>
                                <li>
                                    <p class="text-center">综合评分</p>
                                    <div class="text-center text-color text-size14">@if($shopInfo['total_comment']) {!! $shopInfo['total_comment'] !!} @else 0 @endif</div>
                                </li>
                                <li>
                                    <p class="text-center">
                                        累计雇佣
                                    </p>
                                    <div class="text-center text-color text-size14">{!! $shopInfo['serviceNum'] !!}</div>
                                </li>
                            </ul>
                        </div>
                        <div class="wrap4" >
                            @if(Auth::check())
                                @if(Auth::id() != $shopInfo['uid'] && Theme::get('is_IM_open') == 2)
                                <a href="javascript:;" data-toggle="modal" data-target="#myModalshop" class="ico1"><i></i>联系我</a>
                                @elseif(Auth::id() != $shopInfo['uid'] && Theme::get('is_IM_open') == 1)
                                <a href="javascript:;" class="ico1 shop-im" data-values="{{ $shopInfo['uid'] }}">
                                    <i></i>联系我
                                </a>
                                @endif
                            @else
                            <a href="{!! URL('/login') !!}"  class="ico1"><i></i>联系我</a>
                            @endif
                            @if(Auth::check())
                                @if(empty($isFocus) && $shopInfo['uid'] != Auth::id())
                                <a href="" class="ico2" id="shop_id" shop_id="{!! $shopId !!}"><i></i>收藏店铺</a>
                                @elseif($shopInfo['uid'] != Auth::id())
                                <span href="" class="shop-collectatv">已收藏</span>
                                @endif
                            @else
                            <a href="{!! URL('/login') !!}" class="ico2"><i></i>收藏店铺</a>
                            @endif
                        </div>
                        @if(Auth::check() && Auth::id() != $shopInfo['uid'])
                        <a class="g-shopabbtn bg-blue" href="{!! URL('/employ/create/'.$shopInfo['uid']) !!}">立即雇佣</a>
                        @elseif(!Auth::check())
                        <a class="g-shopabbtn bg-blue" href="{!! URL('/login') !!}">立即雇佣</a>
                        @endif
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
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 col-left">
                <div class="g-shopabmain  needs-rights">
                    @if(Auth::check() && Auth::id() != $shopInfo['uid'])
                    <a class="shop-btbtnbg hidden-lg" href="{!! URL('/employ/create/'.$shopInfo['uid']) !!}"><i class="shop-gybtnico"></i>立即雇佣</a>
                    @elseif(!Auth::check())
                        <a class="shop-btbtnbg hidden-lg" href="{!! URL('/login') !!}"><i class="shop-gybtnico"></i>立即雇佣</a>
                    @endif
                    <div class="g-shopabhd">关于我们</div>
                    <div class="g-shopabinfo">
                        {!! $shopInfo['shop_desc'] !!}
                    </div>
                    <div class="g-shopabcontact">
                        <p class="g-shopabnum">联系方式：&nbsp;
                            @if($contactInfo['mobile_status'])
                            <span class="g-shopabnumph text-size12">{!! $contactInfo['mobile'] !!}</span>
                            @endif
                            @if($contactInfo['qq_status'])
                            <span class="g-shopabnumqq text-size12">{!! $contactInfo['qq'] !!}</span>
                            @endif
                            @if($contactInfo['wechat_status'])
                            <span class="g-shopabnumwx text-size12">{!! $contactInfo['wechat'] !!}</span>
                            @endif
                        </p>
                        @if($shopInfo['tags'])
                        <p class="g-shopablabel">店铺标签：&nbsp;
                            @foreach($shopInfo['tags'] as $tv)
                            <span>{!! $tv['tag_name'] !!}</span>
                            @endforeach
                        </p>
                        @endif
                        <div class="g-shopabicoli">
                            认证状况：
                            <ul class="clearfix">
                                @if($authUser['bank'])
                                <li><img src="/themes/default/assets/images/shop/shopbank.png" alt=""><p>银行卡认证</p></li>
                                @endif
                                @if($authUser['alipay'])
                                <li><img src="/themes/default/assets/images/shop/shopali.png" alt=""><p>支付宝认证</p></li>
                                @endif
                                @if($authUser['realname'])
                                <li><img src="/themes/default/assets/images/shop/shopreal.png" alt=""><p>实名认证</p></li>
                                @endif
                                @if($emailStatus == 2)
                                <li><img src="/themes/default/assets/images/shop/shopemail.png" alt=""><p>邮箱认证</p></li>
                                @endif
                                @if($authUser['enterprise'])
                                <li><img src="/themes/default/assets/images/shop/shopcompany.png" alt=""><p>企业认证</p></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shopContact','js/doc/shopContact.js') !!}






