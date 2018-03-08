<div class="col-xs-12 col-left">
        <div class="taskDetails alert taskbg clearfix">
            <div class="page-header">
                <h4 class="text-size22 cor-gray51"><strong>您的订单提交成功，请尽快支付！</strong></h4>
            </div>
            <div class="cor-gray51 text-size14">
                <div class="space"></div>
                <p>支付金额：<span class="text-size26 cor-orange text-blod">￥{{ sprintf(" %1\$.2f",($service_money)) }}</span></p>
                <div class="space"></div>
                <p>请选择支付方式</p>
            </div>
            <div class="space"></div>
            <div class="tabbable">
                <ul id="myTab4" class="nav nav-tabs">
                    <li class="active f-trubtn pay-cancel">
                        <a href="#home1" data-toggle="tab" class="trusttab">余额支付</a>
                    </li>
                    <li class="f-trubtn pay-cancel">
                        <a href="#home2" data-toggle="tab" class="trusttab tab-itm">第三方支付</a>
                    </li>
                </ul>
                <div class="tab-content clearfix f-tab">
                    <!--余额支付-->
                    <div class="tab-pane in active clearfix text-size14 cor-gray51 u-pay" id="home1">
                        @if($balance_pay)
                            <form class="form-horizontal" role="form" action="/task/buyServiceTaskBid" method="post"  name="bounty-form">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $id }}" />
                                <input type="hidden" name="pay_canel" id="pay-canel" value=0 />
                                <span class="help-block cor-gray51">您的账户可用余额：<span class="cor-orange">￥{{ $user_money }}</span></span>
                                <label class="">请输入支付密码：</label>
                                <input type="password" placeholder=""  name="password"  class="inputxt" datatype="*6-15" errormsg="密码范围在6~15位之间！">　　
                                <label><a target="_blank" href="/user/payPassword" class="cor-gray89 text-size12">忘记密码？</a></label>
                                {!! $errors->first('password') !!}
                                <div class="space"></div>
                                <div class="text-center clearfix">
                                    <button class="btn btn-primary btn-blue btn-big1 bor-radius2" >确认支付</button>
                                    <a href="/task/release/{{ $id }}" class="cor-gray93 btn-big">返回</a>
                                </div>
                            </form>
                            @else
                                    <!--余额不足状态-->
                            <div class="text-size14 cor-gray51">
                                <p>您的账户可用余额：<span>￥{{ $user_money }}</span></p>
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="icon-remove"></i>
                                </button>
                                您的余额不足，请选择其他支付方式或是去　<a href="/finance/cash" class="btn btn-sm btn-orange34 bor-radius2">充值</a>　<a href="/task/release/{{ $id }}" class="cor-gray93 btn-big1">返回</a>
                                <br>
                            </div>
                        @endif
                    </div>

                    <!--第三方支付-->
                    <div class="tab-pane clearfix" id="home2">
                        <form class="form-horizontal" role="form" action="/task/buyServiceTaskBid" method="post"  name="bounty-form" target="_blank">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $id }}" />
                            <input type="hidden" name="pay_canel" id="pay-canel" value=1 />
                        <div class="space"></div>
                        <div class="radio clearfix">
                            @if($payConfig['alipay']['status'])
                            <label class="clearfix inline check-boxItm">
                                <input type="radio" name="pay_type" value=1 class="ace"/>
                                <span class="lbl lbl-active">
                                    <span  class="lbl-bank">
                                        <div class="s-packbor s-bank1">
                                            <img src="{!! Theme::asset()->url('images/trust-ico1.png') !!}" alt="">
                                        </div>
                                    </span>
                                </span>
                            </label>
                            @endif
                            @if($payConfig['wechatpay']['status'])
                            <label class="clearfix inline check-boxItm">
                                <input type="radio" name="pay_type" value=2 class="ace" />
                                <span class="lbl">
                                    <span  class="lbl-bank lbl-bank-weixinlogo">
                                        <div class="s-bank2 s-packbor">
                                            <img src="{!! Theme::asset()->url('images/trust-ico2.png') !!}" alt="">
                                        </div>
                                    </span>
                                </span>
                            </label>
                            @endif
                            {{--@if($payConfig['unionpay']['status'])
                            <div class="space-8 visible-sm-block"></div>
                            <label class="clearfix inline check-boxItm">
                                <input type="radio" name="pay_type" value=3 class="ace"/>
                                <span class="lbl ">
                                    <span  class="lbl-bank lbl-bank-yllogo">
                                        <div class="s-bank3 s-packbor">
                                            <img src="{!! Theme::asset()->url('images/trust-ico3.png') !!}" alt="">
                                        </div>
                                    </span>
                                </span>
                            </label>
                            @endif--}}
                        </div>
                        <div class="space"></div>

                        <div class="text-center clearfix">
                            <button class="btn btn-primary btn-blue btn-big1 bor-radius2" data-toggle="modal" data-target="#myModal">确认支付</button>
                            <a href="/task/release/{{ $id }}" class="cor-gray93 btn-big">返回</a>
                        </div>
                        <div class="space"></div>
                        </form>
                    </div>
                </div>
            </div>
            {{--模态框--}}
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header widget-header-flat">
                    <span class="modal-title text-size14">
                        支付提示
                    </span>
                        </div>
                        <div class="modal-body text-center clearfix">
                            <div class="col-sm-3 hidden-xs">
                                <div class="row text-right">
                                    <div class="space"></div>
                                    <span class="fa-stack cor-orange"><i class="fa fa-exclamation-circle fa-stack-2x"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-8 hidden-xs">
                                <div class="cor-gray51 text-left">
                                    <div class="space"></div>
                                    <h3 class="mg-margin text-size20 text-blod">请在打开的页面上完成付款！</h3>
                                    <h6 class="cor-gray97">付款完成前请不要关闭此窗口</h6>
                                    <div class="space"></div>
                                    <p>
                                        <a href="/task/{{ $id }}" type="button" class="btn btn-primary btn-sm btn-blue btn-big1 bor-radius2" >已完成付款</a>&nbsp;
                                        <a href="/user/unreleasedTasks" class="cor-blue167 text-under">支付遇到问题</a>
                                    </p>
                                    <p><a href="/task/bounty/{{ $id }}" class="cor-blue167 text-under">返回选择其他支付方式></a></p>
                                </div>
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm visible-xs-12">
                                <div class="row text-center">
                                    <div class="space"></div>
                                    <span class="fa-stack cor-orange"><i class="fa fa-exclamation-circle fa-stack-2x"></i></span>
                                </div>
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm visible-xs-12">
                                <div class="cor-gray51 text-center">
                                    <div class="space"></div>
                                    <h3 class="mg-margin text-size20 text-blod">请在打开的页面上完成付款！</h3>
                                    <h6 class="cor-gray97">付款完成前请不要关闭此窗口</h6>
                                    <div class="space"></div>
                                    <p>
                                        <a href="/task/{{ $id }}" type="button" class="btn btn-primary btn-sm btn-blue btn-big1 bor-radius2" >已完成付款</a>&nbsp;
                                        <a href="/user/unreleasedTasks" class="cor-gray97 modaltxt">支付遇到问题</a>
                                    </p>
                                    <p><a href="/task/bounty/{{ $id }}" class="cor-blue167" data-dismiss="modal">返回选择其他支付方式></a></p>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>
        </div>
    </form>
</div>
{!! Theme::widget('popup')->render() !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('bounty-js','js/doc/bounty.js') !!}
