<div class="col-md-10">
    <div class="container-fluid">

        <form class="form-horizontal" action="{{ URL('password') }}" method="post" name="form">
            {!! csrf_field() !!}
            <div style="padding-left: 71px;font-weight: 700; ">
                <p>修改登录密码</p>
                <p>登录账号：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp豪客</p>
            </div>
            <div class="control-group">
                <label class="col-sm-2 control-label" for="inputEmail">邮箱:</label>
                <div class="col-sm-10">
                    <input id="inputEmail" readonly="readonly" type="text" value="{{ $user['email'] }}"/>
                    <button class="btn btn-primary" type="button">发送验证码</button>
                </div>
            </div>
            <div class="control-group">
                <label class="col-sm-2 control-label">验证码:</label>
                <div class="col-sm-10">
                    <input id="inputPassword" type="text" name="code" placeholder="请输入验证码" />
                    {!! $errors->first('attempt') !!}
                </div>
            </div>
            <div class="control-group">
                <div class="col-sm-10">
                    <br /> <input class="btn btn-primary" type="submit" value="下一步" />
                </div>
            </div>
        </form>
    </div>
</div>
