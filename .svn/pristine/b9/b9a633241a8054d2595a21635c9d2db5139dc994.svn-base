<div class="col-md-12 col-left">
    <!-- 所在位置 -->
    <div class="now-position text-size12">
        您的位置：首页 &gt; 问答中心 &gt; 我要打赏
    </div>
</div>
<div class="col-xs-12 col-left">
    <div class=" alert clearfix bg-white b-border quiz reward-content ">
        <div class="page-header">
            <h4 class="text-size22 cor-blue2f mg-margin "><span class="quiz-ico rewardIco"></span>我要打赏</h4>
            <div class="clearfix reward-bg-gary">
                <div class="col-sm-1 col-xs-12">
                    @if(empty($question['avatar']))
                        <img class="user-image2" src="/themes/default/assets/images/defauthead.png" width="60" height="60">
                    @else
                        <img src="{!! $domain.'/'.$question['avatar'] !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                    @endif
                </div>
                <div class="col-sm-11 col-xs-12">
                    <div class="row">
                        <div class="space-2"></div>
                        <p class="text-size14 cor-gray51">回答问题：<span class="cor-blue2f">{{$question['discription']}}</span></p>
                        <p class="text-size14 mg-margin cor-gray51">回答人：<span class="cor-blue2f">{{$answer['name']}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <form class="" role="form" action="/question/reward/add" method="post" id="question_form">
            {{ csrf_field() }}
        <div class="form-group quiz-form">
            <span class="text-size14 cor-gray51">我的资产：</span>
            <label for="" id="money"><span class="text-size20 cor-orange">{{$question['balance']}}</span>元</label>
            <input type="hidden" name="questionid" value="{{$question['id']}}">
            <input type="hidden" name="questionuid" value="{{$question['uid']}}">
            <input type="hidden" name="answeruid" value="{{$answer['uid']}}">
            <input type="hidden" name="answerid" value="{{$answer['id']}}">
        </div>
        <div class="form-group quiz-form">
            <span class="pull-left text-size14 cor-gray51">打赏金额：</span>
            <input type="text" name="reward" id="reward" datatype="decimal" nullmsg="请填写数字，最多保留两位小数" errormsg="请保留两位小数"> 元
            {!! $errors->first('reward') !!}
        </div>
        <div class="space-20"></div>
        <div class="space-20"></div>
        <div class="space-20"></div>
        <div class="quiz-btn text-center">
            <button type="button" class="btn btn-primary btn-blue btn-big1 bor-radius2" data-toggle="modal" data-target="#myModal">确定打赏</button>
            <a href="/question/check/{{$question['id']}}">返回</a>
        </div>
        <div class="space-20"></div>
        <!--模态框-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header widget-header-flat">
                        <span class="modal-title cor-gray51 text-size14 text-blod">
                            输入支付密码
                        </span>
                        <button type="button" class="bootbox-close-button close text-size14" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="space"></div>
                        <div class="clearfix text-center">
                            <input type="password" name="password" style="width: 50%" datatype="*" nullmsg="请输入密码">
                            {!! $errors->first('password') !!}
                        </div>
                        <div class="space"></div>
                        <div class="clearfix text-center">
                            <button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2" type="submit" >确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                        </div>
                        <div class="space"></div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->

            </div>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('news','css/news.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('question','css/question.css') !!}
{!! Theme::asset()->container('cistom-css')->usepath()->add('quesReward','js/quesReward.js') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('cistom-css')->usepath()->add('reward','js/reward.js') !!}