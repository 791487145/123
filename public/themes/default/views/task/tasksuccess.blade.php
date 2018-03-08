<div class="g-taskposition col-lg-12 col-left">您的位置：首页 &gt; 任务大厅</div>
<div class="col-xs-12 col-left">
    <div class="taskDetails taskbg clearfix taskSuccess">
        <div class="taskSuccess-left col-lg-4 col-md-3 col-sm-2 hidden-xs text-right">
            <img src="{{ Theme::asset()->url('images/success-right.png') }}" alt="">
        </div>
        <div class="taskSuccess-left hidden-lg hidden-sm hidden-md visible-xs-12 text-center">
            <img src="{{ Theme::asset()->url('images/success-right.png') }}" alt="">
        </div>
        <div class="taskSuccess-right col-lg-8 col-md-9 col-sm-10 col-xs-12">
            <h4 class="text-size24">恭喜您任务发布成功，请您耐心等待后台审核！</h4>
            <p class="">如果任务长时间未通过审核，请立即<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes">联系管理员</a></p>
            <p><a href="{{ url('/task/create') }}">继续发布任务</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ url('task',['id'=>$id]) }}">查看任务</a></p>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
