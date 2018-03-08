
    <div class="taskDetails taskbg clearfix employ-bounty g-getpay">
        <div class="g-signmain clearfix">
            <div class="space-32"></div>
            <div class="space-32"></div>
            <div class="space-32"></div>
            <div class="space-32"></div>
            @if(!empty($goods_info) && $goods_info->status == 0)
                @if(!empty($order_info) && $order_info->status == 1)
                {{--付款成功--}}
                <div class="widget-main loginmain">
                    <div class="step-content row-fluid position-relative" id="step-container">
                        <div class=" findmain g-findmain">
                            <div class="clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-3 text-right u-activasuccess hidden-xs">
                                    <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="">
                                </div>
                                <div class="hidden-lg hidden-md hidden-sm  text-center u-activasuccess">
                                    <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="">
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-9 text-left u-activasuccess">
                                    <p class="text-size24">恭喜您付款成功，请耐心等待后台审核！</p>
                                    <p class="cor-gray51 text-size14">如果作品长时间未通过审核，请立即<a class="text-under" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes">联系管理员</a></p>
                                    <p class="cor-gray51 text-size14"><a class="text-under" href="/user/pubGoods">继续发布作品</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="text-under" href="/user/goodsShop">查看作品</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(!empty($order_info) && $order_info->status == 0)
                {{--付款失败--}}
                <div class="widget-main loginmain">
                    <div class="step-content row-fluid position-relative" id="step-container">
                        <div class=" findmain g-findmain">
                            <div class="clearfix">
                                <div class="col-lg-5 col-md-4 col-sm-3 text-right u-activasuccess">
                                    <img src="{!! Theme::asset()->url('images/sign-icon3.png') !!}" alt="">
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-9 text-left u-activasuccess">
                                    <p class="text-size24">很遗憾，您的付款失败！</p>
                                    <p class="cor-gray51 text-size14">请立即<a class="text-under" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes">联系管理员</a></p>
                                    <p class="cor-gray51 text-size14"><a class="text-under" href="/finance/getpay/{!! $id !!}">重新付款</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="text-under" href="/user/pubGoods">重新发布作品</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="widget-main loginmain">
                    <div class="step-content row-fluid position-relative" id="step-container">
                        <div class=" findmain g-findmain">
                            <div class="clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-3 text-right u-activasuccess hidden-xs">
                                    <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="">
                                </div>
                                <div class="hidden-lg hidden-md hidden-sm  text-center u-activasuccess">
                                    <img src="{!! Theme::asset()->url('images/sign-icon1.png') !!}" alt="">
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-9 text-left u-activasuccess">
                                    <p class="text-size24">请耐心等待后台审核！</p>
                                    <p class="cor-gray51 text-size14">如果作品长时间未通过审核，请立即<a class="text-under" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes">联系管理员</a></p>
                                    <p class="cor-gray51 text-size14"><a class="text-under" href="/user/pubGoods">继续发布作品</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="text-under" href="/user/goodsShop">查看作品</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @elseif(!empty($goods_info) && $goods_info->status == 3)
            {{--商品未通过审核--}}
            <div class="widget-main loginmain">
                <div class="step-content row-fluid position-relative" id="step-container">
                    <div class=" findmain g-findmain">
                        <div class="clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-3 text-right u-activasuccess">
                                <img src="{!! Theme::asset()->url('images/sign-icon3.png') !!}" alt="">
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-9 text-left u-activasuccess">
                                <p class="text-size24">很遗憾，您的作品未通过审核！</p>
                                <p class="cor-gray51 text-size14">请立即<a class="text-under" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes">联系管理员</a> 或
                                    <a class="text-under" href="/user/pubGoods">重新发布作品</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div><!-- /widget-main -->
    </div>

{{--订单css--}}
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('recharge-css','css/usercenter/finance/finance-recharge.css') !!}

