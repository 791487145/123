
            <h3 class="header smaller lighter blue mg-bottom20 mg-top12">服务管理</h3>
            <div class="well">
                <form class="form-inline" role="form" action="/manage/goodsList" method="get">

                    <div class="form-group search-list ">
                        <label for="name">店主　　　</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="请输入店主" @if(isset($merge['name']))value="{!! $merge['name'] !!}" @endif>
                    </div>
                    <div class="form-group search-list ">
                        <label for="namee">服务名　　</label>
                        <input type="text" class="form-control" id="goods_name" name="goods_name" placeholder="请输入商品名" @if(isset($merge['goods_name']))value="{!! $merge['goods_name'] !!}" @endif>
                    </div>
                    <div class="form-group search-list width285">
                        <label>服务状态　</label>
                        <select name="status">
                            <option value="0">全部</option>
                            <option value="1" @if(isset($merge['status']) && $merge['status'] == 1)selected="selected"@endif>待审核</option>
                            <option value="2" @if(isset($merge['status']) && $merge['status'] == 2)selected="selected"@endif>售卖中</option>
                            <option value="3" @if(isset($merge['status']) && $merge['status'] == 3)selected="selected"@endif>下架</option>
                            <option value="4" @if(isset($merge['status']) && $merge['status'] == 4)selected="selected"@endif>审核失败</option>

                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                </form>
            </div>

        <!-- <div class="table-responsive"> -->

        <!-- <div class="dataTables_borderWrap"> -->
        <div class="table-responsive">
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">
                        {{--<label class="position-relative">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>--}}
                    </th>
                    <th>编号</th>
                    <th>服务名</th>
                    <th>服务报价</th>
                    <th>店主</th>
                    <th>服务状态</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                @if($goods_list)
                    @foreach($goods_list as $item)
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace auth_id" name="ckb[]" value="{!! $item->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>

                            <td>
                                <a href="#">{!! $item->id !!}</a>
                            </td>
                            <td>{!! $item->title !!}</td>
                            <td>{!! $item->cash !!}</td>
                            <td>{!! $item->name !!}</td>
                            <td>
                                @if($item->status == 0)
                                    <span class="label label-sm label-success">待审核</span>
                                @elseif($item->status == 1)
                                    <span class="label label-sm label-danger">售卖中</span>
                                @elseif($item->status == 2)
                                    <span class="label label-sm label-danger">下架</span>
                                @elseif($item->status == 3)
                                    <span class="label label-sm label-danger">审核失败</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" id="deal" data-id="{!! $item->id !!}">
                                    @if($item->status == 0)
                                        <a class="btn btn-xs btn-success" href="javaScript:;" data-values="3" onclick="changeGoodsStatus(this)">
                                            <i class="ace-icon fa fa-check bigger-120">审核通过</i>
                                        </a>
                                        <a class="btn btn-xs btn-danger check_failure" href="javaScript:;" data-values="4" data-toggle="modal" data-target="#modal1">
                                            <i class="ace-icon fa fa-ban bigger-120">审核失败</i>
                                        </a>
                                    @endif
                                    @if($item->status == 1)
                                        <a class="btn btn-xs btn-danger" href="javaScript:;" data-values="2" onclick="changeGoodsStatus(this)">
                                            <i class="ace-icon fa fa-ban bigger-120">下架</i>
                                        </a>
                                    @endif
                                    @if($item->status == 2)
                                        <a class="btn btn-xs btn-success" href="javaScript:;" data-values="1" onclick="changeGoodsStatus(this)">
                                            <i class="ace-icon fa fa-check bigger-120">上架</i>
                                        </a>
                                        <a class="btn btn-xs btn-danger" href="javaScript:;" data-values="5" onclick="changeGoodsStatus(this)">
                                            <i class="fa fa-trash-o"></i>删除
                                        </a>
                                    @endif
                                    @if($item->status == 3)
                                        <a class="btn btn-xs btn-danger" href="javaScript:;" data-values="5" onclick="changeGoodsStatus(this)">
                                            <i class="fa fa-trash-o"></i>删除
                                        </a>
                                    @endif
                                    <a class="btn btn-xs btn-warning" href="/manage/serviceInfo/{!! $item->id !!}">
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
                                            {!! $goods_list->appends($merge)->render() !!}
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
<!--模态框（Modal） -->
<form action="javascript:;" method="post" enctype="multipart/form-data" id="report-form">
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header widget-header-flat">
                <span class="modal-title cor-gray51 h4 text-blod">
                    审核失败：
                </span>
                    <button type="button" class="bootbox-close-button close text-size14" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="space-8"></div>
                    <div class="clearfix">
                        <div class="form-group clearfix">
                            <label class="col-sm-3 control-label text-right">失败原因：</label>
                            <div class="col-sm-8 ">
                                <textarea type="text" name="reason" id="reason" placeholder="请输入审核失败的原因"  rows="3" class="col-xs-12 jbchat-text"></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="space-4"></div>
                    <div class="clearfix text-center" data-id="" id="delete_id">
                        <button class="btn btn-primary btn-md btn-big1 btn-blue bor-radius2" type="button" id="check_failure" data-values="4" data-dismiss="modal" aria-hidden="true">确定</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default btn-md btn-big1 btn-gray999 bor-radius2" data-dismiss="modal" aria-hidden="true">取消</button>
                    </div>
                    <div class="space"></div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>
    </div>
</form>
{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}

{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('shoplist', 'js/doc/goodslist.js') !!}
