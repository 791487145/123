@foreach($delivery['data'] as $v)
    <div class="bidrecords">
        <div class="evaluate row evaluatetop">
            <div class="col-md-1 evaluateimg"><img src="{{ CommonClass::getDomain().'/'.CommonClass::getAvatar($v['uid']) }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))"></div>
            <div class="col-md-11 evaluatemain">
                <div class="evaluateinfo clearfix">
                    <div class="pull-left">
                        <p><b>{{ $v['nickname'] }}</b> | 好评率：<span class="cor-orange">{{ CommonClass::applauseRate($v['uid']) }}%</span></p>
                        <p class="evaluatetime">提交于{{ date('Y-m-d H:i:s',strtotime($v['created_at'])) }}</p>
                    </div>

                    <div class="pull-right" id="check-{{ $v['id'] }}">
                        @if($v['status']==2 && $user_type==1)
                            <button class="btn btn-primary btn-sm btn-blue btn-big1 bor-radius2 " data-toggle="modal" data-target="#modal{{ $v['id'] }}">验收付款</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!--验收付款 模态框（Modal） -->
                            <div class="modal fade" id="modal{{ $v['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header widget-header-flat">
                                            <span class="modal-title cor-gray51 text-size14 text-blod">
                                                交稿提示：
                                            </span>
                                            <button type="button" class="bootbox-close-button close text-size14"
                                                    data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <form action="/task/check" method="get" id="form">
                                                <input name="work_id" value="{{ $v['id'] }}" type="hidden"/>
                                                <div class="space"></div>
                                                <p class="cor-gray51 text-size14">请确认您是否已查看源文件，并通过验收！</p>
                                                <div class="clearfix text-size12">
                                                    <label class="inline">
                                                        <input type="checkbox" class="ace" name="agree" checked="checked" datatype="*" nullmsg="请先阅读并同意">
                                                        <span class="lbl text-muted">&nbsp;&nbsp;&nbsp;我已阅读并同意 <a href="/bre/agree/task_delivery">《KPPW文件交付协议》</a></span>
                                                    </label>
                                                </div>
                                                <div class="space"></div>
                                                <button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2" type="submit" >确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button href="javascript:;" class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                                                <div class="space"></div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal -->
                            </div>
                        @endif
                        @if($v['status']==2 && ($user_type==1 || ($user_type==2 && Auth::check() && $v['uid']==Auth::user()['id'])))
                            <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2 " data-toggle="modal" data-target="#modallost{{ $v['id'] }}">交易维权</button>
                            <!--交易维权 模态框（Modal） -->
                            <div class="modal fade" id="modallost{{ $v['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header widget-header-flat">
                                            <span class="modal-title cor-gray51 text-size14 text-blod">
                                                交易维权：
                                            </span>
                                            <button type="button" class="bootbox-close-button close text-size14"
                                                    data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/task/ajaxRights" class="form-horizontal text-size14 cor-gray51" role="form" method="post" id="right-form-{{ $v['id'] }}">
                                                {{ csrf_field() }}
                                                <input name="task_id" value="{{ $detail['id'] }}" type="hidden" />
                                                <input name="work_id" value="{{ $v['id'] }}" type="hidden" />
                                                <div class="space"></div>
                                                <div class="clearfix">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">维权类型：</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <select name="type">
                                                                    <option value="1">违规信息</option>
                                                                    <option value="2">虚假交稿</option>
                                                                    <option value="3">涉嫌抄袭</option>
                                                                    <option value="4">其他</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">维权原因：</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <textarea type="text" name="desc"   placeholder="请输入维权原因"  rows="3" cols="50"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="clearfix text-center">
                                                    <button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2" type="button" work_id="{{ $v['id'] }}" onclick="ajaxRights($(this))" data-dismiss="modal" aria-hidden="true">确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                                                </div>
                                                <div class="space"></div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal -->
                            </div>
                        @endif
                    </div>
                    @if($v['status']==3  && $user_type==1  && CommonClass::ownerEvalute($v['task_id'],Auth::user()['id'],$v['uid'])==0)
                        <div class="pull-right">
                            <a target="_blank" href="{{ URL('/task/evaluate').'?'.http_build_query(['id'=>$v['task_id'],'work_id'=>$v['id']]) }}" class="btn btn-primary btn-sm btn-blue btn-big1 bor-radius2 ">去评价</a>
                        </div>
                    @elseif($v['status']==3 && $user_type==2 && CommonClass::evaluted($v['task_id'],Auth::user()['id'])==0 && $v['uid']==Auth::user()['id'])
                        <div class="pull-right">
                            <a target="_blank" href="{{ URL('/task/evaluate').'?'.http_build_query(['id'=>$v['task_id'],'work_id'=>$v['id']]) }}" class="btn btn-primary btn-sm btn-blue btn-big1 bor-radius2 ">去评价</a>
                        </div>
                    @endif
                </div>
                <div class="evaluatext">
                    {!! $v['desc'] !!}
                </div>
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
            </div>
        </div>
    </div>
@endforeach
<div class="pull-right">
    <ul class="pagination ">
        @if(!empty($works['prev_page_url']))
            <li><a href="javascript:void(0)" onclick="ajaxPageDelivery($(this))" url="{!! URL('task/ajaxPageDelivery').'/'.$detail['id'].'?'.http_build_query(array_merge($merge,['page'=>$works['current_page']-1])) !!}">«</a></li>
        @elseif($works['last_page']>1)
            <li class="disabled"><span>«</span></li>
        @endif
        @if($works['last_page']>1)
            @for($i=1;$i<=$works['last_page'];$i++)
                <li class="{{ ($i==$works['current_page'])?'active disabled':'' }}"><a href="javascript:void(0)" onclick="ajaxPageDelivery($(this))" url="{!! URL('task/ajaxPageDelivery').'/'.$detail['id'].'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
            @endfor
        @endif
        @if(!empty($works['next_page_url']))
            <li><a href="javascript:void(0)" onclick="ajaxPageDelivery($(this))" url="{!! URL('task/ajaxPageDelivery').'/'.$detail['id'].'?'.http_build_query(array_merge($merge,['page'=>$works['current_page']+1])) !!}">»</a></li>
        @elseif($works['last_page']>1)
            <li class="disabled"><span>»</span></li>
        @endif
    </ul>
</div>
