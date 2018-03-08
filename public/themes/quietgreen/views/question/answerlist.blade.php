<section>
    <div class="container">
        <div class="row">
<div class="container">
    <div class="row">
        <div class="col-md-12 col-left">
            <!-- 所在位置 -->
            <div class="now-position text-size12">
                您的位置：<a href="/">首页</a> ><a href="/question/index"> 问答中心 </a>><a
                        href="/question/check/{{$question['id']}}"> 我要回答</a>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- main -->
        <div class="col-lg-9 col-left">
            <div class="news-main-area question-left reply no-margin-bottom">
                <div class="news-detail-info clearfix">
                    <div class="page-header no-border-bottom no-padding-bottom no-margin-bottom">
                        <h4 class="text-size20 cor-gray51 mg-margin ">
                            <span class=" badgee">问</span>
                            <div class="mg-left30 word-wrap">{!! $question['discription']  !!}？</div>
                            <input type="hidden" name="questionid" value="{{$question['id']}}">
                        </h4>
                        <div class="change-cp cor-gray89">
                            <a href="javascript:;">{{$question['username']}}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<span>{{$question['name']}}</span>&nbsp;&nbsp;|&nbsp;&nbsp;<span>{{$question['time']}}</span>
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
                                    <script type="text/javascript">
                                        var jiathis_config = {
                                            summary: "",
                                            shortUrl: false,
                                            hideMore: false
                                        }
                                    </script>
                                    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js"
                                            charset="utf-8"></script>
                                    <!-- JiaThis Button END --></div>
                                <div class="shop-share"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-8"></div>
            </div>
            <div class="space-10"></div>
            {{--当前用户的id--}}
            <input type="hidden" name="uid" value="{{$uid}}"/>
            {{--采纳状态--}}
            @forelse($answer2 as $k=>$v)
                @if($v['adopt']==1)
                    <div class="answerlist-main news-main-area news-detail-info question-icobg">
                        <div class="ico-111"></div>
                        <div class="ico-112"></div>
                        <ul>
                            <li class="row">
                                <div class="col-sm-1 col-xs-2 usercter answerlist-img">
                                    @if(!empty($v['avatar']))
                                        <img src="{!! $domain.'/'.$v['avatar'] !!}" alt=""
                                             onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                                    @else
                                        <img src="{!! Theme::asset()->url('images/defauthead.png') !!}" alt="">
                                    @endif
                                </div>
                                <div class="col-sm-11 col-xs-10 usernopd">
                                    <div class="cor-gray51 text-size14">{{$v['username']}}</div>
                                    <div class="space-2"></div>
                                    <p class="cor-gray89 text-size12">提交于 {{$v['time']}}</p>
                                    <div class="space-2"></div>
                                    <div class="cor-gray51 text-size14 answerlist-cont">
                                        <p>{!! htmlspecialchars_decode($v['content']) !!}</p>
                                    </div>
                                    <div class="clearfix">
                                        @if($reward!=1)
                                            <a href="/question/reward/{{$v['id']}}/{{$v['questionid']}}"
                                               class="cor-orange pull-right answerlist-clickups" status="1"><i
                                                        class="fa fa-database text-size14"></i>
                                                <span class="answerlist-addnum" style="display: inline-block;"
                                                      id="reward">去打赏</span>
                                                <span class="answerlist-addzan"
                                                      style="display: none;">{{$v['cash']}}</span>
                                                <span class="answerlist-add">+1</span>
                                            </a>
                                        @else
                                            <a href="javascript:;" class="cor-orange pull-right answerlist-clickups"><i
                                                        class="fa fa-database text-size14" status="2"></i>
                                                {{$v['cash']}}
                                            </a>
                                        @endif
                                        @if($v['praise']==1)
                                            <a href="javascript:;" class="cor-blue2f pull-right answerlist-clickup"
                                               style="margin-right: 10px" status="1">
                                                <i class="fa fa-thumbs-up text-size14"></i>
                                                <span class="answerlist-addnum"
                                                      style="display: inline-block;">{{$v['praisenum']}}</span>
                                                <input type="hidden" name="answerid" value="{{$v['id']}}"/>
                                                <span class="answerlist-addzan" style="display: none;">已赞</span>
                                                <span class="answerlist-add">+1</span>
                                            </a>
                                        @elseif(isset($v['same']) && $v['same']==1)
                                            <a class="cor-blue2f pull-right answerlist-clickup"
                                               style="margin-right: 10px" >
                                                <i class="fa fa-thumbs-up text-size14"></i>
                                                <span class="answerlist-addnum"
                                                      style="display: inline-block;">{{$v['praisenum']}}</span>
                                                <input type="hidden" name="answerid" value="{{$v['id']}}"/>
                                                <span class="answerlist-addzan"
                                                      style="display: none;">{{$v['praisenum']}}</span>
                                            </a>
                                        @elseif(isset($v['tourists']) && $v['tourists']==1)
                                            <a href="javascript:;" class="cor-blue2f pull-right answerlist-clickup"
                                               style="margin-right: 10px" status="1">
                                                <i class="fa fa-thumbs-up text-size14"></i>
                                                <span class="answerlist-addnum"
                                                      style="display: inline-block;">{{$v['praisenum']}}</span>
                                                <input type="hidden" name="answerid" value="{{$v['id']}}"/>
                                                <span class="answerlist-addzan"
                                                      style="display: none;">{{$v['praisenum']}}</span>
                                            </a>
                                        @else
                                            <a href="javascript:;" class="cor-blue2f pull-right answerlist-clickup"
                                               style="margin-right: 10px" status="0">
                                                <i class="fa fa-thumbs-up text-size14"></i>
                                                <span class="answerlist-addnum"
                                                      style="display: inline-block;">{{$v['praisenum']}}</span>
                                                <input type="hidden" name="answerid" value="{{$v['id']}}"/>
                                                <span class="answerlist-addzan" style="display: none;">赞</span>
                                                <span class="answerlist-add">+1</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                @endif
            @empty
            @endforelse
            <div class="space-10"></div>
            <div class="answerlist-main news-main-area news-detail-info">
                <div class="space-8"></div>
                <div class="cor-gray51 text-size16 answerlist-head">全部回答（{{$count}}）</div>
                <div class="space"></div>
                <ul>
                    @forelse($answer1 as $k => $v)
                        @if($v['adopt']==0)
                            <li class="row">
                                <div class="col-sm-1 col-xs-2 usercter answerlist-img">
                                    @if(!empty($v['avatar']))
                                        <img src="{!! $domain.'/'.$v['avatar'] !!}" alt=""
                                             onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                                    @else
                                        <img src="{!! Theme::asset()->url('images/defauthead.png') !!}" alt="">
                                    @endif
                                </div>
                                <div class="col-sm-11 col-xs-10 usernopd">
                                    <div class="cor-gray51 text-size14">{{$v['username']}}</div>
                                    <div class="space-2"></div>
                                    <p class="cor-gray89 text-size12">{{$v['time']}} 提交于 {{$v['time']}}</p>
                                    <div class="space-2"></div>
                                    <div class="cor-gray51 text-size14 answerlist-cont">{!! htmlspecialchars_decode($v['content']) !!}
                                    </div>
                                    <div class="clearfix">
                                        @if($question['status']<=3)
                                            <a class="pull-right answerlist-btn" href="javascript:;" data-toggle="modal"
                                               data-target="#answerlist"><input type="hidden" name="adoptid" value="{{$v['id']}}"/>采纳答案</a>
                                        @endif
                                        @if($v['praise']==1)
                                            <a class="cor-blue2f pull-right answerlist-clickup" status="1">
                                                <!--答案的用户id-->
                                                <input type="hidden" name="answeruid" value="{{$v['answeruid']}}"/>
                                                <i class="fa fa-thumbs-up text-size14"></i>
                                                <input type="hidden" name="answerid" value="{{$v['id']}}"/>
                                                <span class="answerlist-addnum">{{$v['praisenum']}}</span>
                                                <span class="answerlist-addzan">已赞</span>
                                            </a>
                                        @elseif(isset($v['same']) && $v['same']==1)
                                            <a class="cor-blue2f pull-right answerlist-clickup"
                                               style="margin-right: 10px" >
                                                <i class="fa fa-thumbs-up text-size14"></i>
                                                <span class="answerlist-addnum"
                                                      style="display: inline-block;">{{$v['praisenum']}}</span>
                                                <input type="hidden" name="answerid" value="{{$v['id']}}"/>
                                                <span class="answerlist-addzan"
                                                      style="display: none;">{{$v['praisenum']}}</span>
                                            </a>
                                        @elseif(isset($v['tourists']) && $v['tourists']==1)
                                            <a href="/login" class="cor-blue2f pull-right answerlist-clickup"
                                               style="margin-right: 10px" >
                                                <i class="fa fa-thumbs-up text-size14"></i>
                                                <span class="answerlist-addnum"
                                                      style="display: inline-block;">{{$v['praisenum']}}</span>
                                                <input type="hidden" name="answerid" value="{{$v['id']}}"/>
                                                <span class="answerlist-addzan"
                                                      style="display: none;">{{$v['praisenum']}}</span>
                                            </a>
                                        @else
                                            <a href="javascript:;" class="cor-blue2f pull-right answerlist-clickup"
                                               status="0">
                                                <!--答案的用户id-->
                                                <input type="hidden" name="answeruid" value="{{$v['answeruid']}}"/>
                                                <i class="fa fa-thumbs-up text-size14"></i>
                                                <input type="hidden" name="answerid" value="{{$v['id']}}"/>
                                                <span class="answerlist-addnum" id="num">{{$v['praisenum']}}</span>
                                                <span class="answerlist-addzan">赞</span><span
                                                        class="answerlist-add">+1</span></a>
                                        @endif
                                    </div>
                                </div>
                            </li>

                        @endif

                    @empty
                        {{--无数据--}}
                        <div class="g-nomessage">暂无信息哦 ！</div>
                        <div class="space"></div>
                        <div class="space"></div>
                    @endforelse
                </ul>

            </div>
            {{--分页--}}
            <div class="clearfix">
                <div class="paginationwrap pull-right">
                    {!! $answerlist->render() !!}
                </div>
            </div>
        </div>
        <!-- 模态框 -->
        <div class="modal fade" id="answerlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog  contact-me-modal" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-size14 cor-gray71" id="myModalLabel"><b>提示</b></h4>
                    </div>
                    <div class="space-16"></div>
                    <p class="text-size16 cor-gray51 text-center">确定采纳该答案吗？</p>
                    <p class="text-size12 cor-gray51 text-center">确定成功后还可以打赏答谢该用户哦~</p>
                    <div class="space-14"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary adopt" id="btn_primary">确定</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- side -->
        <div class="col-md-3 g-taskside visible-lg-block col-left">
            <!-- ad -->
            <div class="g-tasksidemand">

                @if(count($rightAd))
                    <a href="{!! $rightAd[0]['ad_url'] !!}"><img src="{!! URL($rightAd[0]['ad_file']) !!}" alt=""></a>
                @else
                    <img src="{!! Theme::asset()->url('images/news_pic_side.png') !!}" alt="">
                @endif
            </div>

        </div>
    </div>
    <div class="space-30"></div>
</div>
            <div class="space"></div>
        </div>
    </div>
</section>
{!! Theme::asset()->container('old-css')->usepath()->add('main','css/main.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('header','css/header.css') !!}
{!! Theme::asset()->container('old-css')->usepath()->add('footer','css/index/common.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('news','css/news.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('question','css/question.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('answerlist', 'js/answerlist.js') !!}