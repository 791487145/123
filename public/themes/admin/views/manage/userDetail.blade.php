{{--<div class="well">
	<h4 >普通用户资料</h4>
</div>--}}
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">编辑普通用户资料</h3>

<form class="form-horizontal registerform" role="form" action="{!! url('manage/userEdit') !!}" method="post">
    {!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">
		<input type="hidden" name="uid" value="{!! $info['id'] !!}">
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 用户名：</p>
			<p class="col-sm-4">
				<input type="text" name="name" id="form-field-1" class="col-xs-10 col-sm-5" value="{!! $info['name'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 真实姓名：</p>
			<p class="col-sm-4">
				<input type="text" name="realname" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['realname'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 身份证：</p>
			<p class="col-sm-4">
				<input type="text" name="realname" id="form-field-1"  class="col-xs-10 col-sm-5" disabled="disabled" value="{!! $info['card_number'] !!}">
				<span style="color:#667f00;margin-left: 10px;">{{$auth_status == 1 ? '已认证': '未认证'}}</span>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 昵    称：</p>
			<p class="col-sm-4">
				<input type="text" name="nickname" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['nickname'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 性    别：</p>
			<p class="col-sm-4">
				<select name="sex">
					<option name="2" {{$info['sex'] == 2 ? 'selected':''}}>男</option>
					<option name="1" {{$info['sex'] == 2 ? 'selected':''}}>女</option>
				</select>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 手机号码：</p>
			<p class="col-sm-4">
				<input type="text" name="mobile" id="form-field-1"   class="col-xs-10 col-sm-5" value="{!! $info['mobile'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 出生日期：</p>
			<div class="col-sm-4">
				<p class="input-group input-group-sm col-xs-10 col-sm-5">
					<input type="text" disabled="disabled" id="datepicker" class="form-control hasDatepicker">
					<!-- <input type="text" name="birthday" id="datepicker" class="form-control hasDatepicker"> -->
				</p>
			</div>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 年    龄：</p>
			<p class="col-sm-4">
				<input type="text" disabled="disabled" name="year_old" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['year_old'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 余    额：</p>
			<p class="col-sm-4">
				<input type="text" name="balance" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['balance'] !!}">
			</p>
		</div>
		{{--<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 金    币：</p>
			<p class="col-sm-4">
				<input type="text" name="gold" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['gold'] !!}">
			</p>
		</div>--}}

			<div class="bankAuth-bottom clearfix col-xs-12">
				<p  class="col-sm-1 control-label no-padding-left">所在地：</p>
				<div class="col-sm-6">
					<div class="row">
						<p class="col-sm-4">
							<select name="province" id="province" class="form-control validform-select Validform_error" onchange="checkprovince(this)">
								<option value="" id="province-back">请选择省份</option>
								@foreach($province as $item)
									<option @if(!empty($info['province']) && $info['province']== $item['id'])selected="selected"@endif value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
								@endforeach
							</select>
						</p>
						<p class="col-sm-4">
							@if(!empty($info['city']))
							<select class="form-control  validform-select" name="city" id="city" onchange="checkcity(this)">
							@else
							<select class="form-control  validform-select" style="display: none;" name="city" id="city" onchange="checkcity(this)">
							@endif
								<option value="" id="city-back">请选择城市</option>
								@foreach($province_city as $item1)
									<option @if(!empty($info['city']) && $info['city'] == $item1['id'])selected="selected"@endif value="{!! $item1['id'] !!}">{!! $item1['name'] !!}</option>
								@endforeach
							</select>
						</p>
						<p class="col-sm-4">
							@if(!empty($info['area']))
							<select class="form-control  validform-select" name="area" id="area">
							@else
							<select class="form-control  validform-select" style="display:none;" name="area" id="area">
							@endif
								<option value="" id="city-back">请选择区域</option>
								@foreach($city_area as $item2)
									<option @if($info['area'] == $item2['id'])selected="selected"@endif value="{!! $item2['id'] !!}">{!! $item2['name'] !!}</option>
								@endforeach
							</select>

						</p>
					</div>
				</div>
			</div>
			<div class="bankAuth-bottom clearfix col-xs-12">
				<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 籍    贯：</p>
				<p class="col-sm-4">
					<input type="text" name="native_place" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['native_place'] !!}">
				</p>
			</div>
			<div class="bankAuth-bottom clearfix col-xs-12">
				<p  class="col-sm-1 control-label no-padding-left">学校信息：</p>
				<div class="col-sm-6">
					<div class="row">
						<p class="col-sm-4">
							<select name="region" id="region" class="form-control validform-select Validform_error" onchange="checkregion(this)">
								<option value="" id="region-back">请选择大区</option>
								@foreach($region as $item3)
									<option @if(!empty($info['region']) && $info['region'] == $item3['id'])selected="selected"@endif value="{!! $item3['id'] !!}">{!! $item3['name'] !!}</option>
								@endforeach
							</select>
						</p>
						<p class="col-sm-4">
							@if(!empty($info['school_province']))
							<select class="form-control  validform-select" name="school_province" id="school_province" onchange="checkschoolprovince(this)">
							@else
							<select class="form-control  validform-select" style="display: none;" name="school_province" id="school_province" onchange="checkschoolprovince(this)">
							@endif
								<option value="" id="school-province-back">请选择城市</option>
								@foreach($region_province as $item4)
									<option @if(!empty($info['school_province']) && $info['school_province'] == $item4['id'])selected="selected"@endif value="{!! $item4['id'] !!}">{!! $item4['name'] !!}</option>
								@endforeach
							</select>
						</p>
						<p class="col-sm-4">
							@if(!empty($info['school']))
							<select class="form-control  validform-select" name="school" id="school">
							@else
							<select class="form-control  validform-select" style="display: none;" name="school" id="school">
							@endif
								<option value="">请选择学校</option>
								@foreach($province_school as $item5)
									<option @if(!empty($info['school']) && $info['school'] == $item5['id'])selected="selected"@endif value="{!! $item5['id'] !!}">{!! $item5['name'] !!}</option>
								@endforeach
							</select>
						</p>
					</div>
				</div>
			</div>

		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 系：</p>
			<p class="col-sm-4">
				<input type="text" name="system" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['system'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 专    业：</p>
			<p class="col-sm-4">
				<input type="text" name="majors" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['majors'] !!}">
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 班    级：</p>
			<p class="col-sm-4">
				<input type="text" name="class" id="form-field-1"  class="col-xs-10 col-sm-5" value="{!! $info['class'] !!}">
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
		<!-- <input type="hidden" name="change_ids" id="area-change" value="" /> -->
		{{--<table id="sample-table-1" class="table table-striped table-bordered table-hover">
	            <thead>
	            <tr>
	                <th >排序</th>
	                <th width="50%" >名称</th>
	                <th>操作</th>
	            </tr>
	            </thead>
	            <tbody id="area_data_change">
	            @foreach($province as $v)
	                <tr id="area-delete-{{ $v['id'] }}" area_id = "{{ $v['id'] }}">
	
	                    <td>
	                        <input class="area-index" type="text" name="displayorder[{{ $v['id'] }}]" value="{{ $v['displayorder'] }}" area_id="{{ $v['id'] }}" onchange="area_change($(this))">
	                    </td>
	                    <td class="text-left">
	                        <input type="text" name="name[{{ $v['id'] }}]" value="{{ $v['name'] }}" area_id="{{ $v['id'] }}" onchange="area_change($(this))">
	                    </td>
	                    <td width="40%">
	                        <span class="btn  btn-sm btn-primary" area_id="{{ $v['id'] }}"  onclick="area_delete($(this))" >删除</span>
	                    </td>
	
	                </tr>
	            @endforeach
	            </tbody>
	        </table>--}}
		{{--<div class="space col-xs-12"></div>
		<div class="col-xs-12">
			<div class="col-md-1 text-right"></div>
			<div class="col-md-10"><a href="">上一项</a>　　<a href="">下一项</a></div>
		</div>--}}
	</div>
</form>

{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userManage-js', 'js/userManage.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('main-js', 'js/main.js') !!}
<script>
    /**
     * 省级切换
     * @param obj
     */
    function checkprovince(obj){
    	$('#city').hide();
    	$('#area').hide();
        var id = obj.value;
        $('#province-back').val(0);
        $.get('/manage/ajaxcity',{'id':id},function(data){
            var html = '<option>请选择城市</option>';
            // var area = '';
            for(var i in data.province){
                html+= "<option value=\""+data.province[i].id+"\">"+data.province[i].name+"<\/option>";
                // area+= "<tr id='area-delete-"+data.province[i].id+"'  area_id=\""+data.province[i].id+"\"><td><input class=\"area-index\" type=\"text\" name=\"displayorder["+data.province[i].id+"]\" value=\""+data.province[i].displayorder+"\" area_id=\""+data.province[i].id+"\" onchange=\"area_change($(this))\"><\/td><td class=\"text-left\"><input type=\"text\" name=\"name["+data.province[i].id+"]\"  value=\""+ data.province[i].name+"\" area_id=\""+data.province[i].id+"\" onchange=\"area_change($(this))\"><\/td><td width=\"40%\"><span class=\"btn btn-sm btn-primary\" area_id=\""+data.province[i].id+"\" onclick=\"area_delete($(this))\">删除<\/span><\/td><\/tr>";
            }
            if(data.id!=0){
                $('#province_check').html(html);
            }else{
                html = '<option value=\"\">城市</option>';
                $('#province_check').html(html);
            }
            $('#city').html();
            $('#city').html(html).show();
            //替换数据列表
            // $('#area_data_change').html(area);
            // $('#area-change').attr('value','');
        });
    }
    /**
     * 市级切换
     * @param obj
     */
    function checkcity(obj){
    	$('#area').hide();
        var id = obj.value;
        $('#city-back').attr('value',id);
        $.get('/manage/ajaxarea',{'id':id},function(data){
            var html = '<option>请选择区域<\/option>';
            // var area = '';
            for(var i in data){
                html += "<option value=\""+data[i].id+"\">"+data[i].name+"<\/option>";
                // area+= "<tr id='area-delete-"+data[i].id+"' area_id=\""+data[i].id+"\"><td><input class=\"area-index\" type=\"text\" name=\"displayorder["+data[i].id+"]\" value=\""+data[i].displayorder+"\" area_id=\""+data[i].id+"\" onchange=\"area_change($(this))\"><\/td><td class=\"text-left\"><input type=\"text\" name=\"name["+data[i].id+"]\" value=\""+ data[i].name+"\" area_id=\""+data[i].id+"\" onchange=\"area_change($(this))\"><\/td><td width=\"40%\"><span class=\"btn btn-sm btn-primary\" area_id=\""+data[i].id+"\" onclick=\"area_delete($(this))\">删除<\/span><\/td><\/tr>";
            }
            $('#area').html();
            $('#area').html(html).show();
            // $('#area_data_change').html(area);
            // $('#area-change').attr('value','');
        });
    }

    /**
     * 大区切换
     * @param obj
     */
    function checkregion(obj){
    	var id = obj.value;
    	$('#school_province').hide();
    	$('#school').hide();
    	$.get('/manage/ajaxRegionProvince',{'id':id},function(data){
    		var html = '<option>请选择省份<\/option>';
    		$('#region-back').val(0);
    		for(var i in data.region){
    			html += "<option value=\""+data.region[i].id+"\">"+data.region[i].name+"<\/option>";
    		}
    		$('#school_province').html();
    		$('#school_province').html(html).show();
    	});
    }

    /**
     * 学校省份切换
     * @param obj
     */
    function checkschoolprovince(obj){
    	var id = obj.value;
    	$('#school').hide();
    	$('#school-province-back').attr('value',id);
    	$.get('/manage/ajaxProvinceSchool',{'id':id},function(data){
    		var html = '<option>请选择学校<\/option>';
    		for(var i in data){
    			html += "<option value=\""+data[i].id+"\">"+data[i].name+"<\/option>";
    		}
    		$('#school').html();
    		$('#school').html(html).show();
    	});
    }
</script>