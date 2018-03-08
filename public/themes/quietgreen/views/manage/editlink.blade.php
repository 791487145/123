
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">编辑友情链接</h3>
<div class="g-backrealdetails clearfix bor-border interface">

<form action="/manage/updatelink/{{ $list['id'] }}" method="post" enctype="multipart/form-data" class="registerform">
    {{ csrf_field() }}
    <table class="table table-hover">
        <tbody>
            <tr>
                <td class="text-right editlink-tit">
                    链接名称：
                </td>
                <td class="text-left">
                    <input type="text" name="title" value="{{ $list['title'] }}" datatype="*">
                    <i class="light-red ace-icon fa fa-asterisk"></i>
                </td>
            </tr>
            <tr>
                <td class="text-right">链接封面：</td>
                <td class="text-left">
                    <div class="memberdiv pull-left">
                        <div class="position-relative">
                            <input multiple="" type="file" id="id-input-file-3" name="pic"/>
                            @if($list['pic'])
                                <img src="{!! url($list['pic']) !!}" width="148px" height="55px">
                            @endif
                        </div>
                    </div>
                    <label class="sys-infotop">
                    <span class="cor-gray87">
                        <i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>
                        位于首页底部，建议图片尺寸大小150px*55px
                    </span>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="text-right">链接地址：</td>
                <td class="text-left">
                    <input type="text" class="col-sm-6" name="content" value="{{ $list['content'] }}" datatype="url">
                    <i class="light-red ace-icon fa fa-asterisk"></i>
                </td>
            </tr>
            <tr>
                <td class="text-right">排序：</td>
                <td class="text-left">
                    <div class="clearfix pull-left">
                        <input type="text" class="input-mini" id="spinner3" name="sort" value="{{ $list['sort'] }}" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-right"></td>
                <td class="text-left">

                    <a href="/manage/link"><button class="btn btn-primary btn-sm" type="submit">提交</button></a>

                </td>
            </tr>
        </tbody>
    </table>
</form>
</div>
{!! Theme::asset()->container('specific-css')->usePath()->add('bootstrap-datetimepicker.css', 'plugins/ace/css/bootstrap-datetimepicker.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('fuelux.spinner.min.js', 'plugins/ace/js/fuelux/fuelux.spinner.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('moment', 'plugins/ace/js/date-time/moment.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepickertime-js', 'plugins/ace/js/date-time/bootstrap-datetimepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('datefuelux-js', 'js/doc/datefuelux.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('linkManage-js', 'js/linkManage.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}