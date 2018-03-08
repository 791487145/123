

<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#need">任务需求</a>
            </li>
        </ul>
    </div>
</div>
<div class="widget-body">
    <div class="widget-main paddingTop no-padding-left no-padding-right">
        <div class="tab-content padding-4">
            <div id="need" class="tab-pane active">
                <div class="row" style="height:430px;">
                    <div class="col-lg-12">
                        <form action="/manage/taskDetailUpdate" method="post" id="seo-form" class="form-horizontal">
                            <div class="g-backrealdetails clearfix bor-border interface" style="height:430px;">
                                <div class="space-8 col-xs-12"></div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 发布人： </label>

                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $task['nickname'] }}</label>
                                        <label class="col-sm-5">手机号：{{ $task['phone'] }}</label>
                                    </div>
                                </div>

                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 领取人： </label>
                                    @if(!empty($task['to_name']))
                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $task['to_name'] }}</label>
                                        <label class="col-sm-5">手机号：{{ $task['to_mobile'] }}</label>
                                    </div>
                                    @else
                                        <div class="col-sm-9">
                                            <label class="col-sm-1">无</label>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 任务标题： </label>

                                    <div class="col-sm-9">
                                        <label class="col-sm-6">{{ $task['title'] }}</label>

                                    </div>
                                </div>

                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 托管金额： </label>

                                    <div class="col-sm-9">
                                        <label class="col-sm-1">{{ $task['bounty'] }}元</label>
                                    </div>
                                </div>
                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 发布于： </label>

                                    <div class="col-sm-9">
                                        <label class="col-sm-2">
                                            {{ date('Y-m-d H:i:s',strtotime($task['created_at'])) }}
                                        </label>
                                        <label class="col-sm-10">
                                            状态：{{ $task['status_text'] }}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group interface-bottom col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 任务描述： </label>
                                    <div class="col-sm-8">
                                        <div class="clearfix ">
                                            {!! htmlspecialchars_decode($task['desc']) !!}

                                        </div>
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                <div class="col-xs-12">
                                    <div class="clearfix row bg-backf5 padding20 mg-margin12">
                                        <div class="col-xs-12">
                                            <div class="col-sm-1 text-right"></div>
                                            <div class="col-sm-10">
                                            @if($task['status'] == 1)
                                                <a class="btn btn-xs btn-success" href="/manage/taskPass/{!! $task['id'] !!}">
                                                    <i class="ace-icon fa fa-check bigger-120">审核通过</i>
                                                </a>
                                                <a class="btn btn-xs btn-danger" href="/manage/taskNotPass/{!! $task['id'] !!}">
                                                   <i class="ace-icon fa fa-minus-circle bigger-120"> 审核失败</i>
                                                </a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
    @if($task['status'] != 9)
    <div class="well">
        <form class="form-inline search-group" action="{!! url('manage/taskHandle') !!}" method="post">
            {!! csrf_field() !!}
            <div class="form-group search-list ">
                <label for="name" class="">处罚对象</label>
                <select name="object" >
                    <option value="雇主">雇主</option>
                    <option value="猎人">猎人</option>
                    <option value="全部">全部</option>
                </select>
            </div>

            <div class="form-group search-list ">
                <label for="name" class="">处罚类型</label>
                <select name="type">
                    <option value="刷单">刷单</option>
                    <option value="广告">广告</option>
                    <option value="违法">违法</option>
                </select>
            </div>

            <div class="form-group search-list">
                <label for="namee" class="">处罚级别</label>
                <select name="punish_grade" >
                    @foreach($punish_grade as $v)
                        <option value="{{ $v->id }}">{!! $v->name !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value='{{ $task['id'] }}' />
                <input type="hidden" name="status" value='{{ $task['status'] }}' />
                <button type="submit" class="btn btn-primary btn-sm">提交</button>
            </div>
        </form>
    </div>
    @endif

        <div class="widget-header mg-bottom20 mg-top12 widget-well">
            <div class="widget-toolbar no-border pull-left no-padding">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#need">惩罚等级</a>
                    </li>
                </ul>
            </div>
        </div>

        <div>
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>等级</th>
                    <th>经验值</th>
                    <th>时间</th>
                </tr>
                </thead>

                <tbody>
                @foreach($punish_grade as $item)
                    <tr>
                        <td>{!! $item->id !!}</td>
                        <td>{!! $item->name !!}</td>
                        <td>{!! $item->experience !!}经验值</td>
                        <td>{!! $item->penalty_time !!}分钟</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}