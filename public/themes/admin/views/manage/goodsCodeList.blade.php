
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">物品兑换码</h3>
<div class="well">
    <div class="form-inline search-group">
        <form  role="form" action="/manage/codeList" method="get">
            <div class="form-group search-list">
                <select class="" name="code_sign">
                    <option value="">请选择兑换码标志</option>
                    @foreach($code_sign as $v)
                        <option value="{{$v['sign']}}" @if(isset($search['code_sign']) && $v['sign'] == $search['code_sign']) selected="selected" @endif>{{$v['describe']}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">搜索</button>
            </div>
        </form>
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
                    <th>兑换码</th>
                    <th>兑换数量</th>
                    <th>兑换标志</th>
                    <th>操作</th>
                </tr>
                </thead>
                <form action="/manage/goodsCodeHandle" method="post" id="FromSubmit">
                    {!! csrf_field() !!}
                    <tbody>
                    @if(!empty($goods_code))
                    @foreach($goods_code as $item)
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox"  class="ace check" name="ckb[]" value="{!! $item->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{!! $item->id !!}</td>
                            <td>{!! $item->code !!}</td>
                            <td>{!! $item->amount !!}</td>
                            <td>{!! $item->code_sign !!}</td>
                            <td>
                                <a  href="goodsCodeDel/{{ $item['id'] }}" title="删除" class="btn btn-xs btn-danger">
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
                    {!! $goods_code->render() !!}
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
