
            <h3 class="header smaller lighter blue mg-bottom20 mg-top12">订单管理</h3>
            <div class="well">
                <form class="form-inline"  role="form" action="/manage/shopOrderList" method="get">
                    <div class="form-group search-list ">
                        <label for="name">订单名　　</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="请输入订单名" @if(isset($merge['title']))value="{!! $merge['title'] !!}" @endif>
                    </div>
                    <div class="form-group search-list ">
                        <label for="namee">下单人　　　</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="请输入下单人" @if(isset($merge['name']))value="{!! $merge['name'] !!}" @endif>
                    </div>
                    <div class="space"></div>
                    <div class="form-group search-list width285">
                        <label class="">订单状态　</label>
                        <select name="status">
                            <option value="0">全部</option>
                            <option value="1" @if(isset($merge['status']) && $merge['status'] == 1)selected="selected" @endif>待付款</option>
                            <option value="2" @if(isset($merge['status']) && $merge['status'] == 2)selected="selected" @endif>已支付</option>
                            <option value="3" @if(isset($merge['status']) && $merge['status'] == 3)selected="selected" @endif>确认源文件</option>
                            <option value="4" @if(isset($merge['status']) && $merge['status'] == 4)selected="selected" @endif>维权中</option>
                            <option value="5" @if(isset($merge['status']) && $merge['status'] == 5)selected="selected" @endif>交易结束</option>
                            <option value="6" @if(isset($merge['status']) && $merge['status'] == 6)selected="selected" @endif>维权结束</option>
                        </select>
                    </div>
                    <div class="form-group search-list">
                        <label for="namee">下单时间　　</label>
                        <div class="input-daterange input-group">
                            <input type="text" name="start" class="input-sm form-control" @if(isset($merge['start']))value="{!! $merge['start'] !!}" @endif>
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                            <input type="text" name="end" class="input-sm form-control" @if(isset($merge['end']))value="{!! $merge['end'] !!}" @endif>
                        </div>
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
                    <th>编号</th>
                    <th>订单名</th>
                    <th>订单金额（元）</th>
                    <th >下单人</th>

                    <th>
                        <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                        下单时间
                    </th>
                    <th>
                        订单状态
                    </th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                    @if(!empty($order_list))
                        @foreach($order_list as $item)
                        <tr>
                            <td>
                                {!! $item->id !!}
                            </td>
                            <td>{!! $item->title !!}</td>
                            <td>￥{!! $item->cash !!}</td>
                            <td>{!! $item->name !!}</td>
                            <td>{!! date('Y-m-d',strtotime($item->created_at)) !!}</td>
                            <td>
                                @if($item->status == 0) 待付款
                                @elseif($item->status == 1) 已支付
                                @elseif($item->status == 2) 确认源文件
                                @elseif($item->status == 3) 维权中
                                @elseif($item->status == 4) 交易完成
                                @elseif($item->status == 5) 维权结束
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-warning" href="/manage/shopOrderInfo/{!! $item->id !!}">
                                        <i class="ace-icon fa fa-search bigger-120"></i>查看
                                    </a>
                                    @if(in_array($item->status,[4,5]))
                                    <a title="删除" href="" class="btn btn-xs btn-danger">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_bootstrap row">
                    <ul class=" ">
                        {!! $order_list->appends($merge)->render() !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('enterpriseauthlist', 'js/doc/enterpriseauthlist.js') !!}
