<div class="g-taskbarnav g-stationbarnav bg-blue">
    <div class="container col-left">
        <div class="g-nav clearfix">
            <div class="pull-left stationinfo hidden-xs hidden-lg" href="javascript:;">分类
                <ul>
                    @if(!empty(Theme::get('task_cate')))
                        @if(count(Theme::get('task_cate')) >= 8)
                            @for($j=0;$j<8;$j++)
                                @if(isset(Theme::get('task_cate')[$j]['pid']) && Theme::get('task_cate')[$j]['pid'] == 0)
                                <li class="text-size12 claerfix"><span class="text-size14">{!! Theme::get('task_cate')[$j]['name'] !!}</span>
                                    / @if(!empty(Theme::get('task_cate')[$j]['child_task_cate']) && Theme::get('task_cate')[$j]['child_task_cate'][0])
                                        {!! Theme::get('task_cate')[$j]['child_task_cate'][0]['name'] !!}
                                    @endif
                                    <i class="fa fa-angle-right pull-right"></i>
                                    <div class="stationsubshow">
                                        @if(!empty(Theme::get('task_cate')[$j]['child_task_cate']) && is_array(Theme::get('task_cate')[$j]['child_task_cate']))
                                            @if(count(Theme::get('task_cate')[$j]['child_task_cate']) >= 9)
                                                @for($i =0 ;$i<9;$i++)
                                                    <a class="cor-gray89 text-size14"
                                                       href="/substation/tasks/{!! Theme::get('substationID') !!}?category={!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['id'] !!}">
                                                        {!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}
                                                    </a>
                                                @endfor
                                            @else
                                                @for($i =0 ;$i<count(Theme::get('task_cate')[$j]['child_task_cate']);$i++)
                                                    <a class="cor-gray89 text-size14"
                                                       href="/substation/tasks/{!! Theme::get('substationID') !!}?category={!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['id'] !!}">
                                                        {!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}
                                                    </a>

                                                @endfor
                                            @endif
                                        @endif
                                    </div>
                                </li>
                                @endif
                            @endfor
                        @else
                            @for($j=0;$j<count(Theme::get('task_cate'));$j++)
                                @if(isset(Theme::get('task_cate')[$j]['pid']) && Theme::get('task_cate')[$j]['pid'] == 0)
                                    <li class="text-size12 claerfix"><span class="text-size14">{!! Theme::get('task_cate')[$j]['name'] !!}</span>
                                        / @if(!empty(Theme::get('task_cate')[$j]['child_task_cate']) && Theme::get('task_cate')[$j]['child_task_cate'][0])
                                            {!! Theme::get('task_cate')[$j]['child_task_cate'][0]['name'] !!}
                                        @endif
                                        <i class="fa fa-angle-right pull-right"></i>
                                        <div class="stationsubshow">
                                            @if(!empty(Theme::get('task_cate')[$j]['child_task_cate']) && is_array(Theme::get('task_cate')[$j]['child_task_cate']))
                                                @if(count(Theme::get('task_cate')[$j]['child_task_cate']) >= 9)
                                                    @for($i =0 ;$i<9;$i++)
                                                        <a class="cor-gray89 text-size14"
                                                           href="/substation/tasks/{!! Theme::get('substationID') !!}?category={!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['id'] !!}">
                                                            {!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}
                                                        </a>
                                                    @endfor
                                                @else
                                                    @for($i =0 ;$i<count(Theme::get('task_cate')[$j]['child_task_cate']);$i++)
                                                        <a class="cor-gray89 text-size14"
                                                           href="/substation/tasks/{!! Theme::get('substationID') !!}?category={!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['id'] !!}">
                                                            {!! Theme::get('task_cate')[$j]['child_task_cate'][$i]['name'] !!}
                                                        </a>

                                                    @endfor
                                                @endif
                                            @endif
                                        </div>
                                    </li>
                                @endif
                            @endfor
                        @endif
                    @endif
                </ul>
            </div>
            <ul class="g-stationhead pull-left clearfix hidden-xs">
                <li @if(Theme::get('menu_type')==1) class="active  "@endif>
                    <a href="{{ URL('substation',['id'=>Theme::get('substationID')]) }}">{!! Theme::get('substationNAME') !!}站</a>
                </li>
                <li @if(Theme::get('menu_type')==2) class="active  "@endif>
                    <a href="{{ URL('substation/service',['id'=>Theme::get('substationID')]) }}">{!! Theme::get('substationNAME') !!}服务商</a>
                </li>
                <li @if(Theme::get('menu_type')==3) class="active  "@endif>
                    <a href="{{ URL('substation/tasks',['id'=>Theme::get('substationID')]) }}">{!! Theme::get('substationNAME') !!}需求</a>
                </li>
            </ul>
            <div class="pull-right visible-lg-block visible-md-block g-stationback">
                <a href="{{ URL('/') }}" class=""><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;返回主站</a>
            </div>
            <nav  class="navbar navbar-default navbar-static hidden-sm hidden-md hidden-lg col-xs-12"  id="navbar-example" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle z-activeNavlist" type="button" data-toggle="collapse"
                            data-target=".bs-js-navbar-scrollspy">
                        <span class="sr-only">切换导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <button class="navbar-toggle mg-right0" type="button" data-toggle="collapse"
                            data-target=".bs-js-navbar-scrollspy1">
                        <span class="fa fa-search"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse bs-js-navbar-scrollspy">
                    <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ URL('substation/',['id'=>Theme::get('substationID')]) }}" @if(Theme::get('menu_type')==1) class="z-navHome" @endif>
                                    {!! Theme::get('substationNAME') !!}站
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL('substation/service',['id'=>Theme::get('substationID')]) }}" @if(Theme::get('menu_type')==2) class="z-navHome" @endif>
                                    {!! Theme::get('substationNAME') !!}服务商
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL('substation/tasks',['id'=>Theme::get('substationID')]) }}" @if(Theme::get('menu_type')==3) class="z-navHome" @endif>
                                    {!! Theme::get('substationNAME') !!}需求
                                </a>
                            </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse bs-js-navbar-scrollspy1 bg-white">
                    <ul class="nav navbar-nav clearfix">
                        <li class="clearfix">
                            <a href="javascript:;" class="clearfix search-btn">
                                <div class="g-tasksearch clearfix">
                                    <i class="fa fa-search"></i>
                                    <input type="text" placeholder="输入关键词" class="input-boxshaw"/>
                                    <button>搜索</button>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>