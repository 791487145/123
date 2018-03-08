<!-- #section:basics/sidebar.mobile.toggle -->
<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
    <span class="sr-only">Toggle sidebar</span>

    <span class="icon-bar"></span>

    <span class="icon-bar"></span>

    <span class="icon-bar"></span>
</button>

<!-- /section:basics/sidebar.mobile.toggle -->
<div class="navbar-header pull-left">
    <!-- #section:basics/navbar.layout.brand -->
    <a href="/manage" class="navbar-brand">
        {{--<img src="{!! url(Theme::get('site_config')['site_logo_2'])!!}"/>--}}
        @if(Theme::get('site_config')['site_logo_2'])
            <img src="{!! url(Theme::get('site_config')['site_logo_2'])!!}">
        @else
            <img src="{!! Theme::asset()->url('images/logo.png') !!}">
        @endif
    </a>

    <!-- /section:basics/navbar.layout.brand -->

    <!-- #section:basics/navbar.toggle -->

    <!-- /section:basics/navbar.toggle -->
</div>

<!-- #section:basics/navbar.dropdown -->
<div class="navbar-buttons navbar-header pull-right" role="navigation">
    <ul class="nav ace-nav">
        {{--<li class="grey">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-tasks"></i>
                <span class="badge badge-grey">4</span>
            </a>

            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                    <i class="ace-icon fa fa-check"></i>
                    4 Tasks to complete
                </li>

                <li>
                    <a href="#">
                        <div class="clearfix">
                            <span class="pull-left">Software Update</span>
                            <span class="pull-right">65%</span>
                        </div>

                        <div class="progress progress-mini">
                            <div style="width:65%" class="progress-bar"></div>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <div class="clearfix">
                            <span class="pull-left">Hardware Upgrade</span>
                            <span class="pull-right">35%</span>
                        </div>

                        <div class="progress progress-mini">
                            <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <div class="clearfix">
                            <span class="pull-left">Unit Testing</span>
                            <span class="pull-right">15%</span>
                        </div>

                        <div class="progress progress-mini">
                            <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <div class="clearfix">
                            <span class="pull-left">Bug Fixes</span>
                            <span class="pull-right">90%</span>
                        </div>

                        <div class="progress progress-mini progress-striped active">
                            <div style="width:90%" class="progress-bar progress-bar-success"></div>
                        </div>
                    </a>
                </li>

                <li class="dropdown-footer">
                    <a href="#">
                        See tasks with details
                        <i class="ace-icon fa fa-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li class="purple">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                <span class="badge badge-important">8</span>
            </a>

            <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                    <i class="ace-icon fa fa-exclamation-triangle"></i>
                    8 Notifications
                </li>

                <li>
                    <a href="#">
                        <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
												New Comments
											</span>
                            <span class="pull-right badge badge-info">+12</span>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="btn btn-xs btn-primary fa fa-user"></i>
                        Bob just signed up as an editor ...
                    </a>
                </li>

                <li>
                    <a href="#">
                        <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
												New Orders
											</span>
                            <span class="pull-right badge badge-success">+8</span>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
												Followers
											</span>
                            <span class="pull-right badge badge-info">+11</span>
                        </div>
                    </a>
                </li>

                <li class="dropdown-footer">
                    <a href="#">
                        See all notifications
                        <i class="ace-icon fa fa-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </li>--}}

        <li class="green">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="background-color: #3885B1; padding: 0 15px;">
                {{--<i class="ace-icon fa fa-user"></i>--}}
                <img src="/themes/default/assets/plugins/ace/avatars/avatarabout.png" alt="" style="width:15px; height: 17px; vertical-align: -3px;">
                {{--<span class="badge badge-success">5</span>--}}
                &nbsp;授权信息
            </a>

            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header text-center">
                    {{--<i class="ace-icon fa fa-envelope-o"></i>--}}
                    当前版本：@if(Theme::get('kppw_auth_code'))已授权@else 未授权 @endif
                </li>

                <li class="dropdown-content" style="padding: 12px 16px">
                    {{--<ul class="dropdown-menu dropdown-navbar">
                        <li>
                            <a href="#">
                                <img src="{!! Theme::asset()->url('plugins/ace/avatars/avatar.png') !!}" class="msg-photo" alt="Alex's Avatar" />
                                <span class="msg-body">
                                    <span class="msg-title">
                                        <span class="blue">Alex:</span>
                                        Ciao sociis natoque penatibus et auctor ...
                                    </span>

                                    <span class="msg-time">
                                        <i class="ace-icon fa fa-clock-o"></i>
                                        <span>a moment ago</span>
                                    </span>
                                </span>
                            </a>
                        </li>

                    </ul>--}}
                    <p style="color:#7d8695; font-size:12px; height:auto; line-height: 23px; margin-bottom: 0">版&nbsp;&nbsp;本&nbsp;&nbsp;号：KPPW3.0 2016-08-08</p>
                    @if(Theme::get('kppw_auth_code'))
                        <p style="color:#7d8695; font-size:12px; height:auto; line-height: 23px; margin-bottom: 0">授权类别：商业授权</p>
                        <p style="color:#7d8695; font-size:12px; height:auto; line-height: 23px; margin-bottom: 0">授&nbsp;&nbsp;权&nbsp;&nbsp;码：{!! Theme::get('kppw_auth_code') !!} </p>
                    @else
                        <p style="color:#7d8695; font-size:12px; height:auto; line-height: 23px; margin-bottom: 0">
                            <a href="http://www.kppw.cn/sqgm/" target="_blank">去授权</a>
                        </p>
                    @endif
                </li>

                <li class="dropdown-footer" style="padding-left: 16px;padding-right: 16px;">
                    <a href="/manage/aboutUs">
                        查看开发人员&nbsp;&nbsp;<i class="fa fa-angle-right text-size18" style="font-size:18px;vertical-align:-1px;"></i>
                    </a>
                </li>
            </ul>
        </li>

        <!-- #section:basics/navbar.user_menu -->
        <li class="light-blue">
            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                {{--<img class="nav-user-photo" src="{!! Theme::asset()->url('plugins/ace/avatars/user.jpg') !!}" alt="Jason's Photo" />--}}
                <img class="nav-user-photo" src="{!! Theme::asset()->url('images/default_avatar.png') !!}"  alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
                                    {!! Theme::get('manager') !!}
								</span>

                <i class="ace-icon fa fa-caret-down"></i>
            </a>

            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                <li>
                    <a href="{!! url('manage/managerDetail/1') !!}">
                        <i class="ace-icon fa fa-cog"></i>
                        设置
                    </a>
                </li>


                <li class="divider"></li>

                <li>
                    <a href="{!! url('manage/logout') !!}">
                        <i class="ace-icon fa fa-power-off"></i>
                        退出
                    </a>
                </li>
            </ul>
        </li>

        <!-- /section:basics/navbar.user_menu -->
    </ul>
</div>

<!-- /section:basics/navbar.dropdown -->