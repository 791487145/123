<div class="accordion-style1 panel-group accordion-style2 g-side1" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title clearfix">
                <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1 {{ (preg_match('/^\/user\/userfocus/',$_SERVER['REQUEST_URI']) || preg_match('/^\/user\/userfans/',$_SERVER['REQUEST_URI']))?'g-active':'' }}"><i class="s-baseicon s-myiconwrp1"></i>&nbsp;&nbsp;&nbsp;&nbsp;我的关注
                    <i class="pull-right ace-icon fa {{ (preg_match('/^\/user\/userfocus/',$_SERVER['REQUEST_URI']) || preg_match('/^\/user\/userfans/',$_SERVER['REQUEST_URI']))?'fa-angle-down':'fa-angle-right' }}" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                    <i class="bigger-110 icon-angle-down" ></i>
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse {{ ((preg_match('/^\/user\/userfocus/',$_SERVER['REQUEST_URI']) || preg_match('/^\/user\/userfans/',$_SERVER['REQUEST_URI'])))?'in':'collapse' }}">
            <div class="g-sidenav {{ (preg_match('/^\/user\/userfocus/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/userfocus" class="g-wrap2 active">用户关注</a>
            </div>
            <div class="g-sidenav {{ (preg_match('/^\/user\/userfans/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/userfans" class="g-wrap2 active">我的粉丝</a>
            </div>
        </div>
        <div class="panel-heading">
            <h4 class="panel-title clearfix">
                <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1 {{ (preg_match('/^\/user\/(myfocus|myCollectShop)/',$_SERVER['REQUEST_URI']))?'g-active':'' }}"><i class="s-baseicon s-myiconwrp2"></i>&nbsp;&nbsp;&nbsp;&nbsp;我的收藏
                    <i class="pull-right ace-icon fa {{ (preg_match('/^\/user\/(myfocus|myCollectShop)/',$_SERVER['REQUEST_URI']))?'fa-angle-down':'fa-angle-right' }}" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                    <i class="bigger-110 icon-angle-down" ></i>
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse {{ (preg_match('/^\/user\/(myfocus|myCollectShop)/',$_SERVER['REQUEST_URI']))?'in':'collapse' }}">
            <div class="g-sidenav {{ (preg_match('/^\/user\/myfocus/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/myfocus" class="g-wrap2 active">我收藏的任务</a>
            </div>
            <div class="g-sidenav {{ (preg_match('/^\/user\/myCollectShop/',$_SERVER['REQUEST_URI']))?'z-active':'' }}">
                <a href="/user/myCollectShop" class="g-wrap2 active ">我收藏的店铺</a>
            </div>
        </div>
    </div>

    {{--<div class="accordion-style1 panel-group accordion-style2 g-side1" id="accordion">--}}
        {{--<div class="panel panel-default">--}}

        {{--</div>--}}
    {{--</div>--}}
</div>