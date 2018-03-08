<div class="row">
    <div class="col-xs-12">

        <!-- <div class="dataTables_borderWrap"> -->
        <div>
            <form class="form-horizontal" role="form" method="post" action="{{Theme::getRoute()}}">
                <table id="sample-table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                            <label class="position-relative">
                                <input type="checkbox" class="ace"/>
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>编号</th>
                        <th>行业</th>
                        <th>父分类</th>
                        <th class="hidden-480">名称</th>

                        <th>排序</th>
                        <th class="hidden-480">
                            状态
                        </th>


                        <th>处理</th>
                    </tr>
                    </thead>

                    {!! csrf_field() !!}
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" name="ckb[]" value="{!! $item->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>

                            <td>
                                {!! $item->id !!}
                            </td>
                            <td>

                                    @foreach($industry as $k=>$v)

                                        <laber for="ck_{!! $item->id !!}_{!!  $k!!}"><input id="ck_{!! $item->id !!}_{!!  $k!!}" type="checkbox" name="field[{!! $item->id !!}][type][]" value="{!! $k !!}" @if(in_array($k,$item->type))checked="checked"@endif>{!! $v !!}</laber>

                                    @endforeach

                            </td>
                            <td>
                                <select name="field[{!! $item->id !!}][pid]" id="select_pid">
                                    @if($item->pid==0)
                                        <option value="0">----无----</option>
                                    @endif
                                        @foreach($parent as $k=>$v)

                                            <option value="{!! $k !!}" @if($item->pid==$k)selected="selected"@endif>{!! $v->name !!}</option>

                                        @endforeach

                                </select>
                            </td>
                            <td><input name="field[{!! $item->id !!}][name]" value="{!! $item->name !!}"></td>

                            <td><input name="field[{!! $item->id !!}][sort]" value="{!! $item->sort !!}"></td>

                            <td class="hidden-480">

                                <label>
                                    <input name="field[{!! $item->id !!}][display]" type="checkbox" @if($item->display == 'on')checked="checked"@endif class="ace ace-switch ace-switch-4 btn-flat" >
                                    <span class="lbl"></span>
                                </label>

                            </td>




                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            操作
                                            <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{Theme::getRoute()}}/{!! $item->id !!}/delete">删除</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="9">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="sample-table-2_info" role="status"
                                         aria-live="polite">
                                        <button type="button" class="btn btn-info btn-sm" id="add">添加</button>
                                        <input type="hidden" id="add_count" name="add_count" value="0">
                                        <button type="submit" class="btn btn-primary btn-sm">保存</button>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </form>

        </div>
    </div>
</div><!-- /.row -->

<script type="text/javascript">

    $("#add").click( function () {
        var addCount = parseInt($("#add_count").val())+1;
        $("#sample-table tr:eq(-1)").before("<tr><td class='center'>&nbsp;</td>"+"<td>&nbsp;</td>"
                +"<td class='hidden-480'><input type='checkbox' name='add["+addCount+"][type][]' value='1'>教育培训<input type='checkbox' name='add["+addCount+"][type][]' value='2'>IT软件</td>"+ "<td><select name='add["+addCount+"][pid]'><option value='0'>顶级分类</option><option value='1'>平面视觉</option><option value='2'>技术产品</option><option value='3'>网络建设</option><option value='4'>宣传视频</option><option value='5'>环境建设</option><option value='6'>会务活动</option></select></td>"
                +"<td><input name='add["+addCount+"][name]' type='text'></td>"+"<td><input type='text' name='add["+addCount+"][sort]' value='9999'></td>" +"<td class='hidden-480'> </td></tr>"
        );
    });

</script>
