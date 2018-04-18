<link rel="stylesheet" type="text/css" href="{{ asset('uploadify/uploadify.css') }}">

<h3 class="header smaller lighter blue mg-top12 mg-bottom20">添加公司信息</h3>


<form class="form-horizontal" role="form" action="/manage/companyCreate" enctype="multipart/form-data" method="post">
	{!! csrf_field() !!}
	<div class="g-backrealdetails clearfix bor-border">

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 公司名称：</p>
		<p class="col-sm-4">
			<input type="text" placeholder="长度为1-6位" id="form-field-1" name="name"  class="col-xs-10 col-sm-5" value="">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>
	<div class="bankAuth-bottom clearfix col-xs-12">
		<label class="col-sm-1 control-label no-padding-right" for="form-field-1"><strong>上传LOGO</strong>  </label>
		<div class="col-sm-4">
			<div class="memberdiv pull-left">
				<div class="position-relative">
					<input type="file" id="id-input-file-3" name="pic" />
				</div>
			</div>
		</div>
	</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 公司规模：</p>
			<select name="scale">
				@foreach($company_scales as $company_scale)
					<option value="{{$company_scale->id}}">{{$company_scale->scale}}</option>
				@endforeach
			</select>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 公司行业：</p>
			<select name="industry">
				@foreach($company_industies as $company_industy)
					<option value="{{$company_industy->id}}">{{$company_industy->industry}}</option>
				@endforeach
			</select>
			</p>
		</div>
		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1"> 融资阶段：</p>
			<select name="financing">
				@foreach($company_financings as $company_financing)
					<option value="{{$company_financing->id}}">{{$company_financing->financing}}</option>
				@endforeach
			</select>
			</p>
		</div>

		<div class="bankAuth-bottom clearfix col-xs-12">
			<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > EMAIL：</p>
			<p class="col-sm-4">
				<input type="text" placeholder="" id="form-field-1" name="email"  class="col-xs-10 col-sm-5" value="">
				<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
			</p>
		</div>


		<div class="bankAuth-bottom clearfix col-xs-12">
			<p  class="col-sm-1 control-label no-padding-left">所在地：</p>
			<div class="col-sm-6">
				<div class="row">
					<p class="col-sm-4">
						<select name="province" id="province" class="form-control validform-select Validform_error" onchange="checkprovince(this)">
							<option value="" id="province-back">请选择省份</option>
							@foreach($province as $item)
								<option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
							@endforeach
						</select>
					</p>
					<p class="col-sm-4">

							<select class="form-control  validform-select" name="city" id="city" onchange="checkcity(this)">
									<select class="form-control  validform-select" style="display: none;" name="city" id="city" onchange="checkcity(this)">
									</select>
					</p>
					<p class="col-sm-4">
							<select class="form-control  validform-select" name="area" id="area">
									<select class="form-control  validform-select" style="display:none;" name="area" id="area">
									</select>

					</p>
				</div>
			</div>
		</div>

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 详细地址：</p>
		<p class="col-sm-4">
			<input type="text" placeholder="长度为1-6位" id="form-field-1" name="address"  class="col-xs-10 col-sm-5" value="">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
		</p>
	</div>

	<div class="bankAuth-bottom clearfix col-xs-12">
		<p class="col-sm-1 control-label no-padding-left" for="form-field-1" > 电话：</p>
		<p class="col-sm-4">
			<input type="text" placeholder="长度为1-6位" id="form-field-1" name="phone"  class="col-xs-10 col-sm-5" value="">
			<span class="help-inline col-xs-12 col-sm-7"><i class="light-red ace-icon fa fa-asterisk"></i></span>
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
	</div>
</form>

{!! Theme::widget('popup')->render() !!}
{{--{!! Theme::widget('editor')->render() !!}--}}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('chosen', 'plugins/ace/css/chosen.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('style','css/blue/style.css') !!}

{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('chosen','plugins/ace/js/chosen.jquery.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('backstage', 'js/doc/successcase.js') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}




{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}

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
</script>







