
    <div class="g-taskposition col-xs-12 col-left">
            您的位置：首页 > 任务大厅
    </div>

    <div class="col-xs-12 hidden-xs col-left">
        <div class="poster">
            <div data-target="#step-container" class="row-fluid " id="fuelux-wizard">
                <ul class="wizard-steps poster-time">
                    <li class="active text-left" data-target="#step1">
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
                    <li data-target="#step4 text-right">
                        <span class="title h6 p-space">等待审核</span>
                        <span class="step">4</span>
                    </li>
                </ul>
            </div>
        </div><!--/时间轴-->
    </div>
            <div class="col-lg-9 list-l col-left">
                <form action="/task/createTask" method="post" id="form" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="task-r">
                        <ul class="mg-margin">
                            <li>
                                <a class="task-tit" href="javascript:;" data-toggle="collapse"
                                   data-target="#demo">
                                    <span class="ace-icon fa fa-angle-double-down"
                                          data-icon-hide="ace-icon fa fa-angle-double-down"
                                          data-icon-show="ace-icon fa fa fa-angle-double-right">

                                    </span> 描述需求
                                </a>
                                <div id="demo" class="collapse in">
                                        <div class="form-group task-phone clearfix task-checkip-right">
                                            <p for="name" class="phone text-size14">联系手机：</p>
                                            <input type="text" class="form-control task-input pull-left"
                                                   id="name"  name="phone" value="{!! old('phone') !!}"
                                                   placeholder="请输入手机号" datatype="m"
                                                   nullmsg="请填写手机号！" errormsg="手机号错误！">
                                            <label class="Validform_checktip task-checkip task-checkip-wrong">

                                            </label>
                                            @if($errors->first('phone'))
                                                <span class="Validform_checktip task-checkip task-checkip-wrong">
                                                    {!! $errors->first('phone') !!}
                                                </span>
                                            @endif
                                        </div>
                                    <div  class="task-select-bottom task-validform-right">
                                        <div id="task-select"  class="task-select" style="margin-bottom: 0px;">
                                            <p class="text-blod text-size14">选择需要做什么：</p>
                                            @foreach($hotcate as $v)
                                                <a url="{{ URl('task/getTemplate') }}" cate-id="{{ $v['id'] }}"
                                                   class="chooseCate"  >
                                                    {{ $v['name'] }}
                                                </a>
                                            @endforeach
                                            <span>
                                                <a class="select-txt z-close text-under" href="javascript:;">
                                                    更多>>
                                                </a>
                                            </span>
                                            @if($errors->first('cate_id'))
                                                <p class="Validform_checktip Validform_wrong">
                                                    {!! $errors->first('cate_id') !!}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="task-select1 collapse" id="gd"  style="margin-bottom: 0px;">
                                            <p class="text-blod text-size14">选择需要做什么：</p>
                                            <select multiple="" class="chosen-select tag-input-style"
                                                    name="cate_id"  data-placeholder="选择一下您的标签吧"
                                                    style="display:block;">
                                                @foreach($category_all as $v)
                                                    <option value="{{ $v['id'] }}"
                                                            cate-id="{{ $v['id'] }}" class="chooseCate" >
                                                        {{ $v['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="task-Validform-filtersort  ">
                                            <input type="hidden" name="cate_id" id="task_category"
                                                   datatype="n" nullmsg="请选择需要做什么！" />
                                            <span class="Validform_checktip"></span>
                                        </div>
                                    </div>
                                    <div class="task-bar">
                                        <p class="text-size14">地域：</p>
                                        <a class="area-limit" href="javascript:void(0);">不限地区</a>
                                        <a class="area-limit bar-txt" href="javascript:void(0);">指定地区</a>
                                        <span id="area_select" style="display: none;">
                                            <select name="province" style="margin-left:20px;" onchange="checkprovince(this)">
                                                @foreach($province as $v)
                                                    <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <select name="city" id="province_check" onchange="checkcity(this)">
                                                @foreach($city as $v)
                                                    <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <select name="area" id="area_check" onchange="arealimit(this)">
                                                @foreach($area as $v)
                                                    <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                        <span>
                                            @foreach($area as $v)
                                                <div style="display:none;" id="province-{{ $v['id'] }}">
                                                    @if(!empty($v['children_area']))
                                                        @foreach($v['children_area'] as $value)
                                                            <option value={{ $v['id'] }}>
                                                                {{ $value['name'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        </span>
                                        <input type="hidden" name="area" id="region-limit" value="0" />
                                    </div>
                                    <div class="form-group">
                                        <p class="text-blod text-size14">明确需求标题和详情：</p>
                                        <div class="row">
                                            <div class="col-sm-12 task-filtersort">
                                                <input type="text" class="col-xs-10 col-sm-5 task-input-depivt"
                                                       name="title" value="{!! old('title') !!}"
                                                       id="form-input-readonly"
                                                       placeholder="一句话描述您的需求，XX餐饮公司VI设计"
                                                       datatype="*" nullmsg="请填写标题！">
                                            <p class="hidden-xs">
                                                <label class="middle task-case-middel">
                                                    <span class="lbl" id="example">
                                                        <a class="text-under" href="javascript:;">
                                                            参照发布实例
                                                        </a>
                                                    </span>
                                                    <span class="lbl txt-lbl">
                                                        <a class="text-under" href="/task" id="seeothers">
                                                            逛任务大厅看看别人怎么写
                                                        </a>
                                                    </span>
                                                </label>
                                                <span></span>
                                            </p>
                                            @if($errors->first('title'))
                                                <p class="Validform_checktip Validform_wrong">
                                                    {!! $errors->first('title') !!}
                                                </p>
                                            @endif
                                            </div>

                                            <!-- 模态框（Modal） -->
                                            <div class="modal fade" id="myexample" tabindex="-1" role="dialog"
                                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="background-color:#e4e4e4;">
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal" id="model-close"
                                                                    aria-hidden="true">
                                                                &times;
                                                            </button>
                                                            <h5 class="modal-title" id="myModalLabel">
                                                                <b>选择您的模板</b>
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="myTabContent" class="tab-content">
                                                                <div class="tab-pane fade in active clearfix">
                                                                    <h4 class="text-center"
                                                                        id="template-title">
                                                                        请先选择您需要做什么
                                                                    </h4>
                                                                    <div id="template-content" class="clearfix">

                                                                    </div>
                                                                </div>
                                                                <div class="text-center">
                                                                    <button type="button"
                                                                            onclick="insert_example()"
                                                                            class="btn btn-primary"
                                                                            id="insertTemplate"
                                                                            data-toggle="button">
                                                                        插入模板
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div>
                                            </div><!-- 模态框（Modal）end -->
                                        </div>
                                    </div>
                                    <!--编辑器-->
                                    <div class="clearfix  Validform-wysiwyg-editor" id="editor_validform">
                                        {{--<div class="wysiwyg-editor" id="editor1">{!! old('description') !!}</div>--}}
                                        <script id="editor"  type="text/plain"
                                                style="width:100%;height:300px;" >{!! old('description') !!}
                                        </script>
                                        <input type="hidden" name="description" id="discription-edit"
                                               datatype="*1-5000" nullmsg="需求描述不能为空"
                                               errormsg="字数超过限制" >
                                        @if($errors->first('description'))
                                            <p class="Validform_checktip Validform_wrong">
                                                {!! $errors->first('description') !!}
                                            </p>
                                        @endif
                                        <span class="Validform_checktip">
                                        </span>
                                    </div>


                                    <div class="annex">
                                        <!--文件上传-->
                                        <div  class="dropzone clea>fix" id="dropzone"
                                              url="{{ URL('task/fileUpload')}}"
                                              deleteurl="{{ URL('task/fileDelet') }}">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div id="file_update"></div>
                                </div>
                            </li>
                            <li>
                                <a class="task-tit" href="javascript:;" data-toggle="collapse"
                                   data-target="#demol">
                                    <span class="ace-icon fa fa-angle-double-down"
                                          data-icon-hide="ace-icon fa fa-angle-double-down"
                                          data-icon-show="ace-icon fa fa fa-angle-double-right">

                                    </span> 交易模式
                                </a>
                                <div id="demol" class="panel-group">
                                    @forelse($rewardModel as $k => $type_v)
                                    <div class="panel panel-default">
                                        @if($type_v['alias'] == 'xuanshang')
                                        <div class="checkbox panel-heading">
                                            <label class="z-check z-check-validform" data-toggle="collapse"
                                                   data-parent="#demol" href="#ck">
                                                <input  type="radio" class="ace" name="type_id"
                                                        {{ (!empty(old('xuanshang')))?'checked':'' }}
                                                        datatype="*" nullmsg="请选择交易模式"
                                                        value="{{$type_v['id']}}"/>
                                                <span class="lbl text-blod text-size16 pull-left"> 悬赏模式</span>
                                            </label>
                                            <div class=" mission-task">
                                                <p class="text-size14 cor-gray89">威客们先工作，再选中标作品。
                                                    托管赏金后吸引更多威客。</p>
                                            </div>
                                        </div>

                                        <div class="mission-task panel-collapse collapse
                                        {{ (!empty(old('xuanshang')))?'in':'' }}" id="ck">
                                            <div class="mission-ck z-check-validform-ck">
                                                <div class="checkbox">
                                                    <label class="checkbox-inline">
                                                        有明确预算，明确的预算更能吸引服务商参与
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="text" name="bounty{{$type_v['alias']}}" id="bounty"
                                                           value="{!! old('bounty') !!}"  class="mis-txt"
                                                           ajaxurl="/task/checkbounty" datatype="decimal"
                                                           nullmsg="请填写你的预算！"
                                                           errormsg="请填写数子,最多保留两位小数！">
                                                    @if($errors->first('bounty'))
                                                        <p class="Validform_checktip Validform_wrong">
                                                            {!! $errors->first('bounty') !!}</p>
                                                    @endif
                                                </div>
                                                <div class="checkbox ">
                                                    <label class="checkbox-inline">
                                                        希望有多少服务商完成此任务？
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="text" name="worker_num{{$type_v['alias']}}" class="mis-txt"
                                                           datatype="positive"  nullmsg="请填写服务商数量！"
                                                           errormsg="请填写大于0的整数！">
                                                    @if($errors->first('worker_num'))
                                                        <p class="Validform_checktip Validform_wrong">
                                                            {!! $errors->first('worker_num') !!}</p>
                                                    @endif
                                                </div>
                                                <div class="checkbox">
                                                    <label class="checkbox-inline">
                                                        设置投稿时间
                                                    </label>
                                                </div>
                                                <div class=" input-group" style="width:60%;margin-left:20px;">
                                                    <span class="input-group-addon date-icon" >
                                                        <i class="fa fa-calendar bigger-110"></i>
                                                     </span>
                                                    <div>
                                                        <input type="text" class="input-sm form-control "
                                                               id="datepiker-begin" onchange="beginAt($(this))"
                                       value="{!! (old('begin_at'))?old('begin_at'):date('Y年m月d日',time()) !!}"
                                                               placeholder="开始时间" >
                                                    </div>
                                                    <span class="input-group-addon  date-icon ">
                                                        <i class="fa fa-exchange"></i>
                                                    </span>
                                                    <div>
                                                        <input type="text" class="input-sm form-control "
                                                               id="datepiker-deadline"
                                                               onchange="deadline($(this))"
                                                               value="{!! old('delivery_deadline') !!}"
                                                               placeholder="截稿时间">
                                                    </div>
                                                </div>
                                            @if($errors->first('start')|| $errors->first('delivery_deadline'))
                                                    <p class="Validform_checktip Validform_wrong">
                                                        {!! $errors->first('begin_at') !!}
                                                        {!! $errors->first('delivery_deadline') !!}
                                                    </p>
                                            @endif
                                                <input name="begin_at{{$type_v['alias']}}" type="hidden" id="begin_at"
                                                       datatype="*" nullmsg="请填写开始时间！" class="begin_at"
                                   value="{!! (old('begin_at'))?old('begin_at'):date('Y年m月d日',time()) !!}"/>
                                                <input name="delivery_deadline{{$type_v['alias']}}" type="hidden"
                                                       id="delivery_deadline" ajaxurl="/task/checkdeadline"
                                                       datatype="*" nullmsg="请填写截稿时间！"
                                                       class="delivery_deadline"
                                                       value="{!! old('delivery_deadline') !!}" />
                                                <span class="time_check validform_checktip  Validform_wrong"
                                                      style="width:90%;margin-left:20px;display:none">
                                                </span>
                                                <ul class="clearfix checkbox process">
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>发布需求，托管赏金</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>服务商交稿</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>雇主选稿</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>中标公开</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>验收付款</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>评价</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endif

                                        @if($type_v['alias'] == 'zhaobiao')
                                        <div class="checkbox panel-heading">
                                            <label class="z-check z-check-validform"
                                                   data-toggle="collapse"
                                                   data-parent="#demol" href="#ck1">
                                                <input  type="radio" class="ace" name="type_id"
                                                        {{ (!empty(old('zhaobiao')))?'checked':'' }}
                                                        datatype="*" nullmsg="请选择交易模式"
                                                        value="{{$type_v['id']}}"/>
                                                <span class="lbl text-blod text-size16 pull-left">
                                                    招标模式
                                                </span>
                                            </label>
                                            <div class=" mission-task">
                                                <p class="text-size14 cor-gray89">适合建筑设计、网站开发、软件开发、装修设计等周期较长、工作较复杂的项目类需求，需要找人单独服务。发布需求后，服务商会对你的需求报价，你选择一个合适的一对一服务</p>
                                            </div>
                                        </div>

                                        <div class="mission-task panel-collapse collapse
                                            {{ (!empty(old('zhaobiao')))?'in':'' }}" id="ck1">
                                            <div class="mission-ck z-check-validform-ck">
                                                <div class="checkbox">
                                                    <label class="checkbox-inline">
                                                        设置报名时间
                                                    </label>
                                                </div>
                                                <div class=" input-group" style="width:60%;margin-left:20px;">
                                                    <span class="input-group-addon date-icon" >
                                                        <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <div>
                                                        <input type="text" class="input-sm form-control "
                                                               id="datepiker-begin1"
                                                               onchange="beginAt($(this))"
                                   value="{!! (old('begin_at'))?old('begin_at'):date('Y年m月d日',time()) !!}"
                                                               placeholder="开始时间" >
                                                    </div>
                                                    <span class="input-group-addon  date-icon ">
                                                        <i class="fa fa-exchange"></i>
                                                    </span>
                                                    <div>
                                                        <input type="text" class="input-sm form-control "
                                                               id="datepiker-deadline1"
                                                               onchange="deadline($(this))"
                                                               value="{!! old('delivery_deadline') !!}"
                                                               placeholder="截止时间">
                                                    </div>
                                                </div>
                                            @if($errors->first('start')|| $errors->first('delivery_deadline') )
                                                    <p class="Validform_checktip Validform_wrong">
                                                        {!! $errors->first('begin_at') !!}
                                                        {!! $errors->first('delivery_deadline') !!}
                                                    </p>
                                            @endif
                                                <input name="begin_at{{$type_v['alias']}}" type="hidden" id="begin_at1" datatype="*"
                                                       nullmsg="请填写开始时间！" class="begin_at"
                                   value="{!! (old('begin_at'))?old('begin_at'):date('Y年m月d日',time()) !!}"/>
                                                <input name="delivery_deadline{{$type_v['alias']}}" type="hidden"
                                                       id="delivery_deadline1" class="delivery_deadline"
                                                       ajaxurl="/task/checkDeadlineByBid"
                                                       datatype="*" nullmsg="请填写截止时间！"
                                                       value="{!! old('delivery_deadline') !!}" />
                                                <span class="time_check validform_checktip  Validform_wrong"
                                                      style="width:90%;margin-left:20px;display:none">

                                                </span>
                                                <input type="hidden" name="worker_num{{$type_v['alias']}}" value="1">
                                                <div class="checkbox ">
                                                    <label class="checkbox-inline">
                                                        您的预算
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="number" name="bounty{{$type_v['alias']}}" class="mis-txt"
                                                           placeholder="若无明确预算，可不填">
                                                </div>
                                                <ul class="clearfix checkbox process">
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>发布需求</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>服务商报价</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>选择服务商并托管赏金</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>服务商工作</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>验收付款</p>
                                                    </li>
                                                    <li class="pull-left">
                                                        <span></span>
                                                        <p>评价</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                            </li>
                            <li>
                                <a class="task-tit" href="javascript:;" data-toggle="collapse" data-target="#demor">
                                    <span class="ace-icon fa fa-angle-double-down fa-angle-double-{{ (!empty(old('product')))?'down':'right' }}" data-icon-hide="ace-icon fa fa-angle-double-down" data-icon-show="ace-icon fa fa fa-angle-double-right"></span> 增值服务
                                </a>
                                <div id="demor" class="collapse in {{ (!empty(old('product')))?'in':'' }}">
                                    <ul class="vat">
                                        @foreach($service as $v)
                                            <li class="clearfix">
                                                <div class="pull-left">
                                                    <div class="checkbox pull-left">
                                                        <label>
                                                            <input type="checkbox" name="product[]" {{ (!empty(old('product')) && in_array($v['id'],old('product')))?'checked':'' }} class="taskservice" price="{{ $v['price'] }}" value={{ $v['id'] }}><span>{{ substr($v['title'],3,3) }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="pull-left">
                                                        <p class="text-size14 cor-gray51">{{ $v['title'] }}</p>
                                                        <p class="p-space cor-gray89">
                                                            {{ $v['description'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="pull-right vat-txt">
                                                    ￥{{ $v['price'] }}
                                                </div>
                                            </li>
                                        @endforeach
                                        <li class="clearfix">
                                            <div class="checkbox pull-left">
                                                <label>
                                                    <input type="checkbox" id="taskservice_all"><span class="vat-check" >全选</span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="task-bt">
                        <h3><strong>结算清单</strong></h3>
                        <p class="text-size14">托管赏金：<span>￥<span id="bounty_money">0</span></span></p>
                        <div style="display:none;" id="service-box">
                            <p>增值服务：</p>
                            @foreach($service as $v)
                                <p class="bt-pd" style="display:none;" id="service-{{ $v['id'] }}">
                                    {{ $v['title'] }}：<span>￥{{ $v['price'] }}
                                    </span>
                                </p>
                            @endforeach
                        </div>
                        <p class="text-size14">应付总额 <span>￥<span id="total-price">0</span></span></p>
                        <div class="clearfix text-size12">
                            <label class="inline task-validform-right">
                                @if(!empty($agree))
                                <input type="checkbox" class="ace" name="agree" checked="checked" datatype="*"
                                       nullmsg="请先阅读并同意">
                                <span class="lbl text-muted">&nbsp;&nbsp;&nbsp;我已阅读并同意
                                    <a target="_blank" class="text-under" href="/bre/agree/task_publish">
                                        《{!! $agree->name !!}》
                                    </a>
                                </span>
                                @endif
                            </label>
                        </div>
                        <input type='hidden' name="slutype" value="1" id="slutype"/>
                        <button class="btn btn-primary btn-blue bor-radius2 btn-big3 preservation" onclick="sluSub(1)">
                            保存
                        </button>
                        <a href="javascript:sluSub(2);"  class="text-size14 text-under preview">预览任务</a>
                        <a href="javascript:sluSub(3);" class="text-size14 text-under not_released">暂不发布</a>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 task-l hidden-xs hidden-md hidden-sm col-left">
                <div class="taskside">
                    <p class="text-center text-size14 cor-gray51 mg-bottom20">遇到问题，联系客服免费帮您解决</p>
                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes"
                       class="btn btn-block btn-primary bor-radius2 text-size14 btn-blue">联系在线客服</a>
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
                        <a href="{!! $ad[0]['ad_url'] !!}">
                            <img src="{!! URL($ad[0]['ad_file']) !!}"
                                 alt="" class="img-responsive" width="100%">
                        </a>
                    @else
                        <img src="{{ Theme::asset()->url('images/task-gg.png') }}"
                             alt="" class="img-responsive" width="100%">
                    @endif
                </div>
            </div>

    {!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
    {{--{!! Theme::asset()->container('specific-css')->usepath()->add('issuetask','plugins/ace/css/dropzone.css') !!}--}}
    {!! Theme::asset()->container('specific-css')->usepath()->add('chossen','css/ace/chosen.css') !!}
    {{--{!! Theme::asset()->container('custom-js')->usepath()->add('ace-extra', 'plugins/ace/js/ace/ace-extra.min.js') !!}--}}

    {{--{!! Theme::asset()->container('custom-js')->usepath()->add('dropzone','plugins/ace/js/dropzone.min.js') !!}--}}
    {!! Theme::asset()->container('custom-js')->usepath()->add('chosen', 'plugins/ace/js/chosen.jquery.min.js') !!}
    {!! Theme::widget('ueditor')->render() !!}
    {{--{!! Theme::widget('editor',['plugins'=>CommonClass::getEditorInit(['insertImage'])])->render() !!}--}}
    {!! Theme::widget('datepicker')->render() !!}
    {!! Theme::widget('fileUpload')->render() !!}
    {!! Theme::asset()->container('custom-js')->usepath()->add('task', 'js/doc/task.js') !!}
    <!--日历 有可能是手机端的，暂时不能删除-->
    {{--{!! Theme::asset()->container('custom-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}--}}
    {{--{!! Theme::asset()->container('custom-js')->usepath()->add('touch-punch', 'plugins/ace/js/jquery.ui.touch-punch.min.js') !!}--}}

    {!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
    {!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}