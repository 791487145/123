
<div class="vipDetails">
    <div class="container">
        <div class="row">
            <div class="g-taskposition col-lg-12 col-left">当前位置：首页 &gt; VIP首页 &gt; VIP访谈</div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-9 col-left">
                        <div class="mainarticle detail-l clearfix">
                            <h1 class="text-center text-size18 cor-gray51">{{$info->title}}</h1>
                            <div class="artinfo text-center">
                                <span>发布时间: {{$info->created_at}}</span>
                                <span>浏览：{{$info->view_count}}</span>
                            </div>
                            <div class="artibody">
                                {{$info->desc}}
                            </div>
                            <div class="prevnext a2 clearfix">
                                <span class="pull-left">
                                    @if($head_info)
                                    上一篇：<a href="{{url('vipshop/details/' . $head_info->id)}}">{{$head_info->title}}</a>
                                    @endif
                                </span>

                                <span class="pull-right">
                                    @if($next_info)
                                    下一篇：<a href="{{url('vipshop/details/' . $next_info->id)}}">{{$next_info->title}}</a>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="space-10"></div>
                        <div class="space-10"></div>
                    </div>
                    <div class="col-lg-3 col-left clearfix">
                        <div class="detail-r">
                            <img src="/themes/default/assets/images/news_pic_side.png" alt="" class="img-responsive">
                            <h6 class="text-size18 cor-gray51 p-space"><span>香蕉人文化传播公司</span><span class="ico"></span></h6>
                            <a class="a aBtn" href="javascript:;">雇佣TA</a>
                            <a class="aBtn" href="javascript:;">进入店铺</a>
                        </div>
                        <div class="space-10"></div>
                        <div class="list-more clearfix">
                            <h6 class="text-size14 cor-gray51 mg-margin">更多访谈 <a href="{{url('vipshop/page')}}" class="pull-right text-size12 cor-gray51">more&gt;</a></h6>
                            <ul class="clearfix mg-margin">
                                @forelse($side_list as $item)
                                <li class="clearfix">
                                    <div class="media-left">
                                        <a class="text-size14 cor-gray51" href="{{url('vipshop/details/' . $item->id)}}">
                                            <img src="{{$item->shop_cover}}" onerror="onerrorImage('/themes/default/assets/images/employ/bg2.jpg',$(this))">
                                        </a>
                                    </div>
                                    <div class="media-body ">
                                        <a class="cor-gray51 p-space text-size14" href="{{url('vipshop/details/' . $item->id)}}">{{$item->title}}</a>
                                        <div class="space-6"></div>
                                        <div class="clearfix content">
                                            <a class="cor-gray89" href="{{url('vipshop/details/' . $item->id)}}">
                                                {{$item->desc}}
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
