
            <h3 class="header smaller lighter blue mg-bottom20 mg-top12">店铺设置</h3>
            <div class="well">
                <form class="form-inline search-group" role="form" action="/manage/shopList" method="get">

                    <div class="form-group search-list ">
                        <label for="name">店主　　　</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="请输入店主" @if(isset($merge['name']))value="{!! $merge['name'] !!}" @endif>
                    </div>
                    <div class="form-group search-list ">
                        <label for="namee">店铺名　　</label>
                        <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="请输入店铺名" @if(isset($merge['shop_name']))value="{!! $merge['shop_name'] !!}" @endif>
                    </div>
                    <div class="form-group search-list width285">
                        <label class="">店铺状态　</label>
                        <select name="status">
                            <option value="0">全部</option>
                            <option value="1" @if(isset($merge['status']) && $merge['status'] == 1)selected="selected"@endif>开启</option>
                            <option value="2" @if(isset($merge['status']) && $merge['status'] == 2)selected="selected"@endif>关闭</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                </form>
            </div>

        <!-- <div class="table-responsive"> -->

        <!-- <div class="dataTables_borderWrap"> -->
        <div class="table-responsive">
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    {{--<th class="center">
                        --}}{{--<label class="position-relative">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>--}}{{--
                    </th>--}}
                    <th>编号</th>
                    <th>店主</th>
                    <th>店铺名</th>
                    <th>作品数</th>
                    <th>服务数</th>
                    <th>
                        状态
                    </th>
                    <th>处理</th>
                </tr>
                </thead>

                <tbody>
                @if($shop)
                @foreach($shop as $item)
                    <tr>
                        {{--<td class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace auth_id" name="ckb[]" value="{!! $item->id !!}"/>
                                <span class="lbl"></span>
                            </label>
                        </td>--}}

                        <td>
                            <a href="#">{!! $item->id !!}</a>
                        </td>
                        <td>{!! $item->name !!}</td>
                        <td>{!! $item->shop_name !!}</td>
                        <td>@if(isset($item->goods_num)){!! $item->goods_num !!}@else 0 @endif</td>
                        <td>
                            @if(isset($item->service_num)){!! $item->service_num !!}@else 0 @endif
                        </td>
                        <td>
                            @if($item->status == 1)
                            <span class="label label-sm label-success">开启</span>
                            @elseif($item->status == 2)
                            <span class="label label-sm label-danger">关闭</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                @if($item->status == 2)
                                <a class="btn btn-xs btn-success" href="/manage/openShop/{!! $item->id !!}">
                                    <i class="ace-icon fa fa-check bigger-120">开启</i>
                                </a>
                                @endif
                                @if($item->status == 1)
                                <a class="btn btn-xs btn-danger" href="/manage/closeShop/{!! $item->id !!}">
                                    <i class="ace-icon fa fa-ban bigger-120">关闭</i>
                                </a>
                                    @if($item->is_recommend == 0)
                                    <a class="btn btn-xs btn-success" href="{!! url('manage/recommendShop/' . $item->id) !!}">
                                        <i class="ace-icon fa bigger-120">推荐</i>
                                    </a>
                                    @else
                                    <a class="btn btn-xs btn-success" href="{!! url('manage/removeRecommendShop/' . $item->id) !!}">
                                        <i class="ace-icon fa bigger-120">取消推荐</i>
                                    </a>
                                    @endif
                                @endif
                                <a class="btn btn-xs btn-warning" href="{!! url('manage/shopInfo/' . $item->id) !!}">
                                    <i class="ace-icon fa fa-search bigger-120">查看</i>
                                </a>

                            </div>

                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="9">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="col-sm-6">
                                    {{--<div class="dataTables_info" id="sample-table-2_info">
                                        <label><input type="checkbox" class="ace" id="allcheck"/>
                                            <span class="lbl"></span>全选
                                        </label>
                                        <button id="open" type="submit" class="btn btn-sm btn-primary ">开启</button>
                                        <button id="close" type="submit" class="btn btn-sm btn-primary ">关闭</button>
                                    </div>--}}
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="dataTables_paginate paging_bootstrap ">
                                    <ul class="pagination">
                                        {!! $shop->appends($merge)->render() !!}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div><!-- /.row -->
            {!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shoplist', 'js/doc/shoplist.js') !!}
