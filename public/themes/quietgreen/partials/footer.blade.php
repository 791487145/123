
<div class="container">
    <div class="row">
        <div class="col-xs-5">
            <div class="alink">
                @if(!empty(Theme::get('article_cate')))
                    @foreach(Theme::get('article_cate') as $item)
                        <a target="_blank" href="/article/aboutUs/{!! $item['id'] !!}">{!! $item['cate_name'] !!}</a>
                        <a class="oSpan">|</a>
                    @endforeach
                @endif
            </div>
            <p class="addres">
                地址：{!! Theme::get('site_config')['company_address'] !!}
            </p>
        </div>
        <div class="col-xs-4">
            <p class="phone">
                {!! Theme::get('site_config')['phone'] !!}
            </p>
            <p class="email">
                Email：{!! Theme::get('site_config')['Email'] !!}
            </p>
        </div>
        <div class="col-lg-3 focusus visible-lg-block hidden-sm hidden-md hidden-xs col-left">
            <div class="clearfix">
                @if(Theme::get('site_config')['wechat']['wechat_switch'] == 1)
                    <div class="foc foc-bg">
                        <a class="focususwx foc-wx" href=""></a>
                        <div class="foc-ewm">
                            <div class="foc-ewm-arrow1"></div>
                            <div class="foc-ewm-arrow2"></div>
                            <img src="{!! url(Theme::get('site_config')['wechat']['wechat_pic']) !!}"
                                 alt="" width="100" height="100">
                        </div>
                    </div>
                @endif
                @if(Theme::get('site_config')['tencent']['tencent_switch'] == 1)
                    <div class="foc">
                        <a class="focususqq" href="{!! Theme::get('site_config')['tencent']['tencent_url'] !!}"
                           target="_blank">

                        </a>
                    </div>
                @endif
                @if(Theme::get('site_config')['sina']['sina_switch'] == 1)
                    <div class="foc">
                        <a class="focususwb" href="{!! Theme::get('site_config')['sina']['sina_url'] !!}"
                           target="_blank">

                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="footer-copyright">
    <div class="container">
        <p>{!! config('kppw.kppw_powered_by') !!}{!! config('kppw.kppw_version') !!}
            {!! Theme::get('site_config')['copyright'] !!}{!! Theme::get('site_config')['record_number'] !!}</p>
    </div>
</div>

{!! Theme::get('site_config')['statistic_code'] !!}
{!! Theme::widget('popup')->render() !!}
{{--{!! Theme::widget('statement')->render() !!}--}}
@if(Theme::get('is_IM_open') == 1)
    {!! Theme::widget('im',
    array('attention' => Theme::get('attention'),
    'ImIp' => Theme::get('basis_config')['IM_config']['IM_ip'],
    'ImPort' => Theme::get('basis_config')['IM_config']['IM_port']))->render() !!}
@endif