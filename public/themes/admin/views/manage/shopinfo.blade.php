
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">店铺详细信息</h3>
<div class="g-backrealdetails clearfix bor-border interface">
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">店&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;主</p>
        <p class="col-md-11">{!! $shop_info->name !!}</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">店&nbsp;&nbsp;铺&nbsp;&nbsp;名</p>
        <p class="col-md-11">{!! $shop_info->shop_name !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">店铺介绍</p>
        <p class="col-md-11">{!! $shop_info->shop_desc !!}</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">店铺地址</p>
        <p class="col-md-11">{!! $shop_info->province_name !!}&nbsp;&nbsp;{!! $shop_info->city_name !!}</p>
    </div>


    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">店铺标签</p>
        @if(!empty($shop_info->tags))
        <p class="col-md-10">
            @foreach($shop_info->tags as $key => $value)
                {!! $value['tag_name'] !!}&nbsp;&nbsp;
            @endforeach
        </p>
        @endif
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">店铺封面</p>
        <p class="col-md-10">
            <img src="{!! url($shop_info->shop_pic) !!}">
        </p>
    </div>

    <form method="post" action="/manage/updateShopInfo" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" id="id" name="id" value="{!! $shop_info->id !!}">
        <div class="realname-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">seo标题</p>
            <p class="col-md-11">
                <input type="text" name="seo_title" value="{!! $shop_info->seo_title !!}">
            </p>
        </div>

        <div class="realname-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">seo关键字</p>
            <p class="col-md-11">
                <input type="text" name="seo_keyword" value="{!! $shop_info->seo_keyword !!}">
            </p>
        </div>

        <div class="realname-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">seo描述</p>
            <p class="col-md-11">
                <textarea name="seo_desc">
                    {!! $shop_info->seo_desc !!}
                </textarea>
            </p>
        </div>

        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <p class="col-md-10">
                        <button type="submit" class="btn btn-primary btn-sm">保存</button>
                    </p>
                </div>
            </div>
        </div>
    </form>

    <div class="col-xs-12">
        <div class="space-8"></div>
        <p class="col-md-10 col-md-offset-1">
            @if(!empty($pre_id))
                <a href="/manage/shopInfo/{!! $pre_id !!}">上一项</a>
            @endif
                <a href="/manage/shopList">返回列表</a>
            @if(!empty($next_id))
                <a href="/manage/shopInfo/{!! $next_id !!}">下一项</a>
            @endif
        </p>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}