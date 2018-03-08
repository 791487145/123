<div class="col-md-12 case-col-md-12 col-left">
    <!-- 所在位置 -->
    <div class="now-position text-size12">
        您的位置：首页 > 成功案例
    </div>
    <!-- 任务分类 -->
    <div class="well case-well case-classify-well success-task">
        <div class="clearfix">
            <span class="task-list-itle text-size14 pull-left">任务分类</span>
            <ul class="text-size14 nav nav-pills pull-left">
                <li class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'active':'' !!}">
                    <a href="{!! URL('task/successCase').'?'.http_build_query(array_merge(array_except($merge,['searche']),['category'=>0])) !!}" class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'list-on':'' !!}" >全部</a>
                </li>
                @foreach(array_slice($category,0,7) as $v)
                    <li class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'active':'' !!}"><a href="{!! URL('task/successCase').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}" class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'list-on':'' !!}">{{ $v['name'] }}</a></li>
                @endforeach
            </ul>
            @if(count($category)>7)
                <div class="pull-right select-fa-angle-down">
                    <i class="fa fa-angle-down text-size14 show-next"></i>
                </div>
            @endif
        </div>
        @if(count($category)>7)
        <div class="clearfix success-area">
            <span class="task-list-itle text-size14 pull-left">　　　　</span>
            <ul class="text-size14 nav nav-pills pull-left">
                @foreach(array_slice($category,7,(count($category)-7)) as $v)
                    <li class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'active':'' !!}"><a href="{!! URL('task/successCase').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}" class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'list-on':'' !!}">{{ $v['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <!-- 搜索 -->
    <div class="well case-well case-search-well">
        <div class="case-search-list">
            <ul class="case-search-list text-size14 nav nav-pills">
                <li class="{{ !isset($_GET['desc'])?'active':'' }}"><a href="{!! URL('task/successCase').'?'.http_build_query(array_except($merge,['desc','searche'])) !!}" class="no-padding-left">默认</a> </li>
                <li><span>|</span></li>
                <li class="{{ (isset($_GET['desc']) && $_GET['desc']=='created_at')?'active':''}}"><a href="{!! URL('task/successCase').'?'.http_build_query(array_merge($merge,['desc'=>'created_at'])) !!}">按时间 <i class="glyphicon glyphicon-arrow-down"></i></a></li>
                <li><span>|</span></li>
                <li class="{{ (isset($_GET['desc']) && $_GET['desc']=='view_count')?'active':''}}"><a href="{!! URL('task/successCase').'?'.http_build_query(array_merge($merge,['desc'=>'view_count'])) !!}">按人气 <i class="glyphicon glyphicon-arrow-down"></i></a></li>
            </ul>
        </div>
        <form action="{{ URL('task/successCase') }}" method="get">
            <div class="input-group case-search-key-words">
                    <input type="text" class="form-control search-query case-search-input" placeholder="请输入关键字" name="searche">
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-white no-border  btn-sm case-search-btn">
                    <i class="ace-icon fa fa-search icon-on-right bigger-110"></i></button>
                    </span>
            </div>
        </form>
    </div>

    <!-- 成功案例 -->
    <div class="row  case-list">
        @foreach($list as $v)
            <div class="col-md-3 col-xs-12 col-sm-4 case-list-item">
            {{--<a class="case-list-item-img" href="@if(Auth::check() && Auth::user()->id == $v['uid']) {!! '/user/personevaluationdetail/'.$v['id']  !!} @elseif( !empty($v['url'])) {{  $v['url'] }}  @else {!! '/task/successDetail/'.$v['id']  !!} @endif" target="_blank">--}}
            <a class="case-list-item-img" href="{{ URL('task/successJump',['id'=>$v['id']]) }}" target="_blank">
                <img src="{{ $domain.'/'.$v['pic'] }}" alt=""></a>
            <div class="case-list-item-name">
                <p>
                    {{--<a href="@if(Auth::check() && Auth::user()->id == $v['uid']) {!! '/user/personevaluationdetail/'.$v['id']  !!} @elseif( !empty($v['url'])) {!! $v['url'] !!}  @else {!! '/task/successDetail/'.$v['id']  !!} @endif" target="_blank">{{ $v['title'] }}</a>--}}
                    <a class="case-list-item-img" href="{{ URL('task/successJump',['id'=>$v['id']]) }}" target="_blank">{{ $v['title'] }}</a>
                </p>
                <span><i class="fa fa-eye cor-grayd text-size16"></i> {{ $v['view_count'] }}人浏览</span>
            </div>
            <div class="case-list-item-admin">
                <div class="case-list-item-admin-info">
                        @if($v['type']==0)
                        <a href="javascript:void(0);" target="_blank">
                            <img class="img-circle" src="{{ Theme::asset()->url('images/defauthead.png')}}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                        </a>
                        @else
                        <a href="/bre/serviceCaseList/{{ $v['uid'] }}" target="_blank">
                            <img class="img-circle" src="{{ $domain.'/'.$v['user_avatar'] }}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                        </a>
                        @endif

                        @if($v['type']==0)
                        <a href="javascript:void(0);">
                                 <p>本站推荐</p>
                        </a>
                        @else
                        <a href="/bre/serviceCaseList/{{ $v['uid'] }}" target="_blank">
                            <p>{{ $v['nickname'] }}</p>
                        </a>
                        @endif
                </div>
                <span> <i class="fa fa-tag cor-grayd text-size16"></i> {{ $v['cate_name'] }}</span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row case-page">
        <div class="col-md-12">
            <div class="dataTables_paginate paging_bootstrap">
                <ul class="pagination case-page-list">
                    {{--@if(!empty($list['prev_page_url']))--}}
                    {{--<li class="prev"><a href="{!! URL('task/successCase').'?'.http_build_query(array_merge($merge,['page'=>$list['current_page']-1])) !!}"><i class="fa fa-angle-double-left"></i></a></li>--}}
                    {{--@endif--}}
                    {{--@if($list['last_page']>1)--}}
                       {{--@for($i=1;$i<=$list['last_page'];$i++)--}}
                    {{--<li class="{{ ($i==$list['current_page'])?'active':'' }}" ><a href="{!! URL('task/successCase').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>--}}
                        {{--@endfor--}}
                    {{--@endif--}}
                    {{--@if(!empty($list['next_page_url']))--}}
                    {{--<li class="next"><a href="{!! URL('task/successCase').'?'.http_build_query(array_merge($merge,['page'=>$list['current_page']+1])) !!}"><i class="fa fa-angle-double-right"></i></a></li>--}}
                    {{--@endif--}}
                    {!! $list->appends($_GET)->render() !!}
                </ul>
            </div>
        </div>
    </div>
</div>
@if(count($ad))
<div class="row visible-lg-block visible-md-block" >
    <div class="for-advertise col-md-12">
        <a href="{!! $ad[0]['ad_url'] !!}"><img  src="{!! URL($ad[0]['ad_file']) !!}" alt=""></a>
        <div class="space-10"></div>
    </div>
</div>
@endif
{!! Theme::asset()->container('custom-css')->usepath()->add('case','css/case.css') !!}