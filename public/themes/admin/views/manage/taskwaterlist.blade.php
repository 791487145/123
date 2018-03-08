<h3 class="header smaller lighter blue mg-top12 mg-bottom20">任务列表</h3>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix  well">
            <div class="form-inline search-group">
                <form  role="form" action="/manage/taskList" method="get">
                    <div class="form-inline search-group" >
                        <div class="form-group search-list">
                            <label for="name">任务标题　</label>
                            <input type="text" class="form-control" id="task_title" name="task_title" placeholder="请输入任务标题" @if(isset($merge['task_title']))value="{!! $merge['task_title'] !!}"@endif>
                        </div>
                        <div class="form-group search-list width285">
                            <label class="">状态　</label>
                            <select name="status">
                                <option value="0">全部</option>
                                <option value="2" @if(isset($merge['status']) && $merge['status'] == '2')selected="selected"@endif>已发布</option>
                                <option value="3" @if(isset($merge['status']) && $merge['status'] == '3')selected="selected"@endif>进行中</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
        <div>
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-sm" ><a href="taskWater/add" style="color: white">添加任务</a> </button>
            </div>
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
                    <th>操作</th>
                </tr>
                </thead>
                <form action="/manage/taskMultiHandle" method="post" id="FromSubmit">
                    {!! csrf_field() !!}
                    <tbody>
                    @foreach($task_waters as $item)
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
                            <td>{!! $item->username !!}</td>
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
                                @endif
                            </td>
                           {{-- <td>
                                @if(isset($item->verified_at)){!! $item->verified_at !!} @endif
                            </td>--}}

                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <a href="taskWater/{{$item->id}}/taskDetail" class="btn btn-xs btn-info">
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
                    {!! $task_waters->appends($merge)->render() !!}
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
