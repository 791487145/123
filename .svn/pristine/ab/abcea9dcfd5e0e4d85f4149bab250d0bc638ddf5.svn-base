<div class="g-main" xmlns="http://www.w3.org/1999/html">
    <h4 class="text-size16 cor-blue u-title">邮箱绑定</h4>

    <div class="space"></div>
    @if($step == 1)
            <!--邮箱绑定-->
    <form method="get" action="{!! url('user/sendEmailAuth') !!}">
        {!! csrf_field() !!}
        <div class="form-group s-formwrp1 text-size14 cor-gray51 nomrbtm clearfix">
            <label for="inputText"
                   class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">邮箱地址：</label>
            <div class="space-2 visible-xs-block"></div>
            <div class="col-sm-8">
                <input name="email" type="text" class="inputxt input-xlarge" @if(!empty($email))readonly="readonly"@endif datatype="e" id="inputText" value="@if(old('email')){!! old('email') !!}@else{!! $email !!}@endif">
                <span class="Validform_checktip Validform_wrong">{!! $errors->first('email') !!}</span>
            </div>
        </div>
        <div class="space-10 hidden-xs"></div>
        <div class="form-group s-formwrp1 text-size14 cor-gray51  clearfix">
            <label for="inputText" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1"></label>

            <div class="col-sm-5 center768">
                <button type="submit" class="btn btn-primary btn-big1 btn-blue bor-radius2 btn-imp">下一步</button>
            </div>
        </div>
    </form>
    <div class="hr hr-dotted"></div>
    <div>
        <p class="cor-gray51">邮箱绑定成功后，您可以享有以下服务： </p>

        <p class="cor-gray87">· 找回密码 ，忘记密码时，可以使用邮件找回</p>
    </div>
    @elseif($step == 2)
    <!--邮箱绑定下一步-->
    <div class="cor-gray51 text-size14">
    <p>您的邮箱将收到一封确认邮件，请查收。点击邮件中的确认链接即可完成邮箱绑定。</p>
    <div class="space-10"></div>
    <a href="javascript:viewMail('{!! $emailType !!}');void(0);" class="btn btn-primary btn-sm btn-big1 btn-blue text-size14 bor-radius2">立即查收邮件</a>
    </div>
    <div class="hr hr-dotted"></div>
    <div>
        <input type="hidden" id="reEmail" value="{{$email}}">
    <p class="cor-gray51">未收到邮件？</p>
    <p class="cor-gray87">· 试试检查垃圾邮件、订阅邮件目录</p>
    <p class="cor-gray87">· 若长时间未收到邮件，可<a href="javascript:void(0)" id="reset" class="cor-blue167">重新发送</a></p>
    <input type="hidden" id="reEmail" value="{{$email}}">
    </div>
    @elseif($step == 3)
    <!--成功-->
    <div class="alert alert-block alert-success">
        <i class="fa fa-check green"></i>
        您已经完成了邮箱绑定！
    </div>
    <div>
        <p>您绑定的邮箱是：<span class="text-size20 cor-orange">{!! $email !!}</span></p>
    </div>
    <div class="space-20"></div>
    <div class="hr hr-dotted"></div>
    <div>
        <p class="cor-gray51">您可以享有以下服务：</p>

        <p class="cor-gray87">· 找回密码 ，忘记密码时，可以使用邮件找回</p>
    </div>
    @endif
</div>
{!! Theme::widget('avatar')->render() !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('active-js', 'js/active.js') !!}
