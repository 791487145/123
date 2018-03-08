
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">奖品详情</h3>
<div class="">
    <div class="g-backrealdetails clearfix bor-border">

        <form class="form-horizontal clearfix registerform" role="form"  action="{!! url('manage/updatePrize') !!}" method="post" enctype="multipart/form-data">
            <input type="hidden" @if(isset($prize['id']))value="{!! $prize['id'] !!}"@endif name="id">
            {!! csrf_field() !!}
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 名称：</p>
                <p class="col-sm-4">
                    <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" name="name" @if(isset($prize['name']))value="{!! $prize['name'] !!}"@endif datatype="*">
                    <span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 图片：</p>
                <p class="col-sm-4">
                    <img  src="/{!! $prize['icon'] !!}"/>
                    <input type="file"  name="icon" >
                </p>
            </div>

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 类型：</p>
                <p class="col-sm-4">
                    <select name="kind">
                        @foreach($type as $v)
                        @if($v['type'] == 'stdmode')
                            <option value="{{ $v['id'] }}" {{ ($prize['kind']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                        @endif
                        @endforeach
                    </select>
                </p>
            </div>

            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 功能：</p>
                <p class="col-sm-4">
                    <select name="ability">
                        <option value="">请选择</option>
                        @foreach($type as $v)
                            @if($v['type'] == 'prop')
                                <option value="{{ $v['id'] }}" {{ ($prize['ability']==$v['id'])?'selected':'' }}>{{ $v['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 物品价值（实物）：</p>
                <p class="col-sm-4">
                    <input type="text"  class="col-xs-10 col-sm-5" name="price" @if(isset($prize['price']))value="{!! $prize['price'] !!}"@endif>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 金币兑换：</p>
                <p class="col-sm-4">
                    <input type="text" class="col-xs-10 col-sm-5" name="gold" @if(isset($prize['gold']))value="{!! $prize['gold'] !!}"@endif>
                </p>
            </div>
            <div class="bankAuth-bottom clearfix col-xs-12">
                <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 兑换码标志：</p>
                <p class="col-sm-4">
                    <input type="text"   class="col-xs-10 col-sm-5" name="sign" @if(isset($prize['sign']))value="{!! $prize['sign'] !!}"@endif>
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
