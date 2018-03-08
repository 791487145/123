<section>
    <div class="content">
        <div class="form-group form-group-overfix">
            <div data-target="#step-container" class="row-fluid" id="fuelux-wizard">
                <ul class="wizard-steps">
                    <li class="active" data-target="#step1">
                        <span class="step">1</span>
                        <span class="title">安装协议</span>
                    </li>
                    <li class="active" data-target="#step2">
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
                环境检测：
                <table class="table table-bordered">
                    <tr>
                        <th>检测项目</th>
                        <th>KPPW所需配置</th>
                        <th>KPPW最佳</th>
                        <th>当前服务器</th>
                    </tr>
                    <tr>
                        <td>操作系统</td>
                        <td>不限制</td>
                        <td>linux</td>
                        <td>{!! $env['OS'] !!}</td>
                    </tr>
                    <tr>
                        <td>PHP版本</td>
                        <td>{!! $limitEnv['min']['php_version'] !!}</td>
                        <td>{!! $limitEnv['perfect']['php_version'] !!}</td>
                        <td>{!! $env['php_version'] !!}</td>
                    </tr>
                    <tr>
                        <td>附件上传</td>
                        <td>不限制</td>
                        <td>2M</td>
                        <td>{!! $env['file_upload'] !!}</td>
                    </tr>
                    <tr>
                        <td>GD</td>
                        <td>{!! $limitEnv['min']['gd'] !!}</td>
                        <td>{!! $limitEnv['perfect']['gd'] !!}</td>
                        <td>{!! $env['gd'] !!}</td>
                    </tr>
                    <tr>
                        <td>磁盘空间</td>
                        <td>{!! $limitEnv['min']['disk_space'] !!}</td>
                        <td>{!! $limitEnv['perfect']['disk_space'] !!}</td>
                        <td>{!! $env['disk_space'] !!}</td>
                    </tr>
                </table>
                目录、文件权限检查：
                <table class="table table-bordered">
                    <tr><th>目录文件</th><th>所需状态</th><th>当前状态</th></tr>
                    @foreach($fileRW as $item)
                    <tr>
                        <td>{!! $item['path'] !!}</td>
                        <td><span class="cor-blue2a text-size20">√</span> 可写</td>
                        <td>
                            @if($item['result'] == 1)<span class="cor-blue2a text-size20">√</span>@else<span class="cor-redfc text-size20">×</span>@endif
                            @if($item['result'] == 1)可写@elseif($item['result'] == -1)不存在@else不可写@endif
                        </td>
                    </tr>
                    @endforeach
                </table>
                PHP扩展检查：
                <table class="table table-bordered">
                    <tr><th>所需扩展</th><th>所需状态</th><th>当前状态</th></tr>
                    @foreach($functionArr as $item)
                        <tr>
                            <td>{!! $item['extension'] !!}</td>
                            <td><span class="cor-blue2a text-size20">√</span> 支持</td>
                            <td>
                                @if($item['support'] == 'y')<span class="cor-blue2a text-size20">√</span>@else<span class="cor-redfc text-size20">×</span>@endif
                                @if($item['support'] == 'y')支持@else不支持@endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="footer">
        <div class="btn-group shadow_con">
            <button onclick="javascript:history.back();" type="button" class="btn-white dropdown-toggle">
                返回上一步
            </button>
        </div>
        @if(!$error)
        <a href="{!! url('install?step=' . Crypt::encrypt(3)) !!}" class="btn-orange shadow_con">开始安装</a>
        @endif
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