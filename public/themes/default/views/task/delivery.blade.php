<div class="g-taskposition col-xs-12">
        您的位置：首页 > 任务大厅
</div>

<div class="col-xs-12">
    <div class="well bg-white">
        <h2 class="tasktitle cor-gray51">{{ $task['title'] }}</h2>
    </div>
</div>

<div class="col-xs-12">
    <div class="row">
        <div class="col-lg-9 list-l col-md-12">
                <ul class="tasknav clearfix mg-margin nav nav-tabs">
                    <li class="active">
                        <a href="#home" data-toggle="tab" class="text-size16">交付稿件</a>
                    </li>
                </ul>
                <form action="/task/deliverCreate" method="post" {{--id="content-form"--}} id="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="task_id" value="{{ $task['id'] }}" />
                    <input type="hidden" name="work_id" value="{{ $task['id'] }}" />
                <div class="tab-content b-border0 pd-padding0">
                    <div id="home" class=" tab-pane fade in active pd-padding30  bg-white b-border">
                        <!--编辑器-->
                        <div class="clearfix">
                            <script id="editor" name="desc" type="text/plain" style="height:300px;"></script>
                            {{--<div class="wysiwyg-editor" id="editor1"></div>--}}
                            <input type="hidden" name="desc" id="discription-edit" datatype="*1-5000" nullmsg="描述不能为空" errormsg="字数超过限制" >
                        </div>
                        <div class="annex">
                            <!--文件上传-->
                            <div action=" " class="dropzone clearfix" id="dropzone" url="/task/ajaxAttatchment" deleteurl="/task/delAttatchment">
                                <div class="fallback">
                                    <input name="file" type="file" multiple="" />
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="clearfix text-size12">
                                <label class="inline">
                                    @if(!empty($agree))
                                    <input type="checkbox" class="ace" name="agree" checked="checked" datatype="*" nullmsg="请先阅读并同意">
                                    <span class="lbl text-muted">&nbsp;&nbsp;&nbsp;我已阅读并同意 <a href="/bre/agree/task_delivery">《{!! $agree->name !!}》</a></span>
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div style="display:none;" id="file_update"></div>
                        <div class="clearfix text-center">
                            <button type="button" class="btn btn-primary btn-blue btn-big1 bor-radius2" data-toggle="modal" data-target="#modal1">提交</button>
                            <a href="/task/{{ $task['id'] }}" class="btn-big">返回</a>
                        </div>
                        <!--模态框（Modal） -->
                        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header widget-header-flat">
                                        <span class="modal-title cor-gray51 text-size14 text-blod">
                                            交稿提示：
                                        </span>
                                        <button type="button" class="bootbox-close-button close text-size14"
                                                data-dismiss="modal" aria-hidden="true">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <div class="space"></div>
                                        <p class="cor-gray51 text-size14">请确认您是否已上传真实的源文件附件！</p>
                                        <div class="space"></div>
                                        <button href="javascript:;" form="form" class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2" id="subTask">确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button href="javascript:;" class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                                        <div class="space"></div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal -->
                        </div>
                    </div>
                </div>
                </form>

            <div class="space"></div>
            <div class="space"></div>
        </div>
        <div class="col-md-3 task-l taskMedia hidden-md hidden-sm hidden-xs">

            <div class="taskside">
                <div class="task-sidetime text-center">
                    @if($task['status']==7)
                        <p class="h4">此任务当前处于：<span class="text-primary">验收</span>状态</p>
                    @elseif($task['status']==8)
                        <p class="h4">此任务当前处于：<span class="text-primary">互评</span>状态</p>
                    @elseif($task['status']==9)
                        <p class="h4">此任务当前处于：<span class="text-primary">已结束</span>状态</p>
                    @elseif($task['status']==10)
                        <p class="h4">此任务当前处于：<span class="text-primary">失败</span>状态</p>
                    @endif
                    @if($task['status']==7)
                        <div style="display:none">
                            {!!  $task_delivery_max_time = CommonClass::getConfig('task_select_work') !!}
                            {!!  $task_check_time_limit = CommonClass::getConfig('task_check_time_limit') !!}
                            {!!  $task_delivery_max_time = ($task_delivery_max_time+$task_check_time_limit)*24*3600 !!}
                        </div>
                        <p>离验收结束还剩：</p>
                        <p class="text-center"><b  delivery_deadline="{{ date('Y-m-d H:i:s',strtotime($task['checked_at'])+$task_delivery_max_time) }}" class="cor-orange text-size22 timer-check"></b></p>
                    @endif
                    @if($task['status']==8)
                        <div style="display:none">
                            {!!  $task_comment_time_limit = CommonClass::getConfig('task_comment_time_limit') !!}
                            {!!  $task_comment_time_limit = $task_comment_time_limit*24*3600 !!}
                        </div>
                        <p>离验收结束还剩：</p>
                        <p class="text-center"><b  delivery_deadline="{{ date('Y-m-d H:i:s',strtotime($task['comment_at'])+$task_comment_time_limit) }}" class="cor-orange text-size22 timer-check"></b></p>
                    @endif
                </div>
                <!--<div class="text-center"><a href="javascript:;"  class="btn btn-primary btn-blue btn-block bor-radius2">去交付</a></div>-->
            </div>
            @if(count($hotList))
            <div class=" taskside1 taskside">
                <h4 class="mg-margin text-size14 cor-gray51"><strong>{!! $targetName !!}</strong></h4>
                <div class="space-4"></div>
                <div class="">
                    <ul class="mg-margin">
                        @foreach($hotList as $v)
                        <li class="clearfix">
                            <p class="h5"><a href="{!!URL('task/'.$v['recommend_id'])!!}" class="cor-gray51 text-size14">{!! $v['recommend_name'] !!}</a></p>
                            <div class="clearfix text-size14">
                                <span class="pull-left cor-orange">￥{{ number_format($v['bounty'],2) }}</span><span class="pull-right cor-gray97">{{ date('Y.m.d',strtotime($v['created_at'])) }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <div class="taskside1">
                @if(count($ad))
                    <a href="{!! $ad[0]['ad_url'] !!}"><img src="{!! URL($ad[0]['ad_file']) !!}" alt="" class="img-responsive" width="100%"></a>
                @else
                <img src="{{ Theme::asset()->url('images/task-gg.png') }}" alt="" class="img-responsive" width="100%">
                @endif
            </div>
            <div class="space"></div>
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}


{!! Theme::widget('fileUpload')->render() !!}
{!! Theme::widget('ueditor')->render() !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('checkbox', 'js/doc/checkbox.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
