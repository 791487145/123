
                <h3 class="header smaller lighter blue mg-bottom20 mg-top12">广告添加</h3>

            <form class="form-horizontal" action="/advertisement/adInfo" method="post" enctype="multipart/form-data" id="ad">
                {!! csrf_field() !!}
                <div class="widget-body">
                    <div class="">
                        <div class="g-backrealdetails clearfix bor-border">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td class="text-right">广告名称：</td>
                                    <td class="text-left">
                                        <input type="text" name="ad_name" >
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">广告位置：</td>
                                    <td class="text-left">
                                        <select name="target_id" class="target_id">
                                            <option value="0">全部</option>
                                            @foreach($adTargetInfo as $adTargetInfoV)
                                                <option value="{!! $adTargetInfoV->target_id !!}" data-values="{!! $adTargetInfoV->code !!}">{!! $adTargetInfoV->name !!}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">开始时间：</td>
                                    <td class="text-left col-md-10">
                                        <div class="input-group col-md-2 pull-left">
                                            <input id="date-timepicker1" name="start_time" type="text" class="form-control">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o bigger-110"></i>
                                                        </span>

                                        </div>
                                        <label class="sys-infotop">
                                            <span class="cor-gray87">
                                                <i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>
                                                设置广告展示生效开始时间，留空为永久有效
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">结束时间：</td>
                                    <td class="text-left col-md-10">
                                        <div class="input-group col-md-2 pull-left">
                                            <input id="date-timepicker2" name="end_time" type="text" class="form-control">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o bigger-110"></i>
                                                        </span>
                                        </div>
                                        <label class="sys-infotop">
                                            <span class="cor-gray87">
                                                <i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>
                                                设置广告展示生效开始时间，留空为永久有效
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">展示方式：</td>
                                    <td class="text-left">
                                        <select name="ad_type" class="ad_type">
                                            <option value="image"> 图片 </option>
                                        </select>
                                        <label></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="memberdiv pull-left">
                                            <div class="position-relative">
                                                <input multiple="" type="file" name="ad_file" id="id-input-file-3" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">链接地址：</td>
                                    <td class="text-left">
                                        <input type="text" name="ad_url"  class="col-sm-6">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">排序：</td>
                                    <td class="text-left">
                                        <div class="ace-spinner touch-spinner" style="width: 100px;"><div class="input-group">

                                                <input type="text" id="spinner3" name="listorder" value="0" class="input-mini spinner-input form-control"  maxlength="3">

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">是否开启：</td>
                                    <td class="text-left">
                                        <input type="radio" name="is_open" value="1" checked="checked">是 <input type="radio" name="is_open" value="2">否
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right"></td>
                                    <td class="text-left">
                                        <button type="submit" class="btn btn-primary btn-sm">提交</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('bootstrap-datetimepicker.css', 'plugins/ace/css/bootstrap-datetimepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('fuelux.spinner.min.js', 'plugins/ace/js/fuelux/fuelux.spinner.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('moment', 'plugins/ace/js/date-time/moment.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepickertime-js', 'plugins/ace/js/date-time/bootstrap-datetimepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('datefuelux-js', 'js/doc/datefuelux.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('ad-js', 'js/doc/ad.js') !!}