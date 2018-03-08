<div class="g-main" xmlns="http://www.w3.org/1999/html">
    <h4 class="text-size16 cor-blue u-title">手机绑定</h4>

    <div class="space"></div>
    @if(empty($mobile))
            <!--邮箱绑定-->
    <form method="post" action="{!! url('user/phoneAuth') !!}" class="paypassword-form">
        {!! csrf_field() !!}
        <div class="form-group s-formwrp1 text-size14 cor-gray51 nomrbtm clearfix">
            <label for="inputText"
                   class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1 no-padding-left">手机号：</label>
            <div class="space-2 visible-xs-block"></div>
            <div class="col-sm-8 task-casebghid no-padding-left">
                <input name="mobile" id="form-field-2" placeholder="请输入您的手机号"  nullmsg="请输入您的手机号" ajaxurl="{!! url('checkMobile') !!}" type="text" class="inputxt input-xlarge"  datatype="m" errormsg="手机号格式不对！" value="{{old('mobile')}}">
                <span class="mobile_check Validform_checktip"></span>
            </div>
        </div>

        <div class="space-10 hidden-xs"></div>

        <div class="form-group s-formwrp1 text-size14 cor-gray51 nomrbtm clearfix">
            <label for="inputText"
                   class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1 no-padding-left">&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <div class="space-2 visible-xs-block"></div>
            <div class="col-sm-8 task-casebghid no-padding-left">
               <span class="block input-icon input-icon-right" style="width:100%;">
                    <div id="embed-captcha" data-info="1"></div>
                    <p id="wait" class="show">正在加载验证码......</p>
                    <p id="notice" class="hide">请先完成验证</p>
                </span>
            </div>
        </div>


        <div class="space-10 hidden-xs"></div>
        <div class="form-group s-formwrp1 text-size14 cor-gray51 nomrbtm clearfix">
            <label for="inputText"
                   class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1 no-padding-left">短信验证码：</label>
            <div class="space-2 visible-xs-block"></div>
            <div class="col-sm-8 task-casebghid no-padding-left">
                <input name="code" type="text" placeholder="请输入短信验证码" class="inputxt" nullmsg="请输入验证码" datatype="*" id="form-field-3" value="">&nbsp;
                <input type="button" class="btn btn-white btn-primary c-btntime" token="{{csrf_token()}}" value="获取验证码" id="sendMobileCode" onclick="sendBind()">
                <div class="paypassword-tit no-margin-left Validform_checktip vilid-wrprg col-sm-12 validform-base {{ ($errors->first('code'))?'Validform_wrong':'' }}">{!! $errors->first('code') !!}</div>
            </div>
        </div>
        <div class="space-10 hidden-xs"></div>
        <div class="form-group s-formwrp1 text-size14 cor-gray51  clearfix">
            <label for="inputText" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1"></label>

            <div class="col-sm-5 center768 no-padding-left">
                <button type="submit" class="btn btn-primary btn-big1 btn-blue bor-radius2 btn-imp">下一步</button>
            </div>
        </div>
    </form>
    @else
    <!--成功-->
    <div class="alert alert-block alert-success">
        <i class="fa fa-check green"></i>
        您已经完成了手机绑定！
    </div>
    <div>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您绑定的手机号是：<span class="text-size20 cor-orange">{{$mobile}}</span>&nbsp;&nbsp;&nbsp;<a class="inlineblock" href="{{url('user/unbindMobile')}}">修改手机号</a></p>
    </div>
    <div class="space-10"></div>


    <div class="hr hr-dotted"></div>
    <div>
        <p class="cor-gray51">手机认证成功后，您可以享有以下服务： </p>

        <p class="cor-gray87">· 您可以使用手机号码登录网站</p>
        <p class="cor-gray87">· 绑定手机能够随时获得重要事情提醒。例如支付/提现/选稿/交稿等</p>
        <p class="cor-gray87">· 可以通过手机短信快速找回您的登录密码</p>
    </div>
    @endif
</div>
{!! Theme::widget('avatar')->render() !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-style','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

        <!-- 拖拽验证 -->
{!! Theme::asset()->container('specific-js')->usepath()->add('gt', 'js/user/gt.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('huakuaiyanzheng', 'js/user/huakuaiyanzheng.js') !!}


{!! Theme::asset()->container('custom-js')->usepath()->add('payphoneword','js/doc/payphoneword.js') !!}
