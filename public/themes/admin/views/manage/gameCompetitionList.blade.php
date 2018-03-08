<h3 class="header smaller lighter blue mg-top12 mg-bottom20">单人赛列表</h3>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix  well">
            <div class="form-inline search-group">
                <form  role="form">
                    <div class="form-inline search-group" >
                        <div class="form-group search-list width285">
                            <label class="">状态　</label>
                            <select name="group_id">
                                <option value="1" @if(isset($param['group_id']) && $param['group_id']== 3)selected @endif>王者荣耀</option>
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
                <button type="button" class="btn btn-primary btn-sm"><a href="/manage/game/competition/add/0" style="color: white">添加新赛制</a> </button>
            </div>
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>

                    <th class="center"> </th>
                    <th>编号</th>
                    <th>赛制</th>
                    <th>创建时间</th>

                    <th>操作</th>
                </tr>
                </thead>
                <form action="/manage/taskMultiHandle" method="post" id="FromSubmit">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    <tbody>
                    @foreach($user_game_rules as $user_game_rule)
                        <tr id = "tr_{!! $user_game_rule['id'] !!}">

                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox"  class="ace check" name="ckb[]" value="{!! $user_game_rule['id'] !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>

                            <td>
                                {!! $user_game_rule['id'] !!}
                            </td>
                            <td>{!! $user_game_rule['name'] !!}</td>
                            <td class="hidden-480">{!! $user_game_rule['created_at'] !!}</td>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    {{--<a class="btn btn-xs btn-info" href="{{$user_game_rule->id}}/edit">
                                        <i class="fa fa-edit"></i>编辑
                                    </a>--}}
                                    <a class="btn btn-xs btn-danger" onclick="del({{$user_game_rule['id']}})" href="javascript:void(0)">
                                        <i class="fa fa-trash-o"></i>删除
                                    </a>
                                    <a  href="/manage/game/competition/add/{{$user_game_rule['id']}}" title="添加" class="btn btn-xs btn-orange">
                                        <i class="fa fa-edit bigger-120"></i>添加
                                    </a>
                                   {{--
                                    <a href="/manage/taskDetail/{{ $single->id }}" class="btn btn-xs btn-info">
                                        <i class="ace-icon fa fa-edit bigger-120">详情</i>
                                    </a>--}}

                                </div>

                            </td>
                        </tr>
                        @if(isset($user_game_rule['_child']))
                            @foreach($user_game_rule['_child'] as $v)
                                <tr id = "tr_{!! $v['id'] !!}">

                                    <td class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox"  class="ace check" name="ckb[]" value="{!! $v['id'] !!}"/>
                                            <span class="lbl"></span>
                                        </label>
                                    </td>

                                    <td>
                                        {!! $v['id'] !!}
                                    </td>
                                    <td>&nbsp;&nbsp;-|&nbsp;&nbsp;{!! $v['name'] !!}</td>
                                    <td class="hidden-480">{!! $v['created_at'] !!}</td>
                                    <td>
                                        <div class="hidden-sm hidden-xs btn-group">
                                            {{--<a class="btn btn-xs btn-info" href="{{$user_game_rule->id}}/edit">
                                                <i class="fa fa-edit"></i>编辑
                                            </a>--}}
                                            <a class="btn btn-xs btn-danger" onclick="del({{$v['id']}})" href="javascript:void(0)">
                                                <i class="fa fa-trash-o"></i>删除
                                            </a>
                                            {{--
                                             <a href="/manage/taskDetail/{{ $single->id }}" class="btn btn-xs btn-info">
                                                 <i class="ace-icon fa fa-edit bigger-120">详情</i>
                                             </a>--}}

                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </form>
            </table>
        </div>
        <div class="row">
            {{--@if(isset($merge['status']) && $merge['status'] == '1')
            <div class="col-xs-12">
                <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                	<label class="position-relative mg-right10">
                        <input type="checkbox" class="ace" id="checkAll" value="1" />
                        <span class="lbl"> 全选</span>
                    </label>
                    <button type="submit" id="allTaskHandle" class="btn btn-primary btn-sm">批量审核</button>
                </div>
            </div>
            @endif--}}
            <div class="space-10 col-xs-12"></div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">

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

    function del(id){
        var _token = $("#_token").val();
        $.post('/manage/game/competitionDel',{id:id,_token:_token}, function (msg){
            if(msg){
                $("#tr_"+msg).remove();
            }
        })
    }
</script>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

{!! Theme::asset()->container('custom-js')->usePath()->add('checked-js', 'js/checkedAll.js') !!}
