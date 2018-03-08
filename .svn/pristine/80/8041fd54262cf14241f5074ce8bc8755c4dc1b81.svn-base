<div class="shop-wrap clearfix">
    {{--头部--}}
    <div class="col-md-12 col-left">
        <div class="shop-main buygoods-header">
            <div class="personal-info buygoods-info clearfix">
                <div class="personal-info-words clearfix buygoods-info-words">
                    @if(!is_null($service['cover']))
                    <img src="{{ $domain.'/'.$service['cover'] }}" alt="" class=" personal-info-pic buygoods-img" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" >
                    @else
                    <img src="{{ Theme::asset()->url('images/employ/bg2.jpg')}}" alt="" class="img-circle personal-info-pic buygoods-img" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" >
                    @endif
                    <div class="personal-info-block">
                    <div class="personal-info-block-name">
                            <h3 class="text-size18 cor-gray51"><strong>{{ $service['title'] }}</strong></h3>
                        </div>
                        <div class="alert alert-warning mg-bottom10">
                            <p class="text-size12 cor-gray51"><span class="cor-gray89">服务分类：</span>{{ $all_cate[$service['cate_id']]['name'] }}</p>
                            <div class="space-8"></div>
                            <p class="text-size12 cor-orange31">
                                @if($service['status']==1 && $service['is_delete']==0)
                                <span class="cor-gray89">服务价格：</span><span class="text-size16">￥</span><span class="text-size28">{{ $service['cash'] }}</span>
                                <span class="shop-hint">
                                <i class="fa fa-lightbulb-o text-size16"></i> 小贴士：当前佣金是{{ $rate }}%
                                </span>
                                @elseif($service['status']==2 && $service['is_delete']==0)
                                <span class="cor-gray89">服务价格：</span><b class="cor-orange31 text-size28">已下架</b>
                                @elseif($service['is_delete']==1)
                                <span class="cor-gray89">服务价格：</span><b class="cor-orange31 text-size28">已删除</b>
                                @else
                                <span class="cor-gray89">服务价格：</span><b class="cor-orange31 text-size28">等待审核</b>
                                @endif
                                {{--@if($is_owner!=0)--}}
                    			{{--<span class="shop-hint">--}}
                                    {{--<i class="fa fa-lightbulb-o text-size16"></i> 小贴士：当前佣金是{{ $rate }}%--}}
                                {{--</span>--}}
                                {{--@endif--}}
                    		</p>
                        </div>
                        <div class="personal-about buygoods-about cor-gray51 clearfix">
                            <div class="col-xs-12">
                                <div class="row">
                                    <span class="text-size12 cor-gray89">好评率：<span class="cor-orange31">{{ ($service['comments_num']!=0)?round($service['good_comment']/$service['comments_num'],1)*100:100 }}%</span></span><span class="slow cor-gray89">|</span>
                                    <span class="text-size12 cor-gray89">综合评分：<span class="cor-orange31">{{ ($comments['total']==0)?'5.0':$avgAll }}</span></span><span class="slow cor-gray89">|</span>
                                    <span class="text-size12 cor-gray89">已购买：<span class="cor-orange31">{{ $service['sales_num'] }}次</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="space-6"></div>
                        <div class="clearfix buygoods-btn-wrap">
                            @if($is_owner==0)
                            <a class="buygoods-btn bg-blue" href="{{ URL('employ/create',['uid'=>$service['uid'],'service'=>$service['id']]) }}">购买服务</a>
                            {{--<a class="buygoods-btn bg-gary nopoint" href="javascript:;">购买服务</a>--}}
                            {{--<a class="buygoods-btn bg-blue" href="">文件下载</a>--}}
                            @if(Auth::check())
                                @if( Theme::get('is_IM_open') == 2)
                                    <a class="buygoods-callme shop-im" href="javascript:;" data-toggle="modal" data-target="#myModalshop">联系我</a>
                                @elseif( Theme::get('is_IM_open') == 1)
                                    <a class="shop-callme shop-im"  href="javascript:;">联系我</a>
                                @endif
                            @else
                                <a class="shop-callme" href="{!! URL('/login') !!}">联系我</a>
                            @endif
                            {{--<a class="buygoods-collect" href="">收藏店铺</a>--}}
                            @if(Auth::check())
                                @if(empty($isFocus) && $service['uid'] != Auth::id())
                                    <a href="" class="buygoods-collect" id="shop_id" shop_id="{!! $service['shop_id'] !!}"><i></i>收藏店铺</a>
                                @elseif($service['uid'] != Auth::id())
                                    <span href="" class="buygoods-collect">已收藏</span>
                                @endif
                            @else
                                <a href="{!! URL('/login') !!}" class="buygoods-collect"><i></i>收藏店铺</a>
                            @endif
                            @endif
                            {{--<span href="" class="shop-collectatv">已收藏</span>--}}
                            {{--分享--}}
                            <div class="bdsharebuttonbox" data-tag="share_1">
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
                </div>
            </div>
        </div>
    </div>
    <!-- 模态框（Modal） -->
    @if($contact == 2)
    <div class="modal fade" id="myModalshop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog  contact-me-modal" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-size14 shop-modal-title" id="myModalLabel"><b>联系我</b></h4>
                </div>
                <div class="modal-body shop-modal-shopbody">
                    <input type="hidden" name="js_id" class="js_id" id="contactMeId" value="{!! $service['uid'] !!}">
                    <textarea name="content" id="content" class="shop-modalarea"></textarea>
                    <div class="space-6"></div>
                    <div class="text-right"><button class="btn btn-primary btn-blue shop-modalbtn" id="contactMe">发送</button></div>
                </div>
                @if($contactInfo['mobile_status']== 1 || $contactInfo['qq_status'] == 1 || $contactInfo['wechat_status'] == 1)
                    <div class="modal-shopfooter g-shopabnum">
                        其他联系方式&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if($contactInfo['mobile_status'] == 1)
                            <span class="g-shopabnumph text-size12">{!! $contactInfo['mobile'] !!}</span>
                        @endif
                        @if($contactInfo['qq_status'] == 1)
                            <span class="g-shopabnumqq text-size12">{!! $contactInfo['qq'] !!}</span>
                        @endif
                        @if($contactInfo['wechat_status'] == 1)
                            <span class="g-shopabnumwx text-size12">{!! $contactInfo['wechat'] !!}</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div><!-- 模态框（Modal）end -->
    @endif
    {{--选项卡--}}
    <div class="col-lg-12 list-l col-md-12 col-left buygoods-wares">
        <ul class="buygoods-nav clearfix mg-margin nav nav-tabs">
            <li class="active">
                <a href="#home" data-toggle="tab" class="text-size16 " aria-expanded="false">服务描述</a>
            </li>
            <li class="">
                <a href="#home2" data-toggle="tab" class="text-size16" aria-expanded="false">服务评价</a>
            </li>
        </ul>
        <div class="tab-content b-border0 pd-padding0" >
            <!--商品描述-->
            <div id="home" class="tab-pane fade pd-padding30  bg-white b-border active in">
                <!--描述-->
                <div class="bugoods-description cor-gray51 text-size14" style="word-wrap: break-word;">
                    {!! $service['desc'] !!}
                </div>
            </div>
            <!--商品评价-->
            <div id="home2" class="tab-pane fade">
                <div class="personal-evaluate-area">
                    <!-- 总评 -->
                    <div class="personal-total-evaluate">
                        <!-- 总体评价数量 -->
                        <div class="personal-total-evaluate-num">
                            <span class="personal-evaluate-cicle-title">总体评价</span>
                            <div class="personal-good-evaluate">
                                <p>好评率：<span>{{ ($service['comments_num']!=0)?round($service['good_comment']/$service['comments_num'],1)*100:100 }}%</span></p>
                                <p>好评数量：<span>{{ empty($service['good_comment'])?0:$service['good_comment'] }}</span>个</p>
                            </div>
                        </div>
                        <!-- 总体评分 -->
                        <div class="personal-total-evaluate-point clearfix">
                            <span class="personal-evaluate-cicle-title">总体评分</span>
                            <div class="personal-evaluate-starts-list">
                                <div class="personal-evaluate-starts-item">
                                    <p>工作速度：{{ ($comments['total']==0)?5:$avgSpeed }}分</p>
	                                <span class="personal-star">
	                                      <span class="personal-evaluate-star-point-{{ ($comments['total']==0)?5:$avgSpeed }}"></span>
	                                 </span>
                                </div>
                                <div class="personal-evaluate-starts-item">
                                    <p>工作质量：{{ ($comments['total']==0)?5:$avgQuality }}分</p>
	                                <span class="personal-star">
	                                       <span class="personal-evaluate-star-point-{{ ($comments['total']==0)?5:$avgQuality }}"></span>
	                                </span>
                                </div>
                                <div class="personal-evaluate-starts-item">
                                    <p>工作态度：{{ ($comments['total']==0)?5:$avgAttitude }}分</p>
	                                <span class="personal-star">
	                                   <span class="personal-evaluate-star-base-{{ ($comments['total']==0)?5:$avgAttitude }}"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 案例评价列表 -->
                    <div class="personal-evaluate-list" id="ajaxcomments">
                        <div class="text-size14 cor-gray51 clearfix record">
                            <div class="col-xs-12 task-mediaAssessR pd-padding0">
                                <label class="evaluate-back">
                                    <input name="type" type="radio" class="ace ajaxchangetype" checked value=1 url="{{ URL('shop/ajaxServiceComments').'?type=1&id='.$service['id'] }}">
                                    <span class="lbl"> <span class="flower4">好评</span></span>&nbsp;&nbsp;&nbsp;
                                </label>
                                <label class="evaluate-back">
                                    <input name="type" type="radio" class="ace ajaxchangetype" value="2" url="{{ URL('shop/ajaxServiceComments').'?type=2&id='.$service['id'] }}">
                                    <span class="lbl"> <span class="flower5">中评</span></span>&nbsp;&nbsp;&nbsp;
                                </label>
                                <label>
                                    <input name="type" type="radio" class="ace ajaxchangetype" value="3" url="{{ URL('shop/ajaxServiceComments').'?type=3&id='.$service['id'] }}">
                                    <span class="lbl"> <span class="flower6">差评</span></span>
                                </label>
                            </div>
                        </div>
                        @if($comments_toArray['total']>0)
                        <ul>
                            @foreach($comments_toArray['data'] as $v)
                            <li class="personal-evaluate-list-item">
                                <div class="personal-case-evaluate-words personal-shop-evaluate">
                                    <h5>
                                        <a href="/task/740">{{ $v['title'] }}</a>
                                    </h5>
                                    <p>评价：{{ $v['comment'] }}</p>
                                </div>
                                <div class="personal-case-evaluate-person-time personal-shop-evaluate-time pull-right text-right">
                                    <div class="z-hov">
                                        @if($v['type'] == 1)
                                            <i class="evaluate-flowers"></i>
                                            <span class="good-evaluate">好评</span>
                                        @elseif($v['type'] == 2)
                                            <i class="evaluate-flowers evaluate-flowersin"></i>
                                            <span class="good-evaluate">中评</span>
                                        @else
                                            <i class="evaluate-flowers evaluate-flowersno"></i>
                                            <span class="good-evaluate">差评</span>
                                        @endif
                                        {{ $v['total_score'] }}分
                                        <i class="u-evaico"></i>
                                        <div class="u-recordstar b-border">
                                            <div>
                                                工作速度：
                                                @for($i=0;$i<$v['speed_score'];$i++)
                                                <span class="rec-active"></span>
                                                @endfor
                                                @for($i=0;$i<(5-$v['speed_score']);$i++)
                                                <span ></span>
                                                @endfor
                                                <a class="cor-orange mg-left">{{ $v['speed_score'] }}分 </a>
                                                @if($v['speed_score']>4 && $v['speed_score']<=5)
                                                    - 速度很快
                                                @elseif($v['speed_score']>3 && $v['speed_score']<=4)
                                                    - 速度一般
                                                @elseif($v['speed_score']>2 && $v['speed_score']<=3)
                                                    - 速度较慢
                                                @else
                                                    - 速度很慢
                                                @endif
                                            </div>
                                            <div class="space-8"></div>
                                            <div>
                                                工作质量：
                                                @for($i=0;$i<$v['quality_score'];$i++)
                                                    <span class="rec-active"></span>
                                                @endfor
                                                @for($i=0;$i<(5-$v['quality_score']);$i++)
                                                    <span ></span>
                                                @endfor
                                                <a class="cor-orange mg-left">{{ $v['quality_score'] }}分 </a>
                                                @if($v['quality_score']>4 && $v['quality_score']<=5)
                                                    - 质量很高
                                                @elseif($v['quality_score']>3 && $v['quality_score']<=4)
                                                    - 质量一般
                                                @elseif($v['quality_score']>2 && $v['quality_score']<=3)
                                                    - 质量较低
                                                @else
                                                    - 质量很低
                                                @endif
                                            </div>
                                            <div class="space-8"></div>
                                            <div>
                                                工作态度：
                                                @for($i=0;$i<$v['attitude_score'];$i++)
                                                    <span class="rec-active"></span>
                                                @endfor
                                                @for($i=0;$i<(5-$v['attitude_score']);$i++)
                                                    <span ></span>
                                                @endfor
                                                <a class="cor-orange mg-left">{{ $v['attitude_score'] }}分 </a>
                                                @if($v['attitude_score']>4 && $v['attitude_score']<=5)
                                                    - 态度很好
                                                @elseif($v['attitude_score']>3 && $v['attitude_score']<=4)
                                                    - 速度一般
                                                @elseif($v['attitude_score']>2 && $v['attitude_score']<=3)
                                                    - 态度较差
                                                @else
                                                    - 态度很差
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>
                                    <p><span>雇主：<span class="span-space p-space">{{ $v['user_name'] }}</span></span>&nbsp;<span>评价于：{{ date('Y-m-d',strtotime($v['created_at'])) }}</span></p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <!-- 底部分页 -->
                        <div class="space-6"></div>
                        <div class="row personal-evaluate-page">
                            <div class="col-md-12">
                                <div class="dataTables_paginate paging_bootstrap">
                                    {!! $comments->appends(['id'=>$service['id']])->render() !!}
                                </div>
                            </div>
                        </div>
                        <div class="space-6"></div>
                        @else
                        <div class="row close-space-tip">
                            <div class="col-md-12 text-center">
                                <div class="space"></div>
                                <div class="space"></div>
                                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                                <div class="space-10"></div>
                                <p class="text-size16 cor-gray87">暂无评价</p>
                                <div class="space-32"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--其他商品--}}
    <div class="col-sm-12 col-left">
        <div class="shop-wares buygoods-shop">
            <div class="shop-evalhd clearfix">
                <h4 class="pull-left text-size16 cor-gray45">店铺其他服务</h4>
                <a href="{{ URL('shop/serviceAll',['shop_id'=>Theme::get('SHOPID')]) }}" class="pull-right">More></a>
            </div>
            <div class="shop-mainlistwrap">
                <ul class="row shop-mainlist">
                    @foreach($other_service as $v)
                    <li class="col-md-3 col-sm-4 col-xs-6">
                        <div class="shop-mainimg shop-mainimg234">
                            <a href="{{ URL('shop/buyservice',['id'=>$v['id']]) }}">
                                {{--<img src="{{ !empty($v['cover'])?$v['cover']:Theme::asset()->url('images/employ/bg2.jpg') }}" alt=""  onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">--}}
                                @if(!empty($v['cover']))
                                    <img src="{{ $domain.'/'.$v['cover'] }}" alt=""  onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" >
                                @else
                                    <img src="{{ Theme::asset()->url('images/employ/bg2.jpg')}}" alt=""  onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" >
                                @endif
                            </a>
                        </div>
                        <div class="shop-maininfo">
                            <a href="{{ URL('shop/buyservice',['id'=>$v['id']]) }}" ><h5 class="text-size14 cor-gray51 p-space">{{ $v['title'] }}</h5></a >
                            <div class="space-6"></div>
                            <p class="clearfix cor-gray89">
                                <span class="case-tag pull-left"> <i class="fa fa-tag cor-grayD3 text-size16"></i>&nbsp;&nbsp;{{ $all_cate[$v['cate_id']]['name'] }}</span>
                                <span class="pull-right cor-orange">￥{{ $v['cash'] }}</span>
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('userCenterCase','css/usercenter/successCase/userCenterCase.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('successstory','css/shop/successstory.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('jquery_raty','plugins/jquery/raty/jquery.raty.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('evaluate','js/buyservice.js') !!}
