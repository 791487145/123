<div class="g-taskbarnav employ-nav">
    <div class="container clearfix col-left">
        <div class="clearfix">
            <div class="pull-left tit">雇佣服务商</div>
            <ul class="list-inline hidden-xs">
                <li>
                    <span>填写需求</span>
                    <div class="active">1</div>
                </li>
                <li>
                    <span >托管赏金</span>
                    @if(preg_match('/^\/employ\/(bounty|success)/',$_SERVER['REQUEST_URI']))
                    <div class="active">2</div>
                    @else
                    <div class="{{ (Theme::get('employ_bounty_status')==1)?'active':'' }}">2</div>
                    @endif
                </li>
                <li>
                    <span >等待受理</span>
                    @if(preg_match('/^\/employ\/(success)/',$_SERVER['REQUEST_URI']))
                    <div class="active">3</div>
                    @else
                    <div class="{{ (Theme::get('employ_bounty_status')==1 && in_array(Theme::get('employ_status'),[0,1,2,3,4]))?'active':'' }}">3</div>
                    @endif
                </li>
                <li>
                    <span >服务商工作</span>
                    <div class="{{ (Theme::get('employ_bounty_status')==1 && in_array(Theme::get('employ_status'),[1,2,3,4]))?'active':'' }}">4</div>
                </li>
                <li>
                    <span >验收满意付款</span>
                    <div class="{{ (Theme::get('employ_status') &&   in_array(Theme::get('employ_status'),[3,4]))?'active':'' }}">5</div>
                </li>
                <li>
                    <span >评价</span>
                    <div class="{{ (Theme::get('employ_status') &&   in_array(Theme::get('employ_status'),[4]))?'active':'' }}">6</div>
                </li>
            </ul>
        </div>
    </div>
</div>