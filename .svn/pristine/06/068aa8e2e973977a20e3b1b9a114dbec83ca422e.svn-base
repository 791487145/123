<script>
    function checkForm() {
        var displayname =  $("input[name='display_name']");
        if(displayname == ""){
            alert('权限名b')
        }
    }
</script>
{{--<div class="well">
    <h4 >添加权限</h4>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加权限</h3>
<div class="">
    <div class="g-backrealdetails clearfix bor-border">
        <form class="form-horizontal clearfix registerform" role="form" action="permissionsAdd" method="post" >
            {!! csrf_field() !!}
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 权限名：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="display_name" datatype="*">
                    <span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1">权限路由：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="name" datatype="*">
                    <span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
                </p>
            </div>


            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 描述：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="description">
                </p>
            </div>

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 所属模块：</p>
                <p class="col-sm-4">
                    <select name="module_type" class="col-xs-10 col-sm-5">
                        @foreach(Theme::get('manageMenu') as $v)
                            <option value="{{ $v['id'] }}" >{{ $v['name']}}</option>
                            @if(!empty($v['_child']))
                                @foreach($v['_child'] as $value)
                                    <option value="{{ $value['id'] }}" >|-{{ $value['name']}}</option>
                                    @if(!empty($value['_child']))
                                        @foreach($value['_child'] as $values)
                                            <option value="{{ $values['id'] }}" >|-|-{{ $values['name']}}</option>
                                        @endforeach()
                                    @endif
                                @endforeach()
                            @endif
                        @endforeach()
                    </select>
                </p>
            </div>

            <div class="col-xs-12">
                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                    <div class="col-xs-12">
                        <div class="col-md-1 text-right"></div>
                        <div class="col-md-10">
                            <button class="btn btn-primary btn-sm" type="submit" onclick="return checkForm()">提交</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space col-xs-12"></div>
            <div class="col-xs-12">
                <div class="col-md-1 text-right"></div>
                <div class="col-md-10"><a href="">上一项</a>　　<a href="">下一项</a></div>
            </div>
            <div class="col-xs-12 space">

            </div>
            {{--<div class="form-group text-center">
                <label class="col-sm-1 control-label no-padding-left" for="form-field-1"></label>
                <div class="col-sm-3 text-left">
                    　<button class="btn btn-primary btn-sm" type="submit" onclick="return checkForm()">提交</button>
                </div>
            </div>--}}
        </form>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userManage-js', 'js/userManage.js') !!}
