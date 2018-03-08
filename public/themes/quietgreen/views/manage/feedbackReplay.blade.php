
    {{--<div class="space-2"></div>
    <div class="page-header">
        <h1>
            投诉建议
        </h1>
    </div><!-- /.page-header -->--}}
    <h3 class="header smaller lighter blue mg-top12 mg-bottom20">投诉建议</h3>
    {{--<div class="alert alert-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;投诉建议#{!! $feedbackDetail->id !!}</div>--}}
    <form  role="form" action="/manage/feedbackUpdate" class="form-inline search-group" method="get">
        <div class="g-backrealdetails clearfix bor-border">
        <input type="text" name="id" value="{!! $feedbackDetail->id !!}" style="display:none">

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">建议编号</p>
            <p class="col-md-11">#{!! $feedbackDetail->id !!}</p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">建议类型</p>
            <p class="col-md-11">我的建议</p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <input type="hidden" name="uid" value="{!! $feedbackDetail->uid  !!}">
            <input type="hidden" name="username" value="{!! $feedbackDetail->name  !!}">
            <p class="col-md-1 text-right">建议人</p>
            <p class="col-md-11">
            <span class="text-primary">
                @if($feedbackDetail->name)
                    {!! $feedbackDetail->name !!}
                @else
                    无
                @endif
            </span>
                @if($feedbackDetail->phone)
                    || <span class="text-danger">手机号码</span>:{!! $feedbackDetail->phone !!}
                @endif
            </p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">建议时间</p>
            <p class="col-md-11">{!! $feedbackDetail->created_time !!}</p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">状态</p>
            <p class="col-md-11">@if($feedbackDetail->status == '1')未回复@else已回复@endif</p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">详细描述</p>
            <p class="col-md-11">{!! $feedbackDetail->desc !!}</p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">@if($feedbackDetail->name)回复内容 @else 备注 @endif</p>
            <p class="col-md-11">
            <textarea name="replay">
            </textarea>
                {!! $errors->first('replay') !!}
            </p>
        </div>

        {{--<div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-11 col-md-offset-1">
                <button type="submit" id="gritter-center" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-pencil bigger-120"></i>回复</button>　　
                <a href="/manage/feedbackList">
                    <span class="btn btn-sm"><i class="fa fa-mail-reply"></i> 返回</span>
                </a>
            </p>
        </div>--}}
        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <div class="col-md-10">
                        <button type="submit" id="gritter-center" class="btn btn-primary btn-sm">回复</button>　　
                        <a href="/manage/feedbackList">
                            <span class="btn btn-sm"> 返回</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="space col-xs-12"></div>
        <div class="col-xs-12">
            <div class="col-md-1 text-right"></div>
            <div class="col-md-10"><a href="">上一项</a>　　<a href="">下一项</a></div>
        </div>
        <div class="col-xs-12 space">

        </div>
    </div>
    </form>



{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}