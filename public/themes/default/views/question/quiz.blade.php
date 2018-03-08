<div class="col-md-12 col-left">
    <!-- 所在位置 -->
    <div class="now-position text-size12">
        您的位置：首页 &gt; 问答中心
    </div>
</div>
{{--提问--}}
@if(isset($mark) && $mark==1)
    <div class="col-xs-12 col-left">
        <div class=" alert clearfix bg-white b-border quiz">
            <div class="page-header">
                <h4 class="text-size22 cor-gray51 mg-margin "><span class="quiz-ico"></span>提出您的疑问</h4>
            </div>
            <form class="" role="form" action="add" method="post" id="question_form">
                <div class="form-group quiz-form">
                    <label class="text-size14 cor-gray51">问题类型</label>
                    <select name="" id="pid" datatype="*" nullmsg="请选择类型！">
                        <option value="">问题归纳</option>
                        @foreach($view as $v)
                            @if($v['pid']==0)
                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                            @endif
                        @endforeach
                    </select>
                    <select name="category" id="child" datatype="*" nullmsg="请选择类型！">
                        <option value="">问题子类</option>
                    </select>
                    @if($errors->first('category'))
                        <p class="Validform_checktip Validform_wrong">{!! $errors->first('category') !!}</p>
                    @endif
                </div>
                <div class="form-group quiz-form">
                    <label class="pull-left text-size14 cor-gray51 quiz-wap">问题描述</label>
                    <textarea id="txtarea" name="description" rows="10" datatype="*5-200" nullmsg="请填写问题描述"
                              errormsg="请输入5-200个字符"></textarea>
                    <div class="pull-right cor-gray51"><i class="fa fa-exclamation-circle cor-orange text-size18"></i>
                        您已输入<span id="result">0</span>/200字
                    </div>
                </div>
                <div class="space-20"></div>
                <div class="quiz-btn">
                    <button type="submit" class="btn btn-primary btn-blue btn-big1 bor-radius2">提交问题</button>
                    <a href="/question/index">返回</a>
                    @if($errors->first('description'))
                        <p class="Validform_checktip Validform_wrong">{!! $errors->first('description') !!}</p>
                    @endif
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            </form>
            <!--模态框-->
            <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header widget-header-flat">
                         <span class="modal-title text-size14">
                             支付提示
                         </span>
                         </div>
                         <div class="modal-body text-center clearfix">
                             <div class="col-sm-3 hidden-xs">
                                 <div class="row text-right">
                                     <div class="space"></div>
                                     <span class="fa-stack cor-orange"><i class="fa fa-exclamation-circle fa-stack-2x"></i></span>
                                 </div>
                             </div>
                             <div class="col-sm-8 hidden-xs">
                                 <div class="cor-gray51 text-left">
                                     <div class="space"></div>
                                     <h3 class="mg-margin text-size20 text-blod">请在打开的页面上完成付款！</h3>
                                     <h6 class="cor-gray97">付款完成前请不要关闭此窗口</h6>
                                     <div class="space"></div>
                                     <p>
                                         <a href="/task/" type="button" class="btn btn-primary btn-sm btn-blue btn-big1 bor-radius2" >已完成付款</a>&nbsp;
                                         <a href="/user/unreleasedTasks" class="cor-blue167 text-under">支付遇到问题</a>
                                     </p>
                                     <p><a href="/task/bounty/" class="cor-blue167 text-under">返回选择其他支付方式></a></p>
                                 </div>
                             </div>
                             <div class="hidden-lg hidden-md hidden-sm visible-xs-12">
                                 <div class="row text-center">
                                     <div class="space"></div>
                                     <span class="fa-stack cor-orange"><i class="fa fa-exclamation-circle fa-stack-2x"></i></span>
                                 </div>
                             </div>
                             <div class="hidden-lg hidden-md hidden-sm visible-xs-12">
                                 <div class="cor-gray51 text-center">
                                     <div class="space"></div>
                                     <h3 class="mg-margin text-size20 text-blod">请在打开的页面上完成付款！</h3>
                                     <h6 class="cor-gray97">付款完成前请不要关闭此窗口</h6>
                                     <div class="space"></div>
                                     <p>
                                         <a href="/task/" type="button" class="btn btn-primary btn-sm btn-blue btn-big1 bor-radius2" >已完成付款</a>&nbsp;
                                         <a href="/user/unreleasedTasks" class="cor-gray97 modaltxt">支付遇到问题</a>
                                     </p>
                                     <p><a href="/task/bounty/" class="cor-blue167" data-dismiss="modal">返回选择其他支付方式></a></p>
                                 </div>
                             </div>
                         </div>
                     </div>&lt;!&ndash; /.modal-content &ndash;&gt;
                 </div>&lt;!&ndash; /.modal &ndash;&gt;
             </div>-->
        </div>
    </div>
    {{--审核--}}
@elseif(isset($mark) && $mark==2)
    <div class="col-xs-12 col-left">
        <div class="taskDetails taskbg clearfix taskSuccess employ-bounty">
            <div class="taskSuccess-left col-lg-5 col-md-3 col-sm-2 hidden-xs text-right">
                <img src="{{ Theme::asset()->url('images/withdrawhint.png') }}" alt="">
            </div>
            <div class="taskSuccess-left hidden-lg hidden-sm hidden-md visible-xs-12 text-center">
                <img src="{{ Theme::asset()->url('images/withdrawhint.png') }}" alt="">
            </div>
            <div class="taskSuccess-right col-lg-7 col-md-9 col-sm-10 col-xs-12">
                <h4 class="text-size24">请耐心等待后台审核！</h4>
                <p class=""> 如长时间未通过审核，请立即<a target="_blank"
                                             href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes">联系管理员</a>
                </p>
                <p><a href="/question/quiz" target="_blank">继续提问</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                            href="/user/myquestion" target="_blank">我的提问</a></p>
            </div>
        </div>
    </div>
    {{--发布失败--}}
@elseif(isset($mark) && $mark==3)
    <div class="col-xs-12 col-left">
        <div class="taskDetails taskbg clearfix taskSuccess employ-bounty">
            <div class="taskSuccess-left col-lg-5 col-md-3 col-sm-2 hidden-xs text-right">
                <img src="{{ Theme::asset()->url('images/sign-icon3.png') }}" alt="">
            </div>
            <div class="taskSuccess-left hidden-lg hidden-sm hidden-md visible-xs-12 text-center">
                <img src="{{ Theme::asset()->url('images/sign-icon3.png') }}" alt="">
            </div>
            <div class="taskSuccess-right col-lg-7 col-md-9 col-sm-10 col-xs-12">
                <h4 class="text-size24">很遗憾，您的问题发布失败！</h4>
                <p class=""> 如有疑问，请立即<a target="_blank"
                                        href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq }}&site=qq&menu=yes">联系管理员</a></p>
                <p><a href="/question/quiz" target="_blank">继续提问</a>或返回<a href="/user/myquestion"
                                                                          target="_blank">我的提问</a></p>
            </div>
        </div>
    </div>
@endif
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/taskbar/issuetask.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('news','css/news.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('question','css/question.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('validform-css', 'plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('validform-js', 'plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('question','js/question.js') !!}