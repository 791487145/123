
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">VIP店铺购买记录</h3>

<div class="well">
    <form  role="form" class="form-inline search-group" action="{!! url('manage/vipShopList') !!}" method="get">
        <div class="">
            <div class="form-group search-list ">
                <label for="">　用户名　</label>
                <input type="text" name="user_name" @if(isset($merge['user_name']))value="{!! $merge['user_name'] !!}"@endif />
            </div>
            <div class="form-group search-list ">
                　<label for="">店铺名　</label>
                <input type="text" name="shop_name" @if(isset($merge['shop_name']))value="{!! $merge['shop_name'] !!}"@endif/>
            </div>

        </div>
        <div class="space-10"></div>
        <div class="">
            <div class="form-group search-list width285">
                <label for="">当前套餐　</label>
                <select name="package_id">
                    <option  value="0">全部</option>
                    @if(!empty($package))
                    @foreach($package as $pv)
                    <option  value="{!! $pv['id'] !!}" @if(isset($merge['package_id']) && $merge['package_id'] == $pv['id']) selected ="selected" @endif>{!! $pv['title'] !!}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group search-list width285">
                <label for="">状态　　</label>
                <select name="status">
                    <option  value="0">全部</option>
                    <option  value="1" @if(isset($merge['status']) && $merge['status'] == 1) selected ="selected" @endif>使用中</option>
                    <option  value="2" @if(isset($merge['status']) && $merge['status'] == 2) selected ="selected" @endif>已过期</option>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-sm">搜索</button>
            </div>
        </div>
    </form>
</div>


<table id="sample-table-1" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>
            <label>
                编号
            </label>
        </th>
        <th>用户</th>
        <th>店铺名</th>
        <th>购买套餐</th>
        <th>时间</th>
        <th>价格</th>
        <th>购买时间</th>

        <th>
            到期时间
        </th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>

    <tbody>
            @foreach($shopPackageList as $sv)
            <tr>
                <td>{!! $sv->id !!}</td>
                <td>{!! $sv->username !!}</td>
                <td>{!! $sv->shop_name !!}</td>
                <td>{!! $sv->package_name !!}</td>
                <td>{!! $sv->duration !!}月</td>
                <td>{!! $sv->price !!}元</td>
                <td>{!! $sv->start_time!!}</td>
                <td>{!! $sv->end_time !!}</td>
                <td><span class="label label-sm label-success">@if($sv->status == 0) 使用中 @else 已过期 @endif</span></td>
                <td>
                    <a class="btn btn-xs btn-warning" href="{!! URL('/manage/vipShopAuth/'.$sv->id) !!}">
                        <i class="ace-icon fa fa-search bigger-120"></i>查看
                    </a>
                </td>
            </tr>
            @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_simple_numbers row" id="dynamic-table_paginate">
            {!! $shopPackageList->appends($merge)->render() !!}
        </div>
    </div>
</div>
{!! Theme::asset()->container('specific-js')->usepath()->add('datepicker', 'plugins/ace/css/bootstrap-datetimepicker/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usepath()->add('jquery.webui-popover', '/plugins/jquery/css/jquery.webui-popover.min.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
