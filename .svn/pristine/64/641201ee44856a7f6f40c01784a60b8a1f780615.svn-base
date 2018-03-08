
<div class="col-md-12 col-left">
    <!-- 所在位置 -->
    <div class="now-position text-size12">
        您的位置：首页 &gt; 问答中心 &gt; 我要回答
    </div>
</div>


<div class="col-xs-12">
    <div class="row">
        <div class="col-lg-9 col-md-12 col-xs-12 col-left">
            <div class="news-main-area question-left reply">
                <div class="news-detail-info clearfix">
                    <div class="page-header">
                        <h4 class="text-size20 cor-gray51 mg-margin ">
                            <span class=" badgee">问</span>
                            <div class="mg-left30 word-wrap">{!! $question[0]['discription'] !!}？</div>
                        </h4>
                        <div class="change-cp cor-gray89">
                            <a href="javascript:;">{{$question[0]['username']}}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<span>{{$question[0]['name']}}</span>&nbsp;&nbsp;|&nbsp;&nbsp;<span>{{$question[0]['time']}}</span>
                            {{--分享--}}
                            <div class="bdsharebuttonbox clearfix hidden-xs" data-tag="share_1">
                                <div class="shop-sharewrap"><span class="pull-left cor-gray51">分享：&nbsp;</span>
                                    <!-- JiaThis Button BEGIN -->
                                    <div class="jiathis_style">
                                        <a class="jiathis_button_tsina"></a>
                                        <a class="jiathis_button_weixin"></a>
                                        <a class="jiathis_button_qzone"></a>
                                        <a class="jiathis_button_tqq"></a>
                                        <a class="jiathis_button_cqq"></a>
                                        <a class="jiathis_button_douban"></a>
                                    </div>
                                    <script type="text/javascript" >
                                        var jiathis_config={
                                            summary:"",
                                            shortUrl:false,
                                            hideMore:false
                                        }
                                    </script>
                                    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
                                    <!-- JiaThis Button END --></div>
                                <div class="shop-share"></div>
                            </div>
                        </div>
                    </div>
                    @if(isset($status) && $status==1)
                        {{--等待--}}
                        <div class="clearfix replay-wait">
                            <div class="taskSuccess-left col-lg-5 col-md-3 col-sm-2 hidden-xs text-right">
                                <img src="{{ Theme::asset()->url('images/sign-icon1.png') }}" alt="">
                            </div>
                            <div class="taskSuccess-left hidden-lg hidden-sm hidden-md visible-xs-12 text-center">
                                <img src="{{ Theme::asset()->url('images/sign-icon1.png') }}" alt="">
                            </div>
                            <div class="taskSuccess-right col-lg-7 col-md-9 col-sm-10 col-xs-12">
                                <div class="space-8"></div>
                                <h4 class="text-size18 row">您的问题已提交，请耐心等待···</h4>
                                <h4 class="text-size18 row text-center hidden-lg hidden-sm hidden-md visible-xs-12">您的问题已提交，请耐心等待···</h4>
                            </div>
                        </div>
                    @else
                        <div class="alert clearfix">
                            <div class="taskSuccess-left col-lg-5 col-md-5 col-sm-4 hidden-xs text-right">
                                <img src="{{ Theme::asset()->url('images/reply.png') }}" alt="">
                            </div>
                            <div class="taskSuccess-left hidden-lg hidden-sm hidden-md visible-xs-12 text-center">
                                <img src="{{ Theme::asset()->url('images/reply.png') }}" alt="">
                            </div>
                            <div class="taskSuccess-right col-lg-7 col-md-5 col-sm-8 col-xs-12">
                                <p class="text-size18 cor-gray51 hidden-xs">问题 so easy~  快来帮助TA吧！</p>
                                <p class="text-size18 cor-gray51 text-center hidden-lg hidden-sm hidden-md visible-xs-12">问题 so easy~  快来帮助TA吧！</p>
                            </div>
                        </div>
                        <form action="/question/answeradd" id="form" method="post">
                            {{ csrf_field() }}
                            <div class="clearfix">
                                <script id="editor" name="desc" type="text/plain" style="height:300px;"></script>
                                <div class="space-4"></div>
                                <input type="hidden" name="desc" id="discription-edit" datatype="*1-1000" nullmsg="描述不能为空" errormsg="字数超过限制" >
                                <span class="Validform_checktip"><span class="cor-orange"><i class="fa fa-exclamation-circle"></i> 长度不超过1000个字符</span></span>
                                <div class="pull-right">
                                    <div class="space-4"></div>
                                    @if($login==1)
                                    <button form="form" class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2 " id="subTask">提交回答</button>
                                        @else
                                        <a href="/login"  class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2 ">提交回答</a>
                                    @endif
                                </div>
                                <div class="space-20"></div>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="questionid" value="{{$question[0]['id']}}">
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <!-- side -->
        <div class="col-md-3 g-taskside visible-lg-block col-left">

            <div class="g-tasksidemand">
                @if(count($rightAd))
                    <a href="{!! $rightAd[0]['ad_url'] !!}"><img src="{!! URL($rightAd[0]['ad_file']) !!}" alt=""></a>
                @else
                    <img src="{{ Theme::asset()->url('images/news_pic_side.png') }}" alt="">
                @endif
            </div>
            <div class="space-10"></div>
        </div>

    </div>
</div>


{!! Theme::asset()->container('custom-css')->usepath()->add('news','css/news.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('question','css/question.css') !!}
{!! Theme::widget('ueditor')->render() !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('reply', 'js/reply.js') !!}
{!! Theme::asset()->container('specific-css')->usepath()->add('validform-css','plugins/jquery/validform/css/style.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('validform-js','plugins/jquery/validform/js/Validform_v5.3.2_min.js') !!}