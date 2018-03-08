
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li>
                <a href="{!! URL('/manage/vipDetailsList') !!}">访谈列表</a>
            </li>
            <li class="active">
                <a href="{!! URL('/manage/vipDetailsAuth') !!}">添加访谈</a>
            </li>
        </ul>
    </div>
</div><!-- <div class="dataTables_borderWrap"> -->

<form class="form-horizontal clearfix registerform" role="form" action="{!! url('manage/addInterview') !!}" method="post">
    {!! csrf_field() !!}
    <div class="g-backrealdetails clearfix bor-border">
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 访谈标题：</p>
            <p class="col-sm-4">
                <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5" value="{{old('title')}}" name="title">
                {!! $errors->first('title') !!}
            </p>
        </div>
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 访谈店铺：</p>
            <p class="col-sm-4">
                <select name="shop_id">
                    <option value="0" >请选择</option>
                    @if(!empty($shopInfo))
                    @foreach($shopInfo as $sv)
                    <option value="{!! $sv['id'] !!}" @if(old('shop_id') == $sv['id']) selected="selected" @endif >{!! $sv['shop_name'] !!}</option>
                    @endforeach
                    @endif
                </select>
                {!! $errors->first('shop_id') !!}
            </p>
        </div>
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 访谈内容：</p>
            <p class="col-sm-4">
                <textarea name="desc" id="" cols="30" rows="10" >{{old('desc')}}</textarea>
                {!! $errors->first('desc') !!}
            </p>
        </div>
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 排序：</p>
            <p class="col-sm-4">
                <input type="text" id="form-field-1"  class="col-xs-10 col-sm-5"  name="list" datatype="*" value="{{old('list')}}">
                {!! $errors->first('list') !!}
            </p>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <div class="col-md-10">
                        <button class="btn btn-primary btn-sm" type="submit">保存</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{!! URL('/manage/vipDetailsList') !!}">返回</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="space col-xs-12"></div>
    </div>
</form>


{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/css/bootstrap-datetimepicker/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('jquery.webui-popover', '/plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
