<div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div class="widget-body ">
                <h3 class="header smaller lighter blue mg-top12 mg-bottom20">互评记录</h3>
                <div class="widget-main paddingTop no-padding-left no-padding-right">
                    <div class="tab-content padding-4">
                        <div id="basic" class="tab-pane active">
                            <div class="table-responsive clearfix  well">
                                <form role="form" class="form-inline search-group" action="/manage/getCommentList" method="get">
                                    <div class="form-group search-list width285">
				                        {{--<label for="name" class="">用户名　　</label>--}}
                                        用户名&nbsp;&nbsp;
				                        <input class="form-control" type="text" name="commentId" @if(isset($merge['commentId']))value="{!! $merge['commentId'] !!}" @endif>
				                    </div>
				                    <div class="form-group search-list ">
				                        <label for="name" class="">来自&nbsp;&nbsp;</label>
				                        <select name="from" >
                                            <option value="0" {!! (!isset($merge['from']) || $merge['from']==0)?'selected':'' !!}>全部</option>
                                            <option value="1" {!!(isset($merge['from']) && $merge['from']==1)?'selected':'' !!}>来自雇主</option>
                                            <option value="2" {!!(isset($merge['from']) && $merge['from']==2)?'selected':'' !!}>来自威客</option>
                                        </select>
				                    </div>
				                    <div class="form-group">
				                    	 <button class="btn btn-primary btn-sm">搜索</button>
				                    </div>
				                    <div class="space"></div>
				                    <div class="form-inline search-group " >
				                        {{--<div class="form-group search-list width285">
				                            <label class="">结果排序　</label>
				                            <select name="orderBy">
                                                <option value="id">默认排序</option>
                                                <option value="created_at">时间排序</option>
                                            </select>
                                            <select name="orderByType">
                                                <option value="asc" {!! (!isset($merge['orderByType']) || $merge['orderByType']=='asc')?'selected':'' !!}>递增</option>
                                                <option value="desc" {!! (isset($merge['orderByType']) && $merge['orderByType']=='desc')?'selected':'' !!}>递减</option>
                                            </select> 
				                        </div>--}}
				                        {{--<div class="form-group">
				                            <label class="">显示条数　 </label>
				                            <select name="pageSize">
                                                <option {!!(!isset($merge['pageSize']) || $merge['pageSize']==10)?'selected':'' !!} value="10">10条</option>
                                                <option {!! (isset($merge['pageSize']) && $merge['pageSize']==20)?'selected':'' !!} value="20">20条</option>
                                                <option {!! (isset($merge['pageSize']) && $merge['pageSize']==30)?'selected':'' !!} value="30">30条</option>
                                           </select>
				                        </div>--}}
                                        <div class="form-group search-list">
                                            时间&nbsp;&nbsp;
                                            <div class="input-daterange input-group">
                                                <input type="text" name="start" class="input-sm form-control" @if(isset($merge['start']))value="{!! $merge['start'] !!}" @endif>
                                                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                                <input type="text" name="end" class="input-sm form-control" @if(isset($merge['end']))value="{!! $merge['end'] !!}" @endif>
                                            </div>
                                        </div>
				                    </div>
                                </form>
                            </div>
                            <div class="space-6"></div>
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>
                                            编号
                                        </th>
                                        <th>
                                            所属模型
                                        </th>
                                        <th>查看详情</th>
                                        <th>来自</th>
                                        <th>对用户</th>
                                        <th>
                                            评价
                                        </th>
                                        <th>
                                            时间
                                        </th>
                                        <th>
                                            操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['data'] as $v)
                                            <tr>
                                        <td>
                                            <label>
                                                {{--<input type="checkbox" class="ace" name="chk"/>--}}
                                                <span class="lbl"></span>
                                                {{ $v['id'] }}
                                            </label>
                                        </td>

                                        <td>
                                            悬赏任务
                                        </td>
                                        <td>
                                            <a href="/task/{{ $v['task_id'] }}">查看任务</a>
                                        </td>
                                        <td>
                                            {{ $v['from_nickname'] }}
                                        </td>
                                        <td>
                                            {{ $v['to_nickname'] }}
                                        </td>
                                        <td>
                                            {{ str_limit($v['comment'],10) }}
                                        </td>
                                        <td>
                                            {{ $v['created_at'] }}
                                        </td>
                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                <a title="删除" href="/manage/commentDel/{{ $v['id'] }}" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                                </a>
                                            </div>
                                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                <div class="inline position-relative">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-left dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
                                                                <span class="red">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ $data['current_page'] }} / {{ $data['last_page'] }}页
                                </div>
                               <div class="space-10 col-xs-12"></div>
                                <div class="col-sm-12">
                                    <div class="dataTables_paginate paging_bootstrap text-right row">
                                        <ul class="pagination">
                                            {!! $comment->appends($merge)->render() !!}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}