<div class="s-slidebar bg-blue"><i class="fa fa-reorder cor-white"></i></div>
<div class="bg-white s-slidecenter">
    <div class="accordion-style1 panel-group accordion-style2 g-side1" id="accordion1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title clearfix">
                    <a href="#collapseOne1" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1 {{ (preg_match('/^\/user\/userfocus/',$_SERVER['REQUEST_URI']))?'g-active':'' }}"><i class="s-baseicon s-myiconwrp1"></i>&nbsp;&nbsp;&nbsp;&nbsp;用户关注
                        <i class="pull-right fa {{ (preg_match('/^\/user\/userfocus/',$_SERVER['REQUEST_URI']))?'fa-angle-down':'fa-angle-right' }}" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                        <i class="bigger-110 icon-angle-down" ></i>
                    </a>
                </h4>
            </div>
            <div id="collapseOne1" class="panel-collapse {{ (preg_match('/^\/user\/userfocus/',$_SERVER['REQUEST_URI']))?'in':'collapse' }}">
                <div class="g-sidenav z-active">
                    <a href="/user/userfocus" class="g-wrap2 active">用户关注</a>
                </div>
            </div>
            {{--我的收藏--}}
            <div class="panel-heading">
                <h4 class="panel-title clearfix">
                    <a href="#collapseTwo1" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1 {{ (preg_match('/^\/user\/myfocus/',$_SERVER['REQUEST_URI']))?'g-active':'' }}"><i class="s-baseicon s-myiconwrp2"></i>&nbsp;&nbsp;&nbsp;&nbsp;我的收藏
                        <i class="pull-right fa {{ (preg_match('/^\/user\/myfocus/',$_SERVER['REQUEST_URI']))?'fa-angle-down':'fa-angle-right' }}" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                        <i class="bigger-110 icon-angle-down" ></i>
                    </a>
                </h4>
            </div>

            <div id="collapseTwo1" class="panel-collapse {{ (preg_match('/^\/user\/(myfocus|myCollectShop)/',$_SERVER['REQUEST_URI']))?'in':'collapse' }}">
                <div class="g-sidenav {{ (preg_match('/^\/user\/myfocus/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                    <a href="/user/myfocus" class="g-wrap2 {{ (preg_match('/^\/user\/myfocus/',$_SERVER['REQUEST_URI']))?'active':'' }}">我收藏的任务</a>
                </div>

                <div class="g-sidenav {{ (preg_match('/^\/user\/myCollectShop/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                    <a href="/user/myCollectShop" class="g-wrap2 {{ (preg_match('/^\/user\/myCollectShop/',$_SERVER['REQUEST_URI']))?'active':'' }}">我收藏的店铺</a>
                </div>
            </div>

            {{--我的账本--}}
            <div class="panel-heading">
                <h4 class="panel-title clearfix">
                    <a href="#collapseThree1" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1 {{ (preg_match('/^\/finance\/list/',$_SERVER['REQUEST_URI']))?'g-active':'' }}"><span class="s-sideicon s-myiconwrp3"></span>&nbsp;&nbsp;&nbsp;&nbsp;我的账本
                        <i class="pull-right fa {{ (preg_match('/^\/finance\/list/',$_SERVER['REQUEST_URI']))?'fa-angle-down':'fa-angle-right' }}" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                        <i class="bigger-110 icon-angle-down" ></i>
                    </a>
                </h4>
            </div>

            <div id="collapseThree1" class="panel-collapse {{ (preg_match('/^\/finance\/list/',$_SERVER['REQUEST_URI']))?'in':'collapse' }}">
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
    </div>
</div>