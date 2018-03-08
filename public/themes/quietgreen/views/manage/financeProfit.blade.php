            <div class="widget-header mg-bottom20 mg-top12 widget-well">
                <div class="widget-toolbar no-border pull-left no-padding">
                    <ul class="nav nav-tabs">
                        <li class="">
                            <a href="/manage/financeStatement">网站收支</a>
                        </li>

                        <li class="">
                            <a href="/manage/financeRecharge">充值记录</a>
                        </li>
                        <li class="">
                            <a href="/manage/financeWithdraw">提现记录</a>
                        </li>
                        <li class="active">
                            <a href="/manage/financeProfit">利润统计</a>
                        </li>
                    </ul>
                </div>
            </div>
            <form class="form-inline" method="get" action="{!! url('manage/financeProfit') !!}">
                <div class="well">
                    <div class="form-group search-list">
                        <label for="">来源　</label>
                        <select name="from">
                            <option @if(isset($from) && $from == 'task')selected="selected"@endif value="task">任务佣金</option>
                            <option @if(isset($from) && $from == 'tool')selected="selected"@endif value="tool">增值服务</option>
                            <option @if(isset($from) && $from == 'cashout')selected="selected"@endif value="cashout">用户提现</option>
                        </select>
                    </div>
                    <div class="form-group search-list">
                        <label class="">时间　</label>
                        <div class="input-daterange input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                            <input type="text" class="input-sm form-control" name="start" @if(isset($start))value="{!! $start !!}" @endif />
                            <span class="input-group-addon">
                                <i class="fa fa-exchange"></i>
                            </span>
                            <input type="text" class="input-sm form-control" name="end" @if(isset($end))value="{!! $end !!}" @endif/>
                        </div>
                    </div>
                    <div class="form-group">
                        　<button type="submit" class="btn btn-sm btn-primary">搜索</button>
                    </div>
                </div>
            </form>
            <!--任务佣金-->
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover mg-bottom0">
                    @if($from == 'task')
                    <thead>
                    <tr>
                        <th>
                            来源
                        </th>
                        <th>任务编号</th>
                        <th>用户名</th>
                        <th>托管金额</th>
                        <th>时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($list))
                    @foreach($list as $item)
                    <tr>
                        <td>任务佣金</td>
                        <td>{!! $item->task_id !!}</td>
                        <td>{!! $item->name !!}</td>
                        <td>{!! $item->cash !!}</td>
                        <td>{!! $item->created_at !!}</td>
                    </tr>
                    @endforeach
                    {{--<tr>
                        <td colspan="5">
                            {!! $list->appends($search)->render() !!}
                        </td>
                    </tr>--}}
                    @endif
                    </tbody>
                    @elseif($from == 'tool')
                    <thead>
                    <tr>
                        <th class="center">
                            来源
                        </th>
                        <th class="hidden-480">用户名</th>
                        <th class="hidden-480">金额</th>
                        <th>时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($list))
                    @foreach($list as $item)
                    <tr>
                        <td class="center">增值服务</td>
                        <td class="hidden-480">{!! $item->name !!}</td>
                        <td>{!! $item->cash !!}</td>
                        <td>{!! $item->created_at !!}</td>
                    </tr>
                    @endforeach
                    {{--<tr>
                        <td colspan="4">
                            {!! $list->appends($search)->render() !!}
                        </td>
                    </tr>--}}
                    @endif
                    </tbody>
                    @elseif($from == 'cashout')
                    <thead>
                    <tr>
                        <th>
                            来源
                        </th>
                        <th>用户名</th>
                        <th>提现金额</th>
                        <th>到账金额</th>
                        <th>手续费</th>
                        <th>时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($list))
                    @foreach($list as $item)
                    <tr>
                        <td>用户提现</td>
                        <td>{!! $item->name !!}</td>
                        <td>{!! $item->cash !!}</td>
                        <td>{!! $item->real_cash !!}</td>
                        <td>{!! $item->fees !!}</td>
                        <td>{!! $item->created_at !!}</td>
                    </tr>
                    @endforeach

                    @endif
                    </tbody>
                    @endif
                </table>
                <div class="well">
                    总计：{!! $sum !!}
                </div>
                <div>
                    <div class="dataTables_paginate paging_bootstrap pull-right text-right row">
                        {!! $list->appends($search)->render() !!}
                    </div>
                </div>
            </div>

{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('statement-js', 'js/statement.js') !!}