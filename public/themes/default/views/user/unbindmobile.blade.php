<div class="g-main" xmlns="http://www.w3.org/1999/html">
    <h4 class="text-size16 cor-blue u-title">手机绑定</h4>

    <div class="space"></div>
            <!--邮箱绑定-->
    <form method="post" action="{!! url('user/unbindMobile') !!}" class="paypassword-form">
        {!! csrf_field() !!}

        <!--修改手机号-->
        <p class="text-size14 cor-gray8f">修改前需要先解绑您原先的手机号</p>
        <div class="space-8"></div>
        <div class="form-group s-formwrp1 text-size14 cor-gray51 nomrbtm clearfix">
            <label for="inputText"
                   class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1 no-padding-left">原手机号：</label>
            <div class="space-2 visible-xs-block"></div>
            <div class="col-sm-8 task-casebghid no-padding-left">
                <input name="mobile" readonly="readonly" id="form-field-2" placeholder="请输入您的手机号" nullmsg="请输入您的手机号" token="{{ csrf_token() }}" type="text" class="inputxt input-xlarge"  datatype="m" errormsg="手机号格式不对！" value="{{$mobile}}">
                <span class="Validform_checktip"></span>
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
                <input type="button" class="btn btn-white btn-primary c-btntime" token="{{csrf_token()}}" value="获取验证码" id="sendMobileCode" onclick="sendunbind()">
                <div class="paypassword-tit no-margin-left mobile_check Validform_checktip vilid-wrprg col-sm-12 validform-base {{ ($errors->first('code'))?'Validform_wrong':'' }}">{!! $errors->first('code') !!}</div>
            </div>
        </div>
        <div class="space-10 hidden-xs"></div>
        <div class="form-group s-formwrp1 text-size14 cor-gray51  clearfix">
            <label for="inputText" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1"></label>

            <div class="col-sm-5 center768 no-padding-left">
                <button type="submit" class="btn btn-primary btn-big1 btn-blue bor-radius2 btn-imp">解绑</button>
            </div>
        </div>
    </form>
</div>
{!! Theme::widget('avatar')->render() !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-style','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}

        <!-- 拖拽验证 -->
{!! Theme::asset()->container('specific-js')->usepath()->add('gt', 'js/user/gt.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('huakuaiyanzheng', 'js/user/huakuaiyanzheng.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('payphoneword','js/doc/payphoneword.js') !!}
