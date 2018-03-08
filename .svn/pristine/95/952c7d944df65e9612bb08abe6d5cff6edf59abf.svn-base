<div class="row">
    <div class=" focusmain cpr">
        <div class="widget-box cmt ">
            <div class="widget-header widget-header-flat"><h4 class="focustitle">资料管理</h4></div>
            <div class="form-group form-horizontal datum">
                <div class="row cm">
                    <div class="row"><div class="col-md-9"><div class="col-sm-2 datumtitle">基本资料</div></div></div>
                    <form class="form-horizontal col-md-9" action="{{ URL('/user/infoUpdate') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="inputText" class="col-sm-2 control-label">昵称：</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nickname" id="inputText" placeholder="昵称" value="{{ $uinfo['nickname']?$uinfo['nickname']:'' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">真实姓名：</label>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" name="realname" id="inputEmail3" placeholder="姓名" value="{{ $uinfo['realname']?$uinfo['realname']:'' }}">
                                {!! $errors->first('username') !!}
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="realname_status">
                                    <option value=0 {{ $uinfo['realname_status']==0?'selected':'' }}>不公开</option>
                                    <option value=1 {{ $uinfo['realname_status']==1?'selected':'' }}>公开</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">所在地：</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="province" onchange="checkprovince(this)">
                                    @foreach($area as $v)
                                        <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="city" id="province_check" onchange="checkcity(this)">
                                    <option>北京市</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="area" id="area_check">
                                    @foreach($beijing as $v)
                                        <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNumber" class="col-sm-2 control-label">手机号：</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="mobile" id="inputNumber" placeholder="请填写手机号" value="{{ $uinfo['mobile']?$uinfo['mobile']:'' }}">
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="mobile_status">
                                    <option value=0 {{ $uinfo['mobile_status']==0?'selected':'' }}>不公开</option>
                                    <option value=1 {{ $uinfo['mobile_status']==1?'selected':'' }}>公开</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">电子邮箱：</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="wechat" id="inputEmail5" placeholder="微信" value="{{ $uinfo['wechat']?$uinfo['wechat']:'' }}">
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="wechat_status">
                                    <option value=0 {{ $uinfo['wechat_status']==0?'selected':'' }}>不公开</option>
                                    <option value=1 {{ $uinfo['wechat_status']==1?'selected':'' }}>公开</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">QQ：</label>
                            <div class="col-sm-6 ">
                                <input type="text" class="form-control" name="qq" id="inputEmail6" placeholder="QQ" value="{{ $uinfo['qq']?$uinfo['qq']:'' }}">
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="qq_status">
                                    <option value=0 {{ $uinfo['qq_status']==0?'selected':'' }}>不公开</option>
                                    <option value=1 {{ $uinfo['qq_status']==1?'selected':'' }}>公开</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">个人信息：</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="introduce">{{ $uinfo['introduce']?$uinfo['introduce']:'' }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10 skillbtn">
                                <button type="submit">保 存</button>
                                <br><br><br><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--添加消息提示--}}
{!! Theme::widget('popup')->render() !!}
{!! Theme::asset()->container('footer')->usepath()->add('froala_editor', 'js/doc/userinfo.js') !!}
{!! Theme::asset()->container('footer2')->usepath()->add('header','css/newindex/header.css') !!}
{!! Theme::asset()->container('footer2')->usepath()->add('footer','css/newindex/footer.css') !!}
{!! Theme::asset()->container('footer2')->usepath()->add('datum','css/newindex/usercenter/datum.css') !!}

