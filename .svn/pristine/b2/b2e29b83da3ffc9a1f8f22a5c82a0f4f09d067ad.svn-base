<h3 class="header smaller lighter blue mg-bottom20 mg-top12">推广配置管理&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-sm label-default">注册推广</span></h3>
<p>小提示：注册推广必须配合一项认证才能生效</p>
<form class="form-horizontal" action="/manage/promoteConfig" method="post">
    {!! csrf_field() !!}
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">是否开启推广</label>

            <div class="col-sm-9">
                <label>
                    <input class="ace" type="radio" name="is_open" value="1"
                           @if(!empty($promote_type['is_open']) && $promote_type['is_open'] == 1)checked="checked"@endif>
                    <span class="lbl"> 开启</span>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                    <input class="ace" type="radio" name="is_open" value="2"
                           @if(!empty($promote_type['is_open']) && $promote_type['is_open'] == 2)checked="checked"@endif>
                    <span class="lbl"> 不开启 </span>
                </label>
            </div>
        </div>
        <div class=" interface-bottom col-xs-12">
            <label class="col-sm-1 control-label no-padding-right" for="form-field-1" rows="2">推广奖励&nbsp;</label>

            <div class="col-sm-9">
                注册并通过&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                    <input type="radio" class="ace" value="1" name="finish_conditions"
                           @if(!empty($promote_type['finish_conditions']) && $promote_type['finish_conditions'] == 1)checked="checked"@endif/>
                    <span class="lbl"> 实名认证</span>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                    <input type="radio" class="ace" value="2" name="finish_conditions"
                           @if(!empty($promote_type['finish_conditions']) && $promote_type['finish_conditions'] == 2)checked="checked"@endif/>
                    <span class="lbl"> 邮箱认证</span>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                    <input type="radio" class="ace" value="3" name="finish_conditions"
                           @if(!empty($promote_type['finish_conditions']) && $promote_type['finish_conditions'] == 3)checked="checked"@endif/>
                    <span class="lbl"> 支付认证</span>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                后才能生效，推广者将获得
                <input type="text" name="price"
                       @if(!empty($promote_type['price']))value="{!! $promote_type['price'] !!}" @endif> 元现金
            </div>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10">
                        <button class="btn btn-info" type="submit">
                            保存
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}