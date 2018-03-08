
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">宝箱物品详情</h3>
<div class="">
    <div class="g-backrealdetails clearfix bor-border">

        <form class="form-horizontal clearfix registerform" role="form"  action="{!! url('manage/boxUp') !!}" method="post">
            <input type="hidden" @if(isset($box_goods['id']))value="{!! $box_goods['id'] !!}"@endif name="id">
            <input type="hidden" @if(isset($box_goods['box_id']))value="{!! $box_goods['box_id'] !!}"@endif name="box_id">
            {!! csrf_field() !!}

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 物品名称：</p>
                <p class="col-sm-4">
                    <select name="goods_id">
                        @foreach($sjlm_goods as $v)
                            <option value="{{ $v['id'] }}" {{ ($box_goods['goods_id']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                        @endforeach
                    </select>
                </p>
            </div>

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1">物品数量：</p>
                <p class="col-sm-4">
                    <input type="number" id="form-field-1"  class="col-xs-10 col-sm-5" name="g_amount" @if(isset($box_goods['g_amount']))value="{!! $box_goods['g_amount'] !!}"@endif>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                    <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 物品概率：</p>
                    <p class="col-sm-4">
                        <input type="number" max="10000" id="form-field-1"  class="col-xs-10 col-sm-5" name="probability" @if(isset($box_goods['probability']))value="{!! $box_goods['probability'] !!}"@endif datatype="*">
                        <span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
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
