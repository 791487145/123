<div class="g-main">
    <h4 class="text-size16 cor-blue2f u-title">店铺装修</h4>
    @if($havePrivilege)
    <div class="space-12"></div>
        <form method="post" action="{{url('user/vipshopbar')}}">
            {!! csrf_field() !!}
        <div class="vipshopbarhd">
            <div class="vipshopbarbt">
                导航栏肤色
                <div class="space-6"></div>
                <p>
                    <label>
                        <input name="color" type="radio" class="vipace" @if($color == 'blue') checked @endif value="blue">
                        <span class="lbl vipblue"></span>
                    </label>
                    <label>
                        <input name="color" type="radio" class="vipace" @if($color == 'purple') checked @endif value="purple">
                        <span class="lbl vippurple"></span>
                    </label>
                    <label>
                        <input name="color" type="radio" class="vipace" @if($color == 'red') checked @endif value="red">
                        <span class="lbl vipred"></span>
                    </label>
                    <label>
                        <input name="color" type="radio" class="vipace" @if($color == 'green') checked @endif value="green">
                        <span class="lbl vipgreen"></span>
                    </label>
                    <label>
                        <input name="color" type="radio" class="vipace" @if($color == 'orange') checked @endif value="orange">
                        <span class="lbl viporange"></span>
                    </label>
                </p>
            </div>
        </div>
        <div class="space-12"></div>
        <div class="vipshopbarhd vipshopedhd">
            <div class="vipshopbarbt">
                自定义导航
                <div class="space-6"></div>
                <div class="alert g-alertreal clearfix" role="alert">
                    <i class="fa fa-lightbulb-o pull-left"></i>
                    <span class="text-size12">友情提示 ：模块勾选后将会在店铺导航处显示，模块顺序可以进行拖拽重排，双击文字还可以编辑哦！</span>
                </div>
                <div class="drag-tab">
                    <label id="1">
                        <input type="checkbox" class="drag-tabinp">
                        <span class="drag-tabspan">首页</span>
                    </label>
                    <label id="2">
                        <input type="checkbox" class="drag-tabinp">
                        <span class="drag-tabspan">作品</span>
                    </label>
                    <label id="3">
                        <input type="checkbox" class="drag-tabinp">
                        <span class="drag-tabspan">服务</span>
                    </label>
                    <label id="4">
                        <input type="checkbox" class="drag-tabinp">
                        <span class="drag-tabspan">成功案例</span>
                    </label>
                    <label id="5">
                        <input type="checkbox" class="drag-tabinp">
                        <span class="drag-tabspan">关于我们</span>
                    </label>
                    <label id="6">
                        <input type="checkbox" class="drag-tabinp">
                        <span class="drag-tabspan">交易评价</span>
                    </label>
                </div>
                <div class="space-12"></div>
            </div>
        </div>
        <div class="space-12"></div>
        <p class="cor-orange alertpdl text-size14">
            <i class="fa fa-exclamation-circle text-size18"></i>
            该页所传图片只适用于自身店铺
        </p>
        <div class="space-10"></div>
        <p class="cor-gray51 text-size14"><i>1</i>&nbsp;&nbsp;轮播图</p>
        <div class="space-4"></div>
        <!--文件上传-->
        <div  class="dropzone clearfix vipdropzone" id="dropzone-bar"  url="{{ URL('task/fileUpload')}}" deleteurl="{{ URL('user/delVipshopFile' . '?type=banner') }}">
            <div class="fallback">
                <input name="file" type="file" multiple="" />
            </div>
        </div>
        <div class="space-14"></div>
        <p class="cor-gray51 text-size14"><i>2</i>&nbsp;&nbsp;中部图</p>
        <div class="space-4"></div>
        <!--文件上传-->
        <div  class="dropzone clearfix vipdropzone" id="dropzone-main"  url="{{ URL('task/fileUpload')}}" deleteurl="{{ URL('task/fileDelet' . '?type=central') }}">
            <div class="fallback">
                <input name="file" type="file" multiple="" />
            </div>
        </div>
        <div class="space-14"></div>
        <p class="cor-gray51 text-size14"><i>3</i>&nbsp;&nbsp;底部图</p>
        <div class="space-4"></div>
        <!--文件上传-->
        <div  class="dropzone clearfix vipdropzone" id="dropzone-foot"  url="{{ URL('task/fileUpload')}}" deleteurl="{{ URL('task/fileDelet' . '?type=footer') }}">
            <div class="fallback">
                <input name="file" type="file" multiple="" />
            </div>
        </div>
        <div class="space-20"></div>
        <div id="banner">
            @forelse($hiddenBanner as $item)
            <input type="hidden" name='banner[]' id="file-{{$item['id']}}" value="{{$item['id']}}">
            @empty
            @endforelse
        </div>
        <div id="centralAD">
            @forelse($hiddenCentral as $item)
                <input type="hidden" name='centralAD[]' id="file-{{$item['id']}}" value="{{$item['id']}}">
            @empty
            @endforelse
        </div>
        <div id="footerAD">
            @forelse($hiddenFooter as $item)
                <input type="hidden" name='footerAD[]' id="file-{{$item['id']}}" value="{{$item['id']}}">
            @empty
            @endforelse
        </div>
        <button class="btn btn-primary btn-big btn-blue bor-radius2 btn-sm btn-imp" type="submit">保存</button>
    </form>
    @else
    <div class="row close-space-tip">
        <div class="col-md-12 text-center">
            <div class="space"></div>
            <div class="space"></div>
            <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
            <div class="space-10"></div>
            <p class="text-size16 cor-gray87">您还未购买VIP店铺套餐，购买后才能使用该功能！<a target="_blank" href="{{url('vipshop/payvip')}}">立即购买</a></p>
            <div class="space-32"></div>
        </div>
    </div>
    @endif
</div>
{!! Theme::asset()->container('custom-css')->usePath()->add('realname-css', 'css/usercenter/realname/realname.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
@if($havePrivilege)
<script>
    var uploadRule = '{!! CommonClass::attachmentUnserialize() !!}';
    uploadRule = JSON.parse(uploadRule);
    var extensions = '';
    for(var i in uploadRule.extensions)
    {
        extensions += uploadRule.extensions+',';
    }
            @if(isset($maxFiles))
                var maxFiles = {{ $maxFiles }};
            @else
                var maxFiles = 6;
            @endif
            @if(isset($initimage))
                var initimage = {!! $initimage   !!} ;
            @else
                var initimage = 6;
    @endif

    var nav = {!! $nav !!};
    var initBanner = {!! $initBanner !!};
    var initCentral = {!! $initCentral !!};
    var initFooter = {!! $initFooter !!};
    var countBanner = {{$countBanner}};
    var countCentral = {{$countCentral}};
    var countFooter = {{$countFooter}};

</script>
{!! Theme::asset()->container('specific-css')->usepath()->add('issuetask','plugins/ace/css/dropzone.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('dropzone','plugins/ace/js/dropzone.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery-ui','plugins/ace/js/jquery-ui.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('vipshopbar','js/vipshopbar.js') !!}
@endif



