<div class="accordion-style1 panel-group accordion-style2 g-side1" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title clearfix">
                <a href="#collapseThree4" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1
                {{ (preg_match('/^\/user\/(acceptTasksList|serviceMyJob|workComment|mySellGoods)/',$_SERVER['REQUEST_URI']))?'g-active':'' }}">
                    <i class="text-size20 g-tradingico"></i>&nbsp;&nbsp;&nbsp;&nbsp;交易管理
                    <i class="pull-right ace-icon fa fa-angle-down" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>

                </a>
            </h4>
        </div>
        <div id="collapseThree4" class="panel-collapse collapse {{ (preg_match('/^\/user\/(acceptTasksList|serviceMyJob|workComment|mySellGoods)/',$_SERVER['REQUEST_URI']))?'in':'' }}">
            <div class="g-sidenav {{ (preg_match('/^\/user\/(myTask|acceptTasksList)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/acceptTasksList" class="g-wrap2 {{ (preg_match('/^\/user\/(myTask|myTasksList)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我承接的任务</a>
            </div>
            <div class="g-sidenav {{ (preg_match('/^\/user\/(serviceMyJob)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/serviceMyJob" class="g-wrap2 {{ (preg_match('/^\/user\/(serviceMyJob)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我承接的服务</a>
            </div>
            <div class="g-sidenav {{ (preg_match('/^\/user\/(mySellGoods)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/mySellGoods" class="g-wrap2 {{ (preg_match('/^\/user\/(mySellGoods)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我卖出的作品</a>
            </div>
            <div class="g-sidenav {{ (preg_match('/^\/user\/(workComment)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/workComment" class="g-wrap2 {{ (preg_match('/^\/user\/(workComment)/',$_SERVER['REQUEST_URI']))?'active':'' }}">交易评价</a>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title clearfix">
                <a href="#collapseThrees2" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1
                   {{ (preg_match('/^\/user\/(shop|myShopSuccessCase|goodsShop|serviceList|serviceEdit|serviceCreate|serviceBounty|shopcommentowner|waitGoodsHandle|pubGoods|editGoods|addShopSuccess|editShopSuccess|enterpriseAuth)/',$_SERVER['REQUEST_URI']))?'g-active':'' }} collapsed">
                    <i class="text-size20 g-tradingico g-tradshopico"></i>&nbsp;&nbsp;&nbsp;&nbsp;店铺管理
                    <i class="pull-right ace-icon fa fa-angle-right" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                </a>
            </h4>
        </div>
        <div id="collapseThrees2" class="panel-collapse collapse
        {{ (preg_match('/^\/user\/(switchUrl|shop|myShopSuccessCase|goodsShop|serviceList|serviceEdit|serviceCreate|serviceBounty|shopcommentowner|waitGoodsHandle|pubGoods|editGoods|addShopSuccess|editShopSuccess|enterpriseAuth|waitServiceHandle|vipshopbar)/',$_SERVER['REQUEST_URI']))?'in':'' }}">
            <div class="g-sidenav {{ (preg_match('/^\/user\/switchUrl$/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/switchUrl" class="g-wrap2 {{ (preg_match('/^\/user\/(switchUrl)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我的店铺</a>
            </div>
            <div class="g-sidenav {{ (preg_match('/^\/user\/(shop|enterpriseAuth)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/shop" class="g-wrap2 {{ (preg_match('/^\/user\/(shop|enterpriseAuth)/',$_SERVER['REQUEST_URI']))?'active':'' }}">店铺设置</a>
            </div>

            <div class="g-sidenav {{ (preg_match('/^\/user\/(goodsShop|waitGoodsHandle|pubGoods|editGoods)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/goodsShop" class="g-wrap2 {{ (preg_match('/^\/user\/(goodsShop)/',$_SERVER['REQUEST_URI']))?'active':'' }}">作品管理</a>
            </div>
            <div class="g-sidenav {{ (preg_match('/^\/user\/(serviceList|serviceEdit|serviceCreate|serviceBounty|waitServiceHandle)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="{{ URL('user/serviceList') }}" class="g-wrap2">服务管理</a>
            </div>
            <div class="g-sidenav {{ (preg_match('/^\/user\/(myShopSuccessCase|addShopSuccess|editShopSuccess)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/myShopSuccessCase" class="g-wrap2 {{ (preg_match('/^\/user\/(myShopSuccessCase|addShopSuccess|editShopSuccess)/',$_SERVER['REQUEST_URI']))?'active':'' }}">案例管理</a>
            </div>
            <div class="g-sidenav {{ (preg_match('/^\/user\/(shopcommentowner)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/shopcommentowner" class="g-wrap2 {{ (preg_match('/^\/user\/(shopcommentowner)/',$_SERVER['REQUEST_URI']))?'active':'' }}">交易评价</a>
            </div>
        </div>
    </div>
    <!--<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title clearfix">
                <a href="#collapseThrees5" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1
                   {{ (preg_match('/^\/user\/(shop|myShopSuccessCase|goodsShop|serviceList|serviceEdit|serviceCreate|serviceBounty|shopcommentowner|waitGoodsHandle|pubGoods|editGoods|addShopSuccess|editShopSuccess|enterpriseAuth)/',$_SERVER['REQUEST_URI']))?'g-active':'' }} collapsed">
                    <i class="text-size20 g-tradingico g-vipsideico"></i>&nbsp;&nbsp;&nbsp;&nbsp;VIP管理
                    <i class="pull-right ace-icon fa fa-angle-right" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                </a>
            </h4>
        </div>
        <div id="collapseThrees5" class="panel-collapse collapse
        {{ (preg_match('/^\/user\/(vippaylist|vippaylog)/',$_SERVER['REQUEST_URI']))?'in':'' }}">
            <div class="g-sidenav {{ (preg_match('/^\/user\/(vippaylist|vippaylog)$/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="{{url('user/vippaylist')}}" class="g-wrap2 {{ (preg_match('/^\/user\/(vippaylist|vippaylog)/',$_SERVER['REQUEST_URI']))?'active':'' }}">购买记录</a>
            </div>
        </div>
    </div>-->
    {{--@if(Theme::get('question_switch')==1)--}}
    {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading">--}}
            {{--<h4 class="panel-title clearfix">--}}
                {{--<a href="#collapseOne2" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1--}}
                   {{--{{ (preg_match('/^\/user\/(myAnswer|myquestion)/',$_SERVER['REQUEST_URI']))?'g-active':'' }} collapsed">--}}
                    {{--<span class="text-size20 fa fa-question-circle cor-blue2f"></span>&nbsp;&nbsp;&nbsp;&nbsp;我的问答--}}
                    {{--<i class="pull-right ace-icon fa fa-angle-right" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>--}}
                {{--</a>--}}
            {{--</h4>--}}
        {{--</div>--}}
        {{--<div id="collapseOne2" class="panel-collapse collapse--}}
        {{--{{ (preg_match('/^\/user\/(myAnswer|myquestion)/',$_SERVER['REQUEST_URI']))?'in':'' }}">--}}
            {{--<div class="g-sidenav {{ (preg_match('/^\/user\/myAnswer$/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">--}}
                {{--<a href="/user/myAnswer" class="g-wrap2 {{ (preg_match('/^\/user\/(myAnswer)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我的回答</a>--}}
            {{--</div>--}}
            {{--<div class="g-sidenav {{ (preg_match('/^\/user\/(myquestion)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">--}}
                {{--<a href="/user/myquestion" class="g-wrap2 {{ (preg_match('/^\/user\/(myquestion)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我的提问</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--@endif--}}
    {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading">--}}
            {{--<h4 class="panel-title clearfix">--}}
                {{--<a href="#collapseFive2" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1 collapsed">--}}
                    {{--<span class="text-size20 g-tradingico g-bullhorn"></span>&nbsp;&nbsp;&nbsp;&nbsp;我的推广--}}
                    {{--<i class="pull-right ace-icon fa fa-angle-right" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>--}}
                {{--</a>--}}
            {{--</h4>--}}
        {{--</div>--}}
        {{--<div id="collapseFive2" class="panel-collapse collapse">--}}
            {{--<div class="g-sidenav">--}}
                {{--<a href="" class="g-wrap2">推广代码</a>--}}
            {{--</div>--}}
            {{--<div class="g-sidenav">--}}
                {{--<a href="" class="g-wrap2">推广收益</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title clearfix">
                <a href="#collapseThre1" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1"><i class="text-size20 g-trazoneico"></i>&nbsp;&nbsp;&nbsp;&nbsp;空间设置
                    <i class="pull-right fa fa-angle-down" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                    <i class="bigger-110 icon-angle-down" ></i>
                </a>
            </h4>
        </div>
        <div id="collapseThre1" class="panel-collapse collapse">
            <div class="g-sidenav {{ (preg_match('/^\/user\/(personCase)/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/personCase" class="g-wrap2 {{ (preg_match('/^\/user\/(personCase)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我的空间</a>
            </div>
        </div>
    </div>--}}
</div>
