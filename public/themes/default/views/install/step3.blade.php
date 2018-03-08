<form class="conts-form" action="{!! url('install/checkDatabase') !!}" method="post" >
    {!! csrf_field() !!}
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
                        <li class="active" data-target="#step3">
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
            <div class="main ">
                <div class="conts dialogs">
                    <div class="conts-data">
                        <p class="title tit">填写数据信息:{!! $errors->first('install_fail') !!}</p>
                    </div>
                    <div class="conts-data-form" action="">
                        <div class="form-group data-form-group">
                            <label for="exampleInputName2" class="title">网站地址：</label>
                            <input type="text" class="form-control" id="exampleInputName2" name="site_url" datatype="*" errormsg="请输入站点url" value="@if(old('site_url')){!! old('site_url') !!}@else{!! $preData['site_url'] !!}@endif">
                            <label class="Validform_checktip point-out">站点的url</label>
                        </div>
                        <div class="form-group data-form-group">
                            <label for="exampleInputName3" class="title">数据库服务器：</label>
                            <input type="text" class="form-control" id="exampleInputName3" name="db_host" datatype="*" errormsg="请输入数据库服务器" value="@if(old('db_host')){!! old('db_host') !!}@else{!! $preData['db_host'] !!}@endif">
                            <label class="Validform_checktip point-out">@if($errors->first('db_host')){!! $errors->first('db_host') !!}@else 数据库服务器地址，一般为localhost @endif</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName4" class="title">数据库名：</label>
                            <input type="text" class="form-control inputxt" name="db_name" id="exampleInputName4" datatype="*" errormsg="请输入数据库名" value="@if(old('db_name')){!! old('db_name') !!}@else{!! $preData['db_name'] !!}@endif">
                            <label class="Validform_checktip point-out">请输入数据库名</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName5" class="title">数据库账号：</label>
                            <input type="text" class="form-control inputxt" name="db_account" id="exampleInputName5" datatype="*" errormsg="请输入数据库账号" value="@if(old('db_account')){!! old('db_account') !!}@else{!! $preData['db_account'] !!}@endif">
                            <label class="Validform_checktip point-out">@if($errors->first('db_account')){!! $errors->first('db_account') !!}@else 请输入数据库账号 @endif</label>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName6" class="title">数据库密码：</label>
                            <input type="password" class="form-control inputxt" name="db_password" id="exampleInputName6" datatype="*" errormsg="请输入数据库密码" value="@if(old('db_password')){!! old('db_password') !!}@else{!! $preData['db_password'] !!}@endif">
                            <label class="Validform_checktip point-out">@if($errors->first('db_password')){!! $errors->first('db_password') !!}@else 请输入数据库密码 @endif</label>

                        </div>
                    </div>
                    <div class="conts-manage">
                        <p class="title tit">填写管理员信息:</p>
                    </div>
                    <div class="conts-manage-form" action="">
                        <div class="form-group data-form-group">
                            <label for="exampleInputName7" class="title">管理员账号:</label>
                            <input type="text" class="form-control inputxt" name="admin_account" id="exampleInputName7" datatype="s4-10" nullmsg="管理员账号必填" errormsg="请填写4到10位之间" value="@if(old('admin_account')){!! old('admin_account') !!}@else{!! $preData['admin_account'] !!}@endif">
                            <label class="Validform_checktip point-out">请输入管理员账号</label>
                        </div>
                        <div class="form-group data-form-group">
                            <label for="exampleInputName8" class="title">管理员密码：</label>
                            <input type="password" name="admin_password" class="form-control inputxt" id="exampleInputName8" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间" value="{!! old('admin_password') !!}">
                            <label  class="Validform_checktip point-out">请输入管理员密码，长度至少为6位</label>
                        </div>
                        <div class="form-group data-form-group">
                            <label for="exampleInputName9" class="title">重复密码：</label>
                            <input type="password" name="admin_confirm_password" class="form-control inputxt" id="exampleInputName9" datatype="*" recheck="admin_password" nullmsg="请再输入一次密码" errormsg="您两次输入的账号密码不一致！" value="{!! old('admin_confirm_password') !!}">
                            <label  class="Validform_checktip point-out">请重复输入管理员密码</label>
                        </div>
                        <div class="radio">
                            <label class="title"></label>
                            <label>
                                <input type="radio" name="is_data" id="optionsRadios1" value="1" checked="checked">
                                带有演示数据
                            </label>
                        </div>
                        <div class="radio">
                            <label class="title"></label>
                            <label>
                                <input type="radio" name="is_data" id="optionsRadios2" value="0">
                                纯净版（不包括文章的演示数据，一般不推荐使用）
                            </label>
                        </div>
                    </div>
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
            <button  type="submit" class="btn-orange shadow_con" id="btn_sub" onsubmit="">提交</button>
        </div>
    </footer>
</form>

{{--modal--}}
<div class="overlay">
    <div class="spinner">
        <div class="spinner-container container1">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
        <div class="spinner-container container2">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
        <div class="spinner-container container3">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
        <em>Loading......</em>
    </div>
</div>

<script src="/themes/default/assets/plugins/jquery/jquery.min.js"></script>
<script src="/themes/default/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/themes/default/assets/plugins/ace/js/ace-elements.min.js"></script>
<script src="/themes/default/assets/plugins/ace/js/ace.min.js"></script>
<script src="/themes/default/assets/plugins/jquery/validform/js/Validform_v5.3.2_min.js"></script>
<script>
    $('.dialogs,.comments').ace_scroll({
        size: 420
    });
</script>
<script>

    $('.conts-form').Validform({
        tiptype:3,
        showAllError:true,
        beforeSubmit:function(data){
            showModal();
        }
    })

</script>
<script>

    function showModal(){

        /*获取宽度*/
        var windowWidth = $(window).width();
        /*获取高度*/
        var windowHeight = $(window).height();

        $('.overlay').css('width',windowWidth);
        $('.overlay').css('height',windowHeight);
        $('.overlay').fadeIn(1000);

    }

</script>
