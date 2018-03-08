
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">校园招聘</h3>
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#basic">校园招聘管理</a>
            </li>

            <li class="">
                <a  href="/manage/addCampus">添加招聘信息</a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div>
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center"></th>
                    <th>编号</th>
                    <th>公司名称</th>
                    <th>公司规模</th>
                    <th>岗位名称</th>
                    <th>薪资</th>
                    <th>联系方式</th>
                    <th>操作</th>
                </tr>
                </thead>
                <form action="/manage/campusHandle" method="post" id="FromSubmit">
                    {!! csrf_field() !!}
                    <tbody>
                    @if(!empty($campus))
                    @foreach($campus as $item)
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox"  class="ace check" name="ckb[]" value="{!! $item->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{!! $item->id !!}</td>
                            <td>{!! $item->company_name !!}</td>
                            <td>{!! $item->type_name !!}</td>
                            <td>{!! $item->post_name !!}</td>
                            <td>{!! $item->salary !!}</td>
                            <td>{!! $item->phone !!}</td>
                            <td>
                                <a class="btn btn-xs btn-info" href="campusDetail/{{ $item['id'] }}">
                                    <i class="fa fa-edit bigger-120"></i>编辑
                                </a>
                                <a  href="campusDel/{{ $item['id'] }}" title="删除" class="btn btn-xs btn-danger">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </form>
            </table>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                	<label class="position-relative mg-right10">
                        <input type="checkbox" class="ace" id="checkAll" value="1" />
                        <span class="lbl"> 全选</span>
                    </label>
                    <button type="submit" id="allTaskHandle" class="btn btn-primary btn-sm">批量删除</button>
                </div>
            </div>
            <div class="space-10 col-xs-12"></div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
                    {!! $campus->render() !!}
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
