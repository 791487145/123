
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">推荐编辑</h3>

            <form class="form-horizontal" action="/advertisement/modifyRecommend/{!! $service_id !!}" method="post" enctype="multipart/form-data" id="ad">
                {{ csrf_field() }}
                <div class="widget-body">
                    <div class="">
                        <div class="g-backrealdetails clearfix bor-border">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    {!! $errors->first('message') !!}
                                    <td class="text-right">推荐分类：</td>
                                    <td class="text-left">
                                        <select name="type" onchange="getReInfo(this)">
                                            <option value="0">请选择</option>
                                            <option value="service" @if($serviceInfo[0]['type'] == 'service')selected="selected"@endif>服务商</option>
                                            <option value="successcase" @if($serviceInfo[0]['type'] == 'successcase')selected="selected"@endif>成功案例</option>
                                            <option value="article" @if($serviceInfo[0]['type'] == 'article')selected="selected"@endif>资讯</option>
                                            <option value="task" @if($serviceInfo[0]['type'] == 'task')selected="selected"@endif>任务</option>
                                            <option value="shop" @if($serviceInfo[0]['type'] == 'shop')selected="selected"@endif>店铺</option>
                                            <option value="work" @if($serviceInfo[0]['type'] == 'work')selected="selected"@endif>作品</option>
                                            <option value="server" @if($serviceInfo[0]['type'] == 'server')selected="selected"@endif>服务</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">推荐名称：</td>
                                    <td class="text-left">
                                        <input type="hidden" name="recommend_id" id="recommend_id" value="{!! $serviceInfo[0]['recommend_id'] !!}"/>
                                        <select multiple="" class="chosen-select tag-input-style" id="form-field-select-4" data-placeholder="Choose a State...">
                                            @foreach($userInfo as $v)
                                                @if($serviceInfo[0]['type'] == 'service')
                                                <option value="{{ $v['id'] }}" @if($v['id'] == $serviceInfo[0]['recommend_id']){{ 'selected'}}@endif >{{ $v['name'] }}</option>
                                                @elseif($serviceInfo[0]['type'] == 'successcase')
                                                <option value="{{ $v['id'] }}" @if($v['id'] == $serviceInfo[0]['recommend_id']){{ 'selected'}}@endif >{{ $v['title'] }}</option>
                                                @elseif($serviceInfo[0]['type'] == 'article')
                                                <option value="{{ $v['id'] }}" @if($v['id'] == $serviceInfo[0]['recommend_id']){{ 'selected'}}@endif >{{ $v['title'] }}</option>
                                                @elseif($serviceInfo[0]['type'] == 'task')
                                                <option value="{{ $v['id'] }}" @if($v['id'] == $serviceInfo[0]['recommend_id']){{ 'selected'}}@endif >{{ $v['title'] }}</option>
                                                @elseif($serviceInfo[0]['type'] == 'shop')
                                                <option value="{{ $v['id'] }}" @if($v['id'] == $serviceInfo[0]['recommend_id']){{ 'selected'}}@endif >{{ $v['shop_name'] }}</option>
                                                @elseif($serviceInfo[0]['type'] == 'work')
                                                <option value="{{ $v['id'] }}" @if($v['id'] == $serviceInfo[0]['recommend_id']){{ 'selected'}}@endif >{{ $v['title'] }}</option>
                                                @elseif($serviceInfo[0]['type'] == 'server')
                                                <option value="{{ $v['id'] }}" @if($v['id'] == $serviceInfo[0]['recommend_id']){{ 'selected'}}@endif >{{ $v['title'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">推荐位置：</td>
                                    <td class="text-left">
                                        <select name="position_id" class="position_id">
                                            <option value="0">未选择</option>
                                            @foreach($positionInfo as $positionInfoV)
                                                <option value="{!! $positionInfoV->id !!}" data-values="{!! $positionInfoV->code !!}"
                                                        @if($positionInfoV->id == $serviceInfo[0]['position_id'])selected="selected"@endif>
                                                    {!! $positionInfoV->name !!}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="sys-infotop">
                                            <span class="cor-gray87">
                                                <i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>
                                                推荐服务商为App专用推荐位
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">开始时间：</td>
                                    <td class="text-left col-md-10">
                                        <div class="input-group col-md-2 pull-left">
                                            <input id="date-timepicker1" name="start_time" value="{!! $serviceInfo[0]['start_time'] !!}" type="text" class="form-control">
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
                                            <input id="date-timepicker2" name="end_time" value="{!! $serviceInfo[0]['end_time'] !!}" type="text" class="form-control">
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
                                        <select name="recommend_type" class="recommend_type">
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
                                                <input multiple="" type="file" name="recommend_pic"  id="id-input-file-3" />
                                                @if($serviceInfo[0]['recommend_pic'])
                                                <img src="{!! url($serviceInfo[0]['recommend_pic']) !!}" width="152" height="126">
                                                @endif
                                            </div>
                                        </div>
                                        <label class="sys-infotop">
                                            <span class="cor-gray87">
                                                <i class="fa fa-exclamation-circle cor-orange text-size18 red"></i>
                                                推荐店铺、作品、服务、成功案例上传图片将替换店主上传的封面
                                            </span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">链接地址：</td>
                                    <td class="text-left">
                                        <input type="hidden" id="domain" value="{{$domain}}">
                                        <input type="text" name="url" value="{!! $serviceInfo[0]['url'] !!}"  class="col-sm-6">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">排序：</td>
                                    <td class="text-left">
                                        <div class="ace-spinner touch-spinner" style="width: 100px;"><div class="input-group">

                                                <input type="text" id="spinner3" name="sort" value="{!! $serviceInfo[0]['sort'] !!}" class="input-mini spinner-input form-control"  maxlength="3">

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">是否开启：</td>
                                    <td class="text-left">
                                        <input type="radio" name="is_open" value="1" @if($serviceInfo[0]['is_open'] == '1')checked="checked"@endif>是 <input type="radio" name="is_open" value="2" @if($serviceInfo[0]['is_open'] == '2')checked="checked"@endif>否
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

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('chosen','plugins/ace/css/chosen.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('bootstrap-datetimepicker.css', 'plugins/ace/css/bootstrap-datetimepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('fuelux.spinner.min.js', 'plugins/ace/js/fuelux/fuelux.spinner.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('moment', 'plugins/ace/js/date-time/moment.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepickertime-js', 'plugins/ace/js/date-time/bootstrap-datetimepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('datefuelux-js', 'js/doc/datefuelux.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('recommend-js', 'js/doc/recommend.js') !!}