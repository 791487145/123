<div class="g-main cashiergray-box">
    <h4 class="text-size16 cor-blue u-title">推广代码</h4>
    <div class="space"></div>
    <div class="space-6"></div>
    <div class="extendlink text-size14 cor-gray51">我的专用推广链接：</div>
    <div class="space-8"></div>
    <div class="extendbtn">
        <input type="text" class="col-xs-5" value="{!! $url !!}">&nbsp;&nbsp;
        <button onclick="copyUrl()" class="btn btn-white bg-gary">点击复制</button>
    </div>
    <div class="space-10"></div>
    <p class="cor-orange alertpdl text-size14">
        <i class="fa fa-exclamation-circle text-size18"></i>
        复制成功后就可以粘贴到论坛，贴吧，博客，空间，微博里，或者通过邮箱，QQ或QQ群发给好友，只要有人通过推广代码注册到@if(Theme::get('site_config')['site_name'])
            {!! Theme::get('site_config')['site_name'] !!}
        @else
            客客专业威客建站系统
        @endif，您将可以获得该注册会员注册认证的推广提成。
    </p>
    <div class="space-14"></div>
    <div class="extendico text-size14 cor-gray51">推广提成比例</div>
    <div class="space-8"></div>
    <div class="f-table">
        <table class="table table-hover text-size14 cor-gray51 table638">

            <thead>
                <tr>
                    <th>推广项目</th>
                    <th>描述</th>
                    <th>基数</th>
                    <th>比例</th>
                </tr>
            </thead>
            <tbody>
            @if(!empty($promote_type))
                @foreach($promote_type as $item)
                <tr>
                    <td>{!! $item['name'] !!}</td>
                    <td>@if($item['finish_conditions'] == 1)完成实名认证
                        @elseif($item['finish_conditions'] == 2)完成邮箱认证
                        @elseif($item['finish_conditions'] == 3)完成支付认证
                        @endif
                    </td>
                    <td>每人</td>
                    <td>￥@if($item['price']){!! $item['price'] !!}@else 0.00 @endif</td>
                </tr>
                @endforeach
            @endif
                {{--<div class="g-nomessage g-nofinancelist">暂无收益哦 ！</div>--}}
            </tbody>
        </table>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('froala_editor', 'css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('finacelist', 'css/usercenter/finance/finance-detail.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('usercenter-js', 'js/usercenter.js') !!}