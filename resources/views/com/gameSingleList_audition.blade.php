<div class="row">
    <div class="col-xs-12">
        <div class="clearfix  well">
            <div class="form-inline search-group">
                <form  role="form">
                    <div class="form-inline search-group" >
                        <div class="form-group search-list width285">
                            <label class="">状态　</label>
                            <select name="competition">
                                <option value="999"@if(isset($param['competition']) && $param['competition']== 999)selected @endif>全部</option>
                                <option value="0" @if(isset($param['competition']) && $param['competition']== 0)selected @endif>未分组</option>
                                @foreach($user_game_rules as $user_game_rule)
                                    <option value="{{$user_game_rule->id}}" @if(isset($param['competition']) && $param['competition']== $user_game_rule->id)selected @endif>{{$user_game_rule->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="status" value="{{$status}}">

                        <div class="form-group search-list width285">
                            <label class="">参赛结果　</label>
                            <select name="group_child">
                                @foreach($user_game_rules_child as $value)
                                    <option value="{{$value['id']}}"@if(isset($param['group_child']) && $param['group_child']== 1)selected @endif>{{$value['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-sm">若当前比赛完结，进入{{$user_game_rule_ch->name}}比赛，请按确认</button>
                        </div>
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

                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox"  class="ace check" name="ckb[]" value="{!! $single->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>

                            <td>
                                {!! $single->id !!}
                            </td>
                            <td>{!! $single->name !!}</td>
                            <td class="hidden-480">{!! $single->game_name !!}
                                {{--@if($item->status >=2)<a target="_blank" href="/task/{!! $item->id  !!}">{!! $item->title !!}</a>@else{!! $item->title !!} @endif--}}
                            </td>
                            <td>{!! $single->game_server !!}</td>
                            <td>
                                {!! $single->group !!}
                            </td>
                            <td>
                                {!! $single->group_b !!}
                            </td>
                            <td>
                                {!! $single->match_result !!}
                            </td>

                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <a class="btn btn-xs btn-info" href="{{$single->id}}/edit">
                                        <i class="fa fa-edit"></i>编辑
                                    </a>
                                    {{-- <a class="btn btn-xs btn-danger" href="managerDel/{{ $single->id }}">
                                         <i class="fa fa-trash-o"></i>删除
                                     </a>

                                     <a href="/manage/taskDetail/{{ $single->id }}" class="btn btn-xs btn-info">
                                         <i class="ace-icon fa fa-edit bigger-120">详情</i>
                                     </a>--}}

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
                    {!! $singles->appends($param)->render() !!}共计{{$singles->total()}}条数据
                </div>
            </div>
        </div>
    </div>
</div>

