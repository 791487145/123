<div class="g-main clearfix">
    <h4 class="text-size16 cor-blue u-title">资料完善</h4>
    <div class="space-20"></div>
    <div class="col-xs-12 nopd768">
            <form class="registerform form-horizontal row"  role="form" action="{{ URL('/user/infoUpdate') }}" method="post">
                {!! csrf_field() !!}
            <div class="form-group s-formwrp1">
                <label for="inputText" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">用户名&nbsp;&nbsp;</label>
                <div class="space-6 visible-xs-block"></div>
                <div class="col-sm-5">
                    <input type="text" class="form-control inputxt" disabled id="inputText" placeholder="昵称" value="{{ Auth::user()['name'] }}">
                    <div class="space-10"></div>
                </div>
            </div>

            <div class="space-12"></div>

            <div class="form-group s-formwrp1">
                <label for="inputText" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">电子邮箱&nbsp;&nbsp;</label>
                <div class="space-6 visible-xs-block"></div>
                {{--未绑定状态--}}
                {{--<div class="col-sm-5">
                    <span class="cor-red">未绑定邮箱</span>&nbsp;&nbsp;&nbsp;<a href="javascript:;">立即绑定</a>
                </div>--}}
                <div class="col-sm-5">
                    <input type="text" class="form-control inputxt" disabled id="inputText"   value="{{ Auth::user()['email'] }}">
                    @if(Auth::user()->email_status == 2)
                    <span class="Validform_checktip col-sm-6 validform-base Validform_right">邮箱已认证</span>
                    @else
                    <span class="Validform_checktip  validform-base Validform_wrong">未绑定邮箱 <a href="{!! url('user/emailAuth') !!}">点击绑定</a></span>
                    @endif
                </div>
                <div class="space-8 visible-xs-block"></div>
            </div>

            <div class="space-12"></div>

            <div class="form-group s-formwrp1">
                <label for="inputPassword3" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">真实姓名&nbsp;&nbsp;</label>
                <div class="space-6 visible-xs-block"></div>
                <div class="col-sm-5">
                    <input type="text" class="form-control inputxt" id="inputPassword3" name="realname" value="{{ $uinfo['realname']?$uinfo['realname']:'' }}" placeholder="真实姓名" >
                </div>
                <div class="space-12 visible-xs-block"></div>
                {{--<div class="col-sm-2">--}}
                    {{--<select class="form-control" name="realname_status">--}}
                        {{--<option value=0 {{ $uinfo['realname_status']==0?'selected':'' }}>不公开</option>--}}
                        {{--<option value=1 {{ $uinfo['realname_status']==1?'selected':'' }}>公开</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                <div class="space-10 col-sm-12"></div>
            </div>

            <div class="space-12"></div>

            <div class="form-group s-formwrp1 task-casehid">
                <label for="inputPassword3" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">所在地&nbsp;&nbsp;</label>
                <div class="space-6 visible-xs-block"></div>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <select name="province" onchange="checkprovince(this)"class="form-control validform-select" datatype="*" nullmsg="请选择省份！" errormsg="请选择省份！">
                                @foreach($province as $v)
                                    <option value={{ $v['id'] }} {{ ($uinfo['province']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control  validform-select" name="city" id="province_check" onchange="checkcity(this)" datatype="*" nullmsg="请选择城市！" errormsg="请选择城市！">
                                @foreach($city as $v)
                                    <option value={{ $v['id'] }} {{ ($uinfo['city']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <select name="area" id="area_check" class="form-control  validform-select" datatype="*" nullmsg="请选择区域！" errormsg="请选择区域！">
                        @foreach($area as $v)
                            <option value={{ $v['id'] }} {{ ($uinfo['area']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-10 col-sm-12"></div>
            </div>

            <div class="space-12"></div>

            <div class="form-group s-formwrp1 task-casehid">
                <label for="inputNumber" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">手机号&nbsp;&nbsp;</label>

                <div class="space-6 visible-xs-block" > </div>
                {{--未绑定状态--}}
                {{--<div class="col-sm-5">
                    <span class="cor-red">未绑定手机号</span>&nbsp;&nbsp;&nbsp;<a href="javascript:;">立即绑定</a>
                </div>--}}
                <div class="col-sm-5">
                    <input type="text" class="form-control inputxt" disabled="disabled" name="mobile" id="inputNumber" value="{{ $user['mobile']?$user['mobile']:'' }}" placeholder="请填写手机号" datatype="m|empty"  errormsg="手机号格式错误！">
                    @if(!$user['mobile'])<span class="cor-red">未绑定手机号</span>&nbsp;&nbsp;&nbsp;<a href="{{ URL('user/phoneAuth') }}">立即绑定</a>@endif
                    {{--<span class="Validform_checktip col-sm-6 validform-base Validform_right">手机已认证</span>--}}
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="mobile_status">
                        <option value=0 {{ $uinfo['mobile_status']==0?'selected':'' }}>不公开</option>
                        <option value=1 {{ $uinfo['mobile_status']==1?'selected':'' }}>公开</option>
                    </select>
                </div>
                <div class="space-10 col-sm-12"></div>
            </div>

            <div class="space-12"></div>

            <div class="form-group s-formwrp1 task-casehid">
                <label for="inputEmail" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">微信&nbsp;&nbsp;</label>
                <div class="space-6 visible-xs-block"></div>
                <div class="col-sm-5">
                    <input type="text" class="form-control inputxt" id="inputEmail" name="wechat" value="{{ $uinfo['wechat']?$uinfo['wechat']:'' }}" placeholder="微信号" >
                </div>
                <div class="space-12 visible-xs-block"></div>
                <div class="col-sm-2">
                    <select class="form-control" name="wechat_status">
                        <option value=0 {{ $uinfo['wechat_status']==0?'selected':'' }}>不公开</option>
                        <option value=1 {{ $uinfo['wechat_status']==1?'selected':'' }}>公开</option>
                    </select>
                </div>
                <div class="space-10 col-sm-12"></div>
            </div>

            <div class="space-12"></div>

            <div class="form-group s-formwrp1 task-casehid">
                <label for="QQ" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">QQ&nbsp;&nbsp;</label>
                <div class="space-6 visible-xs-block"></div>
                <div class="col-sm-5 ">
                    <input type="text" class="form-control inputxt" id="QQ" name="qq"  value="{{ $uinfo['qq']?$uinfo['qq']:'' }}" placeholder="QQ" datatype="qq|empty" errormsg="请填写QQ！">
                </div>
                <div class="col-sm-2">
                    <select class="form-control"  name="qq_status">
                        <option value=0 {{ $uinfo['qq_status']==0?'selected':'' }}>不公开</option>
                        <option value=1 {{ $uinfo['qq_status']==1?'selected':'' }}>公开</option>
                    </select>
                </div>
                <div class="space-10 col-sm-12"></div>
            </div>

            <div class="space-12"></div>

            <div class="form-group s-formwrp2">
                <label for="inputEmail" class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1">个人信息&nbsp;&nbsp;</label>
                <div class="space-6 visible-xs-block"></div>
                <div class="col-sm-7">
                    <textarea class="form-control" rows="5" placeholder="以下信息将展现您的个人能力"  name="introduce">{{ $uinfo['introduce']?$uinfo['introduce']:'' }}</textarea>
                </div>
                <div class="space-12 visible-xs-block"></div>
            </div>

            <div class="space-18 "></div>

            <div class="form-group s-formwrp2">
                <label class="col-sm-2 control-label no-padding-right s-safetywrp1 s-labelwrp1"> </label>

                <div class="col-sm-10 center768">
                    <button class="btn btn-primary btn-big btn-blue bor-radius2 btn-sm btn-imp" type="submit">保存</button>
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
{!! Theme::asset()->container('custom-js')->usepath()->add('paypassword','js/doc/userinfo.js') !!}
{!! Theme::widget('popup')->render() !!}
{!! Theme::widget('avatar')->render() !!}

