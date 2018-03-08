
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">附件配置</h3>
{{--<div class="widget-header widget-header-flat">
<h5 class="widget-title">附件配置</h5>
</div>--}}


<form method="post" action="{!! url('manage/config/attachment') !!}">
    {!! csrf_field() !!}
    <div class="g-backrealdetails clearfix bor-border">
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="text-right col-xs-1"><lable class="control-label no-padding-right">附件大小限制：</lable></p>
            <p class="text-left col-xs-9">
                <input type="text" name="attachment[size]" @if(isset($config['attachment']['size']))value="{!! $config['attachment']['size'] !!}"@endif>
                <label>系统配置值：2M，如果设定值超过系统配置值，则以系统配置值为准,该配置 生效需配合php.ini,查看详细</label>
            </p>
        </div>
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="text-right col-xs-1">附件格式：</p>
            <p class="text-left col-xs-9">
                <input type="text" placeholder="pdf|doc|docx|xls|ppt|wps|zip|rar|txt|jpg|jpeg|gif|bmp" name="attachment[extension]" @if(isset($config['attachment']['extension']))value="{!! $config['attachment']['extension'] !!}"@endif>
                <label >如果有多个关键字，(zip|rar|jpg|gif|png)(不含引号) 等符号分隔</label>
            </p>
        </div>
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <div class="col-md-10">
                        <button class="btn btn-primary btn-sm" type="submit">提交</button>
                    </div>
                </div>
            </div>
        </div>
        {{--<tr>
            <td class="text-right"></td>
            <td class="text-left">
                <button type="submit" class="btn btn-primary btn-sm">提交</button>
            </td>
        </tr>--}}
    </div>
</form>

{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}