<div class="g-taskposition col-xs-12 col-left">
        您的位置：首页 > 任务大厅
</div>

<div class="col-xs-12 hidden-lg col-left">
    <div class="task-sidetime well bg-white text-size14 task-timeSheet clearfix">
        <p>恭喜您已完成交易请对威客进行评价</p>
    </div>
</div>

<div class="col-xs-12">
    <div class="row">
        <div class="col-lg-9 list-l col-md-12 col-left">
            <form action="/task/evaluateCreate" method="post" >
                    {{ csrf_field() }}
                    <input type="hidden" name="task_id" value="{{ $task_id }}" />
                    <input type="hidden" name="work_id" value="{{ $work_id }}">
                <div class="tab-content b-border0 pd-padding0">
                    <!--&lt;!&ndash;威客评价&ndash;&gt;-->
                    <div id="home" class=" tab-pane fade in active pd-padding30 bg-white b-border pd-pdtp15">
                        <div class="clearfix">
                            <div class="col-md-1 col-xs-12 task-mediaAssessL evaluateimg clearfix">
                                <div class="row">
                                    <img src="{{ CommonClass::getDomain().'/'.CommonClass::getAvatar($evaluate_people['uid']) }}"  onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                                </div>
                            </div>
                            <div class="col-md-11 col-xs-12 task-mediaAssessR evaluatemain clearfix">
                                <div class="row">
                                    <p class="text-size16 cor-gray51">{{ $evaluate_people['nickname'] }}（{{ ($evaluate_from==0)?'雇主':'威客' }}）</p>
                                    <p class="evaluatetime cor-gray87 text-size14">
                                        <span class="evaluate-back">好评率：<span class="cor-orange">{{ CommonClass::applauseRate($comment_people['uid']) }}% </span></span>
                                        @if(!empty($evaluate_people['phone']))
                                        <span class="evaluate-back">手机：{{ $evaluate_people['phone'] }}</span>
                                        @endif
                                        @if(!empty($evaluate_people['qq']))
                                        <span class="evaluate-back">QQ：{{ $evaluate_people['qq'] }}</span>
                                        @endif
                                        <span>来自：湖北</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="record b-border">
                            <div class="text-size14 cor-gray51 clearfix">
                                <div class="col-xs-1 task-mediaAssessL pd-padding0">
                                        总体评价：
                                </div>
                                <div class="col-xs-11 task-mediaAssessR pd-padding0">
                                    <label class="evaluate-back">
                                        <input name="type" type="radio" class="ace" checked="" value=1>
                                        <span class="lbl"> <span class="flower4">好评</span></span>&nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label class="evaluate-back">
                                        <input name="type" type="radio" class="ace" value="2">
                                        <span class="lbl"> <span class="flower5">中评</span></span>&nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label>
                                        <input name="type" type="radio" class="ace" value="3">
                                        <span class="lbl"> <span class="flower6">差评</span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="space"></div>
                            <div class="text-size14 cor-gray51 clearfix">
                                <div class="col-xs-1 task-mediaAssessL pd-padding0">
                                        评价内容：
                                </div>
                                <div class="col-xs-11 task-mediaAssessR pd-padding0">
                                    <textarea name="comment" id="limit" class="col-xs-12" rows="5"></textarea>
                                    <div class="cor-gray51">
                                        <span class="cor-orange"><i class="fa fa-exclamation-circle"></i></span> 最多<span id="textCount">100</span>个字
                                    </div>
                                </div>
                            </div>
                            <div class="space"></div>
                            <div class="space"></div>
                            <div class="star text-size14 cor-gray51 clearfix">
                                <div class="col-xs-1 task-mediaAssessL pd-padding0">
                                    <div class="starpd">评价质量：</div>
                                </div>
                                <div class="col-xs-11 task-mediaAssessR pd-padding0">
                                    @if($evaluate_from==0)
                                    <div class="target-star starpd"> 付款及时性：</div>
                                    <div id="function-star1" class="target-star evaluate-back">
                                        <input type="hidden" name="speed_score" id="speed-score" value="5">
                                    </div>
                                    <div class="target-star starpd">合作愉快度： </div>
                                    <div id="function-star2" class="target-star evaluate-back">
                                        <input type="hidden" name="quality_score" id="quality-score" value="5">
                                    </div>

                                    @else
                                    <div class="target-star starpd"> 工作速度：</div>
                                    <div id="function-star1" class="target-star evaluate-back">
                                        <input type="hidden" name="speed_score" id="speed-score" value="5">
                                    </div>
                                    <div class="target-star starpd">工作质量： </div>
                                    <div id="function-star2" class="target-star evaluate-back">
                                        <input type="hidden" name="quality_score" id="quality-score" value="5">
                                    </div>
                                    <div class="target-star starpd">工作态度： </div>
                                    <div id="function-star3" class="target-star evaluate-back">
                                        <input type="hidden" name="attitude_score" id="attitude-score" value="5">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="space"></div>
                            <div class="space"></div>
                            <div class="space"></div>
                            <div class="space"></div>
                            <div class="clearfix text-center">
                                <button class="btn btn-primary btn-blue btn-big1 bor-radius2">提交</button>
                                <a href="/task/{{ $task_id }}" class="btn-big">返回</a>
                            </div>
                            <div class="space-8"></div>
                            <div class="space"></div>
                        </div>
                    </div>
                </div>
                </form>
        </div>
        <div class="col-md-3 task-l col-left taskMedia  hidden-md hidden-sm hidden-xs">
            <div class="record b-border bg-white">
                <div class="task-sidetime text-center text-size18 cor-gray51">
                    <p>恭喜您已<span class="cor-blue2f">完成交易</span></p>
                    <p class="mg-margin">请对{{ ($evaluate_from==0)?'雇主':'威客' }}进行评价</p>
                </div>
            </div>
            @if(count($hotList))
                <div class=" taskside1 taskside">
                    <h4 class="mg-margin text-size14 cor-gray51"><strong>{!! $targetName !!}</strong></h4>
                    {{--<div class="space-4"></div>--}}
                    <div class="">
                        <ul class="mg-margin one-noborbot">
                            @foreach($hotList as $v)
                                <li class="clearfix">
                                    <p class="text-size14"><a href="{!!URL('task/'.$v['recommend_id'])!!}" class="cor-gray51 text-size14">{!! $v['recommend_name'] !!}</a></p>
                                    <div class="clearfix text-size14">
                                        <span class="pull-left cor-orange">￥{{ number_format($v['bounty'],2) }}</span><span class="pull-right cor-gray97">{{ date('Y.m.d',strtotime($v['created_at'])) }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="taskside1" >
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
{!! Theme::widget('popup')->render() !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('dropzone','plugins/ace/css/dropzone.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_raty','plugins/jquery/raty/jquery.raty.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('evaluate','js/doc/evaluate.js') !!}
