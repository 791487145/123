<div class="g-taskposition col-xs-12 col-left">
        您的位置：任务发布 > 任务预览
</div>

<div class="col-xs-12 hidden-xs col-left">
    <div class="poster">
        <div data-target="#step-container" class="row-fluid" id="fuelux-wizard1">
            <ul class="wizard-steps">
                <li class="active" data-target="#step1">
                    <span class="title h6 p-space">需求描述</span>
                    <span class="step">1</span>
                </li>
                <li data-target="#step2">
                    <span class="title h6 p-space">交易模式</span>
                    <span class="step">2</span>
                </li>
                <li data-target="#step3">
                    <span class="title h6 p-space">确认需求，发布</span>
                    <span class="step">3</span>
                </li>
                <li data-target="#step4 p-space">
                    <span class="title h6 p-space">等待审核</span>
                    <span class="step">4</span>
                </li>
            </ul>
        </div>
    </div><!--/时间轴-->
</div>

<div class="col-xs-12">
    <div class="row">
        <div class="col-lg-9 list-l col-md-12 col-left">
                <div class="well bg-white">
                    <h2 class="tasktitle cor-gray51">{{ $data['title'] }}</h2>
                </div>
                <div class="tab-content b-border0 pd-padding0">
                    <div id="home" class="tab-pane fade pd-padding30  bg-white b-border active in">
                        <!--雇主信息-->
                        <div class="row">
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-5 col-xs-6 p-space">
                                        <ul class="task-info mg-margin clearfix">
                                            <li class="h5 cor-gray51">
                                                <span class="t-ico"></span> 雇主：{{ Auth::user()['name'] }}
                                            </li>
                                            <li class="h5 cor-gray51 clearfix">
                                                <span class="t-ico t-ico1"></span>
                                                任务分类：{{ $task_cate['name'] }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 p-space">
                                        <ul class="task-info mg-margin">
                                            <li class="h5 cor-gray51 clearfix">
                                                <span class="t-ico t-ico2"></span>
                                                任务类型：
                                                @if($task_type_alias == 'xuanshang')
                                                    悬赏模式
                                                @elseif($task_type_alias == 'zhaobiao')
                                                    招标模式
                                                @endif
                                            </li>
                                            <li class="h5 cor-gray51 clearfix">
                                                <span class="t-ico t-ico3"></span>
                                                截止时间：{{ date('Y-m-d', strtotime($data['delivery_deadline'])) }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="task-money alert taskSum">
                                        @if($task_type_alias == 'xuanshang')
                                            <p class="h5 cor-gray51 ">
                                                本任务已托付任务款：
                                            </p>
                                            <h2 class="text-center cor-orange text-size36 text-blod">
                                                {{ $data['bounty'] }}
                                                <span class="text-size12">
                                                元
                                            </span>
                                            </h2>
                                        @elseif($task_type_alias == 'zhaobiao')
                                            <p class="h5 cor-gray51 ">
                                                @if(!empty($data['bounty'])){{ $data['bounty'] }}元@endif
                                            </p>
                                            <h2 class="text-center cor-orange text-size36 text-blod">
                                                可议价
                                                <span class="text-size12">

                                            </span>
                                            </h2>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--时间轴-->
                        @if($task_type_alias == 'xuanshang')
                            <div data-target="#step-container" class="tab-bor row-fluid maintime clearfix hidden-480" id="fuelux-wizard">
                                <ul class="wizard-steps">
                                    <li class="" data-target="#step1 p-space">
                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">发布需求，托管赏金</span>
                                    </li>
                                    <li class="" data-target="#step1">
                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">威客交稿</span>
                                    </li>
                                    <li class="" data-target="#step1">
                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">雇主选稿</span>
                                    </li>
                                    <li data-target="#step1">

                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">中标公示</span>
                                    </li>
                                    <li data-target="#step1">

                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">验收付款</span>
                                    </li>
                                    <li data-target="#step1">
                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        </div>
                                        <span class="title">评价</span>
                                    </li>
                                </ul>
                                <div class="space"></div>
                            </div>
                        @elseif($task_type_alias == 'zhaobiao')
                            <div data-target="#step-container" class="tab-bor row-fluid maintime clearfix hidden-480" id="fuelux-wizard">
                                <ul class="wizard-steps">
                                    <li class="" data-target="#step1 p-space">
                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">发布需求</span>
                                    </li>
                                    <li class="" data-target="#step1">
                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">服务商报价</span>
                                    </li>
                                    <li class="" data-target="#step1">
                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">选择服务商并托管赏金</span>
                                    </li>
                                    <li data-target="#step1">

                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">服务商工作</span>
                                    </li>
                                    <li data-target="#step1">

                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-chevron-right"></i>
                                        </span>
                                        </div>
                                        <span class="title">验收付款</span>
                                    </li>
                                    <li data-target="#step1">
                                        <div class="clearfix">
                                        <span class="step">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        </div>
                                        <span class="title">评价</span>
                                    </li>
                                </ul>
                                <div class="space"></div>
                            </div>
                        @endif


                        <!--任务描述-->
                        <div class="task-description cor-gray51">
                            <div class="description-main">
                                <p class="h4 description-title">任务描述</p>
                                {!! $data['desc'] !!}
                            </div>

                            <div class="description-main">
                                <div>
                                    <p class="h4 description-title"><b><i class="fa fa-paperclip fa-rotate-90"></i> 附件 <span class="text-muted">({{ count($attatchment) }})</span></b></p>
                                    <span class="hr"></span>
                                </div>
                                <div class="user-profile clearfix">
                                    <ul class="ace-thumbnails">
                                        @foreach($attatchment as $v)
                                            <li>
                                                <a href="#" >
                                                    <img alt="150x150" src="{!! Theme::asset()->url('images/task-xiazai/'.matchImg($v['type']).'.png') !!}">
                                                    <div class="text">
                                                        <div class="inner"></div>
                                                    </div>
                                                </a>
                                                <div class="tools tools-bottom">
                                                    <a href="{{ URL('task/download',['id'=>$v['id']]) }}" target="_blank">下载</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space"></div>
        </div>
        <div class="col-lg-3 task-l taskMedia hidden-md hidden-sm hidden-xs col-left">
            <div class="taskside">
                <p class="text-center text-size14 cor-gray51 ">遇到问题，联系客服免费帮您解决</p>
                <a href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes" class="btn btn-block btn-primary bor-radius2 text-size14 btn-blue">联系在线客服</a>
                <div class="space"></div>
                <div class="iss-ico1">
                    <p class="cor-gray51 mg-margin">全国免长途电话：</p>
                    <p class="text-size20 cor-gray51">{{ $phone }}</p>
                </div>
                <div class="iss-ico2">
                    <p class="cor-gray51 mg-margin">企业QQ：</p>
                    <p class="text-size20 cor-gray51">{{ $qq }}</p>
                </div>
            </div>
            <div class="taskside1">
                @if(count($ad))
                    <a href="{!! $ad[0]['ad_url'] !!}"><img src="{!! URL($ad[0]['ad_file']) !!}" alt="" class="img-responsive" width="100%"></a>
                @else
                    <img src="{{ Theme::asset()->url('images/task-gg.png') }}" alt="" class="img-responsive" width="100%">
                @endif
            </div>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}