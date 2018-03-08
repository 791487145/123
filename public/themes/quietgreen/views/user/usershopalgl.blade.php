<div class="g-main g-releasetask">
    <h4 class="text-size16 cor-blue2f u-title">案例管理</h4>
    <div class="space-12"></div>
    @if($is_open_shop == 1)
    <div class="clearfix g-reletaskhd hidden-xs">
        <div class="pull-left">
            <form action="/user/myShopSuccessCase" method="get">
                <span class="cor-gray51 text-size14">案例查询： </span>
                <input type="text" placeholder="输入案例关键词" class="input-xlarge inp-size12" name="title" id="title"
                       @if(isset($merge['title']))value="{!! $merge['title'] !!}" @endif />
                <button class="g-reletimehd"><i class="fa fa-search text-size16 cor-graybd"></i></button>
            </form>
        </div>
        <div class="pull-right">
            <a class="g-usershopfbtn bg-blue hov-blue1b" href="/user/addShopSuccess"><i class="fa fa-plus text-size12"></i>&nbsp;&nbsp;添加案例</a>
        </div>
    </div>
    <div class="space-6"></div>
    @if(!empty($success_list->toArray()['data']))
        <ul id="useraccept">
            @foreach($success_list as $item)
            <li class="row width590 case{!! $item->id !!}">
                <div class="col-sm-1 col-xs-2 usercter">
                    <img src="{!! url($item->pic) !!}" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                </div>

                <div class="col-sm-11 col-xs-10 usernopd">
                    <div class="col-sm-9 col-xs-8">
                        <div class="text-size14 cor-gray51">&nbsp;&nbsp;
                            <a class="cor-blue42" href="/shop/successDetail/{!! $item->id !!}">{!! $item->title !!}</a>
                        </div>
                        <div class="space-6"></div>
                        <p class="cor-gray87"><i class="fa fa-eye cor-grayd2"></i> @if($item->view_count){!! $item->view_count !!} @else 0 @endif人浏览&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-clock-o cor-grayd2"></i> {!! $item->created_at !!}
                        </p>
                        <div class="space-6"></div>
                        <p class="cor-gray51 p-space">{!! strip_tags(htmlspecialchars_decode($item->desc)) !!}</p>
                        <div class="space-2"></div>
                        <div class="g-userlabel"><a href="">{!! $item->name !!}</a></div>
                    </div>
                    <div class="col-sm-3 col-xs-4 text-right hiden590">
                        <a class="btn-big bg-blue bor-radius2 hov-blue1b" target="_blank" href="/shop/successDetail/{!! $item->id !!}">查看</a>
                        <p class="g-usershopshow"><a class="g-usershopsmbtn" target="_blank" href="/user/editShopSuccess/{!! $item->id !!}">编辑</a>
                        <a class="g-usershopsmbtn delete-successCase" data-id="{!! $item->id !!}" data-toggle="modal" data-target="#myModal">删除</a></p>
                    </div>
                    <div class="col-xs-12"><div class="g-userborbtm"></div></div>
                </div>
            </li>
            @endforeach
        </ul>
    @else
        <div class="g-nomessage">暂无信息哦 ！</div>
    @endif
    <div class="space-20"></div>
    <div class="dataTables_paginate paging_bootstrap">
        <ul class="pagination">
            {!! $success_list->appends($merge)->render() !!}
        </ul>
    </div>

    @elseif($is_open_shop == 2)
        <div class="row close-space-tip">
            <div class="col-md-12 text-center">
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <div class="space-10"></div>
                <p class="text-size16 cor-gray87">您的店铺已关闭，暂不能查看案例管理！<a href="/shop/manage/{!! $shop_id!!}">开启店铺</a></p>
            </div>
        </div>
    @else
        <div class="row close-space-tip">
            <div class="col-md-12 text-center">
                <div class="space-30"></div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                <img src="{!! Theme::asset()->url('images/close_space_tips.png') !!}" >
                <div class="space-10"></div>
                <p class="text-size16 cor-gray87">您的店铺还没设置，暂不能查看案例管理！<a href="/user/shop">店铺设置</a></p>
            </div>
        </div>
    @endif

</div>

<!-- 删除模态框 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  contact-me-modal" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">确定删除该案例吗</h4>
            </div>
            <input type="hidden" name="SuccessCase_id" class="SuccessCase_id" id="SuccessCase_id" value="">
            <div class="space-20"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="delete_success">确定</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('usercenter','css/usercenter/usercenter.css') !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('shop-css', 'css/usercenter/shop/shop.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('nopie','js/doc/nopie.js') !!}

{!! Theme::asset()->container('custom-js')->usepath()->add('shopSuccessList','js/doc/shopSuccessList.js') !!}


