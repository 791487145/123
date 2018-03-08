<div class="s-slidebar bg-blue"><i class="fa fa-reorder cor-white"></i></div>
<div class="bg-white s-slidecenter">
    <div class="accordion-style1 panel-group accordion-style2 g-side1" id="accordion1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title clearfix">
                    <a href="#collapseOne3" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle g-wrap1
                    {{ (preg_match('/^\/user\/(myAnswer|myquestion)/',$_SERVER['REQUEST_URI']))?'g-active':'' }}">
                        <span class="text-size20 fa fa-question-circle"></span>&nbsp;&nbsp;&nbsp;&nbsp;我的问答
                        <i class="pull-right ace-icon fa fa-angle-right" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                        <i class="bigger-110 icon-angle-down"></i>
                    </a>
                </h4>
            </div>
            <div id="collapseOne3" class="panel-collapse collapse
            {{ (preg_match('/^\/user\/(myAnswer|myquestion)/',$_SERVER['REQUEST_URI']))?'in':'' }}">
                <div class="g-sidenav ">
                    <a href="/user/myAnswer" class="g-wrap2 {{ (preg_match('/^\/user\/(myAnswer)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我的回答</a>
                </div>
                <div class="g-sidenav ">
                    <a href="/user/myquestion" class="g-wrap2 {{ (preg_match('/^\/user\/(myquestion)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我的提问</a>
                </div>
            </div>
        </div>
        @if(Theme::get('promote_switch') == 1)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title clearfix">
                    <a href="#collapseOne4" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle g-wrap1
                    {{ (preg_match('/^\/user\/(promoteUrl|promoteProfit)/',$_SERVER['REQUEST_URI']))?'g-active':'' }}">
                        <span class="text-size20 g-tradingico g-bullhorn"></span>&nbsp;&nbsp;&nbsp;&nbsp;我的推广
                        <i class="pull-right ace-icon fa fa-angle-right" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                        <i class="bigger-110 icon-angle-down"></i>
                    </a>
                </h4>
            </div>
            <div id="collapseOne4" class="panel-collapse collapse
            {{ (preg_match('/^\/user\/(promoteUrl|promoteProfit)/',$_SERVER['REQUEST_URI']))?'in':'' }}">
                <div class="g-sidenav ">
                    <a href="/user/promoteUrl" class="g-wrap2 {{ (preg_match('/^\/user\/(promoteUrl)/',$_SERVER['REQUEST_URI']))?'active':'' }}">我的代码</a>
                </div>
                <div class="g-sidenav ">
                    <a href="/user/promoteProfit" class="g-wrap2 {{ (preg_match('/^\/user\/(promoteProfit)/',$_SERVER['REQUEST_URI']))?'active':'' }}">推广收益</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>