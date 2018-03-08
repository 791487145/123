<div class="g-taskposition col-xs-12 col-left">
        您的位置：首页 > 任务大厅
</div>

<div class="col-xs-12 col-left">
        <div class="well bg-white">
            <h2 class="tasktitle cor-gray51">{{ $task['title'] }}</h2>
        </div>
</div>

<div class="col-xs-12 col-left">
    <div class="row">
        <div class="col-xs-12 list-l ">
                <ul class="tasknav clearfix mg-margin nav nav-tabs">
                    <li class="active">
                        <a href="#home" data-toggle="tab" class="text-size16">我要投稿</a>
                    </li>
                </ul>
                <form action="/task/workCreate" method="post" id="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="task_id" value="{{ $task['id'] }}" />
                    <input type="hidden" name="work_id" value="{{ $task['id'] }}" />
                    <div class="tab-content b-border0 pd-padding0">
                        <div id="home" class=" tab-pane fade in active pd-padding30  bg-white b-border">

                            <!--编辑器-->
                            <div class="clearfix">
                                <p class="text-size14">投稿说明：</p>
                                <script id="editor" name="desc" type="text/plain" style="height:300px;"></script>
                                {{--<div class="wysiwyg-editor" id="editor1"></div>--}}
                                <input type="hidden" name="desc" id="discription-edit" value datatype="*1-5000" nullmsg="描述不能为空" errormsg="字数超过限制" >
                            </div>
                            <div class="annex">
                                <p class="text-size14">投稿附件：</p>
                                <!--文件上传-->
                                <div action=" " class="dropzone clearfix" id="dropzone" url="/task/ajaxAttatchment" deleteurl="/task/delAttatchment">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="clearfix text-size12">
                                    <label class="inline annex-validform">
                                        @if(!empty($agree))
                                        <input type="checkbox" class="ace" name="agree" checked="checked" datatype="*" nullmsg="请先阅读并同意">
                                        <span class="lbl text-muted">&nbsp;&nbsp;&nbsp;我已阅读并同意 <a class="text-under" href="/bre/agree/task_draft">《{!! $agree->name !!}》</a></span>
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div style="display:none;" id="file_update"></div>
                            <div class="clearfix text-center">
                                <button class="btn btn-primary btn-blue btn-big1 bor-radius2" href="" id="subTask">提交</button>
                                <a href="/task/{{ $task['id'] }}" class="btn-big text-under">返回</a>
                            </div>
                        </div>
                    </div>
                </form>

            <div class="space"></div>
            <div class="space"></div>
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}


{{--{!! Theme::widget('editor',['plugins'=>CommonClass::getEditorInit(['insertImage'])])->render() !!}--}}
{!! Theme::widget('fileUpload')->render() !!}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('checkbox', 'js/doc/checkbox.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}