<div class="shop-wrap clearfix">
	<div class="col-lg-3 hidden-xs hidden-md hidden-sm col-left">
        <div class="needs-sidebar rated-bottom">
            <div class="needs-sidebar-wrap">
                <div class="wrap1">
					@if($shopInfo['shop_pic'])
					<img src="{!! $domain.'/'.$shopInfo['shop_pic'] !!}" alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" />
					@else
                    <img src="{!! Theme::asset()->url('images/employ/bg1.jpg') !!}" alt=""/>
					@endif
                </div>
                <div class="wrap2">
                    <p class="tit">{!! $shopInfo['shop_name'] !!}</p>
                    <p class="beyond clearfix beyond-a">
                        <span>认证：</span>
						@if($authUser['realname'])
							<a href="" class="ico1 u-ico1"></a>
						@else
							<a href="" class="ico1"></a>
						@endif
						@if($authUser['bank'])
							<a href="" class="ico2 u-ico2"></a>
						@else
							<a href="" class="ico2"></a>
						@endif
						@if($emailStatus == 2)
							<a href="" class="ico3 u-ico3"></a>
						@else
							<a href="" class="ico3"></a>
						@endif
						@if($authUser['alipay'])
							<a href="" class="ico4 u-ico4"></a>
						@else
							<a href="" class="ico4 "></a>
						@endif
						@if($authUser['enterprise'])
							<a href="" class="ico5 u-ico5"></a>
						@else
							<a href="" class="ico5 "></a>
						@endif
                    </p>
                    <p class="beyond">
                        <span>地址：</span>
						@if($shopInfo['province_name'])
							{!! $shopInfo['province_name'] !!}
						@endif
						@if($shopInfo['city_name'])
							{!! $shopInfo['city_name'] !!}
						@endif
                    </p>
					@if(!empty($shopInfo['tags']))
                    <p class="beyond beyond-s">
                        <span>标签：</span>
						@foreach($shopInfo['tags'] as $tv)
                        <a href="">{!! $tv['tag_name'] !!}</a>
						@endforeach
                    </p>
					@endif
                </div>
                <div class="wrap3">
                    <ul class="list-inline">
                        <li>
                            <p class="text-center">好评数</p>
                            <div class="text-center text-color text-size14">@if($shopInfo['good_comment']) {!! $shopInfo['good_comment'] !!} @else 0 @endif</div>
                        </li>
                        <li>
                            <p class="text-center">综合评分</p>
                            <div class="text-center text-color text-size14">@if($shopInfo['total_comment']) {!! $shopInfo['total_comment'] !!} @else 0 @endif</div>
                        </li>
                        <li>
                            <p class="text-center">
                                累计雇佣
                            </p>
                            <div class="text-center text-color text-size14">@if(!empty($shopInfo)) {!! $shopInfo['serviceNum'] !!} @else 0 @endif</div>
                        </li>
                    </ul>
                </div>
                <div class="wrap4" >
					@if(Auth::check())
						@if(Auth::id() != $shopInfo['uid'] && Theme::get('is_IM_open') == 2)
                    	<a href="javascript:;" data-toggle="modal" data-target="#myModalshop" class="ico1 hovim-orange"><i></i>联系我</a>
						@elseif(Auth::id() != $shopInfo['uid'] && Theme::get('is_IM_open') == 1)
						<a href="javascript:;" class="ico1 shop-im hovim-orange" data-values="{{ $shopInfo['uid'] }}"><i></i>联系我</a>
						@endif
					@else
					<a href="{!! URL('/login') !!}" class="ico1"><i></i>联系我</a>
					@endif
                    @if(Auth::check())
						@if(empty($isFocus) && $shopInfo['uid'] != Auth::id())
						<a href="" class="ico2 hov-orange" id="shop_id" shop_id="{!! $shopId !!}"><i></i>收藏店铺</a>
						@elseif($shopInfo['uid'] != Auth::id())
						<span href="" class="shop-collectatv hov-orange">已收藏</span>
						@endif
					@else
					<a href="{!! URL('/login') !!}" class="ico2 hov-orange"><i></i>收藏店铺</a>
					@endif
                </div>
				@if(Auth::check() && Auth::id() != $shopInfo['uid'])
                <a class="g-shopabbtn bg-blue" href="{!! URL('/employ/create/'.$shopInfo['uid']) !!}">立即雇佣</a>
				@elseif(!Auth::check())
				<a class="g-shopabbtn bg-blue" href="{!! URL('/login') !!}">立即雇佣</a>
				@endif
            </div>
        </div>
        <div class="needs-sidebar rated-bottom">
            <div class="needs-sidebar-wrap">
				@if(!empty($goodCateInfo))
            	<div class="clearfix">
            		<div class="clearfix">
            			 <h5 class="pull-left text-size16 mg-margin cor-gray45">作品</h5>
			        	 <a href="{!! URL('/shop/work/'.$shopId) !!}" class="pull-right cor-gray8f text-size12">More&gt;</a>
            		</div>
            		<div class="space-10"></div>
            		<ul class="mg-margin ul-wrap">
						@foreach($goodCateInfo as $gv)
            			<a href="{!! URL('/shop/work/'.$shopId.'?cate_id='.$gv['cate_id']) !!}"><li>{!! $gv['name'] !!} （{!! $gv['num'] !!}）</li></a>
						@endforeach
            		</ul>
			    </div>
				@endif
				@if(!empty($goodCateInfo) && !empty($serviceCateInfo))
			    <hr class="mg-top0">
				@endif
				@if(!empty($serviceCateInfo))
			    <div class="clearfix">
            		<div class="clearfix">
            			 <h5 class="pull-left text-size16 mg-margin cor-gray45">服务</h5>
			        	 <a href="{!! URL('/shop/serviceAll/'.$shopId) !!}" class="pull-right cor-gray8f text-size12">More&gt;</a>
            		</div>
            		<div class="space-10"></div>
            		<ul class="mg-margin ul-wrap">
						@foreach($serviceCateInfo as $sv)
            			<a href="{!! URL('/shop/serviceAll/'.$shopId.'?cate_id ='.$sv['cate_id']) !!}"><li>{!! $sv['name'] !!} （{!! $sv['num'] !!}）</li></a>
						@endforeach
            		</ul>
			    </div>
				@endif
            </div>
        </div>
    </div>
	<!-- 模态框（Modal） -->
	<div class="modal fade" id="myModalshop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog  contact-me-modal" role="document">
			<div class="modal-content">
				<div class="modal-header ">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-size14 shop-modal-title" id="myModalLabel"><b>联系我</b></h4>
				</div>
					<div class="modal-body shop-modal-shopbody">
						<input type="hidden" name="js_id" class="js_id" id="contactMeId" value="{!! $shopInfo['uid'] !!}">
						<textarea name="content" id="content" class="shop-modalarea"></textarea>
						<div class="space-6"></div>
						<div class="text-right"><button class="btn btn-primary btn-blue shop-modalbtn" id="contactMe">发送</button></div>
					</div>
				<div class="modal-shopfooter g-shopabnum">
					其他联系方式&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@if($contactInfo['mobile_status'])
					<span class="g-shopabnumph text-size12">{!! $contactInfo['mobile'] !!}</span>
					@endif
					@if($contactInfo['qq_status'])
					<span class="g-shopabnumqq text-size12">{!! $contactInfo['qq'] !!}</span>
					@endif
					@if($contactInfo['wechat_status'])
					<span class="g-shopabnumwx text-size12">{!! $contactInfo['wechat'] !!}</span>
					@endif
				</div>
			</div>
		</div>
	</div><!-- 模态框（Modal）end -->
	<div class="col-lg-9">
		<div class="shop-casewrap row tated-casewrap">
		    <div class="col-md-12 col-left">
		        <div class="shop-evaluate">
					@if(Auth::check() && Auth::id() != $shopInfo['uid'])
					<a class="shop-btbtnbg hidden-lg" href="{!! URL('/employ/create/'.$shopInfo['uid']) !!}"><i class="shop-gybtnico"></i>立即雇佣</a>
					@elseif(!Auth::check())
						<a class="shop-btbtnbg hidden-lg" href="{!! URL('/login') !!}"><i class="shop-gybtnico"></i>立即雇佣</a>
					@endif
		        	<div class="rated-chart">
						<div class="g-shopabhd">交易评价</div>
						<div class="space"></div>
			            <div class="clearfix">
			            	<div class="clearfix pull-left hidden-xs hidden-sm">
				            	<div class="clearfix pull-left chart-mg">
					            	<span class="chart1" data-percent="{!! $speedScore*20 !!} ">
										<span class="percent"></span>
									</span>
									<p class="text-center text-size14 cor-gray51">工作速度</p>
					            </div>
					            <div class="clearfix pull-left chart-mg">
					            	<span class="chart2" data-percent="{!! $qualityScore*20 !!}">
										<span class="percent"></span>
									</span>
									<p class="text-center text-size14 cor-gray51">工作质量</p>
					            </div>
					            <div class="clearfix pull-left chart-mg">
					            	<span class="chart3" data-percent="{!! $attitudeScore*20 !!}">
										<span class="percent"></span>
									</span>
									<p class="text-center text-size14 cor-gray51">工作态度</p>
					            </div>
				            </div>
				            <div class="pull-left clearfix rated-blockchart">
				            	<div class="total mg-left0">
				            		<p class="text-center cor-gray51 text-size14">服务总数</p>
				            		<div class="space-8"></div>
				            		<ul class="list-inline mg-margin clearfix">
				            			<li>{!! ($serviceCount%10000 - $serviceCount%1000)/1000 !!}</li>
				            			<li>{!! ($serviceCount%1000 - $serviceCount%100)/100 !!}</li>
				            			<li>{!! ($serviceCount%100 - $serviceCount%10)/10 !!}</li>
				            			<li>{!! $serviceCount%10 !!}</li>
				            		</ul>
				            	</div>
				            	<div class="total">
				            		<p class="text-center cor-gray51 text-size14">作品总数</p>
				            		<div class="space-8"></div>
				            		<ul class="list-inline mg-margin clearfix">
										<li>{!! ($goodsCount%10000 - $goodsCount%1000)/1000 !!}</li>
										<li>{!! ($goodsCount%1000 - $goodsCount%100)/100 !!}</li>
										<li>{!! ($goodsCount%100 - $goodsCount%10)/10 !!}</li>
										<li>{!! $goodsCount%10 !!}</li>
				            		</ul>
				            	</div>
				            </div>
			            </div>
		        	</div>
		        	<div class="space"></div>
		        	<div>
						<div class="g-shopabhd">客户评价</div>
						<div class="space-8"></div>
			            <div class="text-size14 cor-gray51 clearfix record">
							<form action="/shop/rated/{!! $shopId !!}" method="get" id="screen_form">
	                        <div class="col-xs-12 task-mediaAssessR pd-padding0">
	                            <label class="evaluate-back">
	                                <input name="type" type="radio" class="ace screen" checked="" value="1" {{ (!empty($_GET['type']) && $_GET['type']==1)?'checked':'' }}>
	                                <span class="lbl"> <span class="flower4">好评</span></span>&nbsp;&nbsp;&nbsp;
	                            </label>
	                            <label class="evaluate-back">
	                                <input name="type" type="radio" class="ace screen" value="2" {{ (!empty($_GET['type']) && $_GET['type']==2)?'checked':'' }}>
	                                <span class="lbl"> <span class="flower5">中评</span></span>&nbsp;&nbsp;&nbsp;
	                            </label>
	                            <label>
	                                <input name="type" type="radio" class="ace screen" value="3" {{ (!empty($_GET['type']) && $_GET['type']==3)?'checked':'' }}>
	                                <span class="lbl"> <span class="flower6">差评</span></span>
	                            </label>
	                        </div>
							</form>
	                    </div>
	                    <div class="space"></div>
						@if(!empty($commentInfo) && $commentInfo->total())
						@foreach($commentInfo as $cv)
			            <div class="clearfix tated-list">
			                <div class="col-sm-1 col-xs-2">
		                        <div class="row">
		                            <div @if($cv->type == 0) class="g-valugood" @elseif($cv->type == 1) class="g-valuin" @elseif($cv->type == 2) class="g-valupoor" @endif>
		                                <img class="img-responsive img-circle" src="{!! $domain.'/'.$cv->avatar !!}"  onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))" alt="...">

										<div class="g-valuimgbg"></div>
		                            </div>
		                            <div class="space-6"></div>
		                            <p class="text-center g-valuin p-space"><a href="javascript:;" class=" cor-blue2f">{!! $cv->name !!}</a></p>
		                        </div>
			                </div>
			                <div class="col-sm-11 col-xs-10 s-myborder pd-right0">
		                        <div class="clearfix">
		                            <span class=" pull-left text-muted text-size12 cor-gray87 s-myname">@if($cv->sort == 1) 作品 @elseif($cv->sort == 2) 服务 @endif ：<a class="cor-blue42" @if($cv->sort == 1) href="{!! URL('/shop/buyGoods/'.$cv->goodId) !!}" @elseif($cv->sort == 2) href="{!! URL('/shop/buyservice/'.$cv->goodId) !!}" @endif>   {!! $cv->title !!} </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;成交价：￥{!! $cv->cash !!}</span>
		                            <a class="pull-right cor-gray87 text-size12" href="javascript:;">{!! date('Y-m-d',strtotime($cv->created_at)) !!}</a>
		                        </div>
		                        <div class="space-6"></div>
		                        <div class="p-space">
		                            <p class="cor-gray51 text-size14">{!! $cv->desc !!}</p>
		                        </div>
		                        <div class="space-2"></div>
		                        <div class="clearfix">
		                    	<span class="cor-gray87 z-hov">
			                        本次终合评分：<span class="cor-orange">{!! $cv->total_score !!} </span><i class="u-evaico"></i>
			                        <div class="u-recordstar b-border">
			                            <div>
			                                工作速度：
											@if($cv->speed_score>0 && $cv->speed_score <= 1)
												<span class="rec-active"></span>
											@elseif($cv->speed_score>1 && $cv->speed_score <= 2)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@elseif($cv->speed_score>2 && $cv->speed_score <= 3)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@elseif($cv->speed_score>3 && $cv->speed_score <= 4)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@elseif($cv->speed_score>4 && $cv->speed_score <= 5)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@endif
			                                <a class="cor-orange mg-left">{!! $cv->speed_score !!}分 </a>
			                                    - 速度很快
			                            </div>
			                            <div class="space-8"></div>
			                            <div>
			                                工作质量：
											@if($cv->quality_score>0 && $cv->quality_score <= 1)
												<span class="rec-active"></span>
											@elseif($cv->quality_score>1 && $cv->quality_score <= 2)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@elseif($cv->quality_score>2 && $cv->quality_score <= 3)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@elseif($cv->quality_score>3 && $cv->quality_score <= 4)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@elseif($cv->quality_score>4 && $cv->quality_score <= 5)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@endif
			                                <a class="cor-orange mg-left">{!! $cv->quality_score !!}分 </a>
			                                    - 质量很快
			                            </div>
			                            <div class="space-8"></div>
			                            <div>
			                                工作态度：
											@if($cv->attitude_score>0 && $cv->attitude_score <= 1)
												<span class="rec-active"></span>
											@elseif($cv->attitude_score>1 && $cv->attitude_score <= 2)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@elseif($cv->attitude_score>2 && $cv->attitude_score <= 3)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@elseif($cv->attitude_score>3 && $cv->attitude_score <= 4)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@elseif($cv->attitude_score>4 && $cv->attitude_score <= 5)
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
												<span class="rec-active"></span>
											@endif
			                                <a class="cor-orange mg-left">{!! $cv->attitude_score !!}分 </a>
			                                    - 态度很好
			                            </div>
			                        </div>
		                        </span>
		                    </div>
		                    <div class="g-userborbtm"></div>
		                </div>
		            </div>
					@endforeach
					@else
						<div class="g-nomessage">暂无此类评价 </div><div class="space-32"></div><div class="space-6"></div>
					@endif
					@if(!empty($commentInfo) && $commentInfo->total())
					<div class="clearfix">
						<ul class="pagination pull-right">
							{!! $commentInfo->render() !!}
						</ul>
					</div>
					@endif
			        </div>
		        </div>
		    </div>
		</div>
	</div>
</div>






{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/shop/successstory.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('taskcommon','css/taskbar/taskcommon.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('easy-pie-chart','plugins/ace/js/jquery.easypiechart.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shop', 'js/shop.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ownercomment','js/doc/ownercomment.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shopContact','js/doc/shopContact.js') !!}


