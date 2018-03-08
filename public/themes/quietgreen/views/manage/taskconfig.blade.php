<div class="row">
    <div class="col-xs-12 widget-container-col ui-sortable">
        <div class="widget-box transparent ui-sortable-handle">
            <div class="widget-header">
                <h3 class="widget-title lighter"> 流程配置</h3>
            </div>

            <div class="widget-body">

                <div class="widget-main padding-12 no-padding-left no-padding-right">
                    <div class="tab-content padding-4">
                        <div id="basic" class="tab-pane {{ ($id==0)?'active row':'' }} ">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat">
                                            <h5 class="widget-title">基本配置</h5>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main row ">
                                                <table class="table table-hover mg-bottom0">
                                                    <form action="/manage/baseConfig" method="post" >
                                                        {{ csrf_field() }}
                                                        <tbody>
                                                    <tr>
                                                        <td class=" flow-money text-right">模型名称：</td>
                                                        <td>
                                                            <input type="text"  placeholder="悬赏任务" name="name" value="{{ $model_data['name'] }}" class="col-xs-10 col-sm-2">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" flow-money text-right">是否开启：</td>
                                                        <td class="basic-radio">
                                                            <label>
                                                                <input type="radio" name="status" value="1" {{ ($model_data['status']==1)?'checked':'' }} class="ace">
                                                                <span class="lbl">　开启　　　</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="status" value="0" {{ ($model_data['status']==0)?'checked':'' }} class="ace">
                                                                <span class="lbl">　关闭　</span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" flow-money text-right">模型说明：</td>
                                                        <td>
                                                            <div class="clearfix">
                                                                <input type="hidden" name="desc" id="description" value="{{ $model_data['desc'] }}">
                                                                <div class="wysiwyg-editor" id="editor1">{{ $model_data['desc'] }}</div>
                                                                <div class="widget-toolbox padding-4 clearfix">
                                                                    <div class="btn-group pull-right">
                                                                        <button class="btn btn-sm btn-success btn-round" id="onsubmit">

                                                                            提交

                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    </form>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="flow" class="tab-pane {{ ($id==1)?'active row':'' }}">
                            <form action="/manage/taskConfigUpdate" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="change_ids" value="" id="change-ids">
                            <div class="col-sm-8 flow-task">
                                <div class="widget-box">
                                    <div class="widget-header widget-header-flat">
                                        <h5 class="widget-title">任务佣金策略：任务规则设置和异常任务资金分配</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main row paddingTop">
                                            <div class="table-responsive">
                                                <table class="table table-hover mg-bottom0">
                                                    <tbody>
                                                    <tr>
                                                        <td class="col-sm-3 flow-money text-right">任务审核金额设定：</td>
                                                        <td> <input type="text" name="{{ $config['task_bounty_limit']['id'] }}" value="{{ $config['task_bounty_limit']['rule'] }}" class="change_ids"> 元(发布赏金低于该设定金额的任务需要审核，设为0即无限制)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-3 flow-money text-right">任务最大金额设定：</td>
                                                        <td> <input type="text" name="{{ $config['task_bounty_max_limit']['id'] }}" value="{{ $config['task_bounty_max_limit']['rule'] }}" class="change_ids"> 元(设置任务最大金额,为0时不生效)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-3 flow-money text-right">任务最小金额设定：</td>
                                                        <td> <input type="text" name="{{ $config['task_bounty_min_limit']['id'] }}" value="{{ $config['task_bounty_min_limit']['rule'] }}" class="change_ids"> 元(设置任务最小金额不得小于0元)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-3 flow-money text-right">任务提成比例：</td>
                                                        <td> <input type="text" name="{{ $config['task_percentage']['id'] }}" value="{{ $config['task_percentage']['rule'] }}" class="change_ids"> %(站长提取任务佣金的百分比，设为0即无抽佣)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-3 flow-money text-right">任务失败返金抽成比例：</td>
                                                        <td> <input type="text" name="{{ $config['task_fail_percentage']['id'] }}" value="{{ $config['task_fail_percentage']['rule'] }}" class="change_ids"> 元(发布赏金低于该设定金额的任务需要审核，设为0即无限制)</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 flow-assist">
                                <div class="widget-box">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="widget-title smaller">系统辅助流程规则:</h4>

                                        <div class="widget-toolbar">
                                            <label>
                                                <input id="id-check-horizontal" type="checkbox" {{ ($config['task_sys_help_switch']['rule'])?'checked':'' }}  class="ace ace-switch ace-switch-6 change_sys_help" />
                                                <span class="lbl middle"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="widget-body ">
                                        <div class="widget-main flow-foot  minHeight249" >
                                            <div id="dt-list-1">
                                                <p class="well well-sm"> 声明：该功能适用于选稿期结束后有投稿雇主未选稿时</p>
                                                <div >
                                                    {{--<lable>--}}
                                                        {{--<input type="text" name="{{ $config['task_sys_help_people']['id'] }}" value="{{ $config['task_sys_help_people']['rule'] }}" class="change_ids"> 人中标平分佣金,不填写则默认关闭--}}
                                                    {{--</lable>--}}
                                                    {{--<br>--}}
                                                    {{--<hr>--}}
                                                </div>
                                                <div>
                                                    <lable>
                                                        系统自动选稿规则：
                                                        <select name="{{ $config['task_sys_help_rule']['id'] }}" class="change_ids">
                                                            <option value="1" {{ ($config['task_sys_help_rule']['rule']==1)?'selected':'' }}>最先交稿</option>
                                                            <option value="2" {{ ($config['task_sys_help_rule']['rule']==2)?'selected':'' }}>威客好评率</option>
                                                            <option value="3" {{ ($config['task_sys_help_rule']['rule']==3)?'selected':'' }}>参与任务次数</option>
                                                        </select>
                                                    </lable>
                                                    <br><br>
                                                </div>
                                                <p class="well well-sm">注：(同等条件情况下依次复加考虑下拉选项中的规则)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-8 col-sm-12"></div>
                            <div class="col-sm-12">
                                <div class="widget-box">
                                    <div class="widget-header widget-header-flat">
                                        <h5 class="widget-title">任务佣金策略：任务规则设置和异常任务资金分配</h5>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main row paddingTop">
                                            <div class="table-responsive">
                                                <table class="table table-hover mg-bottom0">
                                                    <tbody>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">任务交稿截止时间最大规则：</td>
                                                        <td>
                                                            <table class="mg-bottom0">
                                                                <tbody id="add-rule">
                                                                @if(!empty($config['task_delivery_limit_time']['rule']))
                                                                    @foreach(json_decode($config['task_delivery_limit_time']['rule'],true) as $k=>$v)
                                                                        <tr>
                                                                            <td >
                                                                                <input type="text" name="money[]" value="{{ $k }}"> 元以下
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="day[]" value="{{ $v }}"> 天　
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:void(0);"  onclick="addrule()">添加规则</a>
                                                                                <a href="javascript:void(0);"  onclick="removerule($(this))">删除规则</a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="space-4"></div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td >
                                                                            <input type="text" name="money[]" value=""> 元以下　
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" name="day[]" value=""> 天　
                                                                        </td>
                                                                        <td>
                                                                            <a href="javascript:void(0);" class="addrule">添加规则</a>
                                                                            <a href="javascript:void(0);" class="removerule">删除规则</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="space-4"></div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">任务公示期：</td>
                                                        <td> <input type="text" name="{{ $config['task_publicity_day']['id'] }}" value="{{ $config['task_publicity_day']['rule'] }}" class="change_ids"> 天（大于等于0的整数天，设为0即无公示期）</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">任务交稿截止最小天数：</td>
                                                        <td> <input type="text" name="{{ $config['task_delivery_min']['id'] }}" value="{{ $config['task_delivery_min']['rule'] }}" class="change_ids"> 天（大于等于1的整数天，且需要小于等于交稿时间最大规则天数）</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">新注册用户投票时间限制：</td>
                                                        <td> <input type="text" name="{{ $config['task_vote_time']['id'] }}" value="{{ $config['task_vote_time']['rule'] }}" class="change_ids"> 小时（大于等于0的整数小时，设为0即无注册时间限制）</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">选稿时间设置：</td>
                                                        <td> <input type="text" name="{{ $config['task_select_work']['id'] }}" value="{{ $config['task_select_work']['rule'] }}" class="change_ids"> 天(大于等于1的整数天)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">交付期最大时间限制：</td>
                                                        <td> <input type="text" name="{{ $config['task_delivery_max_time']['id'] }}" value="{{ $config['task_delivery_max_time']['rule'] }}" class="change_ids"> 天  （逾期未完成交付，任务直接冻结交由管理员处理）</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-sm-2 flow-money text-right">验收期最大时间限制：</td>
                                                        <td> <input type="text" name="{{ $config['task_check_time_limit']['id'] }}" value="{{ $config['task_check_time_limit']['rule'] }}" class="change_ids"> 天  （逾期未验收的，任务稿件直接通过验收阶段）</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center col-sm-12">
                                <br>
                                <button class="btn btn-primary btn-sm">保存</button>
                            </div>
                            </form>
                        </div>

                        <div id="power" class="tab-pane {{ ($id==2)?'active row':'' }}">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <div class="well well-sm col-sm-12">
                                        <lable>
                                            任务模型：
                                            <select name="type" >
                                                @foreach($all_model as $v)
                                                    <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </lable>
                                    </div>
                                    <div class="well well-sm col-sm-12 clearfix">
                                        <lable class="pull-left power-pour">项目名称 注：需满足下列条件才能进行相关操作</lable>
                                        <button class="btn btn-primary pull-right btn-sm">提交</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 power-chunk">
                                <div class="col-sm-6 power-buy">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat">
                                            <h5 class="widget-title">发布任务　　买家（雇主）</h5>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <div class="table-responsive">
                                                    <form>
                                                        <span class="help-inline power-list">
                                                            <label class="middle">
                                                                <input class="ace" type="checkbox" id="id-disable-check1">
                                                                <span class="lbl"> 邮箱认证</span>
                                                            </label>
                                                        </span>
                                                        <span class="help-inline power-list">
                                                            <label class="middle">
                                                                <input class="ace" type="checkbox" id="id-disable-check2">
                                                                <span class="lbl"> 银行认证</span>
                                                            </label>
                                                        </span>
                                                        <span class="help-inline power-list">
                                                            <label class="middle">
                                                                <input class="ace" type="checkbox" id="id-disable-check3">
                                                                <span class="lbl"> 手机认证</span>
                                                            </label>
                                                        </span>
                                                        <span class="help-inline power-list">
                                                            <label class="middle">
                                                                <input class="ace" type="checkbox" id="id-disable-check4">
                                                                <span class="lbl"> 实名或企业认证</span>
                                                            </label>
                                                        </span>
                                                        <span class="help-inline  power-list">
                                                            <label class="middle">
                                                                <input class="ace" type="checkbox" id="id-disable-check5">
                                                                <span class="lbl"> 支付宝认证</span>
                                                            </label>
                                                        </span>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 power-sell">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat">
                                            <h5 class="widget-title">交稿　　卖家（威客）</h5>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <form>
                                                    <span class="help-inline power-list">
                                                        <label class="middle">
                                                            <input class="ace" type="checkbox" id="id-disable-check6">
                                                            <span class="lbl"> 邮箱认证</span>
                                                        </label>
                                                    </span>
                                                    <span class="help-inline power-list">
                                                        <label class="middle">
                                                            <input class="ace" type="checkbox" id="id-disable-check7">
                                                            <span class="lbl"> 银行认证</span>
                                                        </label>
                                                    </span>
                                                    <span class="help-inline power-list">
                                                        <label class="middle">
                                                            <input class="ace" type="checkbox" id="id-disable-check8">
                                                            <span class="lbl"> 手机认证</span>
                                                        </label>
                                                    </span>
                                                    <span class="help-inline power-list">
                                                        <label class="middle">
                                                            <input class="ace" type="checkbox" id="id-disable-check9">
                                                            <span class="lbl"> 实名或企业认证</span>
                                                        </label>
                                                    </span>
                                                    <span class="help-inline power-list">
                                                        <label class="middle">
                                                            <input class="ace" type="checkbox" id="id-disable-check10">
                                                            <span class="lbl"> 支付宝认证</span>
                                                        </label>
                                                    </span>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><!-- /.row -->
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('taskconfig', 'js/doc/taskconfig.js') !!}

{!! Theme::asset()->container('specific-js')->usePath()->add('hotkeys', 'plugins/ace/js/jquery.hotkeys.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('bootstrap-wysiwyg', 'plugins/ace/js/bootstrap-wysiwyg.min.js') !!}