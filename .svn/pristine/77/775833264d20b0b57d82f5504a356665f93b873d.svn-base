<article class="col-xs-12 col-left ">
	<div class="successstory">
		<h4 class="text-size20 tit mg-margin0">所有案例</h4>
		@if(!empty($cateInfo))
	    <div class="alink">
			@foreach($cateInfo as $cv)
	        <a class="cor-gray45" href="{!! URL('/shop/successStory/'.$shopId.'?cate_id='.$cv['cate_id']) !!}">{!! $cv['name'] !!} <span>({!! $cv['num'] !!})</span></a>　　
		　　 @endforeach
	    </div>
		@endif
	    <div class="shop-mainlistwrap">
			@if($caseInfo->total())
	    	<ul class="row shop-mainlist successstory-list">
				@foreach($caseInfo as $v)
		        <li class="col-md-3 col-sm-4 col-xs-6">
		            <div class="shop-mainimg shop-mainimg168">
						@if($v->pic)
							<a href="{!! URL('/shop/successDetail/'.$v['id']) !!}"><img src="{!! $domain.'/'.$v->pic !!}"> alt="" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))"></a>
						@else
							<a href="{!! URL('/shop/successDetail/'.$v['id']) !!}"><img src="{{ Theme::asset()->url('images/case_back.png') }}" alt=""></a>
						@endif
					</div>
		            <div class="shop-maininfo">
		                <h5 class="text-size14 p-space"><a class="cor-gray51" href="{!! URL('/shop/successDetail/'.$v['id']) !!}">{!! $v->title !!}</a></h5>
		                <div class="space-6"></div>
		                <p class="clearfix cor-gray89">
		                    <span class="case-tag pull-left"> <i class="fa fa-tag cor-grayD3 text-size16"></i>&nbsp;&nbsp;{!! $v->name !!}</span>
		                    <span class="pull-right "><i class="fa fa-eye"></i>@if($v->view_count){!! $v->view_count !!}@else 0 @endif人浏览</span>
		                </p>
		            </div>
		        </li>
				@endforeach
		    </ul>
			@else
			<div class="row close-space-tip">
				<div class="col-md-12 text-center">
					<div class="space"></div>
					<div class="space"></div>
					<img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
					<div class="space-10"></div>
					<p class="text-size16 cor-gray87">暂无案例</p>
					<div class="space-32"></div>
				</div>
			</div>
			@endif
    	</div>
    	<div>
    		<ul class="pagination pull-right"> 
			    {!! $caseInfo->render() !!}
			</ul>
    	</div>
	</div>
</article>

{!! Theme::asset()->container('custom-css')->usepath()->add('issuetask','css/shop/successstory.css') !!}