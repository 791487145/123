
            <div class="widget-header mg-bottom20 mg-top12 widget-well">
                <div class="widget-toolbar no-border pull-left no-padding">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="/manage/financeStatement">网站收支</a>
                        </li>

                        <li class="">
                            <a href="/manage/financeRecharge">充值记录</a>
                        </li>
                        <li class="">
                            <a href="/manage/financeWithdraw">提现记录</a>
                        </li>
                        <li class="">
                            <a href="/manage/financeProfit">利润统计</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--网站收支-->

                    <div class="clearfix">
                        <div class="col-md-6">
                            <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header-small">
                                    <h4 class="widget-title lighter">
                                        <i class="ace-icon fa fa-signal"></i>
                                        收支表
                                    </h4>

                                </div>

                                <div class="widget-body">
                                    <div class="widget-main padding-4">
                                        <div id="budget-charts"></div>
                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div><!-- /.widget-box -->
                            <div class="space"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header-small">
                                    <h4 class="widget-title lighter">
                                        <i class="ace-icon fa fa-signal"></i>
                                        财务盈利表
                                    </h4>

                                </div>

                                <div class="widget-body">
                                    <div class="widget-main padding-4">
                                        <div id="profit-charts"></div>
                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div><!-- /.widget-box -->
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat widget-header-small">
                                            <h4 class="widget-title lighter">
                                                <i class="ace-icon fa fa-signal"></i>
                                                充值表
                                            </h4>

                                            <div class="widget-toolbar no-border">
                                                <a href="{!! url('manage/financeRecharge') !!}">
                                                    查看明细>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main padding-4">
                                                <div id="sales-charts1"></div>
                                            </div><!-- /.widget-main -->
                                        </div><!-- /.widget-body -->
                                    </div><!-- /.widget-box -->
                                </div>
                                <div class="col-md-3">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat widget-header-small">
                                            <h4 class="widget-title lighter">
                                                <i class="ace-icon fa fa-signal"></i>
                                                提现表
                                            </h4>

                                            <div class="widget-toolbar no-border">
                                                <a href="{!! url('manage/financeWithdraw') !!}">
                                                    查看明细>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main padding-4">
                                                <div id="sales-charts2"></div>
                                            </div><!-- /.widget-main -->
                                        </div><!-- /.widget-body -->
                                    </div><!-- /.widget-box -->
                                </div>
                                <div class="col-md-3">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat widget-header-small">
                                            <h4 class="widget-title lighter">
                                                <i class="ace-icon fa fa-signal"></i>
                                                任务收益表
                                            </h4>

                                            <div class="widget-toolbar no-border">
                                                <a href="{!! url('manage/financeProfit') !!}">
                                                    查看明细>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main padding-4">
                                                <div id="sales-charts3"></div>
                                            </div><!-- /.widget-main -->
                                        </div><!-- /.widget-body -->
                                    </div><!-- /.widget-box -->
                                </div>
                                <div class="col-md-3">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat widget-header-small">
                                            <h4 class="widget-title lighter">
                                                <i class="ace-icon fa fa-signal"></i>
                                                增值服务表
                                            </h4>

                                            <div class="widget-toolbar no-border">
                                                <a href="{!! url('manage/financeProfit') !!}">
                                                    查看明细>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main padding-4">
                                                <div id="sales-charts4"></div>
                                            </div><!-- /.widget-main -->
                                        </div><!-- /.widget-body -->
                                    </div><!-- /.widget-box -->
                                </div>
                            </div>
                        </div>
                    </div>

<div id="finance" data-data='{!! $finance !!}'></div>
<div id="broken" data-data='{!! $broken !!}'></div>
<div id="dateArr" data-data='{!! $dateArr !!}'></div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('flot-js', 'plugins/ace/js/flot/jquery.flot.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('flotZesize-js', 'plugins/ace/js/flot/jquery.flot.resize.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('reporting-js', 'js/reporting.js') !!}