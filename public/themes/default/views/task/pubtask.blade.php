<section>
    <div class="container">
        <!--广告位-->
        <div class="row poster col-md-12">
            <img class="img-responsive poster-img" src="{!! Theme::asset()->url('img/as.jpg') !!}"  width="100%" alt="">
        </div><!--/广告位-->

        <div class="row">
            <div class="col-md-4 task-l">
                <ul class="step">
                    <li class="step-item text-center action">
                        <span class="step-num step-action"><span class="num-bg num-action">描述需求 <br>2016.02.01</span></span>
                    </li>
                    <li class="step-item text-center">
                        <span class="step-num"><span class="num-bg">需求赏金 <br>2016.02.01</span></span>
                    </li>
                    <li class="step-item text-center">
                        <span class="step-num"><span class="num-bg num-pd">确认需求 <br>托管赏金 <br>2016.02.01</span></span>
                    </li>
                    <li class="step-item text-center">
                        <span class="step-num"><span class="num-bg num-pd">等待审核 <br>预计时间<br>2016.02.01</span></span>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 list-l ">
                <form action="/task/createTask" method="post" id="form">
                    {!! csrf_field() !!}
                <div class="task-r">
                    <ul>
                        <li>
                            <a class="task-tit" href="javascript:;" data-toggle="collapse" data-target="#demo"><span class="fa fa-angle-double-right"></span> 描述需求</a></a>
                            <div id="demo" class="collapse in">
                                <div class="form-group task-phone">
                                    <label for="name" class="phone">联系手机：</label>
                                    <input type="text" class="form-control task-input" id="name" name="phone" placeholder="请输入手机号">
                                    {!! $errors->first('phone') !!}
                                </div>
                                <div class="task-select">
                                    <p>选择需要做什么：</p>
                                    @foreach($hotcate as $v)
                                    <a href="javascript:chooseCate({{ $v['id'] }});">{{ $v['name'] }}</a>
                                    @endforeach
                                    <a class="select-txt" href="javascript:void(0);" id="morecate">更多>></a>
                                    <input type="hidden" name="cate_id" id="task_category" />
                                    <p>{!! $errors->first('cate_id') !!}</p>
                                </div>

                                <div class="task-select" style="display:none" id="what-cate">
                                    <span>您选择的是：</span>
                                    <span id="task-choose">设计 >> 平面设计</span>
                                </div>
                                <div class="task-bar">
                                    <p>地域：</p>
                                    <a class="area-limit" href="javascript:void(0);">不限地域</a>
                                    <a class="area-limit bar-txt" href="javascript:void(0);">限制地域</a>
                                    <span id="area_select" style="display: none;">
                                        <select name="province" style="margin-left:20px;" onchange="checkprovince(this)">
                                            @foreach($area as $v)
                                            <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <select name="city" id="province_check" onchange="checkcity(this)">
                                            <option>北京市</option>
                                        </select>
                                        <select name="area" id="area_check" onchange="arealimit(this)">
                                            @foreach($beijing as $v)
                                                <option value={{ $v['id'] }}>{{ $v['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                    <span>
                                        @foreach($area as $v)
                                        <div style="display:none;" id="province-{{ $v['id'] }}">
                                            @if(!empty($v['children_area']))
                                                @foreach($v['children_area'] as $value)
                                                    <option value={{ $v['id'] }}>{{ $value['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </div>
                                        @endforeach
                                    </span>
                                    <input type="hidden" name="area" id="region-limit" value="0" />
                                </div>
                                <div class="form-group">
                                    <p>明确需求标题和详情：</p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="text" class="col-xs-10 col-sm-5" name="title" id="form-input-readonly" placeholder="一句话描述您的需求，XX餐饮公司VI设计">
                                            <span class="help-inline col-xs-12 col-sm-7">
                                                <label class="middle">
                                                    <input class="ace" type="checkbox" id="id-disable-check">
                                                    <span class="lbl"><a href="javascript:;">参照发布实例</a></span>
                                                    <span class="lbl txt-lbl"><a href="javascript:;">逛任务大厅看看别人怎么写</a></span>
                                                </label>
                                            </span>
                                            <p>{!! $errors->first('title') !!}</p>
                                        </div>

                                    </div>
                                </div>

                                <!--编辑器-->
                                <div id="editor" class="editor">
                                    <div id='edit'>
                                        <input type="text" value="sss" name="description" />
                                        {!! $errors->first('description') !!}
                                    </div>
                                </div>

                                <div class="annex" id="file_update">
                                    <p><input class="btn btn-default " type="file" id="fileUpdate" url='{!! Theme::asset()->url('uploadify_bak.swf') !!}' value="上传附件">&nbsp;&nbsp;最多可添加3个附件，每个大小不超过10MB</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="task-tit" href="javascript:;" data-toggle="collapse" data-target="#demol"><span class="fa fa-angle-double-right"></span> 任务模式</a></a>
                            <div id="demol" class="collapse in">
                                <div class="model" type=1>
                                    <p class="mission-tit" style="margin-top:10px;"><i class="fa fa-check"></i> 悬赏模式</p>
                                    <div class=" mission-task">
                                        <span><p class="mis-tb">威客们先工作，再选中标作品。托管赏金后吸引更多威客。</p></span>
                                        <div class="mission-ck">
                                            <div class="checkbox">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> 有明确预算，明确的预算更能吸引服务商参与
                                                </label>
                                            </div>
                                            <input type="text" name="bounty" class="mis-txt">
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! $errors->first('bounty') !!}</p>
                                            <div class="checkbox">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox"  id="inlineCheckbox2" value="option2"> 希望有多少服务商完成此任务？
                                                </label>
                                            </div>
                                            <input type="text" name="worker_num" class="mis-txt">
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! $errors->first('body') !!}</p>
                                            <div class="checkbox">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox"  id="inlineCheckbox3" value="option3"> 您需要何时完成？
                                                </label>
                                            </div>
                                            <input type="text" name="delivery_deadline" class="mis-txt">
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! $errors->first('end_time') !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="model" type=2>
                                    <p class="mission-xs"><i class="fa fa-circle-o"></i> 投标模式</p>
                                    <span><p class="mis-tb">先选中标威客，TA再工作。找到中标威客后托管赏金。</p></span>
                                </div>
                                <input type="hidden" value="1" name="type_id" id="task-type"/>
                            </div>
                        </li>
                        <li>
                            <a class="task-tit" href="javascript:;" data-toggle="collapse" data-target="#demor"><span class="fa fa-angle-double-right"></span> 增值服务</a></a>
                            <div id="demor" class="collapse in">
                                <ul class="vat">
                                    @foreach($service as $v)
                                    <li class="clearfix">
                                        <div class="pull-left">
                                            <div class="checkbox pull-left">
                                                <label>
                                                    <input type="checkbox" name="product[]" value={{ $v['id'] }}><span>{{ substr($v['title'],0,3) }}</span>
                                                </label>
                                            </div>
                                            <div class="pull-left">
                                                <p>{{ $v['title'] }}</p>
                                                <p>{{ $v['description'] }}</p>
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
                                                <input type="checkbox"><span class="vat-check" >全选</span>
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
                    <p>托管赏金：<span>￥500.00</span></p>
                    <p>增值服务：</p>
                    <p class="bt-pd">加急：<span>￥50.00</span></p>
                    <p>应付总额 <span>￥550.00</span></p>
                    <input class="btn-red" type="submit" value="发布任务"><a href="javascript:;">暂不发布</a>
                </div>
                </form>
            </div>
        </div><!-- /.row -->
        <!-- 模态框（Modal） -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#e4e4e4;">
                        <button type="button" class="close" data-dismiss="modal" id="model-close" aria-hidden="true">
                            &times;
                        </button>
                        <h5 class="modal-title" id="myModalLabel"><b>选择您需要做什么</b></h5>
                    </div>
                    <div class="modal-body">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="active">
                                <a href="#design" data-toggle="tab">找设计</a>
                            </li>
                            <li>
                                <a href="#document" data-toggle="tab">找文案</a>
                            </li>
                            <li>
                                <a href="#devolop" data-toggle="tab">找开发</a>
                            </li>
                            <li>
                                <a href="#fitment" data-toggle="tab">找装修</a>
                            </li>
                            <li>
                                <a href="#marketing" data-toggle="tab">找营销</a>
                            </li>
                            <li>
                                <a href="#commerce" data-toggle="tab">找商务</a>
                            </li>
                            <li>
                                <a href="#life" data-toggle="tab">找生活</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="design">
                                <ul class="list-group">
                                    @foreach($category as $v)
                                        @if($v['type']==1)
                                            <li class="list-group-item">
                                                <b>{{ $v['name'] }}</b>
                                                @if(!empty($v['children_task']))
                                                    @foreach($v['children_task'] as $value)
                                                        <a href="javascript:chooseCate({{ $value['id'] }});">{{ $value['name'] }}</a>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                            </div>
                            <div class="tab-pane fade in " id="document">
                                <ul class="list-group">
                                    @foreach($category as $v)
                                        @if($v['type']==2)
                                            <li class="list-group-item">
                                                <b>{{ $v['name'] }}</b>
                                                @if(!empty($v['children_task']))
                                                    @foreach($v['children_task'] as $value)
                                                        <a href="javascript:chooseCate({{ $value['id'] }});">{{ $value['name'] }}</a>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div><div class="tab-pane fade in " id="devolop">
                                <ul class="list-group">
                                    @foreach($category as $v)
                                        @if($v['type']==3)
                                            <li class="list-group-item">
                                                <b>{{ $v['name'] }}</b>
                                                @if(!empty($v['children_task']))
                                                    @foreach($v['children_task'] as $value)
                                                        <a href="javascript:chooseCate({{ $value['id'] }});">{{ $value['name'] }}</a>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div><div class="tab-pane fade in " id="fitment">
                                <ul class="list-group">
                                    @foreach($category as $v)
                                        @if($v['type']==4)
                                            <li class="list-group-item">
                                                <b>{{ $v['name'] }}</b>
                                                @if(!empty($v['children_task']))
                                                    @foreach($v['children_task'] as $value)
                                                        <a href="javascript:chooseCate({{ $value['id'] }});">{{ $value['name'] }}</a>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div><div class="tab-pane fade in " id="marketing">
                                <ul class="list-group">
                                    @foreach($category as $v)
                                        @if($v['type']==5)
                                            <li class="list-group-item">
                                                <b>{{ $v['name'] }}</b>
                                                @if(!empty($v['children_task']))
                                                    @foreach($v['children_task'] as $value)
                                                        <a href="javascript:chooseCate({{ $value['id'] }});">{{ $value['name'] }}</a>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div><div class="tab-pane fade in " id="commerce">
                                <ul class="list-group">
                                    @foreach($category as $v)
                                        @if($v['type']==6)
                                            <li class="list-group-item">
                                                <b>{{ $v['name'] }}</b>
                                                @if(!empty($v['children_task']))
                                                    @foreach($v['children_task'] as $value)
                                                        <a href="javascript:chooseCate({{ $value['id'] }});">{{ $value['name'] }}</a>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div><div class="tab-pane fade in " id="life">
                                <ul class="list-group">
                                    @foreach($category as $v)
                                        @if($v['type']==7)
                                            <li class="list-group-item">
                                                <b>{{ $v['name'] }}</b>
                                                @if(!empty($v['children_task']))
                                                    @foreach($v['children_task'] as $value)
                                                        <a href="javascript:chooseCate({{ $value['id'] }});">{{ $value['name'] }}</a>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div style="display:none;" id="ceshi">
                        <li id="tasks-ceshi">sss</li>
                        @foreach($parentcate as $v)
                            <li id="category{{ $v['id'] }}">{{ $v['parent_task']['name']}} >> {{ $v['name'] }}</li>
                        @endforeach
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div><!-- 模态框（Modal）end -->

        <!--广告位-->
        <div class="row poster col-md-12 ">
            <img class="img-responsive poster-img" src="{!! Theme::asset()->url('img/as.jpg') !!}"  width="100%" alt="">
        </div><!--/广告位-->
    </div>
</section>
{!! Theme::asset()->container('footer2')->usepath()->add('issuetask','css/issuetask.css') !!}
{!! Theme::asset()->container('footer2')->usepath()->add('froala_editor','css/editor/froala_editor.min.css') !!}
{!! Theme::asset()->container('footer')->usepath()->add('froala_editor', 'js/editor/js/froala_editor.min.js') !!}
{!! Theme::asset()->container('footer')->usepath()->add('froala_editor_ie8', 'js/editor/js/froala_editor_ie8.min.js') !!}
{!! Theme::asset()->container('footer')->usepath()->add('tables', 'js/editor/js/plugins/tables.min.js') !!}
{!! Theme::asset()->container('footer')->usepath()->add('colors', 'js/editor/js/plugins/colors.min.js') !!}
{!! Theme::asset()->container('footer')->usepath()->add('font_family', 'js/editor/js/plugins/font_family.min.js') !!}
{!! Theme::asset()->container('footer')->usepath()->add('font_size', 'js/editor/js/plugins/font_size.min.js') !!}
{!! Theme::asset()->container('footer')->usepath()->add('block_styles', 'js/editor/js/plugins/block_styles.min.js') !!}
{!! Theme::asset()->container('footer')->usepath()->add('video', 'js/editor/js/plugins/video.min.js') !!}
{!! Theme::asset()->container('footer')->usepath()->add('uploadify', 'js/jquery.uploadify.min.js') !!}
{!! Theme::asset()->container('footer')->usepath()->add('task', 'task_back.jsck.js') !!}