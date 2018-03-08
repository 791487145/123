<div class="g-main">
    <h4 class="text-size16 cor-blue u-title">我收藏的店铺</h4>
    <div class="space"></div>
    <form class="form-inline" role="form" action="/user/myCollectShop" method="get">
        <div class="form-group">
            <label class="text-size14">搜索店铺：</label>
            <div class="input-group">
                <input type="text" class="form-control search-query" placeholder="请输入店铺关键词" name="shop_name" id="title">
                <span class="input-group-btn">
                      <button class="btn btn-default btn-sm s-myformbtn" type="submit">
                          <span class="fa fa-search"></span>
                      </button>
                </span>
            </div>
        </div>
    </form>
    @if(!empty($shop_list) && !empty($shop_list->toArray()['data']))
    @foreach($shop_list->toArray()['data'] as $item)
    <div class="clearfix" id="">
        <div class="space col-xs-12"></div>
        <div class="col-sm-1 col-xs-12">
            <div class="row">
                <div class=" myshop-img ">
                    <img class="img-responsive" alt="..." src="{!! url($item['shop_pic']) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                </div>
            </div>{{--
            <div class="row myshop-img text-center">
                <img class="  img-responsive" alt="...">
            </div>--}}
        </div>
        <div class="col-sm-11 col-xs-12 s-myborder">
            <div class="col-sm-10 col-xs-9">
                <div class="row">
                    <div class="myshop-icon clearfix p-space">
                        <a class="text-size14 cor-blue s-myname pull-left" href="/shop/{!! $item['id'] !!}" target="_blank">
                            {!! $item['shop_name'] !!}
                        </a>
                        <div class="myshop-icon-span pull-left p-space">
                            @if($item['auth']['realname'] == true)
                                <span class="ico1 u-ico1"></span>
                            @else
                                <span class="ico1"></span>
                            @endif
                            @if($item['auth']['bank'] == true)
                                <span class="ico2 u-ico2"></span>
                            @else
                                <span class="ico2 u-ico2"></span>
                            @endif
                            @if($item['email_status'] == 2)
                                <span class="ico3 u-ico3"></span>
                            @else
                                <span class="ico3"></span>
                            @endif
                            @if($item['auth']['alipay'] == true)
                                <span class="ico4 u-ico4"></span>
                            @else
                                <span class="ico4"></span>
                            @endif
                            @if($item['auth']['enterprise'] == true)
                                <span class="ico5 u-ico5"></span>
                            @else
                                <span class="ico5"></span>
                            @endif
                        </div>
                    </div>
                    <div class="space-4"></div>
                    <p class="cor-gray89 p-space" href="javascript:;">
                        <span class="mg-right10">地址：{!! $item['province_name'] !!}&nbsp;&nbsp; {!! $item['city_name'] !!}</span>
                        <span class="mg-right10">好评数：@if($item['good_comment']){!! $item['good_comment'] !!}@else 0 @endif</span>
                        <span class="mg-right10">好评率：{!! $item['comment_rate'] !!}%</span>
                        <span class="mg-right10">累计雇佣：@if($item['employ_data']){!! count($item['employ_data']) !!}@else 0 @endif </span>
                    </p>

                    <p class="cor-gray97 p-space">{!! htmlspecialchars_decode($item['shop_desc']) !!}</p>

                    <div class="clearfix">
                        <div class="hidden-xs">
                            @if(isset($item['skill']) && !empty($item['skill']))
                                @foreach($item['skill'] as $value)
                                    <a class="s-mybtn" href="javscript:;">{!! $value !!}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="pull-right row">
                    <a class="cor-gray51 text-size12 myshop-btn-cencel" data-target="#myModal-548"
                       data-toggle="modal" data-id="{!! $item['id'] !!}" data-values="{!! $item['shop_name'] !!}">
                        取消收藏
                    </a>
                </div>
            </div>
            <div class="col-xs-12 g-userborbtm"></div>
        </div>
    </div>
    @endforeach
    <div class="space"></div>
    <div class="clearfix">
        <ul class="pagination pull-right">
            <ul class="pagination">
                {!! $shop_list->appends($merge)->render() !!}
            </ul>
        </ul>
    </div>
    @else
    {{--无数据状态--}}
    <div class="g-nomessage">暂无收藏店铺哦 ！</div>
    @endif

</div>

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal-548" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header widget-header-flat">
                <span class="modal-title" id="myModalLabel"></span>
            </div>
            <div class="modal-body text-center">
                <p class="h5">确定将“<span class="text-primary" id="shop_name">汇编microship芯片源码</span>”取消收藏？</p>
                <input type="hidden" name="shop_id" id="shop_id" value="">
                <div class="space"></div>
                <p>
                    <button class="btn btn-primary btn-blue bor-radius2" type="button" id="win-bid" data-dismiss="modal">确 定</button>　　
                    <button class="btn bor-radius2" type="button" data-dismiss="modal">取 消</button></p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>


{!! Theme::asset()->container('custom-css')->usePath()->add('messages', 'css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('collect_shop', 'js/collectshop.js') !!}