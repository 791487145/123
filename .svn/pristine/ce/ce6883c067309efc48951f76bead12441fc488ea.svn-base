<div class="col-md-12 col-left">
    <!-- 所在位置 -->
    <div class="now-position text-size12">
        您的位置：首页 &gt; 问答中心
    </div>
</div>
<div class="row">
    <!-- main -->
    <div class="col-lg-12">
        <!-- 顶部banner -->
        <div class="col-md-12 col-left ">
            <div class="news-main-banner question-banner position-relative">
                @if(count($ad))
                    <a href="{!! $ad[0]['ad_url'] !!}"><img src="{!! URL($ad[0]['ad_file']) !!}" alt=""></a>
                @else
                    <img src="/themes/default/assets/images/question-banner.png" alt="">
                @endif
                {{--<a href="javascript:;"><img src="/themes/default/assets/images/question-banner.png" alt=""></a>--}}
                <div class="question-txt position-absolute hidden-xs hidden-sm">
                    <div class="">
                        <span>{{$count[0]}}</span><span>{{$count[1]}}</span><span>{{$count[2]}}</span><span>{{$count[3]}}</span><span>{{$count[4]}}</span><span>{{$count[5]}}</span><span>{{$count[6]}}</span><span>{{$count[7]}}</span>
                        <p class="cor-gray51 text-size14">位人在这里找到了答案</p>
                    </div>
                    <a href="/question/quiz" class="btn btn-primary bor-radius2 text-size16 cor-white"><i
                                class="fa  fa-edit"></i> 我要提问</a>
                </div>
                <a href="/question/quiz"
                   class="mediaBtn hidden-lg hidden-md btn btn-primary bor-radius2 text-size16 cor-white position-absolute"><i
                            class="fa  fa-edit"></i> 我要提问</a>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-xs-12 col-left">
                    <div class="news-main-area question-left">
                        <div class="news-detail-info clearfix">
                            <h4 class="pull-left text-size18 cor-gray51 mg-margin">推荐的问题</h4>
                            <ul class="pull-right question-tab mg-margin hidden-xs">
                                @if($status==4)
                                    <li class=""><a href="/question/index">全部</a></li>
                                    <li class="active"><a href="/question/index?status=4">已解决</a></li>
                                    <li class=""><a href="/question/index?status=2">待解决</a></li>
                                @elseif($status==2)
                                    <li class=""><a href="/question/index">全部</a></li>
                                    <li class=""><a href="/question/index?status=4">已解决</a></li>
                                    <li class="active"><a href="/question/index?status=2">待解决</a></li>
                                @else
                                    <li class="active"><a href="/question/index">全部</a></li>
                                    <li class=""><a href="/question/index?status=4">已解决</a></li>
                                    <li class=""><a href="/question/index?status=2">待解决</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="question-table">
                            <div class="table-responsive text-size14 mg-margin">
                                <table class="table table-hover mg-margin">
				
                                    @forelse($questions['data'] as $k=>$v)
                                        {{--<a href="/question/check/{{$v['id']}}">--}}
                                        <tr class="padding20">
                                            <td class="question-table-tit">
                                                <div class=" cor-orange p-space">
                                                    <a class="cor-orange" href="/question/index"><i
                                                                class="fa fa-icon-tag"></i>{{$v['name']}}</a>
                                                </div>
                                            </td>
                                            <td class="question-table-text">
                                                <div class="p-space">

                                                    <a class="cor-gray51"
                                                       href="/question/check/{{$v['id']}}">{!! $v['discription'] !!}</a>

                                                    {{--<a class="cor-orange" href="/question/check/{{$v['id']}}">{{$v['discription']}}</a>

                                                    <a href="/question/check/{{$v['id']}}">{{$v['discription']}}</a>--}}

                                                </div>
                                            </td>
                                            @if($v['status']==4)
                                                <td class="question-way">
                                                    <div class="question-table-state cor-grayC2">
                                                        <i class="fa fa-check cor-green64"></i>已解决
                                                    </div>
                                                </td>
                                                <td class="question-num">
                                                    <div class="cor-grayC2 p-space">
                                                        {{$v['answernum']}}回答
                                                    </div>
                                                </td>
                                                <td class="question-scheme">
                                                    <div class="cor-grayC2 p-space">
                                                        &nbsp;&nbsp;&nbsp;{{$v['time']}}
                                                    </div>
                                                </td>
                                            @else
                                                <td class="question-way">
                                                    <div class="question-table-state cor-grayC2">
                                                        <i class="fa fa-question"></i>待解决
                                                    </div>
                                                </td>
                                                <td class="question-num">
                                                    <div class="cor-grayC2 p-space">
                                                        {{$v['answernum']}}回答
                                                    </div>
                                                </td>
                                                <td class="question-scheme ">
                                                    <a href="/question/check/{{$v['id']}}"class="btn btn-primary btn-big4 aDisplay">回答</a>
                                                    <div class="cor-grayC2 p-space hovdisplay">
                                                        &nbsp;&nbsp;&nbsp;{{$v['time']}}
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                    @endforelse
                                </table>
                            </div>
                        </div>
                        {{--no data--}}
                        @if(empty($questions['data']))
                            <div class="g-usernoinfo g-usernoinfo-noinfo text-center text-size16 cor-gray89">暂无推荐！快去<a
                                        href="/question/quiz" target="_blank">提问</a>吧
                            </div>
                        @endif
                    </div>
                    {{--分页--}}
                    <div class="clearfix">
                        @if(isset($current_page))
                            <div class="g-taskpaginfo"> 显示 {{20*($current_page-1)+1}}~{{20*($current_page-1)+20}} 项
                                共 {{$num2}} 个任务
                            </div>
                        @else
                            <div class="g-taskpaginfo"> 显示 1~20 项 共 {{$num2}} 个任务</div>
                        @endif
                        <div class="paginationwrap pull-right">
                            {!! $question->appends($marge)->render() !!}
                        </div>
                    </div>
                    {{--无数据--}}
                   {{-- <div class="g-nomessage">暂无信息哦 ！</div>
                    <div class="space"></div>
                    <div class="space"></div>--}}
                </div>
                <!-- side -->
                <div class="col-md-3 g-taskside visible-lg-block col-left question-right">
                    <div class="g-tasksidemand hot-tit p-space">
                        <span class="text-size18 cor-gray51 clearfix"><i class="fa fa-bigg-ico"></i>热门</span>
                    </div>
                    <!-- hot -->
                    <div class="g-tasksidemand clearfix">
                        @forelse($hot as $k=>$v)
                            <div class="release-form text-size14 hot-txt clearfix">
                                <a href="/question/check/{{$v['id']}}" class="cor-gray51">
                                    <span class="u-title cor-orange p-space"><i
                                                class="fa fa-icon-tag"></i>{{$v['name']}}</span>
                                    <span class="p-space ">{!! strip_tags($v['discription']) !!}</span>
                                </a>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="space-10"></div>
                    <div class="g-tasksidemand">
                        <span class="text-size18 cor-gray51">精华收录</span>
                    </div>
		<!--修改关于提问无人回答时页面异常的情况-->
     	
                    <ul class="mg-margin g-tasksidemand question-wrap">
                        @foreach($essence as $k=>$v)
                            @if(!empty($v['data']))
                                <li class=" ">
                                    <div class="pull-left">
                                        @if(!empty($v['data']['avatar']))
                                            <img src="{!! $domain.'/'.$v['data']['avatar'] !!}" alt=""
                                                 onerror="onerrorImage('{{ Theme::asset()->url('images/defauthead.png')}}',$(this))">
                                        @else
                                            <img src="/themes/default/assets/images/defauthead.png" alt="" width="50px"
                                                 height="50px">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-size14 cor-gray51">{{$v['data']['name']}}
                                            <span class="pull-right cor-grayC2">
                                            <i class="fa fa-thumbs-up"></i>
                                                {{$v['data']['praisenum']}}
                                        </span>
                                        </p>
                                        <p class="p-space text-size14 cor-gray51">回答：
                                            <a href="/question/check/{{$v['id']}}" class="cor-blue2a">{!! strip_tags($v['discription']) !!}</a>
                                        </p>
                                    </div>
                                    <div class="hr"></div>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                

                </div>
            </div>

        </div>
    </div>

</div>
<div class="space"></div>

{!! Theme::asset()->container('custom-css')->usepath()->add('news','css/news.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('question','css/question.css') !!}
