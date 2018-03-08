<div class="s-slidebar bg-blue"><i class="fa fa-reorder cor-white"></i></div>
<div class="bg-white s-slidecenter">
    <div class="accordion-style1 panel-group accordion-style2 g-side1" id="accordion1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title clearfix">
                    <a href="#collapse1" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle g-wrap1 {{ ($_SERVER['REQUEST_URI']=='/user/info' || $_SERVER['REQUEST_URI']=='/user/skill')?'g-active':'' }}">
                        <span class="s-baseicon"></span>&nbsp;&nbsp;&nbsp;&nbsp;基本资料
                        <i class="pull-right ace-icon fa  {{ ($_SERVER['REQUEST_URI']=='/user/info' || $_SERVER['REQUEST_URI']=='/user/skill')?'fa-angle-down':'fa-angle-right' }}" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                    </a>
                </h4>
            </div>

            <div id="collapse1" class="panel-collapse {{ ($_SERVER['REQUEST_URI']=='/user/info' || $_SERVER['REQUEST_URI']=='/user/skill')?'in':'collapse' }}">
                <div class="g-sidenav {{ ($_SERVER['REQUEST_URI']=='/user/info')?'z-active':'' }}">
                    <a href="/user/info" class="g-wrap2 {{ ($_SERVER['REQUEST_URI']=='/user/info')?'active':'' }}">资料完善</a>
                </div>
                <div class="g-sidenav {{($_SERVER['REQUEST_URI']=='/user/skill')?'z-active':'' }}">
                    <a href="/user/skill" class="g-wrap2 {{($_SERVER['REQUEST_URI']=='/user/skill')?'active':'' }}">技能标签</a>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title clearfix">
                    <a href="#collapse2" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle g-wrap1{{ ($_SERVER['REQUEST_URI']=='/user/loginPassword' || $_SERVER['REQUEST_URI']=='/user/payPassword')?'g-active':'' }}">
                        <span class="s-accounticon"></span>&nbsp;&nbsp;&nbsp;&nbsp;账号安全
                        <i class="pull-right ace-icon fa {{ ($_SERVER['REQUEST_URI']=='/user/loginPassword' || $_SERVER['REQUEST_URI']=='/user/payPassword')?'fa-angle-down':'fa-angle-right' }}" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                    </a>
                </h4>
            </div>

            <div id="collapse2" class="panel-collapse {{ ($_SERVER['REQUEST_URI']=='/user/loginPassword' || $_SERVER['REQUEST_URI']=='/user/payPassword')?'in':'collapse' }} ">
                <div class="g-sidenav {{ ($_SERVER['REQUEST_URI']=='/user/loginPassword')?'z-active':'' }} ">
                    <a href="/user/loginPassword" class="g-wrap2 {{ ($_SERVER['REQUEST_URI']=='/user/loginPassword')?'active':'' }}">修改密码</a>
                </div>
                <div class="g-sidenav {{ ($_SERVER['REQUEST_URI']=='/user/payPassword')?'z-active':'' }}">
                    <a href="/user/payPassword" class="g-wrap2 {{ ($_SERVER['REQUEST_URI']=='/user/payPassword')?'active':'' }}">支付密码</a>
                </div>
            </div>
        </div>
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h4 class="panel-title clearfix">
                    <a href="#collapse3" data-parent="#accordion1" data-toggle="collapse"
                       class="accordion-toggle g-wrap1 "><span class="s-approveicon"></span>&nbsp;&nbsp;&nbsp;&nbsp;认证管理
                        <i class="pull-right ace-icon fa fa-angle-right" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                    </a>
                </h4>
            </div>

            <div id="collapse3"
                 class="panel-collapse {{ ($_SERVER['REQUEST_URI']=='/user/realnameAuth' || $_SERVER['REQUEST_URI']=='/user/paylist' || $_SERVER['REQUEST_URI']=='/user/emailAuth')?'in':'collapse' }}">
                <div class="g-sidenav {{ ($_SERVER['REQUEST_URI']=='/user/realnameAuth')?'z-active':'' }}">
                    <a href="{!! url('user/realnameAuth') !!}" class="g-wrap2 {{ ($_SERVER['REQUEST_URI']=='/user/realnameAuth')?'active':'' }}">实名认证</a>
                </div>
                <div class="g-sidenav {{ ($_SERVER['REQUEST_URI']=='/user/paylist')?'z-active':'' }}">
                    <a href="{!! url('user/paylist') !!}" class="g-wrap2 {{ ($_SERVER['REQUEST_URI']=='/user/paylist')?'active':'' }}">支付绑定</a>
                </div>
                <div class="g-sidenav {{ ($_SERVER['REQUEST_URI']=='/user/emailAuth')?'z-active':'' }}">
                    <a href="{!! url('user/emailAuth') !!}" class="g-wrap2 {{ ($_SERVER['REQUEST_URI']=='/user/emailAuth')?'active':'' }}">邮箱绑定</a>
                </div>
            </div>
        </div>
    </div>
</div>