<div class="g-main clearfix">
    <h4 class="text-size16 cor-blue u-title">修改密码</h4>
    <div class="space-16"></div>
    <div class="text-size14 cor-orange alertpdl">
        <i class="fa fa-exclamation-circle cor-orange text-size18"></i> 为了您的权益与安全，请不要将登录密码透露给他人，并且牢记您的新密码。
    </div>
    <div class="space-16"></div>
    <div class="col-xs-12">
        <form  class="registerform form-horizontal row" action="{{ URL('user/passwordUpdate') }}" method="post" role="form">
            {!! csrf_field() !!}
            <div class="form-group nomarb">
                <label class="col-lg-2 col-sm-2 control-label no-padding-right s-safetywrp1" for="form-field-1"> 当前密码&nbsp;&nbsp;</label>

                <div class="col-lg-5 col-sm-9 task-casebghid">
                    <span><input type="password" name="oldpassword" id="form-field-1"  placeholder="当前密码" class="col-xs-12 col-sm-12 inputxt" datatype="*6-16" nullmsg="请输入6-16个字符，支持英文、数字！" errormsg="请输入6-12个字符，支持英文、数字"></span>
                    <span><span class="Validform_checktip col-sm-12 vilidform-wrp1"></span></span>
                </div>

            </div>

            <div class="hr hr-dotted hr18 nomart"></div>

            <div class="form-group nomarb">
                <label class="col-lg-2 col-sm-2 control-label no-padding-right s-safetywrp1" for="form-field-2"> 设置新密码&nbsp;&nbsp;</label>

                <div class="col-lg-5 col-sm-9 col-xs-12 task-casebghid">
                    <span><input type="password" name="password" id="form-field-2" placeholder="设置新密码" class="col-xs-12 col-sm-12 inputxt valishow" plugin="passwordStrength"  nullmsg="设置新密码" datatype="*6-12" errormsg="请输入6-12个字符，支持英文、数字"></span>
                    <span><span class="Validform_checktip col-sm-12 vilidform-wrp1"></span></span>
                </div>
                <div class="col-lg-5 col-xs-12">
                    <div class="row">
                        <div class="passwordStrength col-sm-offset-2 col-lg-offset-0 col-xs-12 col-sm-12 vilidform-passwordlength hidden-480">安全等级： <span>低</span><span>中</span><span class="last">高</span></div>
                    </div>
                </div>
            </div>

            <div class="hr hr-dotted hr18 nomart"></div>

            <div class="form-group nomarb">
                <label class="col-sm-2 control-label no-padding-right s-safetywrp1" for="form-field-3"> 确认新密码&nbsp;&nbsp;</label>

                <div class="col-sm-5 task-casebghid">
                    <span><input type="password" name="confirmPassword"  id="form-field-3" placeholder="确认新密码" name="" class="col-xs-12 col-sm-12 inputxt valihide" recheck="password"  nullmsg="请再次输入密码" datatype="*6-18" errormsg="两次输入的密码不一致！"></span>
                    <span class="valihs"><span class="Validform_checktip col-sm-12 vilidform-wrp1"></span></span>
                </div>
            </div>

            <div class="space-20"></div>

            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right s-safetywrp1" for="form-field-2"> </label>

                <div class="col-sm-10 center768">
                    <button class="btn btn-primary btn-big btn-blue bor-radius2 btn-sm btn-imp" type="submit">确定</button>
                </div>
            </div>
        </form>
    </div>
    <div class="space-20"></div>
</div>
{!! Theme::asset()->container('specific-css')->usepath()->add('detail','css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('safety','css/usercenter/safety/safety-layout.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-style','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('passwordStrength','plugins/jquery/validform/plugins/passwordStrength/passwordStrength-min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('userpassword','js/doc/userpassword.js') !!}
{!! Theme::widget('popup')->render() !!}
{!! Theme::widget('avatar')->render() !!}

