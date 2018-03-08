<div class="position-relative login-container-bg" style="width: 100%;min-height: 978px">
    {{--<img class="img-responsive" src="{!! Theme::asset()->url('images/backlogin.png') !!}" alt="客客族">--}}

    <div class="position-absolute position-ab">
        <div class="login-container">
            <div class="center">
                @if(Theme::get('site_config')['site_logo_2'])
                    <img src="{!! url(Theme::get('site_config')['site_logo_2'])!!}">
                @else
                    <img src="{!! Theme::asset()->url('images/loginlogo.png') !!}" alt="">
                @endif
            </div>
            <div class="space-10"></div>
            <div>
                <h4 class=" white text-center">
                    后台管理中心
                </h4>
            </div>
            <div class="space-20"></div>

            <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">
                    <div class="widget-body">
                        <div class="widget-main">


                            <div class="space-6"></div>

                            <form action="/manage/login" method="post">
                                {!! csrf_field() !!}
                                <fieldset>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="登录账号" name="username" value="{!! old('username') !!}" />
                                            <i class="ace-icon fa fa-user"></i>
                                        </span>
                                        <div class="error_wrong">{!! $errors->first('username') !!}</div>
                                    </label>

                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control" placeholder="登录密码" name="password" />
                                            <i class="ace-icon fa fa-key"></i>
                                        </span>
                                        <div class="error_wrong">{!! $errors->first('password') !!}</div>
                                    </label>

                                    <div class="space"></div>

                                    <div class="clearfix">
                                        <button type="submit" class=" pull-right btn btn-block btn-primary">
                                            <span class="bigger-110 ">登　录</span>
                                        </button>
                                    </div>
                                    <div class="space-4"></div>
                                </fieldset>
                            </form>
                        </div><!-- /.widget-main -->

                    </div><!-- /.widget-body -->
                </div><!-- /.login-box -->

            </div><!-- /.position-relative -->
        </div>
    </div>
    <div class="position-absolute kppw-powered">{!! config('kppw.kppw_powered_by') !!}{!! config('kppw.kppw_version') !!}</div>
</div>

<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='../js/ace/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage-css', 'css/backstage/backstage.css') !!}

