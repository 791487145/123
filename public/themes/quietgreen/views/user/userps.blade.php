
<div class="focusmain cpr">
    <div class="widget-box cmt">
    <div class="widget-header widget-header-flat"><h4 class="focustitle">修改密码</h4></div>
    <div class="amendhint h5 text-orange"><p><i class="fa fa-info-circle"></i> 为了您的权益与安全，请不要将登录密码透露给他人，并且牢记您的新密码</p></div>
    <div class="form-group form-horizontal">
        <form class="form-horizontal" action="{{ URL('user/payPasswordUpdate') }}" method="post">
            {!! csrf_field() !!}
            <div class="form-group text-gray ">
                <label for="inputText" class="col-sm-2 control-label">当前密码：</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="newpass" name="oldpassword" placeholder="请输入当前密码">
                </div>
                <label for="inputPassword3" class="pull-left control-label"><i class="fa fa-info-circle text-orange"></i> {!! empty($errors->first('oldpassword'))?'请输入6-12个字符，支持英文、数字':'' !!}</label>
            </div>
            <div class="form-group text-gray ">
                <label for="inputPassword3" class="col-sm-2 control-label" >设置新密码：</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="newpass" onkeyup="passwordStrong(this)" onblur="passwordStrong(this)" name="password" placeholder="设置新密码">
                </div>
                <label for="inputPassword3" class="pull-left control-label"> 安全等级</label>
                <div class="col-sm-3 control-label">
                    <div class="progress">
                        <div class="progress-bar " id="password-low" style="width: 33.3%">低</div>
                        <div class="progress-bar " id="password-middle" style="width: 33.3%">中</div>
                        <div class="progress-bar " id="password-high" style="width: 33.3%">高</div>
                    </div>
                </div>
                <label for="inputPassword3" class="pull-left control-label" id="password-strong"></label>
            </div>
            <div class="form-group text-gray">
                <label for="inputNumber" class="col-sm-2 control-label">确认新密码：</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="newpassAgain" name="confirmPassword" placeholder="确认新密码">
                </div>
                <label for="inputPassword3" class="pull-left control-label"><i class="fa fa-info-circle text-orange"></i> {!! empty($errors->first('oldpassword'))?'请再次输入您的新密码':'' !!} </label>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btsp" type="submit">保存</button>
                    <br><br><br><br>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
{{--添加消息提示--}}
{!! Theme::widget('popup')->render() !!}
{!! Theme::asset()->container('footer')->usepath()->add('usertags','js/doc/userpassword.js') !!}
