
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">任务列表</h3>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix  well">
            <div class="form-inline search-group">
                <form  role="form" action="/manage/taskList" method="get">
                    <div class="form-group search-list">
                        <label for="name">任务标题　</label>
                        <input type="text" class="form-control" id="task_title" name="task_title" placeholder="请输入任务标题" @if(isset($merge['task_title']))value="{!! $merge['task_title'] !!}"@endif>
                    </div>
                    <div class="form-group search-list">
                        <label for="namee">用户名　　</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名" @if(isset($merge['username']))value="{!! $merge['username'] !!}"@endif>
                    </div>
                    <div class="form-group">
                    	<button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                    <div class="space"></div>
                    <div class="form-inline search-group" >
                        <div class="form-group search-list">
                            <select class="" name="time_type">
                                <option value="task.created_at" @if(isset($merge['time_type']) && $merge['time_type'] == 'task.created_at')selected="selected"@endif>发布时间</option>
                                <option value="task.verified_at" @if(isset($merge['time_type']) && $merge['time_type'] == 'task.verified_at')selected="selected"@endif>审核时间</option>
                            </select>
                            <div class="input-daterange input-group">
                                <input type="text" name="start" class="input-sm form-control" value="@if(isset($merge['start'])){!! $merge['start'] !!}@endif">
                                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                <input type="text" name="end" class="input-sm form-control" value="@if(isset($merge['end'])){!! $merge['end'] !!}@endif">
                            </div>
                        </div>
                        <div class="form-group search-list width285">
                            <label class="">状态　</label>
                            <select name="status">
                                <option value="0">全部</option>
                                <option value="1" @if(isset($merge['status']) && $merge['status'] == '1')selected="selected"@endif>待审核</option>
                                <option value="2" @if(isset($merge['status']) && $merge['status'] == '2')selected="selected"@endif>已发布</option>
                                <option value="3" @if(isset($merge['status']) && $merge['status'] == '3')selected="selected"@endif>进行中</option>
                                <option value="4" @if(isset($merge['status']) && $merge['status'] == '4')selected="selected"@endif>申请超时</option>
                                <option value="5" @if(isset($merge['status']) && $merge['status'] == '5')selected="selected"@endif>提交完成</option>
                                <option value="6" @if(isset($merge['status']) && $merge['status'] == '6')selected="selected"@endif>完成</option>
                                <option value="7" @if(isset($merge['status']) && $merge['status'] == '7')selected="selected"@endif>失败</option>
                                <option value="9" @if(isset($merge['status']) && $merge['status'] == '9')selected="selected"@endif>审核失败</option>
                                <option value="10" @if(isset($merge['status']) && $merge['status'] == '10')selected="selected"@endif>待付款</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div>
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    @if(isset($merge['status']) && $merge['status'] == '1')
                    <th class="center"> </th>
                    @endif
                    <th>编号</th>
                    <th>用户名</th>
                    <th>任务标题</th>

                    <th>
                        发布时间
                    </th>
                    <th>
                        状态
                    </th>
                    <th>
                        审核时间
                    </th>
                    <th>处理</th>
                </tr>
                </thead>
                <form action="/manage/taskMultiHandle" method="post" id="FromSubmit">
                    {!! csrf_field() !!}
                    <tbody>
                    @foreach($task as $item)
                        <tr>
                            @if(isset($merge['status']) && $merge['status'] == '1')
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox"  class="ace check" name="ckb[]" value="{!! $item->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            @endif
                            <td>
                                <a href="#">{!! $item->id !!}</a>
                            </td>
                            <td>{!! $item->name !!}</td>
                            <td class="hidden-480">{!! $item->title !!}
                                {{--@if($item->status >=2)<a target="_blank" href="/task/{!! $item->id  !!}">{!! $item->title !!}</a>@else{!! $item->title !!} @endif--}}
                            </td>
                            <td>{!! $item->created_at !!}</td>
                            <td class="hidden-480">
                                @if($item->status == 1)
                                    <span class="label label-sm label-warning">待审核</span>
                                @elseif($item->status == 2)
                                    <span class="label label-sm label-success">已发布</span>
                                @elseif($item->status == 3)
                                    <span class="label label-sm label-success ">进行中</span>
                                @elseif($item->status == 4)
                                    <span class="label label-sm label-success">申请超时</span>
                                @elseif($item->status == 5)
                                    <span class="label label-sm label-success">提交完成</span>
                                @elseif($item->status == 6)
                                    <span class="label label-sm label-success">完成</span>
                                @elseif($item->status == 7)
                                    <span class="label label-sm label-danger ">失败</span>
                                @elseif($item->status == 9)
                                    <span class="label label-sm label-danger">审核失败</span>
                                @elseif($item->status == 10)
                                    <span class="label label-sm label-danger">待付款</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($item->verified_at)){!! $item->verified_at !!} @endif
                            </td>

                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    @if($item->status == 1)
                                        <a class="btn btn-xs btn-success" href="/manage/taskPass/{!! $item->id !!}">
                                            <i class="ace-icon fa fa-check bigger-120">审核通过</i>
                                        </a>
                                        {{--<a class="btn btn-xs btn-danger" href="/manage/taskHandle/{!! $item->id !!}/deny">--}}
                                            {{--<i class="ace-icon fa fa-minus-circle bigger-120"> 审核失败</i>--}}
                                        {{--</a>--}}
                                    @endif

                                    <a href="/manage/taskDetail/{{ $item->id }}" class="btn btn-xs btn-info">
                                        <i class="ace-icon fa fa-edit bigger-120">详情</i>
                                    </a>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </form>
            </table>
        </div>
        <div class="row">
            @if(isset($merge['status']) && $merge['status'] == '1')
            <div class="col-xs-12">
                <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                	<label class="position-relative mg-right10">
                        <input type="checkbox" class="ace" id="checkAll" value="1" />
                        <span class="lbl"> 全选</span>
                    </label>
                    <button type="submit" id="allTaskHandle" class="btn btn-primary btn-sm">批量审核</button>
                </div>
            </div>
            @endif
            <div class="space-10 col-xs-12"></div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
                    {!! $task->appends($merge)->render() !!}
                </div>
            </div>
        </div>
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
