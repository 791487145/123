<div class="accordion-style1 panel-group accordion-style2 g-side1" id="accordion">
    <div class="panel panel-default">

        {{--我的账本--}}
        <div class="panel-heading">
            <h4 class="panel-title clearfix">
                <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1 {{ (preg_match('/^\/finance\/list/',$_SERVER['REQUEST_URI']))?'g-active':'' }}"><span class="s-sideicon s-myiconwrp3"></span>&nbsp;&nbsp;&nbsp;&nbsp;财务管理
                    <i class="pull-right ace-icon fa {{ (preg_match('/^\/finance\/list/',$_SERVER['REQUEST_URI']))?'fa-angle-down':'fa-angle-right' }}" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                    <i class="bigger-110 icon-angle-down" ></i>
                </a>
            </h4>
        </div>

        <div id="collapseThree" class="panel-collapse {{ (preg_match('/^\/finance\/list/',$_SERVER['REQUEST_URI']))?'in':'collapse' }}">
            <div class="g-sidenav z-active">
                <a href="{!! url('finance/list') !!}" class="g-wrap2 active">收支明细</a>
            </div>
            <div class="g-sidenav">
                <a href="{!! url('finance/cash') !!}" class="g-wrap2">我要充值</a>
            </div>
            <div class="g-sidenav">
                <a href="{!! url('finance/cashout') !!}" class="g-wrap2">我要提现</a>
            </div>
        </div>

    </div>

    {{--<div class="accordion-style1 panel-group accordion-style2 g-side1" id="accordion">--}}
        {{--<div class="panel panel-default">--}}

        {{--</div>--}}
    {{--</div>--}}
</div>