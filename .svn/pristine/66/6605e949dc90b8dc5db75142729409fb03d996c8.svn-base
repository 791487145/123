{{--确认订单--}}
<div class="shop-wrap clearfix">
    <div class="col-sm-12 col-left">
        <div class="shop-wares buygoods-shop orders-wares">
            <div class="shop-evalhd clearfix">
                <h4 class="text-size16 cor-gray45">确认作品信息</h4>
            </div>
            <div class="shop-mainlistwrap orders-table">
                <div class="table-responsive ">
                    <input type="hidden" name="goods_id" id="goods_id" value="{!! $goods_info->id !!}">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="s-title">作品信息</th>
                            <th class="s-amount">作品数量（@if($goods_info->unit == 0)件
                                @elseif($goods_info->unit == 1)时
                                @elseif($goods_info->unit == 2)份
                                @elseif($goods_info->unit == 3)个
                                @elseif($goods_info->unit == 4)张
                                @elseif($goods_info->unit == 5)套
                                @endif）</th>
                            <th class="s-price">作品价格（元）</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="props">
                                    <div class="clearfix">
                                        <a class="pull-left alinkimg" href="">
                                            <img class="img-responsive" src="{!! url($goods_info->cover )!!}" alt="goods_cover" onerror="onerrorImage('{{ Theme::asset()->url('images/employ/bg2.jpg')}}',$(this))">
                                        </a>
                                        <div class="pull-left">
                                            <p><a class="cor-blue016 text-size14" id="title" data-values="{!! $goods_info->title !!}">
                                                    {!! $goods_info->title !!}
                                                </a>
                                            </p>
                                            <p class="cor-gray51 text-size12">
                                                作品分类：{!! $goods_info->cate_pname !!} &nbsp;&nbsp;{!! $goods_info->cate_name !!}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{--<input type="text" class="input-mini" id="spinner3"  name="number"/>--}}
                                    1
                                </td>
                                <td>
                                    <span class="cor-orange31 text-size12" id="cash" data-values="{!! $goods_info->cash !!}">￥{!! $goods_info->cash !!}/@if($goods_info->unit == 0)件@elseif($goods_info->unit == 1)时
                                        @elseif($goods_info->unit == 2)份@elseif($goods_info->unit == 3)个@elseif($goods_info->unit == 4)张
                                        @elseif($goods_info->unit == 5)套@endif
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="space"></div>
                <div class="text-right">
                    <p class="text-right text-size14">实付金额：<span class="text-size24 cor-orange31 pay_num" data-values="{!! $goods_info->cash !!}">￥{!! $goods_info->cash !!}</span></p>
                    <a class="btn btn-big3 text-size16 btn-primary bor-radius2" id="create_order">提交订单</a>
                </div>
            </div>
        </div>
    </div>
</div>


{!! Theme::asset()->container('custom-css')->usepath()->add('successstory','css/shop/successstory.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('spinner','plugins/ace/js/fuelux/fuelux.spinner.min.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('buygoodsinfo','js/buygoodsinfo.js') !!}


