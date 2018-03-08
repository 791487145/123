<div class="g-main g-releasetask">
	<h4 class="text-size16 cor-blue2f u-title clearfix">
		<span>我承接的任务</span>
		<div class="pull-right g-reletaskhd">
			<select class="form-control no-margin" onchange="timeChange(this)">
				 <option value="0" {{ (empty($_GET['time']) || $_GET['time']==0)?'selected':'' }}>时间段</option>
				 <option value="1" {{ (!empty($_GET['time']) && $_GET['time']==1)?'selected':'' }}>1个月</option>
				 <option value="2" {{ (!empty($_GET['time']) && $_GET['time']==2)?'selected':'' }}>3个月</option>
				 <option value="3" {{ (!empty($_GET['time']) && $_GET['time']==3)?'selected':'' }}>6个月</option>
			</select>
		</div>
	</h4>
    <div class="space-12"></div>
    <div class="clearfix g-reletaskhd hidden-xs">
        <form action="/user/acceptTasksList" method="get">
            <div class="col-lg-12 clearfix">
				<div class="col-lg-1 cor-gray51 text-size14 col-sm-2 col-xs-12">
					<div class="row">任务类型</div>
				</div>
				<div class="col-lg-6 col-sm-10  col-xs-12 g-task-select">
					 @foreach($task_type as $Vtt)
					<a class="{!! (!isset($merge['type']) || $merge['type']==$Vtt->id)?'bg-blue':'' !!}" href="{!! URL('user/acceptTasksList').'?'.http_build_query(array_merge(array_except($merge,'page'), ['type'=>$Vtt->id])) !!}">{{$Vtt->name}}（@if(isset($Vtt->counts)){{$Vtt->counts}}@else 0 @endif）</a>
				  @endforeach	
				</div>
				<div class="pull-right">
					<a class="text-size14 cor-blue2f visible-lg-block" href="/user/acceptTasksList"><i class="fa fa-list-ul"></i></a>
					<a class="text-size14 cor-graybd visible-lg-block" href="/user/myTask"><i class="fa fa-list-ul fa-rotate-90"></i></a>
					<div class="text-size14 cor-graybd g-releasechart visible-lg-block hidden-xs hidden-sm hidden-md" href="javascript:;">
						<i class="fa fa-pie-chart"></i>
						<div class="g-releasehidea"></div>
						<div class="g-releasehide">
							<div>
								<div>饼图统计</div>
								@if(!$pie_data)
								<div class="widget-body">
									<div class="widget-main">
										<!-- #section:plugins/charts.flotchart -->
										<div class="g-userchartno">您还没有发布过任务 </div>
									</div><!-- /.widget-main -->
								</div><!-- /.widget-body -->
								@else
								<div class="widget-body">
									<div class="widget-main">
										<!-- #section:plugins/charts.flotchart -->
										<div id="piechart-placeholder"></div>
									</div><!-- /.widget-main -->
								</div><!-- /.widget-body -->
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 clearfix">
				<div class="col-lg-1 cor-gray51 text-size14 col-sm-2 col-xs-12">
					<div class="row">任务状态</div>
				</div>
				<div class="col-lg-11 col-sm-10  col-xs-12 g-task-select">
					<a class="{!! (!isset($merge['status']) || $merge['status']==0)?'bg-blue':'' !!}" href="{!! URL('user/acceptTasksList').'?'.http_build_query(array_merge(array_except($merge,['keywords','page']),['status'=>0])) !!}">全部</a>
					@foreach($task_status as $Kts=>$Vts)
					<a class="{!! (!isset($merge['status']) || $merge['status']==$Kts)?'bg-blue':'' !!}" href="{!! URL('user/acceptTasksList').'?'.http_build_query(array_merge(array_except($merge,'page'), ['status'=>$Kts])) !!}">{{$Vts}}</a>
					@endforeach
				</div>
			</div>
        </form>
    </div>
    <div class="space-6"></div>
    @if(count($my_tasks) && $my_tasks['total'])
    <ul id="useraccept">
        @foreach($my_tasks['data'] as $v)
            <li class="row width590">
                <div class="col-sm-1 col-xs-2 usercter">
                    <img src="{!! url($v['avatar']) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/default_avatar.png')}}',$(this))">
                </div>


                <div class="col-sm-11 col-xs-10 usernopd">
                    <div class="col-sm-9 col-xs-8">
                        <div class="text-size14 cor-gray51"><span class="cor-orange">￥{{ $v['bounty'] }}</span>&nbsp;&nbsp;<a class="cor-blue42" href="/task/{{ $v['id'] }}">{{ $v['title'] }}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;{{ $v['status_text'] }}</div>
                        <div class="space-6"></div>
                        <p class="cor-gray87"><i class="ace-icon fa fa-user bigger-110 cor-grayd2"></i> {{ $v['nickname'] }}&nbsp;&nbsp;&nbsp;<i class="fa fa-eye cor-grayd2"></i> {{ $v['view_count'] }}人浏览/{{ $v['delivery_count'] }}人投稿&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o cor-grayd2"></i> {{$v['show_publish']}}&nbsp;&nbsp;&nbsp;<i class="fa fa-unlock-alt cor-grayd2"></i> @if($v['bounty_status']==0)未托管赏金@else 已托管赏金@endif</p>
                        <div class="space-6"></div>
                        <p class="cor-gray51 p-space">{!! str_limit(strip_tags(htmlspecialchars_decode($v['desc'])),120) !!}</p>
                        <div class="space-2"></div>
                        <div class="g-userlabel">
                            @if($v['cate_name'])<a href="">{{ $v['cate_name'] }}</a>@endif
                            @if($v['region_limit']==1)
                                <a href="">{{ $v['province']['name'].$v['city']['name'] }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-4 text-right hiden590"><a class="btn-big bg-blue bor-radius2 hov-blue1b" target="_blank" href="/task/{{ $v['id'] }}">查看</a></div>
                    <div class="col-xs-12"><div class="g-userborbtm"></div></div>
                </div>
            </li>
        @endforeach
    </ul>
    @else
        <div class="g-nomessage">暂无信息哦 ！</div>
    @endif
    <div class="space-20"></div>
    @if(count($my_tasks) && $my_tasks['total'])
    <div class="dataTables_paginate paging_bootstrap">
        <ul class="pagination">
            {!! $taskInfo_obj->appends($merge)->render() !!}
        </ul>
    </div>
    @endif
</div>
<script>
 function timeChange(obj){
   var time=obj.value;
   var url = location.search; //获取url中"?"符后的字串
   var theRequest = new Object();
   if (url.indexOf("?") != -1) {
      var str = url.substr(1);
      strs = str.split("&");
      for(var i = 0; i < strs.length; i ++) {
         theRequest[strs[i].split("=")[0]]=(strs[i].split("=")[1]);
      }	 
      window.location.href="/user/acceptTasksList?uid="+theRequest.uid+"&time="+time+"&type="+theRequest.type+"&status="+theRequest.status;	  
   }else{
	   window.location.href="/user/acceptTasksList?time="+time;
   }
     

 }
</script>
{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}
@if($pie_data)
    {!! Theme::widget('mypie',['pie_data'=>$pie_data])->render() !!}
@endif
