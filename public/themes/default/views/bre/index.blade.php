<div class="g-banner" @if(!count($adPicInfo))style="display:none"@endif>
    <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($adPicInfo as $picK=>$picV)
            <li data-target="#carousel-example-generic" data-slide-to="$picK" @if($picK == 0)class="active" @else class=""@endif></li>
            @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($adPicInfo as $picInfoK=>$picInfo)
            <div @if($picInfoK == 0)class="item active"@else class="item" @endif>
                <a href="{!! $picInfo['ad_url'] !!}">
                    <img src="{!! URL($picInfo['ad_file']) !!}" height="460" width="100%" alt="..." class="img-responsive">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="go-top" id="go-top" style="display: block;">
    <a href="javascript:;" class="uc-2vm u-hov"></a>
    <form class="form-horizontal" action="/bre/feedbackInfo" method="post" enctype="multipart/form-data" id="complain">
        {!! csrf_field() !!}
        <div class="u-pop">
            <input type="text" name="uid" @if(count($useDetail)) value="{!! $useDetail['uid'] !!}"@endif style="display:none">
            <h2 class="mg-margin text-size12 cor-gray51">一句话点评</h2>
            <div class="space-4"></div>
            <textarea class="form-control u-pop-textarea" name="desc" rows="3" placeholder="期待您的一句话点评，不管是批评、感谢还是建议，我们都将会细心聆听，及时回复"></textarea>
            {!! $errors->first('desc') !!}
            <div class="space-4"></div>
            <input type="text" name="phone" @if(count($useDetail)) value="{!! $useDetail['mobile'] !!}" readonly="readonly" @endif placeholder="填写手机号">
            {!! $errors->first('phone') !!}
            <button type="submit" class="btn-blue btn btn-sm btn-primary">提交</button>
        </div>
    </form>
    <div class="arrow"></div>
    <a href="" target="_blank" class="feedback u-hov"></a>
    <div class="dnd dn">
        <h2 class="mg-margin text-size12 cor-gray51">在线时间：09:00 -18:00</h2>
        <div class="space-4"></div>
        <div>
            <a href="javscript:;"><img src="../images/pa.jpg" alt=""></a> <a href="javscript:;"><img src="../images/pa.jpg" alt=""></a>
        </div>
        <div class="hr"></div>
        <div class="iss-ico1">
            <p class="cor-gray51 mg-margin">全国免长途电话：</p>
            <p class="text-size20 cor-gray51">400-899-259</p>
        </div>
    </div>
    <a href="javascript:;" class="go u-hov"></a>
</div>
<div class="for-advertise" @if(!count($buttomPicInfo))style="display:none"@endif>
    <a @if(count($buttomPicInfo))href="{!! $buttomPicInfo[0]['ad_url'] !!}"@else href="javascript:;" @endif><img @if(count($buttomPicInfo))src="{!! URL($buttomPicInfo[0]['ad_file']) !!}" @else src="../images/grey.gif" @endif alt=""></a>
</div>