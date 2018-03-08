{{--<div class="well">
    <span >用户等级详情</span>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">签到奖品详情</h3>
<div class="">
    <div class="g-backrealdetails clearfix bor-border">

        <form class="form-horizontal clearfix registerform" role="form"  action="{!! url('manage/updateSign') !!}" method="post" enctype="multipart/form-data">
            <input type="hidden" @if(isset($prize['id']))value="{!! $prize['id'] !!}"@endif name="id">
            <input type="hidden" @if(isset($prize['sign_id']))value="{!! $prize['sign_id'] !!}"@endif name="sign_id">
            {!! csrf_field() !!}
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 签到次数：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="date" @if(isset($prize['date']))value="{!! $prize['date'] !!}"@endif>
                    <span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 奖品名称：</p>
                <p class="col-sm-4">
                    <select name="goods_id">
                        @foreach($sjlm_goods as $v)
                            <option value="{{ $v['id'] }}" {{ ($prize['goods_id']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                        @endforeach
                    </select>
                </p>
            </div>

            <div class="col-xs-12">
                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                    <div class="col-xs-12">
                        <div class="col-md-1 text-right"></div>
                        <div class="col-md-10">
                            <button class="btn btn-primary" type="submit">
                                修改
                            </button>
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

{!! Theme::asset()->container('custom-js')->usePath()->add('userManage-js', 'js/userManage.js') !!}
