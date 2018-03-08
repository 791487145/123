<div class="location">
    <div class="container">
        <i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;当前位置 > 成功案例
    </div>
</div>
<article>
    <div class="container">
        <div class="classify">
            <label><i class=" fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;分类:</label>
            <a href="{!! URL('task/successCase').'?'.http_build_query(array_merge(array_except($merge,['searche']),['category'=>0])) !!}">
                <span class="classify-wrap {!! (!isset($merge['category']) || $merge['category']==$pid)?'active':'' !!}">全部</span>
            </a>
            @foreach($category as $v)
                <a  href="{!! URL('task/successCase').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}">
                    <span class="classify-wrap {!! (isset($merge['category']) && $merge['category']==$v['id'])?'active':'' !!}">{{ $v['name'] }}</span>
                </a>
            @endforeach
            {{--<li class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'active':'' !!}">--}}
                {{--<a href="{!! URL('task/successCase').'?'.http_build_query(array_merge(array_except($merge,['searche']),['category'=>0])) !!}" class="{!! (!isset($merge['category']) || $merge['category']==$pid)?'list-on':'' !!}" >全部</a>--}}
            {{--</li>--}}
            {{--@foreach(array_slice($category,0,7) as $v)--}}
                {{--<li class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'active':'' !!}"><a href="{!! URL('task/successCase').'?'.http_build_query(array_merge(array_except($merge,'page'), ['category'=>$v['id']])) !!}" class="{!! (isset($merge['category']) && $merge['category']==$v['id'])?'list-on':'' !!}">{{ $v['name'] }}</a></li>--}}
            {{--@endforeach--}}
        </div>
        <div class="sort clearfix">
            <div class="pull-left sort-l">
                <label class=""><i class="ico-sort-amount-desc"></i>&nbsp;&nbsp;&nbsp;排序 :&nbsp;&nbsp;&nbsp;</label>
                <label class="dropdown dropdown-down">
                    <span href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            @if(isset($merge['desc']) && $merge['desc'] == 'created_at')
                            <span>按时间</span>
                        @elseif(isset($merge['desc']) && $merge['desc'] != 'created_at')
                            <span>按人气</span>
                        @else
                            <span>综合</span>
                        @endif
                        <b class="fa fa-angle-down"></b>
                    </span>
                    <ul class="dropdown-menu">
                        <li><a data-value="综合" href="{!! URL('task/successCase').'?'.http_build_query(array_except($merge,['desc','searche'])) !!}">综合</a></li>
                        <li><a data-value="按时间" href="{!! URL('task/successCase').'?'.http_build_query(array_merge($merge,['desc'=>'created_at'])) !!}">按时间</a></li>
                        <li><a data-value="按人气" href="{!! URL('task/successCase').'?'.http_build_query(array_merge($merge,['desc'=>'view_count'])) !!}">按人气</a></li>
                    </ul>
                </label>
                {{--<select  onchange="window.location=this.value;">
                    <option {{ !isset($_GET['desc'])?'selected':'' }}
                            value="{!! URL('task/successCase').'?'.http_build_query(array_except($merge,['desc','searche'])) !!}">综合</option>
                    <option {{ (isset($_GET['desc']) && $_GET['desc']=='created_at')?'selected':''}}
                            value="{!! URL('task/successCase').'?'.http_build_query(array_merge($merge,['desc'=>'created_at'])) !!}">按时间</option>
                    <option {{ (isset($_GET['desc']) && $_GET['desc']=='view_count')?'active':''}}
                            value="{!! URL('task/successCase').'?'.http_build_query(array_except($merge,['desc','searche'])) !!}">按人气</option>
                </select>--}}
            </div>
            <div class="pull-right sort-search">
                <form class="form-inline" role="form" action="{{ URL('task/successCase') }}"  method="get">
                    <div class="form-group">
                        <button class="ico-search fa fa-search" type="submit"></button>
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="输入关键词" name="searche" value="{{ (!empty($_GET['searche']))?$_GET['searche']:'' }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</article>
<section class="shop">
    <div class="container col-10">
        <div class="row col-10">
            <ul class="clearfix case-list">
                @foreach($list as $v)
                <li class="col-xs-3 col-10">
                    <div class="wrap">
                        <div class="img">
                            <a class="case-list-item-img" href="@if(Auth::check() && Auth::user()->id == $v['uid']) {!! '/user/personevaluationdetail/'.$v['id']  !!} @elseif( !empty($v['url'])) {{  $v['url'] }}  @else {!! '/task/successDetail/'.$v['id']  !!} @endif" target="_blank">
                                <img src="{{ (!empty($v['pic']))?$domain.'/'.$v['pic']:Theme::asset()->url('images/bg1.png') }}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                            </a>
                            <div class="label-tit clearfix">
                                <span></span>
                                <span>{{ $v['cate_name'] }}</span>
                            </div>
                        </div>
                        <div class="txt text-center">
                            <h2 class="p-space"><a href="">{{ $v['title'] }}</a></h2>
                            <div class="num">
                                <span class=""></span>
                            </div>
                        </div>
                        <div class="case-list-item-name clearfix">
                            <div class="col-xs-6">
                                <div class="row">
                                    @if($v['type']==0)
                                    <a>本站推荐</a>
                                    @else
                                    <a href="/bre/serviceCaseList/{{ $v['uid'] }}" target="_blank">{{ $v['nickname'] }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="row text-right">
                                    <i class="fa fa-eye"></i> 浏览 : {{ (!is_null($v['view_count']))?$v['view_count']:0 }}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="clearfix">
                <div class=" paging_bootstrap text-center">
                    <ul class="pagination case-page-list">
                        {!! $list->appends($_GET)->render() !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
{!! Theme::asset()->container('custom-css')->usepath()->add('case','css/index/case.css') !!}