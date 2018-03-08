{{--<div class="row">
    <div class="col-xs-12 widget-container-col ui-sortable">
        <div class="widget-box transparent ui-sortable-handle">
            <div class="widget-header">--}}
                {{--<h3 class="widget-title lighter">任务详情/ <small>任务需求</small></h3>--}}

            <div class="widget-header mg-bottom20 mg-top12 widget-well">
                <div class="widget-toolbar no-border pull-left no-padding">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#need">任务需求</a>
                        </li>

                        <li class="">
                            <a data-toggle="tab" href="#draft">任务稿件</a>
                        </li>

                        <li class="">
                            <a data-toggle="tab" href="#leave">任务留言</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#deal">任务交付</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main paddingTop no-padding-left no-padding-right">
                    <div class="tab-content padding-4">
                        <div id="need" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="/manage/taskDetailUpdate" method="post" id="seo-form" class="form-horizontal">
                                        <div class="g-backrealdetails clearfix bor-border interface">
                                            <div class="space-8 col-xs-12"></div>
                                            <div class="form-group interface-bottom col-xs-12">
                                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 发布人： </label>

                                                <div class="col-sm-9">
                                                    <label class="col-sm-1">{{ $task['nickname'] }}</label>
                                                    <label class="col-sm-5">手机号：<input type="text" name="phone" value="{{ $task['phone'] }}"/></label>
                                                </div>
                                            </div>

                                            <div class="form-group interface-bottom col-xs-12">
                                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 任务标题： </label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="col-sm-5" name="title" value="{{ $task['title'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group interface-bottom col-xs-12">
                                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 任务类型： </label>

                                                <div class="col-sm-9">
                                                    <label><input type="text" value="悬赏模式" readonly="true"/></label>
                                                </div>
                                            </div>
                                            <div class="form-group interface-bottom col-xs-12">
                                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 托管金额： </label>

                                                <div class="col-sm-9">
                                                    <label class="col-sm-1">￥{{ $task['bounty'] }}元</label>
                                                    <label class="col-sm-5">中标人数：{{ $taskDelivery }}人</label>
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
                                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">  任务附件： </label>

                                                <div class="col-sm-9">
                                                    @foreach($taskAttachment as $k=>$v)
                                                        <button>附件{{ ($k+1) }}</button><a href="{{ URL('manage/download',['id'=>$v['attachment_id']]) }}" target="_blank">下载</a>&nbsp;&nbsp;
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="form-group interface-bottom col-xs-12">
                                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 任务描述： </label>
                                                <div class="col-sm-8">
                                                    <div class="clearfix ">
                                                        <script id="editor"  name="desc" type="text/plain" style="width:;height:300px;">{!! htmlspecialchars_decode($task['desc']) !!}</script>

                                                        {{--<div class="wysiwyg-editor" id="editor1">{!! htmlspecialchars_decode($task['desc']) !!}</div>
                                                        <input type="hidden" name="desc" id="discription-edit" datatype="*" nullmsg="需求描述不能为空" value="{{ htmlspecialchars_decode($task['desc']) }}" >--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="task_id" value='{{ $task['id'] }}' />
                                            {{ csrf_field() }}
                                            <div class="form-group interface-bottom col-xs-12">
                                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> seo标题： </label>

                                                <div class="col-sm-9">
                                                    <textarea class="col-xs-5 col-sm-5" name="seo_title" rows="1">{{ $task_seo['seo_title'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group interface-bottom col-xs-12">
                                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1" rows="1"> seo关键字： </label>

                                                <div class="col-sm-9">
                                                    <textarea class=" col-xs-5 col-sm-5" rows="1" name="seo_keyword">{{ $task_seo['seo_keyword'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class=" interface-bottom col-xs-12">
                                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> seo描述： </label>

                                                <div class="col-sm-9">
                                                    <textarea class="col-xs-5 col-sm-5" name="seo_content" rows="1"> {{ $task_seo['seo_content'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                                                    <div class="col-xs-12">
                                                        <div class="col-sm-1 text-right"></div>
                                                        <div class="col-sm-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                           {{-- <div class="space-10"></div>
                                            <div class="clearfix form-actions">
                                                <div class="col-md-offset-3 col-md-9 ">
                                                    <div class="row">
                                                        <button class="btn btn-info" type="submit" form="seo-form" >
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            提交
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="space-24"></div>--}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="draft" class="tab-pane">
                            <div class="row ">
                                <div class="col-md-12 clearfix">
                                    <div class="g-backrealdetails clearfix bor-border interface">
                                        <table class="table table-hover">
                                            <tbody>
                                            @foreach($works as $v)
                                                <tr>
                                                    <td>
                                                        <div class="col-lg-2 col-md-2 text-center">
                                                            <img src="{{ $domain.'/'.$v['avatar'].md5($v['id'].'large').'.jpg' }}"  alt="">
                                                            <p>{{ $v['nickname'] }}</p>
                                                        </div>
                                                        <div class="col-lg-8 col-md-10 ">
                                                            <p>发表于：{{ date('Y-m-d H-i-s',strtotime($v['created_at'])) }}</p>
                                                            <textarea  class="comments" rows="5" placeholder="">{{ $v['desc'] }}</textarea>
                                                        </div>
                                                        <div class="pull-right draft-info">
                                                            <p>隐藏交稿：否 &nbsp;&nbsp;&nbsp;回复：暂无</p>
                                                            <p>附件：
                                                                @foreach($v['children_attachment'] as $k=>$value)
                                                                    <button>附件{{ $k+1 }}</button>
                                                                @endforeach
                                                            </p>
                                                            <a href='/task/{{ $task['id']  }}' target='_blank' class="btn btn-primary btn-sm">查看稿件</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="leave" class="tab-pane">
                            <div class="row ">
                                <div class="col-md-12 clearfix">
                                    <div class="g-backrealdetails clearfix bor-border interface">
                                        <table class="table table-hover">
                                        <tbody>
                                        @foreach($task_massages as $v)
                                            <tr>
                                                <td>
                                                    <div class="col-md-2 text-center">
                                                        <img src="{{ $domain.'/'.$v['avatar'].md5($v['id'].'large').'.jpg' }}" alt="">
                                                        <p>{{ $v['nickname'] }}</p>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <p>发表于：{{ $v['created_at'] }}</p>
                                                        <textarea  class="comments" rows="5" placeholder="这是一个岁数大了肯德基奥斯卡的萨达是">{{ $v['comment'] }}</textarea>
                                                        <div class="text-right">
                                                            <button class="btn btn-success btn-sm">查看稿件</button>  <a href="/manage/taskMassageDelete/{{ $v['id'] }}" class="btn btn-danger btn-sm">删除留言</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="9">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
                                                            {!! $task_massages->render() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="deal" class="tab-pane">
                            @foreach($work_delivery as $v)
                                <div class="col-lg-5 col-md-12 col-xs-12 draft table-bordered deal clearfix">
                                    <div class=" col-xs-2 text-center">
                                        <img src="{{ $domain.$task['avatar'] }}" class="img-responsive" alt="">
                                    </div>
                                    <div class="draft-inline col-xs-10">
                                        <p>（雇主）{{ $task['nickname'] }}   <a target="_blank" href="{{ URL('manage/userEdit',['id'=>$task['uid']]) }}" class="btn btn-primary pull-right btn-sm">查看详情</a></p>
                                        <p>联系方式：{{ $task['phone'] }} QQ:{{ $task['qq'] }}</p>
                                        @if($v['status']==3)
                                            <p>交付时间：{{ $v['created_at'] }}           确认完成：{{ $v['bid_at'] }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12 col-xs-12 draft table-bordered deal pull-right">
                                    <div class=" col-xs-2 text-center">
                                        <img src="{{ $domain.$v['avatar'] }}" class="img-responsive" alt="">
                                    </div>
                                    <div class="draft-inline col-xs-10">
                                        <p>（中标者）{{ $v['nickname'] }}   <a target="_blank" href="{{ URL('task',['id'=>$task['id']]) }}" class="btn btn-primary pull-right btn-sm">查看稿件</a></p>
                                        <p>联系方式：{{ $v['mobile'] }} QQ：{{ $v['qq'] }}</p>
                                        @if($v['status']==3)
                                            <p>交付时间：{{ $v['created_at'] }}           确认完成：{{ $v['bid_at'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->
{!! Theme::widget('editor')->render() !!}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}