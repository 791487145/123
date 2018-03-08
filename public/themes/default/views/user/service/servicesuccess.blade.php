
<div class="taskDetails taskbg clearfix employ-bounty g-getpay">
    <div class="g-signmain clearfix">
        <div class="space-32"></div>
        <div class="space-32"></div>
        <div class="space-32"></div>
        <div class="space-32"></div>
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
                                <p class="cor-gray51 text-size14">如果服务长时间未通过审核，请立即<a class="text-under" href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes">联系管理员</a></p>
                                <p class="cor-gray51 text-size14"><a class="text-under" href="/user/serviceCreate">继续发布服务</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="text-under" href="/shop/buyservice/{!! $id !!}">查看</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div><!-- /widget-main -->
</div>

{{--订单css--}}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('recharge-css','css/usercenter/finance/finance-recharge.css') !!}

