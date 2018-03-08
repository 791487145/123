
                    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">流程配置</h3>

                    <div class="g-backrealdetails clearfix bor-border interface">
                        <form class="form-horizontal" action="/manage/configUpdate" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="change_ids" value="" id="change-ids">
                                {{--<div class="widget-header widget-header-flat">
                                    <h5 class="widget-title">服务规则和服务资金设置</h5>
                                </div>--}}
                            <div class="space-8 col-xs-12"></div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 text-right">服务最小金额设定</label>
                                <div class="col-sm-9 ">
                                    <input type="text" name="{{ $config['employ_bounty_min_limit']['id'] }}" value="{{ $config['employ_bounty_min_limit']['rule'] }}" class="change_ids" > 元(设置服务最小金额不得小于0元)
                                </div>
                            </div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 text-right">服务成功提成比例</label>
                                <div class="col-sm-9 "><input type="text" name="{{ $config['employ_percentage']['id'] }}" value="{{ $config['employ_percentage']['rule'] }}" class="change_ids"> %(站长提取任务佣金的百分比，设为0即无抽佣)</div>
                            </div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 text-right">订单待受理时限</label>
                                <div class="col-sm-9 "><input type="text" name="{{ $config['employ_except_time']['id'] }}" value="{{ $config['employ_except_time']['rule'] }}" class="change_ids"> 小时(设置X小时以后，未受理订单将会在X小时候后取消)</div>
                            </div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 text-right"> 维权时间限定配置</label>
                                <div class="col-sm-9 ">
                                    <input type="text"  name="{{ $config['employee_right_time']['id'] }}" value="{{ $config['employee_right_time']['rule'] }}" class="change_ids"> 小时(服务商交付以后，可以维权的等待时间X小时，设为0则无限制）</div>
                            </div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 text-right">取消服务时间配置</label>
                                <div class="col-sm-9 "><input type="text" name="{{ $config['employer_cancel_time']['id'] }}" value="{{ $config['employee_right_time']['rule'] }}" class="change_ids"> 小时(站长在发布任务后的X小时之后才能取消任务)</div>
                            </div>
                            <div class="form-group interface-bottom col-xs-12">
                                <label class="col-sm-1 text-right">验收最长天数配置：</label>
                                <div class="col-sm-9 "><input type="text" name="{{ $config['employer_delivery_time']['id'] }}" value="{{ $config['employer_delivery_time']['rule'] }}" class="change_ids"> 天(服务完成后，X天雇主未验收，系统自动验收)</div>
                            </div>
                            <div class=" interface-bottom col-xs-12">
                                <label class="col-sm-1 text-right"> 验收好评时间配置</label>
                                <div class="col-sm-9 "> <input type="text" name="{{ $config['employ_comment_time']['id'] }}" value="{{ $config['employ_comment_time']['rule'] }}" class="change_ids"> 天(未评价系统默认时间X天好评)</div>
                            </div>
                            <div class="col-xs-12">
                                <div class="clearfix row bg-backf5 padding20 mg-margin12">
                                    <div class="col-xs-12">
                                        <div class="col-sm-1 text-right"></div>
                                        <div class="col-sm-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="space"></div>
                            <div class="text-right">
                                <button class="btn btn-info">提交</button>　　
                            </div>--}}
                        </form>
                    </div>
{!! Theme::widget('editor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('backemploy', 'js/doc/backemploy.js') !!}