<section>
    <div class="container">
        <div class="row">
<div class="col-lg-12 col-sm-12 col-xs-12 case-col-md-12 col-left">
    <!-- 所在位置 -->
    <div class="now-position text-size14">
        您的位置：成功案例>详情页
    </div>
</div>
<div class="space"></div>
<!-- 成功案例 -->
<div class=" case-detail clearfix">
    <!-- main -->
    <div class="col-lg-9 col-md-12  col-sm-12 col-xs-12 col-left">
        <!-- 案例内容 -->
        <div class="col-md-12 case-detail-main-area case-container-main">
            <div class="case-detail-title-name">
                <h4>{!! $success_case->title !!}</h4>
                <p>
                    行业标签：
                    <span class="case-deatail-tags">{!! $success_case->cate_name !!}</span>
                    <span class="case-detail-time">发布时间：{!! date('Y-m-d',strtotime($success_case->created_at)) !!}</span>
                </p>
            </div>
            <div class="case-detail-info-words cor-gray51">
                {!! htmlspecialchars_decode($success_case->desc) !!}
            </div>
        </div>
    </div>
    <!-- side -->
    <div class="col-lg-3 case-detail-side hidden-xs hidden-sm hidden-md col-left">
        <div class="case-detail-about">
            <div class="clearfix case-detail-about-title">
                <b class="pull-left cor-gray51 text-size14">其他案例</b>
                <a class="pull-right cor-gray8f" href="/shop/successStory/{!! Theme::get('SHOPID') !!}">More></a>
            </div>
            <ul>
                @if(!empty($list))
                    @foreach($list as $item)
                    <li class="clearfix">
                        <div class="pull-left">
                            <a href="/shop/successDetail/{!! $item['id'] !!}">
                                <img src="{!! url($item['pic']) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                            </a>
                        </div>
                        <div class="pull-left case-detail-about-info">
                            <a class="cor-gray51 case-detail-about-info-name" href="/shop/successDetail/{!! $item['id'] !!}">
                                {!! $item['title'] !!}
                            </a>
                            <p class="cor-gray87">行业分类：{!! $item['name'] !!}</p>
                            <p class="cor-gray87">浏览人数：@if(!empty($item['view_count'])){!! $item['view_count'] !!}@else 0 @endif人</p>
                            <a class="cor-gray87" href="/shop/successDetail/{!! $item['id'] !!}">查看更多>></a>
                        </div>
                    </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="space-14"></div>
    </div>
</div>
        </div>
    </div>
</section>
{!! Theme::widget('popup')->render() !!}
{!! Theme::asset()->container('old-css')->usepath()->add('main','css/main.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('header','css/header.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('footer','css/index/common.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('case','css/case.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('serivcecase','css/serivceCase.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('successdetail','js/doc/successdetail.js') !!}