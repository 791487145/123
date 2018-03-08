{{--确认源文件--}}
<div class="shop-wrap clearfix">
    <div class="col-sm-12 col-left">
        <div class="shop-wares buygoods-shop orders-wares">
            <div class="shop-evalhd clearfix">
                <h4 class="text-size16 cor-gray45">确认源文件</h4>
            </div>
            <div class="shop-mainlistwrap orders-table">
                <div class="table-responsive ">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="s-title">作品信息</th>
                            <th class="s-amount">作品数量（@if($goods_info->unit == 0)件@elseif($goods_info->unit == 1)时
                                @elseif($goods_info->unit == 2)份
                                @elseif($goods_info->unit == 3)个@elseif($goods_info->unit == 4)张
                                @elseif($goods_info->unit == 5)套
                                @endif）</th>
                            <th class="s-price">作品价格（元）</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="props">
                                <div class="clearfix">
                                    <a class="pull-left alinkimg" target="_blank" href="/shop/buyGoods/{!! $goods_info->id !!}">
                                        <img class="img-responsive" src="{!! url($goods_info->cover) !!}" alt="商品封面" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                                    </a>
                                    <div class="pull-left">
                                        <p class="p-space">
                                            <a class="cor-blue016 text-size14" href="/shop/BuyGoods/{!! $goods_info->id !!}" target="_blank">
                                                {!! $goods_info->title !!}
                                            </a>
                                        </p>
                                        <p class="cor-gray51 text-size12">
                                            作品分类：{!! $goods_info->cate_pname !!}  {!! $goods_info->cate_name !!}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                <span class="cor-orange31 text-size12">￥{!! $goods_info->cash !!}/@if($goods_info->unit == 0)件@elseif($goods_info->unit == 1)时
                                    @elseif($goods_info->unit == 2)份@elseif($goods_info->unit == 3)个@elseif($goods_info->unit == 4)张
                                    @elseif($goods_info->unit == 5)套@endif
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <p class="text-size14 cor-gray51">
                        @if(!empty($attachment))
                            @foreach($attachment as $item)
　　                          文件：{!! $item->name !!} <a href="{{ URL('shop/download',['id'=>$item['id']]) }}" target="_blank">下载</a>
                            @endforeach
                        @endif
                    </p>
                </div>
                <div class="space-30"></div>
                <div class="space-30"></div>
                {{--<form method="post" action="/shop/postConfirm">--}}
                    {{--{{csrf_field()}}--}}
                    {{--<input type="hidden" name="id" value="{!! $id !!}">--}}
                    <div class="text-center">
                        <button class="btn-sut text-size16 bor-radius2 bg-blue" type="button" data-toggle="modal" data-target="#except8">确认源文件</button>　　
                        <button class="btn-sut text-size16 bor-radius2 btn-gray999" type="button" data-toggle="modal" data-target="#except7">申请维权</button>
                    </div>
                {{--</form>--}}
            </div>
        </div>
    </div>
</div>
<!--维权 模态框（Modal） -->
<div class="modal fade" tabindex="-1" role="dialog" id="except7" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header widget-header-flat">
                <span class="modal-title cor-gray51 text-size14 text-blod">
                    交易维权：
                </span>
                <button type="button" class="bootbox-close-button close text-size14"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div class="space"></div>
                <form method="post" action="/shop/postRightsInfo">
                    {{csrf_field()}}
                    <input name="order_id" type="hidden" value="{!! $id !!}">
                    <div class="clearfix">
                        <div class="form-group clearfix">
                            <label class="col-sm-3 control-label text-right">维权类型：</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <select name="type">
                                        <option value="1">违规信息</option>
                                        <option value="2">虚假交稿</option>
                                        <option value="3">涉嫌抄袭</option>
                                        <option value="4">其他</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-3 control-label text-right">维权原因：</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <textarea type="text" name="desc"   placeholder="请输入维权原因"  rows="3" cols="50"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix text-center">
                        <button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2" type="submit" >确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                    </div>
                    <div class="space"></div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<!--确认源文件 模态框（Modal） -->
<div class="modal fade" tabindex="-1" role="dialog" id="except8" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header widget-header-flat">
                <span class="modal-title text-size14 shop-modal-title">
                    确认源文件：
                </span>
                <button type="button" class="bootbox-close-button close text-size14"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>

            </div>
            <div class="modal-body">
                <div class="space"></div>
                <form method="post" action="/shop/postConfirm">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{!! $id !!}">
                    <div class="clearfix text-center text-size14">
                        <p class="text-size14 cor-gray51 text-center">确定验收源文件了吗？小心人才两空哦！</p>
                    </div>
                    <div class="space-8"></div>
                    <div class="clearfix text-center">
                        <button class="btn btn-primary btn-sm btn-big1 btn-blue bor-radius2" type="submit" >确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default btn-sm btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                    </div>
                    <div class="space"></div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

{!! Theme::asset()->container('custom-css')->usepath()->add('successstory','css/shop/successstory.css') !!}