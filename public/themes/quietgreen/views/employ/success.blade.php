<div class="col-xs-12 col-left">
    <div class="taskDetails taskbg clearfix taskSuccess employ-bounty">
        <div class="taskSuccess-left col-lg-3 col-md-3 col-sm-2 hidden-xs text-right">
            <img src="{{ Theme::asset()->url('images/success-right.png') }}" alt="">
        </div>
        <div class="taskSuccess-left hidden-lg hidden-sm hidden-md visible-xs-12 text-center">
            <img src="{{ Theme::asset()->url('images/success-right.png') }}" alt="">
        </div>
        <div class="taskSuccess-right col-lg-8 col-md-9 col-sm-10 col-xs-12">
            <h4 class="text-size24">恭喜您的雇佣请求已发送给对方,对方受理后会通知您，请耐心等待</h4>
            <p class=""> 您可以与对方进行更多的沟通
                @if(!$user_shop)
                    <a  href="{{ URL('bre/serviceCaseList',['id'=>$id]) }}">进入空间</a>
                @else
                    <a href="{{ URL('shop/'.$user_shop['id']) }}" target="_blank" class="ico2"><i></i>进入店铺</a>
                @endif
            </p>
            <p><a href="{{ URL('employ/workin',['id'=>$id]) }}" >查看雇佣</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ URL('bre/service') }}" >服务商大厅</a></p>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
