{{--<div class="well">
    <span >雇主等级详情</span>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">宝箱详情</h3>
<div class="">
    <div class="g-backrealdetails clearfix bor-border">

        <form class="form-horizontal clearfix registerform" role="form"  action="{!! url('manage/treasureUp') !!}" method="post">
            <input type="hidden" @if(isset($boxes['id']))value="{!! $boxes['id'] !!}"@endif name="id">
            {!! csrf_field() !!}

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 宝箱名称：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="name" @if(isset($boxes['name']))value="{!! $boxes['name'] !!}"@endif>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                    <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 等级：</p>
                    <p class="col-sm-4">
                        <select name="grade">
                            @foreach($grade as $v)
                                <option value="{{ $v }}" {{ ($boxes['grade']==$v)?'selected':'' }}>{{ $v }}级宝箱</option>
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
