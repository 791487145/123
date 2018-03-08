{{--<div class="space-2"></div>
<div class="page-header">
    <h1>
        交易举报
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">交易举报</h3>
{{--<div class="alert alert-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;稿件举报#594</div>--}}
<div class="g-backrealdetails clearfix bor-border">
    <form action="/manage/handleReport" method="post">
        {{ csrf_field() }}
    <input name="id" value="{{ $report['id'] }}" type="hidden" />
    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">所属稿件</p>
        <p class="col-md-11"><span class="text-primary">#{{ $report['id'] }}</span></p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">所属任务</p>
        <p class="col-md-11"><span class="text-primary">{{ $task['title'] }}</span></p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">举报发起人</p>
        <p class="col-md-11">
            <span class="text-primary">{{ $from_user['nickname'] }}</span>
            @if(!empty($from_user['email']))
                <span class="text-danger">E-mail</span>:{{ $from_user['email'] }} ||
            @endif
            @if(!empty($from_user['qq']))
                <span class="text-danger">QQ</span>:{{ $from_user['qq'] }} ||
            @endif
            @if(!empty($from_user['mobile']))
                <span class="text-danger">手机号码</span>:{{ $from_user['mobile'] }}
            @endif
        </p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">举报对象</p>
        <p class="col-md-11">
            <span class="text-primary">{{ $to_user['nickname'] }}</span>
            @if(!empty($to_user['email']))
                <span class="text-danger">E-mail</span>:{{ $to_user['email'] }} ||
            @endif
            @if(!empty($to_user['qq']))
                <span class="text-danger">QQ</span>:{{ $to_user['qq'] }} ||
            @endif
            @if(!empty($to_user['mobile']))
                <span class="text-danger">手机号码</span>:{{ $to_user['mobile'] }}
            @endif
        </p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">申请举报时间</p>
        <p class="col-md-11">{{ $report['created_at'] }}</p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">状态</p>
        <p class="col-md-11">{{ ($report['status']==0)?'未处理':'已处理' }}</p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">举报说明</p>
        <p class="col-md-11">{{ $report['desc'] }}</p>
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">举报附件</p>
        @if(!empty($attachment))
            @foreach($attachment as $v)
                <p class="col-md-11">
                    <a href="{{ URL('manage/download',['id'=>$v['id']]) }}">{{ $v['name'] }}</a>
                </p>
            @endforeach
        @else
            <p class="col-md-11">未提交附件</p>
        @endif
    </div>

    <div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">举报</p>
        <p class="col-md-11">
            <label><input type="radio" class="ace" name="handle" value="0" {{ (isset($report['handle_type']) && $report['handle_type']==0)?'checked':'' }}><span class="lbl">屏蔽稿件</span></label>
            <label><input type="radio" class="ace" name="handle" value="1" {{ (isset($report['handle_type']) && $report['handle_type']==1)?'checked':'' }}><span class="lbl">举报无效</span></label>
            <label><input type="radio" class="ace" name="handle" value="2" {{ (isset($report['handle_type']) && $report['handle_type']==2)?'checked':'' }}><span class="lbl">账号禁用</span></label>
        </p>
    </div>

    {{--<div class="bankAuth-bottom clearfix col-xs-12">
        <p class="col-md-11 col-md-offset-1">
            <button id="gritter-center" class="btn btn-primary btn-sm" type="submit">
                <i class="ace-icon fa fa-pencil bigger-120"></i>处理举报
            </button>
        </p>
    </div>--}}
    <div class="col-xs-12">
        <div class="clearfix row bg-backf5 padding20 mg-margin12">
            <div class="col-xs-12">
                <div class="col-md-1 text-right"></div>
                <div class="col-md-10"><button type="submit" class="btn btn-primary btn-sm">处理举报</button></div>
            </div>
        </div>
    </div>
    <div class="space col-xs-12"></div>
    <div class="col-xs-12">
        <div class="col-md-1 text-right"></div>
        <div class="col-md-10">
            @if(is_numeric($preId))
            <a href="{{ URL('manage/reportDetail/'.$preId) }}">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;
            @endif　
            <a href="/manage/reportList">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;　　
            @if(is_numeric($nextId))
            <a href="{{ URL('manage/reportDetail/'.$nextId) }}">下一项</a>
            @endif
        </div>
    </div>
    <div class="col-xs-12 space">

    </div>
    </form>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}