
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">交易维权</h3>
<div class="g-backrealdetails clearfix bor-border">
    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">交易名称</p>
        <p class="col-md-11">{!! $rights_info->title !!}</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">类型</p>
        <p class="col-md-11">
            @if($rights_info->object_type == 1)雇佣
            @elseif($rights_info->object_type == 2)作品
            @endif
        </p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">维权类型</p>
        <p class="col-md-11">
            @if($rights_info->type == 1)维归信息
            @elseif($rights_info->type == 2)虚假交稿
            @elseif($rights_info->type == 3)涉嫌抄袭
            @elseif($rights_info->type == 4)其他
            @endif
        </p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">维权人</p>
        <p class="col-md-11">
            {!! $rights_info->from_name !!}&nbsp;&nbsp;&nbsp;&nbsp;
            Email : {!! $rights_info->from_email !!}&nbsp;&nbsp;&nbsp;&nbsp;
            QQ : {!! $rights_info->from_qq !!}&nbsp;&nbsp;&nbsp;&nbsp;
            Mobile : {!! $rights_info->from_mobile !!}
        </p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">被维权人</p>
        <p class="col-md-11">
            {!! $rights_info->to_name !!}&nbsp;&nbsp;&nbsp;&nbsp;
            Email : {!! $rights_info->to_email !!}&nbsp;&nbsp;&nbsp;&nbsp;
            QQ : {!! $rights_info->to_qq !!}&nbsp;&nbsp;&nbsp;&nbsp;
            Mobile : {!! $rights_info->to_mobile !!}
        </p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">维权时间</p>
        <p class="col-md-11">
            {!! $rights_info->created_at !!}
        </p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">维权说明</p>
        <p class="col-md-11">
            {!! $rights_info->desc !!}
        </p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">维权状态</p>
        <p class="col-md-11">
            @if($rights_info->status == 0)未处理
            @elseif($rights_info->status == 1)已处理
            @elseif($rights_info->status == 2)不成立
            @endif
        </p>
    </div>

    @if(!empty($rights_info->attachment))
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">交易附件</p>

        <p class="col-md-10">
            @foreach($rights_info->attachment as $key => $value)
　　         文件：{!! $value['name'] !!} <a href="{{ URL('shop/download',['id'=>$value['id']]) }}" target="_blank">下载</a>
            @endforeach
        </p>

    </div>
    @endif
    @if($rights_info->object_type == 1)
    <form method="post" action="/manage/serviceRightsSuccess" enctype="multipart/form-data">
    @elseif($rights_info->object_type == 2)
    <form method="post" action="/manage/ShopRightsSuccess" enctype="multipart/form-data">
    @endif
        {{csrf_field()}}
        <input type="hidden" id="id" name="id" value="{!! $rights_info->id !!}">
        @if($rights_info->status == 0 || $rights_info->status == 1)
        <div class="realname-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">维权处理方案</p>
            <p class="col-md-11">
                @if($rights_info->object_type == 1  && !empty($employ) && $rights_info['to_uid']==$employ['employer_uid'])
                    稿件总佣金{{ $rights_info['employ_cash'] }},此任务为1人任务,每人可最多分{{ $rights_info['employ_cash'] }}元，请在这个范围内分配。
                    雇主 ({!! $rights_info->to_name !!}) 获得
                    <input type="text" name="to_price" value="{!! $rights_info->to_price !!}">
                    元，威客 ({!! $rights_info->from_name !!}) 获得
                    <input type="text" name="from_price" value="{!! $rights_info->from_price !!}">
                    元
                @elseif($rights_info->object_type == 1 && !empty($employ) && $rights_info['to_uid']==$employ['employee_uid'])
                    稿件总佣金{{ $rights_info['employ_cash'] }},此任务为1人任务,每人可最多分{{ $rights_info['employ_cash'] }}元，请在这个范围内分配。
                    雇主 ({!! $rights_info->from_name !!}) 获得
                    <input type="text" name="from_price" value="{!! $rights_info->from_price !!}">
                    元，威客 ({!! $rights_info->to_name !!}) 获得
                    <input type="text" name="to_price" value="{!! $rights_info->to_price !!}">
                    元
                @elseif($rights_info->object_type == 2)
                    作品总金额{!! $rights_info->cash !!}元,
                    若维权成立，买家 ({!! $rights_info->from_name !!}) 获得全部金额，
                    若维权不成立，店主 ({!! $rights_info->to_name !!})获得全部金额元
                @endif
            </p>
        </div>
        @endif
        @if($rights_info->status == 0)
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <p class="col-md-10 col-md-offset-1">
                    @if($rights_info->object_type==1)
                    <button type="submit" class="btn btn-primary btn-sm">处理维权</button>
                    @else
                        <a href="/manage/ShopRightsSuccess/{!! $rights_info->id !!}" class="btn btn-primary btn-sm">成立</a>
                    @endif
                    @if($rights_info->object_type==1)
                    <a href="/manage/serviceRightsFailure/{!! $rights_info->id !!}" class="btn btn-primary btn-sm">不成立</a>
                    @else
                    <a href="/manage/ShopRightsFailure/{!! $rights_info->id !!}" class="btn btn-primary btn-sm">不成立</a>
                    @endif
                </p>
            </div>
        </div>
        @endif
    </form>

    <div class="col-xs-12">
        <div class="space-8"></div>
        <p class="col-md-10 col-md-offset-1">
            @if(!empty($pre_id))
                <a href="/manage/shopRightsInfo/{!! $pre_id !!}">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;
            @endif
                <a href="/manage/ShopRightsList">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
            @if(!empty($next_id))
                <a href="/manage/shopRightsInfo/{!! $next_id !!}">下一项</a>
            @endif
        </p>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}