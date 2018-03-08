{{--<div class="page-header">
        <h1>
            第三方登陆配置
        </h1>
</div>--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">第三方登陆配置</h3>
<div class="">
    <div class="g-backrealdetails clearfix bor-border">
        <form class="" role="form" action="{!! url('manage/thirdLogin') !!}" method="post">
            {!! csrf_field() !!}
        <!-- PAGE CONTENT BEGINS -->
        	<div class="form-group thirdlogin-bottom col-xs-12">
        		<label class="col-sm-1 control-label">
        		开启哪些接口
        		</label>
        		<label class="col-sm-1">
        			<input type="checkbox" name="qq[status]" value="1" @if(isset($data['qq_api']['status']) == 1)checked="checked"@endif> 腾讯QQ
        		</label>
        		<label class="col-sm-1">
        			<input type="checkbox" name="wechat[status]" value="1" @if(isset($data['wechat_api']['status']) == 1)checked="checked"@endif> 微信
        		</label>
        		<label class="col-sm-1 ">
        			<input type="checkbox" name="sina[status]" value="1" @if(isset($data['sina_api']['status']) == 1)checked="checked"@endif> 微博
        		</label>
        	</div>

            <div class="form-group thirdlogin-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">QQappid：</label>
                <div class="col-sm-4">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-12" name="qq[appId]" value="@if(isset($data['qq_api']['appId'])){!! $data['qq_api']['appId'] !!}@endif">
                    {{--<span class="help-inline col-xs-12 col-sm-3">--}}
                        {{--<span class="middle">（QQ开发者平台提供的api编号）</span>--}}
                    {{--</span>--}}
                    {{--<span class="help-inline col-xs-12 col-sm-5">--}}
                        {{--<a class="btn btn-sm btn-primary">点击申请</a>--}}
                    {{--</span>--}}
                </div>
                <label class="col-sm-2 col-xs-12">
                    <span class="help-inline">
                        <span class="middle">（QQ开发者平台提供的api编号）</span>
                    </span>
                </label>
                <label class="col-sm-2 col-xs-12">
                    <span class="help-inline">
                        <a class="btn btn-sm btn-primary">点击申请</a>
                    </span>
                </label>
            </div>
            <div class="form-group thirdlogin-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">
				QQappsecret：</label>
                <div class="col-sm-4">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-12" name="qq[appSecret]" value="@if(isset($data['qq_api']['appSecret'])){!! $data['qq_api']['appSecret'] !!}@endif">
                    {{--<span class="help-inline col-xs-12 col-sm-8">--}}
                        {{--<span class="middle">（QQ开发者平台提供的app_secret编号）</span>--}}
                    {{--</span>--}}
                </div>
                <label class="col-sm-2 col-xs-12">
                    <span class="help-inline">
                        <span class="middle">（QQ开发者平台提供的app_secret编号）</span>
                    </span>
                </label>
            </div>
            <div class="form-group thirdlogin-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">微信appid：</label>
                <div class="col-sm-4">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-12" name="wechat[appId]" value="@if(isset($data['wechat_api']['appId'])){!! $data['wechat_api']['appId'] !!}@endif">
                    {{--<span class="help-inline col-xs-12 col-sm-3">--}}
                        {{--<span class="middle">（微信开放平台提供的api编号）</span>--}}
                    {{--</span>--}}
                    {{--<span class="help-inline col-xs-12 col-sm-5">--}}
                        {{--<a class="btn btn-sm btn-primary">点击申请</a>--}}
                    {{--</span>--}}
                </div>
                <label class="col-sm-2 col-xs-12">
                    <span class="help-inline">
                        <span class="middle">（微信开放平台提供的api编号）</span>
                    </span>
                </label>
                <label class="col-sm-2 col-xs-12">
                    <span class="help-inline">
                        <a class="btn btn-sm btn-primary">点击申请</a>
                    </span>
                </label>
            </div>
            <div class="form-group thirdlogin-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">微信appsecret：</label>
                <div class="col-sm-4">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-12" name="wechat[appSecret]" value="@if(isset($data['wechat_api']['appSecret'])){!! $data['wechat_api']['appSecret'] !!}@endif">
                    {{--<span class="help-inline col-xs-12 col-sm-8">--}}
                        {{--<span class="middle">（微信开放平台提供的app_secret编号）</span>--}}
                    {{--</span>--}}
                </div>
                <label class="col-sm-2 col-xs-12">
                    <span class="help-inline">
                        <span class="middle">（微信开放平台提供的app_secret编号）</span>
                    </span>
                </label>
            </div>
            <div class="form-group thirdlogin-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">Sina appid：</label>
                <div class="col-sm-4">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-12" name="sina[appId]" value="@if(isset($data['sina_api']['appId'])){!! $data['sina_api']['appId'] !!}@endif">
                    {{--<span class="help-inline col-xs-12 col-sm-3">--}}
                        {{--<span class="middle">（新浪开发者平台提供的api编号）</span>--}}
                    {{--</span>--}}
                    {{--<span class="help-inline col-xs-12 col-sm-5">--}}
                      {{--<a class="btn btn-sm btn-primary">点击申请</a>--}}
                    {{--</span>--}}
                </div>
                <label class="col-sm-2 col-xs-12">
                    <span class="help-inline">
                        <span class="middle">（新浪开发者平台提供的api编号）</span>
                    </span>
                </label>
                <label class="col-sm-2 col-xs-12">
                    <span class="help-inline">
                        <a class="btn btn-sm btn-primary">点击申请</a>
                    </span>
                </label>
            </div>
            <div class="form-group thirdlogin-bottom col-xs-12">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">Sina appsecret：</label>
                <div class="col-sm-4">
                    <input type="text" id="form-field-1" class="col-xs-10 col-sm-12" name="sina[appSecret]" value="@if(isset($data['sina_api']['appSecret'])){!! $data['sina_api']['appSecret'] !!}@endif">
                    {{--<span class="help-inline col-xs-12 col-sm-8">--}}
                        {{--<span class="middle">（新浪开发者平台提供的app_secret编号）</span>--}}
                    {{--</span>--}}
                </div>
                <label class="col-sm-2 col-xs-12">
                    <span class="help-inline">
                        <span class="middle">（新浪开发者平台提供的app_secret编号）</span>
                    </span>
                </label>
            </div>

            <div class="col-xs-12">
                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                    <div class="col-xs-12">
                        <div class="col-md-1 text-right"></div>
                        <div class="col-md-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                    </div>
                </div>
            </div>
           {{-- <div class="form-group">
                <label class="col-sm-1 control-label no-padding-right"></label>
                <div class="col-sm-2 col-xs-12">
                    <button type="submit" class="btn btn-sm btn-primary">提交</button>
                </div>
            </div>--}}
            {{--<div class="col-sm-10 center">--}}
                {{--<button type="submit" class="btn btn-sm btn-primary">提交</button>--}}
            {{--</div>--}}
    </form>
</div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage-css', 'css/backstage/backstage.css') !!}