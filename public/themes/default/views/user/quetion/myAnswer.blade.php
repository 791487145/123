<div class="g-main g-message g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">我的回答</h4>
    <div class="space-12"></div>
    <div class="clearfix hidden-xs">
        <form action="{{ URL('user/myAnswer') }}" method="get" id="screen_form">
            <div class="control-group pull-left">
                <select class="form-control" name="type">
                    <option value="0" class="ace screen">全部</option>
                    <option value="1" class="ace screen" @if(isset($_GET['type']) && $_GET['type'] == 1) selected="selected" @endif>被采纳</option>
                </select>
            </div>
        </form>
    </div>
    <div class="space-6"></div>
        @if($myanwser_toArray['total']!=0)
        <ul id="useraccept">
            @foreach($myanwser_toArray['data'] as $v)
            <li class="row width590">
                <div class="col-sm-1 col-xs-2 usercter">
                    <img src="{{ (!empty($v['avatar']))?$domain.'/'.$v['avatar']:Theme::asset()->url('images/defauthead.png') }}" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                </div>
                <div class="col-sm-11 col-xs-10 usernopd">
                    <div class="col-sm-9 col-xs-8">
                        <div class="text-size14 cor-gray51 p-space"><a class="cor-blue42 p-space"  target="_blank" href="{{ URL('question/check',['id'=>$v['questionid']]) }}" >{{ $v['question_name'] }}</a></div>
                        <div class="space-6"></div>
                        <p class="cor-gray87"><i class="ace-icon fa fa-commenting bigger-110 cor-grayd2"></i> {{ $v['answernum'] }}人回答&nbsp;&nbsp;&nbsp;<i class="fa fa-eye cor-grayd2"></i> {{ $v['num'] }}人看过</p>
                        <div class="space-6"></div>
                        <div class="space-2"></div>
                        <div class="g-userlabel"><a href="javascript:;">{{ $v['question_category'] }}</a></div>
                    </div>
                    <div class="col-sm-3 col-xs-4 text-right hiden590"><a class="btn-big bg-blue bor-radius2 hov-blue1b" target="_blank" href="{{ URL('question/check',['id'=>$v['questionid']]) }}">查看</a></div>
                    <div class="col-xs-12"><div class="g-userborbtm"></div></div>
                </div>
            </li>
            @endforeach
        </ul>
        @else
        <div class="g-nomessage">暂无信息哦 ！</div>
        @endif
    <div class="space-20"></div>
    <div class="dataTables_paginate paging_bootstrap">
        {!! $myanwser->appends($_GET)->render() !!}
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ownercomment','js/doc/clicksubmit.js') !!}