
<div class="tab-content bg-white task-taskdisplay">
    <ul class="nav nav-pills mg-margin">
        <li class="{{ !isset($merge['work_type'])?'active':'' }}"><a href="javascript:void(0);" onclick="ajaxPageWorks($(this))"  url="{{ URL('task/ajaxPageWorks/').'/'.$detail['id']}}" class="{{ !isset($merge['work_type'])?'btn-blue':'' }}">全部</a></li>
        <li class="{{ (isset($merge['work_type']) && $merge['work_type']==1)?'active':'' }}"><a class="{{ (isset($merge['work_type']) && $merge['work_type']==1)?'btn-blue':'' }}" href="javascript:void(0)" onclick="ajaxPageWorks($(this))" url="{{ URL('task/ajaxPageWorks/').'/'.$detail['id'].'?'.http_build_query(['work_type'=>1]) }}">未中标<span> ({{ ($works_count-$works_bid_count) }})</span></a></li>
        <li class="{{ (isset($merge['work_type']) && $merge['work_type']==2)?'active':'' }}"><a class="{{ (isset($merge['work_type']) && $merge['work_type']==2)?'btn-blue':'' }}" href="javascript:void(0)" onclick="ajaxPageWorks($(this))" url="{{ URL('task/ajaxPageWorks/').'/'.$detail['id'].'?'.http_build_query(['work_type'=>2]) }}">中标<span> ({{ $works_bid_count }})</span></a></li>
    </ul>
</div>
@if(count($works['data'])>0)
    @foreach($works['data'] as $v)
        @if($detail['work_status']==0 || $user_type==1 || $v['uid']==Auth::user()['id'])
        <div class="bidrecords">
            <div class="evaluate row">
                <div class="col-md-1 evaluateimg"><img src="{{ CommonClass::getDomain().'/'.CommonClass::getAvatar($v['uid']) }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))"></div>
                <div class="col-md-11 evaluatemain">
                    <div class="evaluateinfo clearfix">
                        <div class="pull-left">
                            <div class="clearfix">
                                <p class="pull-left"><b>{{ $v['nickname'] }}</b>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;好评率：<span class="text-orange">{{ CommonClass::applauseRate($v['uid']) }}%</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    @if($user_type==1)
                                        @if(Auth::check() && Auth::User()->id != $v['uid'])
                                            <a class="taskconico contactHe" data-toggle="modal" data-target="#myModalwk" data-values="{{$v['uid']}}" data="{{Theme::get('is_IM_open')}}">联系TA</a>
                                        @endif
                                        <a class="taskentuseico" href="{{ url('bre/serviceCaseList',['uid'=>$v['uid']]) }}">进入空间</a>
                                    @endif
                                </p>
                                @if($task_type_alias == 'zhaobiao')
                                    <p class="pull-left price">
                                        <img src="{{ Theme::asset()->url('images/price_icon.png') }}">
                                        <span>报价金额:</span>
                                        <span>￥{{$v['price']}}</span>
                                    </p>
                                @endif
                            </div>

                            <p class="evaluatetime">
                                提交于{{ $v['created_at'] }}
                            </p>

                        </div>
                        @if(($detail['status']==4 || $detail['status']==5) && $user_type==1 && $v['status']==0)
                            <div id="select-attachment-{{$v['id']}}" class="select-attachment">
                                <div class="pull-right">
                                    <button data-target="#myModal{{ $v['id'] }}" data-toggle="modal" class="btn btn-primary btn-blue btn-big1 bor-radius2">选TA</button>
                                </div>
                                <!-- 模态框（Modal） -->
                                <div class="modal fade" id="myModal{{ $v['id'] }}" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header widget-header-flat">
                                                <span class="modal-title" id="myModalLabel">
                                                    审核提示：
                                                </span>
                                            </div>
                                            <div class="modal-body text-center">
                                                @if($task_type_alias == 'xuanshang')
                                                    <p class="h5">确定将“
                                                        <span class="text-primary">
                                                            {{ $v['nickname'] }}
                                                        </span>”设置为中标吗？
                                                    </p>
                                                @elseif($task_type_alias == 'zhaobiao')
                                                    <p class="h5">确定将“
                                                        <span class="text-primary">
                                                            {{ $v['nickname'] }}
                                                        </span>”设置为中标,并且托管赏金吗？
                                                    </p>

                                                @endif
                                                <div class="space"></div>
                                                <p>
                                                    <button class="btn btn-primary win-bid" type="button" task_id="{{ $detail['id'] }}" work_id="{{ $v['id'] }}" @if($task_type_alias == 'xuanshang') onclick="winBid($(this))"  @elseif($task_type_alias == 'zhaobiao') onclick="bidWinBid($(this))" @endif data-dismiss="modal">确定</button>
                                                    <button class="btn" type="button" data-dismiss="modal">取消</button>
                                                </p>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal -->
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- 联系TA模态框 -->
                    @if(Theme::get('is_IM_open') == 2)
                        <div class="modal fade" id="myModalwk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog  contact-me-modal" role="document">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">联系TA</h4>
                                    </div>
                                    <form class="form-horizontal" action="seriveceCaseDetail_submit" method="post" accept-charset="utf-8">

                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                                                    <strong>标题：</strong> </label>

                                                <div class="col-sm-9">
                                                    <input type="text" id="form-field-1" name="title" class="col-xs-10 col-sm-5 titleHe">
                                                    <input type="hidden" name="js_id" class="js_id" id="contactHeId" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                                                    <strong>内容：</strong> </label>

                                                <div class="col-sm-9">
                                                    <textarea class="form-control col-xs-10 col-sm-5 contentHe" id="form-field-8" name="content"></textarea>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-primary" id="contactHe">确定</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="evaluatext">{!! $v['desc'] !!}</div>
                    <div>
                        <div>
                            <p class="h4 description-title"><b><i class="fa fa-paperclip fa-rotate-90"></i> 附件 <span class="text-muted">({{ count($v['children_attachment']) }})</span></b></p>
                        </div>
                        <div class="user-profile clearfix">
                            <ul class="ace-thumbnails">
                                @foreach($v['children_attachment'] as $value)
                                    <li>
                                        <a href="#" >
                                            <img alt="150x150" src="{!! Theme::asset()->url('images/task-xiazai/'.matchImg($value['type']).'.png') !!}">
                                            <div class="text">
                                                <div class="inner"></div>
                                            </div>
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="{{ URL('task/download',['id'=>$value['attachment_id']]) }}" target="_blank">下载</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="text-right">
                        @if(Auth::check())
                            <a class="evaluateshow text-under blue get-comment" url="/task/getComment" work_id = '{{ $v['id'] }}' num="0" onclick="evaluateshow($(this))"  >回复</a>
                        @else
                            <a class="evaluateshow text-under blue" url="/task/getComment" work_id = '{{ $v['id'] }}' onclick="loginremaind($(this))"  >回复</a>
                        @endif
                        <a class="blue" work_id="{{ $v['id'] }}" onclick="report($(this))" data-toggle="modal" data-target="#modal9">举报</a>
                    </div>
                    <div class="evaluatehide">
                        <div class="space"></div>
                        <div class="widget-box">
                            <div class="widget-body">
                                <div class="widget-main no-padding"  >

                                    <form>
                                        <input id="work-comment-pid-{{ $v['id'] }}" type="hidden" name="pid" >
                                        <div class="form-actions">
                                            <div class="input-group">
                                                <input placeholder="说点什么"  type="text" class="form-control" name="comment" id="work-comment-answer-{{ $v['id'] }}" />
                                                <span class="input-group-btn">
                                                    <span class="btn btn-sm btn-info no-radius allbtn" url="/task/ajaxComment" type="button" work_id = "{{ $v['id'] }}" task_id="{{ $v['task_id'] }}" token="{{ csrf_token() }}" onclick='ajaxComment($(this))'>
                                                        <i class="ace-icon fa fa-share"></i>
                                                        提交
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- #section:pages/dashboard.conversations -->
                                    <div class="dialogs scroll-content" id="work-comment-{{ $v['id'] }}">

                                    </div>

                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div><!-- /.widget-box -->
                    </div>
                </div>
            </div>
            @if($v['status']==1 || $v['status']==2)
                <div class="selecte" id="selecte-{{ $v['id'] }}" ></div>
            @elseif($v['status']==5)
                <div class="weedout" id="weedout-{{ $v['id'] }}" ></div>
            @else
                <div class="selecte" id="selecte-{{ $v['id'] }}" style="display:none;"></div>
                <div class="weedout" id="weedout-{{ $v['id'] }}" style="display:none;"></div>
            @endif
        </div>
        @else
        <div class="norecord">
            <div class="tab-content text-center text-gray">
                {{--<h2><i class="fa fa-exclamation-circle"></i></h2>--}}
                {{--<p>暂无消息</p>--}}
                <div class="detail-nomessage">此稿件已隐藏哦</div>
            </div>
        </div>
        @endif
    @endforeach
@else
    <div class="norecord">
        <div class="tab-content text-center text-gray">
            {{--<h2><i class="fa fa-exclamation-circle"></i></h2>--}}
            {{--<p>暂无消息</p>--}}
            <div class="detail-nomessage">暂无消息哦 ！</div>
        </div>
    </div>
@endif

<div class="pull-right">
    <ul class="pagination ">
        @if(!empty($works['prev_page_url']))
            <li><a href="javascript:void(0)" onclick="ajaxPageWorks($(this))" url="{!! URL('task/ajaxPageWorks').'/'.$detail['id'].'?'.http_build_query(array_merge($merge,['page'=>$works['current_page']-1])) !!}">«</a></li>
        @elseif($works['last_page']>1)
        <li class="disabled"><span>«</span></li>
        @endif
        @if($works['last_page']>1)
            @for($i=1;$i<=$works['last_page'];$i++)
                <li class="{{ ($i==$works['current_page'])?'active disabled':'' }}"><a href="javascript:void(0)" onclick="ajaxPageWorks($(this))" url="{!! URL('task/ajaxPageWorks').'/'.$detail['id'].'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
            @endfor
        @endif
        @if(!empty($works['next_page_url']))
            <li><a href="javascript:void(0)" onclick="ajaxPageWorks($(this))" url="{!! URL('task/ajaxPageWorks').'/'.$detail['id'].'?'.http_build_query(array_merge($merge,['page'=>$works['current_page']+1])) !!}">»</a></li>
        @elseif($works['last_page']>1)
            <li class="disabled"><span>»</span></li>
        @endif
    </ul>
</div>



