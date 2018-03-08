{{--<div class="well">
    <span >雇主等级详情</span>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">猎人等级详情</h3>
<div class="">
    <div class="g-backrealdetails clearfix bor-border">

        <form class="form-horizontal clearfix registerform" role="form"  action="{!! url('manage/iconUpdate') !!}" method="post" enctype="multipart/form-data">
            <input type="hidden" @if(isset($icon['id']))value="{!! $icon['id'] !!}"@endif name="id">
            {!! csrf_field() !!}

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 图标图片：</p>
                <p class="col-sm-4">
                    <img  src="/{!! $icon['icon_name'] !!}"/>
                    <input type="file"  name="icon_name" >
                </p>
            </div>

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 路由：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="route" @if(isset($icon['route']))value="{!! $icon['route'] !!}"@endif>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                    <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 描述：</p>
                    <p class="col-sm-4">
                        <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="describe" @if(isset($icon['describe']))value="{!! $icon['describe'] !!}"@endif datatype="*">
                        <span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
                    </p>
            </div>

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 路由：</p>
                <p class="col-sm-4">
                    <select name="type">
                        @foreach($icon_type as $v)
                            <option value="{{ $v['type_name'] }}" {{ ($icon['type']==$v['type_name'])?'selected':'' }}>{{ $v['describe'] }}</option>
                        @endforeach
                    </select>
                </p>
            </div>



            <div class="col-xs-12">
                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                    <div class="col-xs-12">
                        <div class="col-md-1 text-right"></div>
                        <div class="col-md-10">
                            <button class="btn btn-primary" type="submit">修改</button>
                        </div>
                    </div>
                </div>
            </div>
           
          
        </form>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userManage-js', 'js/userManage.js') !!}
