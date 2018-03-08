<h3 class="header smaller lighter blue mg-top12 mg-bottom20">团队赛详情</h3>
<div class="row">
	<div class="col-xs-12">
		<div class="clearfix  well">
			<div class="form-inline search-group">
				<div>
					战队名称:{{$user_active_team->team_name}}
				</div>
				<div>
					战队状态:{{$user_active_team->report_status}}
				</div>
				<div>
					战队总人数:{{$user_active_team->total}}
				</div>
			</div>
		</div>
		<div>
			<table id="sample-table" class="table table-striped table-bordered table-hover">
				<thead>
				<tr>

					<th class="center"> </th>
					<th>编号</th>
					<th>队员名</th>
					<th>游戏名</th>

					<th>
						战区
					</th>
					<th>
						身份
					</th>
					{{--<th>操作</th>--}}
				</tr>
				</thead>
					<tbody>
					@foreach($user_actives as $user_active)
						<tr>

							<td class="center">
								<label class="pos-rel">
									<input type="checkbox"  class="ace check" name="ckb[]" value="{!! $user_active->id !!}"/>
									<span class="lbl"></span>
								</label>
							</td>

							<td>
								{!! $user_active->id !!}
							</td>
							<td>{!! $user_active->name !!}</td>
							<td class="hidden-480">
								{!! $user_active->game_name !!}
								{{--@if($item->status >=2)<a target="_blank" href="/task/{!! $item->id  !!}">{!! $item->title !!}</a>@else{!! $item->title !!} @endif--}}
							</td>
							<td>{!! $user_active->game_server !!}</td>
							<td>
								{!! $user_active->identify !!}
							</td>

						</tr>
					@endforeach
					</tbody>

			</table>
		</div>
		{{--<div class="row">
			<div class="space-10 col-xs-12"></div>
			<div class="col-xs-12">
				<div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
					{!! $teams->appends($param)->render() !!}共计{{$teams->total()}}条数据
				</div>
			</div>
		</div>--}}
	</div>
</div><!-- /.row -->
<script>
	//全选
	$len=$('.check').length;
	$('#checkAll').on('click',function(){

		if($(this).val() ==1){
			for(var i=0 ;i<$len;i++){
				$('.check')[i].checked=true;
			}

			$(this).val(2);
		}else{
			for(var i=0 ;i<$len;i++){
				$('.check')[i].checked=false;
			}
			$(this).val(1);
		}
	})
	//批量审核
	$('#allTaskHandle').on('click',function(){
		$('#FromSubmit').submit();
	})
</script>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

{!! Theme::asset()->container('custom-js')->usePath()->add('checked-js', 'js/checkedAll.js') !!}
