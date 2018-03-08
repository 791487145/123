
    <div class="g-taskposition col-lg-12 col-left text-size12">
            您的位置：首页 > 服务商
    </div>
    <div class="col-lg-9 col-left">
            <div class="g-taskclassify g-serivceitem table-responsive">
                <div class="col-md-12 col-xs-12 serivce-type">
                    <div class="col-md-1 col-sm-2 col-xs-12 cor-gray51 text-size14">
                        <div class="row">
                            服务商分类
                        </div>
                    </div>
                    <div class="col-lg-11 col-sm-10 col-xs-12">
                        <a class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'bg-blue':'' !!}" href="{!! URL('bre/service') !!}">全部</a>
                        {{--<a class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'keywords'),['category'=>0])) !!}">全部</a>--}}
                        @foreach(array_slice($category,0,7) as $v)
                            <a class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                        @endforeach
                        @if(count($category)>7)
                            <div class="pull-right select-fa-angle-down">
                                <i class="fa fa-angle-down text-size14 show-next"></i>
                            </div>
                        @endif
                    </div>
                </div>
                {{--服务商筛选--}}
                <div class="col-md-12 col-xs-12 serivcelist-type">
                    <div class="col-md-1 col-sm-2 col-xs-12 cor-gray51 text-size14">
                        <div class="row">

                        </div>
                    </div>
                    @if(count($category)>7)
                        <div class="col-lg-11 col-sm-10  col-xs-12">
                            @foreach(array_slice($category,7,(count($category)-7)) as $v)
                                <a class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'bg-blue':'' !!}"
                                   href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-xs-12 clearfix task-area">

                        <div class="col-md-1 col-sm-2 col-xs-12 cor-gray51 text-size14">
                            <div class="row">
                                服务商地区
                            </div>
                        </div>
                        <div class="col-lg-11 col-sm-10 col-md-10 col-xs-12">
                            @if(count($area)>7)
                                <div class="pull-right select-fa-angle-down">
                                    <i class="fa fa-angle-down text-size14 show-next"></i>
                                </div>
                            @endif
                                @if(isset($_GET['province']))
                                    <a class="{!! ( $merge['province']==$area_pid)?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except(array_except($merge,['keywords','page']),['area','city','province']))) !!}">全部</a>
                                    @foreach(array_slice($area,0,7) as $v)
                                        <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['page','province']), ['city'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                    @endforeach
                                @elseif(isset($_GET['city']))
                                    <a class="{!! ($merge['city']==$area_pid)?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['area','city','province','page']))) !!}">全部</a>
                                    @foreach(array_slice($area,0,7) as $v)
                                        <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['page','city']), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                    @endforeach
                                @elseif(isset($_GET['area']))
                                    <a class="{!! (!isset($_GET['area']) && $merge['area']==$area_pid)?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['area','city','province','keywords','page']))) !!}">全部</a>
                                    @foreach(array_slice($area,0,7) as $v)
                                        <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                    @endforeach
                                @else
                                    <a class="bg-blue" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['area','city','keywords','page']),['province'=>0])) !!}">全部</a>
                                    @foreach(array_slice($area,0,7) as $v)
                                        <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['province'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                    @endforeach
                                @endif
                        </div>

                </div>
                @if(count($area)>7)
                    <div class="col-xs-12 clearfix service-area">
                        <div class="row">
                            <div class="col-lg-1 col-sm-2 col-md-2 cor-gray51 text-size14 col-xs-12">
                                <div class="task-dq-label">

                                </div>
                            </div>
                            <div class="col-lg-11 col-sm-10 col-md-10 col-xs-12">
                                @if(isset($_GET['province']))
                                    @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                        <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['page','province']), ['city'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                    @endforeach
                                @elseif(isset($_GET['city']))
                                    @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                        <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,['page','city']), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                    @endforeach
                                @elseif(isset($_GET['area']))
                                    @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                        <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['area'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                    @endforeach
                                @else
                                    @foreach(array_slice($area,7,(count($area)-7)) as $v)
                                        <a class="{!! (isset($merge['area']) && $merge['area']==$v['id'])?'bg-blue':'' !!}" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['province'=>$v['id']])) !!}">{{ $v['name'] }}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="g-taskmain">
                <div class="clearfix g-taskmainhd">
                    <div class="pull-left">
                        <a href="/bre/service" class="g-taskmact">综合</a>
                        <span>|</span>
                        <a class="g-taskmaintime"
                           href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['employee_praise_rate'=>1]))!!}">
                            好评数 <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>
                        {{--<span>|</span>
                        <a class="g-taskmaintime" href="{!! URL('bre/service').'?'.http_build_query(array_merge(array_except($merge,'page'), ['receive_task_num'=>1]))!!}">
                            成交量 <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>--}}
                    </div>
                    <div class="pull-left g-taskmaininp">
                        <form method="get" action="{!! URL('bre/service').'?'.http_build_query($merge)!!}">
                            <input type="text" name="service_name" placeholder="请输入关键字" @if(!empty($merge['service_name']))value="{{$merge['service_name']}}"@endif/>
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <ul class="g-taskmainlist">
                    @if(!empty($list))
                    @foreach($list as $item)
                    <li class="clearfix">
                        <div class="col-sm-2 col-xs-2 m-serivcebox">
                            <div class="row">
                                <img src="@if($item->avatar){!! URL($item->avatar) !!} @else {!! Theme::asset()->url('images/default_avatar.png') !!} @endif" class="img-responsive" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                            </div>
                            @if($item->is_recommend == 1 && $item->shop_status == 1 && $item->shopId)
                            <span class="u-serviceimgico">荐</span>
                            @endif
                        </div>
                        <div class="col-sm-8 col-xs-10 nopdr">
                            <div class="">
                                <a class="cor-blue2f text-size18 text-blod "href="@if($item->shop_status == 1 && $item->shopId) {!! url('shop/'.$item->shopId) !!} @else{!! URL('bre/serviceEvaluateDetail/'.$item->id) !!}@endif" target="_blank">{!! $item->name !!}
                                    {{--<span class="s-servicericon s-icob1"></span><span class="s-servicericon s-ico1"></span><span class="s-servicericon s-icoa1" ></span>--}}
                                    &nbsp;
                                    @if(isset($item->auth) && $item->auth['bank'] == true)
                                        <span class="s-servicericon bank-attestation"></span>
                                    @else
                                        <span class="s-servicericon bank-attestation-no"></span>
                                    @endif
                                    @if(isset($item->auth) && $item->auth['realname'] == true)
                                        <span class="s-servicericon cd-card-attestation"></span>
                                    @else
                                        <span class="s-servicericon cd-card-attestation-no"></span>
                                    @endif
                                    @if($item->email_status == 2)
                                        <span class="s-servicericon email-attestation"></span>
                                    @else
                                        <span class="s-servicericon email-attestation-no"></span>
                                    @endif
                                    @if(isset($item->auth) && $item->auth['alipay'] == true)
                                        <span class="s-servicericon alipay-attestation"></span>
                                    @else
                                        <span class="s-servicericon alipay-attestation-no"></span>
                                    @endif
                                    @if(isset($item->auth) && $item->auth['enterprise'] == true)
                                    <span class="s-servicericon company-attestation"></span>
                                    @else
                                    <span class="s-servicericon company-attestation-no"></span>
                                    @endif
                                </a>
                                <p class="p-space cor-gray87 hidden-xs">服务范围：
                                    @if(empty($item->skill))
                                        暂无标签
                                    @else
                                        @foreach($item->skill as $value)
                                        {!! $value !!}&nbsp;&nbsp;
                                        @endforeach
                                    @endif
                                </p>
                                <p class="cor-gray87">好评数：{!! $item->employee_praise_rate !!}个&nbsp;&nbsp;|&nbsp;&nbsp;好评率：<b class="cor-orange">{!! $item->percent !!}%</b></p>
                                {{--<p class="p-space cor-gray87 hidden-xs">
                                    简介：@if(!empty($item->introduce)){!! $item->introduce !!}@else这家伙很懒什么也没留下！@endif
                                </p>--}}
                                <div class="space-4"></div>
                                {{--@if($item->skill || $item->pre)
                                <div class="u-item serviceitem">
                                    <span class="cor-gray87">标签：</span>
                                    @if(!empty($item->skill))
                                    @foreach($item->skill as $value)
                                        <a href="javascript:;" class="u-itmbtn">{!! $value !!}</a>
                                    @endforeach
                                    @endif
                                    @if($item->pre && $item->city)
                                        <a href="javascript:;" class="u-itmbtn">{!! $item->pre.$item->city !!}</a>
                                    @endif
                                </div>
                                @endif
                                @if(empty($item->skill) && empty($item->pre))<p class="p-space cor-gray87 hidden-xs">标签：暂无标签</p>@endif--}}
                                    @if($item->pre && $item->city)
                                    <div class="u-item serviceitem cor-gray87"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;
                                        {!! $item->pre.$item->city !!}
                                    </div>
                                    @endif
                            </div>
                        </div>
                        @if($item->shop_status == 1 && $item->shopId)
                        <div class="col-sm-2 hidden-xs m-serivcebox1">
                            <div class="row text-right">
                                {{--<a href="@if(Auth::check() && Auth::User()->id == $item->id) {!! url('user/personCase') !!} @else{!! URL('bre/serviceCaseList/'.$item->id) !!}@endif" class="cor-white "><i class="fa fa-cube"></i>&nbsp;&nbsp;进入空间</a>--}}
                                <a class="g-toshopbtn" @if(Auth::check() && Auth::id() == $item->id) href="{!! URL('/shop/manage/'.$item->shopId) !!}" @else href="{!! URL('/shop/'.$item->shopId) !!}" @endif target="_blank">进入店铺</a>
                            </div>
                        </div>
                        @endif
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="clearfix">
                <div class="g-taskpaginfo">@if(!empty($page))显示{!! ($page - 1) * $paginate + 1 !!}~{!! $page * $paginate !!}项@endif 共{!! $list->total() !!}个服务商</div>
                <div class="paginationwrap">
                        {!! $list->render() !!}
                </div>
            </div>
    </div>
    <div class="col-lg-3 g-secrivceside visible-lg-block g-secrivewrap col-left">
        <div class="g-tasksidemand">
            <div>
                @if(count($rightAd))
                <a href="{!! $rightAd[0]['ad_url'] !!}"><img src="{!! URL($rightAd[0]['ad_file']) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" /></a>
                @else
                <img src="{!! Theme::asset()->url('images/mybg.png') !!}" />
                @endif
            </div>
            <form class="registerform" action="/task/create" method="get">
            <div>
                <div class="space-10"></div>
                <b class="text-size16 cor-gray51">快速发布需求</b>
                <div class="space-2"></div>
                <p class="cor-gray87">快速发布，坐等服务商回复</p>
                <div class="input-group">
                    <span class="input-group-addon">
                    <i class="u-tasksideico1"></i>
                    </span>
                <select disabled readonly="true" name="type"><option value="1" >悬赏任务</option></select>
                </div>
                <div class="space-6"></div>
                <div class="input-group">
                            <span class="input-group-addon">
                            <i class="u-tasksideico2"></i>
                            </span>
                    <input id="form-field-mask-2" class="form-control input-mask-phone" name="title"  type="text" placeholder="需求标题,如：logo设计" />
                </div>
                <div class="space-6"></div>
                <div class="input-group">
                    <span class="input-group-addon">
                    <i class="u-tasksideico3"></i>
                    </span>
                    <input id="form-field-mask-3" class="form-control input-mask-phone" type="text"  name="phone" placeholder="手机号码" />
                </div>
                <div class="space-6"></div>
                <button class="btn btn-block btn-primary bor-radius2 text-size14 btn-blue">发布需求</button>
            </div>
            </form>
        </div>
        <div class="space-10"></div>
        @if(count($hotList))
        <div class="g-tasksidelist">
            <div class="clearfix g-tasksidelihd"><b class="pull-left cor-gray51 text-size14">{!! $targetName !!}</b>{{--<a class="pull-right" href="">More></a>--}}</div>
            <ul>
                @foreach($hotList as $v)
                <li class="clearfix">
                    <div class="media-left">{{--<img src="../../images/mybg.png">--}}<a href="{!!$v['url']!!}"><img src="{!! URL($v['recommend_pic']) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"></a></div>
                    <div class="media-body g-tasksidelinfo">
                        <a class="cor-gray51 p-space" href="{!!$v['url']!!}">{!! $v['recommend_name'] !!}</a>
                        <div class="space-4"></div>
                        <p class="cor-gray87">好评率：<b class="cor-orange">{!! $v['percent']*100 !!}%</b></p>
                        <div class="space-12"></div>
                        <a class="cor-gray87 visible-lg-block" href="{!!$v['url']!!}">详情>></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="space-14"></div>

    </div>

    <!--广告位-->
    @if(count($ad))
    <div class="for-advertise col-md-12 visible-lg-block" >
            <a href="{!! $ad[0]['ad_url'] !!}"><img src="{!! URL($ad[0]['ad_file']) !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"></a>
            <div class="space-10"></div>
    </div>
    @endif


{!! Theme::asset()->container('custom-css')->usePath()->add('service-task-css', 'css/taskbar/taskindex.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('service-css', 'css/service.css') !!}







