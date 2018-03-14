<h3 class="header smaller lighter blue mg-top12 mg-bottom20">团队赛列表</h3>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix  well">
            <div class="form-inline search-group">
                <form  role="form" action="/manage/game/team/{{$type}}">
                    <div class="form-inline search-group" >
                        <div class="form-group search-list width285">
                            <label class="">状态　</label>
                            <select name="competition">
                                <option value="0" @if(isset($param['competition']) && $param['competition']== 0)selected @endif>未报名</option>
                                @foreach($user_game_rules as $user_game_rule)
                                    <option value="{{$user_game_rule->id}}" @if(isset($param['competition']) && $param['competition']== $user_game_rule->id)selected @endif>{{$user_game_rule->name}}</option>
                                @endforeach
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
                <button type="button" class="btn btn-primary btn-sm"><a href="/manage/game/add" style="color: white">创建战队</a> </button>
            </div>

            <div class="widget-toolbar no-border pull-left no-padding">
                <ul class="nav nav-tabs">
                    <li class="@if($type == 0) active @endif">
                        <a href="/manage/game/team/0">战队列表</a>
                    </li>

                    <li class="@if($type == 1) active @endif">
                        <a  href="/manage/game/team/1">自定义战队列表</a>
                    </li>
                </ul>
            </div>

            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>

                    <th class="center"> </th>
                    <th>编号</th>
                    <th>战队名</th>
                    <th>战队LOGO</th>

                    <th>
                        战队人数
                    </th>
                    <th>操作</th>
                </tr>
                </thead>
                <form action="/manage/taskMultiHandle" method="post" id="FromSubmit">
                    {!! csrf_field() !!}
                    <tbody>
                    @foreach($teams as $team)
                        <tr id = "tr_{!! $team->id !!}">

                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox"  class="ace check" name="ckb[]" value="{!! $team->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>

                            <td>
                                {!! $team->id !!}
                            </td>
                            <td>{!! $team->team_name !!}</td>
                            <td class="hidden-480">
                                <img src = "/{!! $team->logo !!}" alt = "暂无图片" height="50px" width="50px">
                            </td>
                            <td>{!! $team->total !!}</td>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    @if($team->remark == 5)
                                       <a class="btn btn-xs btn-info" href="/manage/game/{{$team->id}}/teamEdit">
                                            <i class="fa fa-edit"></i>编辑
                                        </a>
                                        <a class="btn btn-xs btn-danger" onclick="del({{$team->id}})" href="javascript:void(0)">
                                            <i class="fa fa-trash-o"></i>删除
                                        </a>
                                    @else
                                        <a href="/manage/game/{{$team->id}}/teamDetail" class="btn btn-xs btn-info">
                                            <i class="ace-icon fa fa-edit bigger-120">详情</i>
                                        </a>
                                    @endif
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </form>
            </table>
        </div>
        <div class="row">
            <div class="space-10 col-xs-12"></div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
                    {!! $teams->appends($param)->render() !!}共计{{$teams->total()}}条数据
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
</div><!-- /.row -->
<script>
    function del(id){
        var _token = $("#_token").val();
        $.post('/manage/game/teamDel',{id:id,_token:_token}, function (msg){
            if(msg){
                $("#tr_"+msg).remove();
            }
            if(msg == 0){
                alert(1);
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
