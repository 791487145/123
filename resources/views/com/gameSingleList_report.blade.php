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
                       {{-- @if($param['competition'] != 999 && $param['competition'] != 0)
                            <div class="form-group search-list width285">
                                <label class="">参赛结果　</label>
                                <select name="match_result">
                                    <option value="999"@if(isset($param['match_result']) && $param['match_result']== 1)selected @endif>全部</option>
                                    <option value="1"@if(isset($param['match_result']) && $param['match_result']== 1)selected @endif>未标记</option>
                                    <option value="2"@if(isset($param['match_result']) && $param['match_result']== 2)selected @endif>输</option>
                                    <option value="3" @if(isset($param['match_result']) && $param['match_result']== 3)selected @endif>赢</option>
                                </select>
                            </div>
                        @endif--}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
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

