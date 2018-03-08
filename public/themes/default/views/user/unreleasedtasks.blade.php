<div class="g-main g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">未发布的任务</h4>
    <div class="space-12"></div>
    <div class="clearfix g-reletaskhd hidden-xs">
        <form action="/user/unreleasedTasks" class="clearfix" method="get">
			<select class="form-control pull-left"  name="type">
				<option value="0" {{ (empty($_GET['type']) || $_GET['type']==0)?'selected':'' }}>全部</option>
				@foreach($task_type as $Vtt)
				<option value="{{$Vtt->id}}" {{ (!empty($_GET['type']) && $_GET['type']=="$Vtt->id")?'selected':'' }}>{{$Vtt->name}}</option>
				@endforeach
			</select>
			<button type="submit">
				<i class="fa fa-search text-size16 cor-graybd"></i> 搜索
			</button>
        </form>
	</div>
        @if(count($unreleased['data'])>0)
        <ul id="useraccept" class="g-unreleaselist">
            @foreach($unreleased['data'] as $v)
            <li>
                <div class="row">
                    <div class="col-lg-9 col-sm-7 col-xs-6 width100">
                        <div class="text-size14 cor-gray51"><a class="cor-blue2f" href="/task/release/{{ $v['id'] }}">{{ $v['title'] }}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;{{ ($v['status']==0)?'未发布':'未托管' }}&nbsp;&nbsp;&nbsp;@if($v['alias'] =='xuanshang' && $type==0)<span style="position:relative;top:1px;color:#fff;font-size:4px;padding:0 5px;background-color:#ff9934;margin-right:1px;">悬赏</span>@elseif($v['alias'] =='zhaobiao' && $type==0)<span style="position:relative;top:1px;color:#fff;font-size:4px;padding:0 5px;background-color:#ff9934;margin-right:1px;">招标</span>@endif</div>
                        <div class="space-8"></div>
                        <p class="cor-gray51 p-space">{!! str_limit(strip_tags(htmlspecialchars_decode($v['desc'])),80) !!}</p>
                        <div class="space-4"></div>
                        <div class="g-userlabel"><a href="">{{ $v['cate_name'] }}</a><span class="inlineblock"><i class="fa fa-calendar"></i> 保存时间：{{ date('Y-m-d',strtotime($v['created_at'])) }}</span></div>
                    </div>
                    <div class="col-lg-3 col-sm-5 col-xs-6 text-right g-unreleasebtn width100">@if($v['status']==1 && $v['alias']=='xuanshang')<a  href="/task/bounty/{{ $v['id'] }}" target="_blank">托管</a>@endif<a href="/task/release/{{ $v['id'] }}" target="_blank">编辑</a><a  href="/user/unreleasedTasksDelete/{{ $v['id'] }}">删除</a></div>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="space-20"></div>
        <div class="dataTables_paginate paging_bootstrap">
            <ul class="pagination">
                @if(!is_null($unreleased['prev_page_url']))
                    <li><a href="{{ $unreleased['prev_page_url'] }}">«</a></li>
                @elseif($unreleased['last_page']>1)
                    <li class="disabled"><span>«</span></li>
                @endif
                @if($unreleased['last_page']>1)
                    @for($i=1;$i<=$unreleased['last_page'];$i++)
                        <li class="{{ ($i==$unreleased['current_page'])?'active':'' }}"><a href="{{ 'unreleasedTasks?page='.$i }}" class="bg-blue">{{ $i }}</a></li>
                    @endfor
                @endif
                @if(!is_null($unreleased['next_page_url']))
                    <li><a href="{{ $unreleased['next_page_url'] }}">»</a></li>
                    @elseif($unreleased['last_page']>1)
                        <li class="disabled"><span>»</span></li>
                @endif
            </ul>
        </div>
        @else
        <div class="space-30"></div>
        <div class="space-30"></div>
        <div class="text-center">
            <p class="cor-gray51 text-size20">抱歉！您没有未发布的任务</p>
            <p class="cor-gray87 text-size14">您可以去发布任务</p>
            <div class="space-10"></div>
            <a class="btn-big bg-blue text-size18 bor-radius2" href="/task/create">发布任务</a>
        </div>
        @endif
    </div>
{!! Theme::widget('popup')->render() !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('finance-layout','css/usercenter/finance/finance-layout.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}