<div class="row">
    <div class="col-xs-12">
        <div class="clearfix  well">
            <div class="form-inline search-group">
                <form  role="form">
                    <div class="form-inline search-group" >
                        <div class="form-group search-list width285">
                            <label class="">状态　</label>
                            <select name="competition">
                                @foreach($user_game_rules as $user_game_rule)
                                    <option value="{{$user_game_rule->id}}" @if(isset($param['competition']) && $param['competition']== $user_game_rule->id)selected @endif>{{$user_game_rule->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="status" value="{{$status}}">

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                        </div>
                       {{-- <div class="form-group">
                            <button type="button" class="btn btn-primary btn-sm">若当前比赛完结，进入{{$user_game_rule_ch->name}}比赛，请按确认</button>
                        </div>--}}
                    </div>

                </form>

            </div>
        </div>
        <div>
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center"> </th>
                    <th>编号</th>
                    <th>用户名</th>
                    <th>游戏名称</th>

                    <th>
                        游戏服务区
                    </th>
                    <th>
                        组别
                    </th>
                    <th>
                        分数
                    </th>
                    <th>
                        对手组别
                    </th>
                    <th>
                        结果
                    </th>
                    <th>操作</th>
                </tr>
                </thead>
                <form action="/manage/taskMultiHandle" method="post" id="FromSubmit">
                    {!! csrf_field() !!}
                    <tbody>
                    @foreach($singles as $single)
                        <tr>
                            <td rowspan = '{{count($single->result)}}' class="center">

                                <label class="pos-rel">
                                    <input type="checkbox"  class="ace check" name="ckb" value="{!! $single->id !!}"/>
                                    <span class="lbl"></span>
                                </label>

                            </td>

                            <td rowspan = '{{count($single->result)}}'>
                                {!! $single->id !!}
                            </td>
                            <td rowspan = '{{count($single->result)}}'>
                                {!! $single->name !!}
                            </td>
                            <td rowspan = '{{count($single->result)}}' class="hidden-480">
                                {!! $single->game_name !!}
                            </td>
                            <td rowspan = '{{count($single->result)}}'>
                                {!! $single->game_server !!}
                            </td>
                            <td rowspan = '{{count($single->result)}}'>
                                {!! $single->group !!}组{!! $single->num !!}号
                            </td>
                            <td rowspan = '{{count($single->result)}}'>
                                @if(isset($single->sort_vote))
                                    {{$single->sort_vote->sort}}
                                @else
                                    0
                                @endif
                            </td>
                        @if($single->result->isEmpty())
                            <td>无</td>
                            <td>无</td>
                            <td>无</td>
                        @else
                            @foreach($single->result as $k=>$result)
                                @if($k >0)
                                    <tr>
                                @endif
                                <td>
                                    {!! $result->group_b_num !!}
                                </td>
                                <td>
                                    @if($result->win == 0)
                                        暂无结果
                                    @endif
                                    @if($result->win == $single->group_id)
                                        获胜
                                    @endif
                                    @if($result->win != 0 && $result->win != $single->group_id)
                                        失败
                                    @endif
                                </td>
                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                                       <a class="btn btn-xs btn-info" href="{{$result->id}}_{{$single->id}}/edit">
                                            <i class="fa fa-edit"></i>编辑
                                       </a>
                                    </div>
                                </td>
                                @if($k >0)
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tr>
                    @endforeach

                    <tr class="draw_lots">
                       {{-- <td colspan="4"><button type="button" class="btn btn-primary btn-sm group">分组</button></td>--}}
                        <td colspan="5"><button type="button" class="btn btn-primary btn-sm binarySectionalization">手动筛选确认</button></td>
                    </tr>

                    </tbody>
                </form>
            </table>
        </div>
        <div class="row">
            <div class="space-10 col-xs-12"></div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
                    {!! $singles->appends($param)->render() !!}共计{{$singles->total()}}条数据
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
<input type="hidden" id="competition" name="competition" value="{{$param['competition']}}">
<script>

    $(".binarySectionalization").click(function () {
        var competition = $("#competition").val();
        var _token = $("#_token").val();
        var munbox=[];
        $("input:checkbox[name='ckb']:checked").each(function() {
            //munbox += $(this).val() + ",";
            munbox.push($(this).val());
        });
        //munbox =fir.join(',');
        //alert(munbox);
        if(munbox.length > 2){
            alert("一次只能选择两个");
            return false
        }
        $.post('/manage/game/hx/sectionalization',{_token:_token,type:1,competition:competition,id:munbox}, function (msg){
            alert("分组成功");
            location.reload();
        })
    })
</script>

