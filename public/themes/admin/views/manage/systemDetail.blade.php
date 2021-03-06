
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="">
                <a href="/manage/system" >系统任务列表</a>
            </li>
        </ul>
    </div>
</div>

<form class="form-horizontal" action="/manage/systemUp" method="post">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{ $system['id'] }}">
    <div class="g-backrealdetails clearfix bor-border interface">
        <div class="space-8 col-xs-12"></div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">任务名称</label>
            <div class="text-left col-sm-9">
                <input type="text" name="name" id="title" value="{{$system['name']}}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <lebel class="col-sm-1 text-right">任务等级</lebel>
            <div class="text-left col-sm-9">
                <select name="grade">
                    <option value="">请选择</option>
                    @if($grade_name)
                        @foreach($grade_name as $item)
                            <option value="{{$item['id']}}" {{ ($item['id']==$system['grade'])?'selected':'' }}>{{ $item['name'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <lebel class="col-sm-1 text-right">任务类型</lebel>
            <div class="text-left col-sm-9">
                <select name="type">
                    <option value="">请选择</option>
                    @if($task_name)
                        @foreach($task_name as $item)
                            <option value="{{$item['id']}}" {{ ($item['id']==$system['type'])?'selected':'' }}>{{ $item['name'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">文章内容</label>
            <div class="text-left col-sm-8">
                <!--编辑器-->
                <div class="clearfix">
                     <script id="editor" name="content"  type="text/plain" >{!! htmlspecialchars_decode($system['content']) !!}</script>
                 </div>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">完成任务次数</label>
            <div class="text-left col-sm-9">
                <input type="text" name="amount" value="{{ $system['amount'] }}">
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">时间限制</label>
            <div class="text-left col-sm-9">
                <input type="text" name="time_limit" id="displayOrder" value="{{ $system['time_limit'] }}">天
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <lebel class="col-sm-1 text-right">奖励类型</lebel>
            <div class="text-left col-sm-9">
                <select name="reward_type">
                    <option value="">请选择</option>
                     @if($reward_type)
                     @foreach($reward_type as $item)
                        <option value="{{$item['id']}}" {{ ($item['id']==$system['reward_type'])?'selected':'' }}>{{ $item['name'] }}</option>
                     @endforeach
                     @endif
                </select>
            </div>
        </div>
        <div class="form-group interface-bottom col-xs-12">
            <label class="col-sm-1 text-right">奖励数量</label>
            <div class="text-left col-sm-9">
                <input type="text" name="reward_amount" id="author" value="{{ $system['reward_amount'] }}">
            </div>
        </div>

        <div class="col-xs-12">
            <div class="clearfix row bg-backf5 padding20 mg-margin12">
                <div class="col-xs-12">
                    <div class="col-sm-1 text-right"></div>
                    <div class="col-sm-10"><button type="submit" class="btn btn-sm btn-primary">提交</button></div>
                </div>
            </div>
        </div>

    </div>
</form>


{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('custom', 'plugins/ace/js/jquery-ui.custom.min.js') !!}

