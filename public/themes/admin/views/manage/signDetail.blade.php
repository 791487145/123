{{--<div class="well">
    <span >签到</span>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">签到</h3>
<div class="">
    <div class="g-backrealdetails clearfix bor-border">

        <form class="form-horizontal clearfix registerform" role="form"  action="{!! url('manage/signUpdate') !!}" method="post">
            <input type="hidden" @if(isset($sign['id']))value="{!! $sign['id'] !!}"@endif name="id">
            {!! csrf_field() !!}
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 签到周期：</p>   
                <div class="input-daterange input-group">
                    <input type="text" name="start_time" class="input-sm form-control" @if(isset($sign['start_time']))value="{!! $sign['start_time'] !!}"@endif ">
                    <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                    <input type="text" name="end_time" class="input-sm form-control" @if(isset($sign['end_time']))value="{!! $sign['end_time'] !!}"@endif>
                </div>
                <p class="col-sm-4"></p>
            </div>    

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 中奖天数：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="winning_days" @if(isset($sign['winning_days']))value="{!! $sign['winning_days'] !!}"@endif datatype="*">
                    
                </p>
            </div>

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 每次签到活跃值：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="active_value" @if(isset($sign['active_value']))value="{!! $sign['active_value'] !!}"@endif>
                    
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 每次签到金币：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="gold" @if(isset($sign['gold']))value="{!! $sign['gold'] !!}"@endif>
                   
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


