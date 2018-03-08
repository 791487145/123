<section>
    <div class="content">
        <div class="form-group form-group-overfix">
            <div data-target="#step-container" class="row-fluid" id="fuelux-wizard">
                <ul class="wizard-steps">
                    <li class="active" data-target="#step1">
                        <span class="step">1</span>
                        <span class="title">安装协议</span>
                    </li>
                    <li data-target="#step2">
                        <span class="step">2</span>
                        <span class="title">环境，文件权限，函数等检测</span>
                    </li>
                    <li data-target="#step3">
                        <span class="step">3</span>
                        <span class="title">表单，数据库信息，管理员账号</span>
                    </li>
                    <li data-target="#step4">
                        <span class="step">4</span>
                        <span class="title">安装完成</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="dialogs">
                <h5>安装协议：</h5>感谢您选择KPPW系统，KPPW 是客客专业威客系统的简称，英文全称Keke Produced Professional Witkey 。武汉客客信息技术有限公司KPPW产品的开发商，依法独立拥有 KPPW 产品著作权<br>
                本授权协议适用且仅适用于 KPPW 产品，武汉客客信息技术有限公司拥有对本授权协议的最终解释权。<br>
                I. 协议许可的权利<br>
                1. 您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途(包括个人用户：不具备法人资格的自然人，以个人名义从事网络威客交易；非盈利性用途：从事非盈利活动的商业机构及非盈利性组织，将KPPW 产品用且仅用于产品演示、展示及发布，而并不是用来买卖及盈利的运营活动的)<br>
                2. 您可以在协议规定的约束和限制范围内修改 KPPW 源代码(如果被提供的话)或界面风格以适应您的网站要求。<br>
                3. 您拥有使用本软件构建的威客系统中全部任务信息，文章，用户信息及相关信息的所有权，并独立承担与其内容的相关法律义务。<br>
                4. 获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持期限、技术支持方式和技术支持内容，自授权时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。<br>
                II. 协议规定的约束和限制</div>
        </div>
    </div>
</section>

<footer>
    <div class="footer">
        <div class="btn-group shadow_con">
            <button type="button" class="btn-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                简体中文<span class="glyphicon glyphicon-menu-down"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">繁体</a></li>
                <li><a href="#">英文</a></li>
            </ul>
        </div>
        <a href="{!! url('install/?step=' . Crypt::encrypt(2)) !!}" class="btn-orange shadow_con">开始安装</a>
    </div>
</footer>
<script src="/themes/default/assets/plugins/jquery/jquery.min.js"></script>
<script src="/themes/default/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/themes/default/assets/plugins/ace/js/ace-elements.min.js"></script>
<script src="/themes/default/assets/plugins/ace/js/ace.min.js"></script>
<script>
    $('.dialogs,.comments').ace_scroll({
        size: 420
    });
</script>