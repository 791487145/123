<div class="page-content-area">
    <div class="row">
        <div class="col-xs-12">

            <div class="row">
                <div class="space-6"></div>

                <div class="col-sm-3 infobox-container">
                    <!-- #section:pages/dashboard.infobox -->
                    <div class="infobox infobox-green clearfix" style="width: 100%;">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-users"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{!! $topCount['todayUser'] !!}</span>
                            <div class="infobox-content">用户数（人）</div>
                        </div>

                        <!-- #section:pages/dashboard.infobox.stat -->
                        <div @if($topCount['userScale'] > 0 || $topCount['userScale'] == 0)class="stat stat-success"@elseif($topCount['userScale'] < 0)class="stat stat-important"@endif>
                            {!! abs($topCount['userScale']) !!}%
                        </div>

                        <!-- /section:pages/dashboard.infobox.stat -->
                    </div>
                    <!-- /section:pages/dashboard.infobox.dark -->
                </div>
                <div class="col-sm-3 infobox-container">

                    <div class="infobox infobox-blue" style="width: 100%;">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-cubes"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{!! $topCount['todayTask'] !!}</span>
                            <div class="infobox-content">任务数（条）</div>
                        </div>

                        <div @if($topCount['taskScale'] > 0 || $topCount['taskScale'] == 0)class="stat stat-success"@elseif($topCount['taskScale'] < 0)class="stat stat-important"@endif>
                            {!! abs($topCount['taskScale']) !!}%
                        </div>
                    </div>

                    <!-- /section:pages/dashboard.infobox.dark -->
                </div>
                <div class="col-sm-3 infobox-container">

                    <div class="infobox infobox-pink" style="width: 100%;">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-credit-card"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{!! $topCount['todayRecharge'] !!}</span>
                            <div class="infobox-content">充值金额（元）</div>
                        </div>
                        <div @if($topCount['rechargeScale'] > 0 || $topCount['rechargeScale'] == 0)class="stat stat-success"@elseif($topCount['rechargeScale'] < 0)class="stat stat-important"@endif>
                            {!! abs($topCount['todayRecharge']) !!}%
                        </div>
                    </div>

                </div>
                <div class="col-sm-3 infobox-container">
                    <!-- #section:pages/dashboard.infobox -->

                    <div class="infobox infobox-red" style="width: 100%;">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-rmb"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">{!! $topCount['todayCashout'] !!}</span>
                            <div class="infobox-content">提现金额（元）</div>
                        </div>
                        <div @if($topCount['cashoutScale'] > 0 || $topCount['cashoutScale'] == 0)class="stat stat-success"@elseif($topCount['cashoutScale'] < 0)class="stat stat-important"@endif>
                            {!! abs($topCount['cashoutScale']) !!}%
                        </div>
                    </div>

                    <!-- /section:pages/dashboard.infobox.dark -->
                </div>

                <div class="vspace-12-sm"></div>

            </div><!-- /.row -->

            <!-- #section:custom/extra.hr -->
            <div class="space"></div>

            <!--任务统计-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="widget-box clearfix">
                        <div class="widget-header widget-header-flat widget-header-small">
                            <h5 class="widget-title">
                                <i class="ace-icon fa fa-signal"></i>
                                任务统计
                            </h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-4 clearfix">
                                <div class="clearfix">
                                    <div class="col-lg-10 col-md-12 col-sm-12">
                                        <div id="sales-charts"></div>
                                    </div>
                                    <div class="space-16"></div>
                                    <div class="infobox-container">
                                        <div class="infobox infobox-orange2">
                                            <!-- #section:pages/dashboard.infobox.sparkline -->
                                            <div class="infobox-chart">
                                                <span class="sparkline sparklineBar-blue" data-values="196,128,202,177,154,94,100,170,224"></span>
                                            </div>

                                            <!-- /section:pages/dashboard.infobox.sparkline -->
                                            <div class="infobox-data">
                                                <span class="infobox-data-number">{!! $topCount['taskCount'] !!}</span>
                                                <div class="infobox-content">总任务数</div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2">
                                            <!-- #section:pages/dashboard.infobox.sparkline -->
                                            <div class="infobox-chart">
                                                <span class="sparkline sparklineLine-gray" data-values="196,128,202,177,154,94,100,170,224"></span>
                                            </div>

                                            <!-- /section:pages/dashboard.infobox.sparkline -->
                                            <div class="infobox-data">
                                                <span class="infobox-data-number">{!! $topCount['successTaskCount'] !!}</span>
                                                <div class="infobox-content">完成的任务</div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2">
                                            <!-- #section:pages/dashboard.infobox.sparkline -->
                                            <div class="infobox-chart">
                                                <span class="sparkline sparklineBar-red" data-values="196,128,202,177,154,94,100,170,224"></span>
                                            </div>

                                            <!-- /section:pages/dashboard.infobox.sparkline -->
                                            <div class="infobox-data">
                                                <span class="infobox-data-number">{!! $topCount['failTaskCount'] !!}</span>
                                                <div class="infobox-content">失败的任务</div>
                                            </div>
                                        </div>
                                        <div class="infobox infobox-orange2">
                                            <!-- #section:pages/dashboard.infobox.sparkline -->
                                            <div class="infobox-chart">
                                                <span class="sparkline sparklineLine-gray" data-values="196,128,202,177,154,94,100,170,224"></span>
                                            </div>

                                            <!-- /section:pages/dashboard.infobox.sparkline -->
                                            <div class="infobox-data">
                                                <span class="infobox-data-number">{!! $topCount['doingTaskCount'] !!}</span>
                                                <div class="infobox-content">进行的任务</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.widget-main -->

                        </div><!-- /.widget-body -->

                    </div><!-- /.widget-box -->
                </div>
            </div><!-- /.row -->
            <div class="space"></div>

            <!--用户统计-财务统计-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-small">
                            <h5 class="widget-title">
                                <i class="ace-icon fa fa-signal"></i>
                                用户统计
                            </h5>
                        </div>

                        <div class="widget-body clearfix padding-8">
                            <div class="widget-main clearfix padding-14">
                                <!-- #section:plugins/charts.flotchart -->
                                <div id="sales-charts1"></div>
                                <div class="space-6"></div>
                                <div class="infobox-container">
                                    <div class="infobox infobox-orange2">
                                        <!-- #section:pages/dashboard.infobox.sparkline -->
                                        <div class="infobox-chart">
                                            <span class="sparkline sparklineBar-blue" data-values="196,128,202,177,154,94,100,170,224"></span>
                                        </div>

                                        <!-- /section:pages/dashboard.infobox.sparkline -->
                                        <div class="infobox-data">
                                            <span class="infobox-data-number">{!! $topCount['userTotal'] !!}</span>
                                            <div class="infobox-content">总用户数</div>
                                        </div>

                                    </div>
                                    <div class="infobox infobox-orange2">
                                        <!-- #section:pages/dashboard.infobox.sparkline -->
                                        <div class="infobox-chart">
                                            <span class="sparkline sparklineLine-gray" data-values="196,128,202,177,154,94,100,170,224"></span>
                                        </div>

                                        <!-- /section:pages/dashboard.infobox.sparkline -->
                                        <div class="infobox-data">
                                            <span class="infobox-data-number">{!! $topCount['todayUser'] !!}</span>
                                            <div class="infobox-content">今日用户数</div>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="widget-box ">
                        <div class="widget-header widget-header-flat widget-header-small">
                            <h4 class="widget-title lighter">
                                <i class="ace-icon fa fa-signal"></i>
                                财务统计
                            </h4>
                        </div>

                        <div class="widget-body clearfix">
                            <div class="widget-main padding-14 clearfix">
                                <div id="sales-charts2"></div>
                                <div class="space-6"></div>
                                <div class="infobox-container">
                                    <div class="infobox infobox-orange2">
                                        <!-- #section:pages/dashboard.infobox.sparkline -->
                                        <div class="infobox-chart">
                                            <span class="sparkline sparklineBar-blue" data-values="196,128,202,177,154,94,100,170,224"></span>
                                        </div>

                                        <!-- /section:pages/dashboard.infobox.sparkline -->
                                        <div class="infobox-data">
                                            <span class="infobox-data-number">{!! $topCount['rechargeTotal'] !!}</span>
                                            <div class="infobox-content">充值总金额</div>
                                        </div>

                                    </div>
                                    <div class="infobox infobox-orange2">
                                        <!-- #section:pages/dashboard.infobox.sparkline -->
                                        <div class="infobox-chart">
                                            <span class="sparkline sparklineLine-gray" data-values="196,128,202,177,154,94,100,170,224"></span>
                                        </div>

                                        <!-- /section:pages/dashboard.infobox.sparkline -->
                                        <div class="infobox-data">
                                            <span class="infobox-data-number">{!! $topCount['cashoutTotal'] !!}</span>
                                            <div class="infobox-content">提现总金额</div>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="space"></div>
            <!--提醒-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h5 class="widget-title"><i class="fa fa-clock-o"></i> 任务时间提醒</h5>
                            <div class="widget-toolbar no-border">
                                <a href="{!! url('manage/taskList') !!}">
                                    查看更多>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main" style="height:271px;">
                                <div class="table-responsive">
                                    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th class="center">
                                                <i class="fa fa-caret-right"></i> 任务名称
                                            </th>
                                            <th>
                                                <i class="fa fa-caret-right"></i> 任务金额
                                            </th>
                                            <th>
                                                <i class="fa fa-caret-right"></i> 任务状态
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($topCount['recentlyTask']))
                                        @foreach($topCount['recentlyTask'] as $item)
                                        <tr>
                                            <td class="center">
                                                {!! $item->title !!}
                                            </td>

                                            <td>
                                                <span class="green">￥{!! $item->bounty !!}</span>
                                            </td>
                                            <td>
                                                <span class="label label-success">
                                                    @if($item->status == 0)未发布@elseif($item->status == 1)待托管@elseif($item->status == 2)待审核@elseif($item->status > 2 && $item->status < 9)进行中
                                                    @elseif($item->status == 9)已结束@elseif($item->status == 10)已失败@elseif($item->status == 11)维权中@endif
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="3">暂无数据</td>
                                        </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h5 class="widget-title"><i class="fa fa-clock-o"></i> 财务事件提醒</h5>
                            <div class="widget-toolbar no-border">
                                <a href="{!! url('manage/financeList') !!}">
                                    查看更多>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main" style="height:271px;">
                                <div class="table-responsive">
                                    <table id="sample-table2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th class="center">
                                                <i class="fa fa-caret-right"></i> 流水
                                            </th>
                                            <th>
                                                <i class="fa fa-caret-right"></i> 金额
                                            </th>
                                            <th>
                                                <i class="fa fa-caret-right"></i> 申请人
                                            </th>
                                            <th>
                                                <i class="fa fa-caret-right"></i> 交易平台
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($topCount['recentlyFinance']))
                                        @foreach($topCount['recentlyFinance'] as $item)
                                        <tr>
                                            <td class="center">
                                                @if($item->action == 1)发布任务
                                                @elseif($item->action == 1)任务佣金
                                                @elseif($item->action == 3)充值
                                                @elseif($item->action == 4)提现
                                                @elseif($item->action == 5)增值服务
                                                @elseif($item->action == 6)购买作品
                                                @elseif($item->action == 7)任务退款
                                                @elseif($item->action == 8)提现退款
                                                @elseif($item->action == 9)出售商品
                                                @elseif($item->action == 10)维权退款
                                                @elseif($item->action == 11)服务退款
                                                @endif
                                            </td>
                                            <td>
                                                <span class="green">￥{!! $item->cash !!}</span>
                                            </td>
                                            <td>
                                                {!! $item->name !!}
                                            </td>
                                            <td>
                                                @if($item->pay_type == 1)余额@elseif($item->pay_type == 2)支付宝@elseif($item->pay_type == 3)微信@elseif($item->pay_type == 4)银联@endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4">暂无数据</td>
                                        </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content-area -->

<div id="broken" data-data='{!! $broken !!}'></div>
<div id="maxDay" data-data='{!! $maxDay !!}'></div>
<div id="dateArr" data-data='{!! $dateArr !!}'></div>


{!! Theme::asset()->container('specific-js')->usePath()->add('excanvas-js', 'plugins/ace/js/jquery.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('easypiechart-js', 'plugins/ace/js/jquery.easypiechart.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('sparkline-js', 'plugins/ace/js/jquery.sparkline.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('flot-js', 'plugins/ace/js/flot/jquery.flot.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('flotPie-js', 'plugins/ace/js/flot/jquery.flot.pie.min.js') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('flotResize-js', 'plugins/ace/js/flot/jquery.flot.resize.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('backstage-js', 'js/backstage.js') !!}
