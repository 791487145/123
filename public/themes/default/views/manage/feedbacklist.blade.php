
    {{--<div class="space-2"></div>
    <div class="page-header">
        <h1>
            搜索
        </h1>
    </div><!-- /.page-header -->--}}
    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">投诉建议</h3>
    <div class="row">
        <div class="col-xs-12">
            <div class="well">
                <form  role="form" action="/manage/feedbackList" class="form-inline search-group" method="get">
                    <div class="form-group search-list ">
                        <label for="namee" class="">用户　　　</label>
                        <select name="user">
                            <option value="0">全部</option>
                            <option value="1" @if(isset($merge['user']) && $merge['user'] == '1')selected="selected"@endif>用户</option>
                            <option value="2" @if(isset($merge['user']) && $merge['user'] == '2')selected="selected"@endif>游客</option>
                        </select>
                    </div>
                    <div class="form-group search-list width285">
                        <label class="">状态　</label>
                        <select name="status">
                            <option value="0">全部</option>
                            <option value="1" @if(isset($merge['status']) && $merge['status'] == '1')selected="selected"@endif>待回复</option>
                            <option value="2" @if(isset($merge['status']) && $merge['status'] == '2')selected="selected"@endif>已回复</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                    <div class="space"></div>
                    <div class="form-inline search-group" >
                        <div class="form-group search-list">
                            <label class="">时间　</label>
                            <div class="input-daterange input-group">
                                <input type="text" name="start" class="input-sm form-control" @if(isset($merge['start']))value="{!! $merge['start'] !!}" @endif>
                                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                <input type="text" name="end" class="input-sm form-control" @if(isset($merge['end']))value="{!! $merge['end'] !!}" @endif>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{--<div class="well h4 blue">投诉建议</div>--}}
            <div>
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                            <label>
                                {{--<input type="checkbox" class="ace">
                                <span class="lbl"></span>--}}
                                编号
                            </label>
                        </th>
                        <th>用户名</th>
                        <th>手机号</th>
                        <th>反馈类型</th>
                        <th>描述</th>
                        <th>
                            时间
                        </th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(!empty($feedbackList->toArray()['data']))
                    @foreach($feedbackList as $v)
                        <tr>
                            <td class="center">
                                <label>
                                    <input type="checkbox" class="ace">
                                    <span class="lbl"></span>
                                    {!! $v->id !!}
                                </label>
                            </td>
                            <td>
                                @if($v->name)
                                {!! $v->name !!}
                                @else
                                无
                                @endif
                            </td>
                            <td>
                                @if($v->phone)
                                    {!! $v->phone !!}
                                @else
                                    无
                                @endif
                            </td>
                            <td>
                                @if($v->type == 0)
                                    普通反馈
                                @elseif($v->type == 1)
                                    VIP反馈
                                @endif
                            </td>
                            <td>{!! $v->desc !!}</td>
                            <td>
                                {!! $v->created_time !!}
                            </td>
                            <td>
                                @if($v->status == '1')
                                    未处理
                                @else
                                    已处理
                                @endif

                            </td>
                            <td>
                                @if($v->status == '2')
                                <a href="/manage/feedbackDetail/{!! $v->id !!}">
                                <button class="btn btn-xs btn-success" title="查看"><i class="ace-icon fa fa-search bigger-120"></i>查看</button>
                                </a>
                                <a href="/manage/deleteFeedback/{!! $v->id !!}">
                                <button class="btn btn-xs btn-danger" title="删除"><i class="ace-icon fa fa-trash-o bigger-120"></i>删除</button>
                                </a>
                                @endif
                                @if($v->status == '1')
                                <a href="/manage/feedbackReplay/{!! $v->id !!}">
                                <button @if($v->name)title="回复"@else title="备注" @endif class="btn btn-xs btn-info">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>回复
                                </button>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_bootstrap row">
                    <div class="row">
                        <ul class="pagination">
                            {!! $feedbackList->appends($merge)->render() !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->

    {!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}

    {{--时间插件--}}
    {!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
    {!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
    {!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}