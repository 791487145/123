{{--<div class="space-2"></div>
<div class="page-header">
    <h1>
        交易维权
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">交易维权</h3>
{{--<div class="alert alert-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;稿件维权#{{ $report['id'] }}</div>--}}
<div class="g-backrealdetails clearfix bor-border">
    <form action="/manage/handleRights" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $report['id'] }}" />
        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">所属稿件</p>
            <p class="col-md-11"><span class="text-primary">#{{ $work['id'] }}</span></p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">所属任务</p>
            <p class="col-md-11"><span class="text-primary">{{ $task['title'] }}</span></p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">维权发起人</p>
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
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">维权对象</p>
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
            <p class="col-md-1 text-right">申请维权时间</p>
            <p class="col-md-11">{{ $report['created_at'] }}</p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">状态</p>
            <p class="col-md-11">{{ ($report['status']==0)?'未处理':'已处理' }}</p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">维权说明</p>
            <p class="col-md-11">{{ $report['desc'] }}</p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">维权附件</p>
            <p class="col-md-11">未提交附件</p>
        </div>

        <div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-1 text-right">维权处理方案</p>
            <div class="col-md-11">
                <p>稿件总佣金{{ $task['bounty'] }},此任务为{{ $task['worker_num'] }}人任务,每人可分{{ ($task['bounty']/$task['worker_num']) }}元，请在这个范围内分配。</p>
                @if($report['status']==0)
                    @if($report['role']==0)
                        <p>雇主 ({{ $to_user['nickname'] }}) 获得 <input type="text" name="owner_bounty"/>元，威客 ({{ $from_user['nickname'] }}) 获得 <input type="text" name="worker_bounty" />元</p>
                    @endif
                    @if($report['role']==1)
                        <p>雇主 ({{ $from_user['nickname'] }}) 获得 <input type="text" name="owner_bounty" />元，威客 ({{ $to_user['nickname'] }}) 获得 <input type="text" name="worker_bounty"  />元</p>
                    @endif
                @endif
            </div>
        </div>

        {{--<div class="bankAuth-bottom clearfix col-xs-12">
            <p class="col-md-11 col-md-offset-1">
                @if($report['status']==0)
                <button id="gritter-center" class="btn btn-primary btn-sm">
                    <i class="ace-icon fa fa-pencil bigger-120"></i>处理维权
                </button>
                　　@endif
                <a class="btn btn-danger btn-sm" href="{{ url('/manage/rightsList') }}">返回</a>
            </p>
        </div>--}}

        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-md-1 text-right"></div>
                    <div class="col-md-10">
                        @if($report['status']==0)
                            <button id="gritter-center" class="btn btn-primary btn-sm">
                                处理维权
                            </button>
                            　　@endif
                        <a class="btn btn-danger btn-sm" href="{{ url('/manage/rightsList') }}">返回</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="space col-xs-12"></div>
        <div class="col-xs-12">
            <div class="col-md-1 text-right"></div>
            @if(is_numeric($preId))
                <a href="{{ URL('manage/rightsDetail/'.$preId) }}">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;
            @endif
            @if(is_numeric($nextId))
                <a href="{{ URL('manage/rightsDetail/'.$nextId) }}">下一项</a>
            @endif
        </div>
        <div class="col-xs-12 space">
    </form>
</div>
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
