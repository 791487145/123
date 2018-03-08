<div class="row">
    <div class="col-md-3 hidden-sm hidden-xs col-left">
        <div class="focuside">
            <div class="accordion-style1 panel-group accordion-style2 g-side1 g-sidebor" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title clearfix">
                            <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse"
                               class="accordion-toggle g-wrap1 g-active"><span class="text-size20"><i
                                            class="fa fa-envelope"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;我的消息
                                <i class="pull-right fa fa-angle-down" data-icon-hide="fa-angle-down"
                                   data-icon-show="fa-angle-right"></i>
                            </a>
                        </h4>
                    </div>

                    <div id="collapseThree" class="panel-collapse collapse in">
                        <div @if($type == 1)class="g-sidenav z-active g-side-select" @else class="g-sidenav  g-side-select" @endif>
                            <a href="/user/messageList/1" class="g-wrap2">系统消息</a>
                        </div>
                        <div @if($type == 2)class="g-sidenav z-active g-side-select" @else class="g-sidenav  g-side-select" @endif>
                            <a href="/user/messageList/2" class="g-wrap2">交易动态</a>
                        </div>
                        <div @if($type == 4)class="g-sidenav z-active g-side-select" @else class="g-sidenav  g-side-select" @endif>
                            <a href="/user/messageList/4" class="g-wrap2 active">收件箱</a>
                        </div>
                        <div @if($type == 3)class="g-sidenav z-active g-side-select" @else class="g-sidenav  g-side-select" @endif>
                            <a href="/user/messageList/3" class="g-wrap2 active">发件箱</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 g-side2 col-left">
        <div class="g-main g-message">
            <h4 class="text-size16 cor-blue u-title" data-values="{{$type}}">@if($type == 1)系统消息 @elseif($type == 3)
                    发件箱 @elseif($type == 4) 收件箱 @else 交易动态 @endif</h4>
            <div class="g-messagehd">
                <a href="javascript:;" class="all_message cor-gray51">全部</a>&nbsp;&nbsp;&nbsp;
                <a href="javascript:;" class="" id="is_read">已读</a> |
                <a href="javascript:;" class="no_read">未读(<span style="padding-right: 0">{{$new_count}}</span>)</a>
            </div>
            @if(!empty($message) && !empty($message->toArray()['data']))
                <div class="space-4"></div>
                <div class="well clearfix hidden-xs">
                    <div class="pull-left">
                        <label class="position-relative">
                            <input class="ace" type="checkbox">
                            <span class="lbl"></span>
                        </label>
                        <a class="is_read">标记所选为已读</a><a class="is_delete">删除所选</a>
                    </div>
                </div>
                @foreach($message->toArray()['data'] as $key => $value)
                    <div class="g-messagewrap">
                        <div @if(!empty($value['read_time']))  class="row g-messagelist" data-values="1"
                             @else class="row g-messagelist g-mesactive" data-values="2"
                             @endif data-id="{{$value['id']}}">
                            <div class="col-sm-9">
                                <div class="col-lg-4 col-sm-5 messnopd">
                            <span class="hidden-xs">
                                <input class="ace check_id" type="checkbox" value="{{$value['id']}}">
                                <span class="lbl"></span>
                            </span>
                                    <span class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span class="g-messageico">{{$value['message_title']}}</span>
                                </div>
                                <div class="space-4 visible-xs-block"></div>
                                <div class="col-lg-8 col-sm-7 messnopd">

                                    <div class="g-messageclick">-- {!! htmlspecialchars_decode($value['message_content']) !!}</div>

                                </div>
                                <div class="space-4 visible-xs-block"></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <p class="text-right">{{$value['receive_time']}}</p>
                                </div>
                            </div>
                            <div class="col-sm-11 col-sm-offset-1 g-messageinfo">
                                {!! htmlspecialchars_decode($value['message_content']) !!}
                                @if($type == 3)
                                    <p class="text-right">
                                        ----发送给 {{$value['username']}}
                                    </p>
                                @endif
                                @if($type == 4)
                                    <p class="text-right">
                                        ----接收自 {{$value['username']}}
                                    </p>
                                    <p class="text-right">
                                        <a class="reply text-size12" data-toggle="modal" data-target="#myModal" data-id="{{$value['fs_id']}}">回复</a>
                                    </p>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <div class="g-nomessage">暂无消息哦 ！</div>
            @endif
        </div>
    </div>
    {{--分页--}}
    <div class="dataTables_paginate paging_bootstrap">
        <ul class="pagination">
            {!! $message->appends($merge)->render() !!}
        </ul>
    </div>
</div>

{{--面包屑--}}
<div class="visible-sm-block visible-xs-block g-sdb">
    <div class="s-slidebar bg-blue"><i class="fa fa-reorder cor-white"></i></div>
    <div class="bg-white s-slidecenter">
        <div class="accordion-style1 panel-group accordion-style2 g-side1" id="accordion1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title clearfix">
                        <a href="#collapseThree1" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle g-wrap1 g-active"><i class="text-size20 g-tradingico"></i>&nbsp;&nbsp;&nbsp;&nbsp;交易管理
                            <i class="pull-right fa fa-angle-down" data-icon-hide="fa-angle-down" data-icon-show="fa-angle-right"></i>
                            <i class="bigger-110 icon-angle-down"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree1" class="panel-collapse in">
                    <div class="g-sidenav z-active">
                        <a href="/user/messageList/1" class="g-wrap2 active">系统消息</a>
                    </div>
                    <div class="g-sidenav ">
                        <a href="/user/messageList/2" class="g-wrap2 ">交易动态</a>
                    </div>
                    <div class="g-sidenav ">
                        <a href="/user/messageList/4" class="g-wrap2 ">收件箱</a>
                    </div>
                    <div class="g-sidenav ">
                        <a href="/user/messageList/3" class="g-wrap2 ">发件箱</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- 回复模态框 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  contact-me-modal" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">联系TA</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="seriveceCaseDetail_submit" method="get" accept-charset="utf-8">
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                            <strong>标题：</strong> </label>

                        <div class="col-sm-9">
                            <input type="text" id="form-field-1" class="col-xs-10 col-sm-5 title">
                            <input type="hidden" class="js_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1">
                            <strong>内容：</strong> </label>

                        <div class="col-sm-9">
                            <textarea class="form-control col-xs-10 col-sm-5 content" id="form-field-8"></textarea>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_primary">确定</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('userslidebar', 'css/usercenter/userslidebar.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('mymessagelist', 'js/doc/mymessagelist.js') !!}

