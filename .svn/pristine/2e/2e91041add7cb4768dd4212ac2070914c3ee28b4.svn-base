
<div class="widget-header mg-bottom20 mg-top12 widget-well">
    <div class="widget-toolbar no-border pull-left no-padding">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="/manage/transactionList">二手交易管理</a>
            </li>

            <li class="">
                <a  href="/manage/addTransaction">发布二手交易</a>
            </li>
        </ul>
    </div>
</div>


<form class="form-inline" action="/manage/transactionList" method="get">
    <div class="well">
        <div class="form-group search-list ">
            <label for="">物品名称　</label>
            <input type="text" name="name" value="@if(isset( $request['name'])){!! $request['name'] !!}@endif">
        </div>
        <div class="form-group search-list width285">
            <label class="">物品类型　</label>
            <select name="type">
                <option value="">全部</option>
                @foreach($type as $item)
                    <option value="{{ $item['id'] }}" @if(isset($request['type']) && $item['id']==$request['type']) selected="selected" @endif>{{$item['name']}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group search-list width285">
            <label class="">状态　</label>
            <select name="status">
                <option value="">不限</option>
                @foreach($status as $item)
                    <option value="{{ $item['id'] }}" @if(isset($request['status']) && $item['id']==$request['status']) selected="selected" @endif>{{$item['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group search-list">
            <label for="">发布时间　</label>
            <div class="input-daterange input-group">
                <input type="text" name="start" class="input-sm form-control" value="@if(isset($request['start'])){!! $request['start'] !!}@endif">
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end" class="input-sm form-control" value="@if(isset($request['end'])){!! $request['end'] !!}@endif">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary">搜索</button>
        </div>
    </div>
</form>
<div>
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>序号</th>
                <th>出售人</th>
                <th>物品名称</th>
                <th>价格</th>
                <th>物品类型</th>
                <th>联系电话</th>
                <th>发布时间</th>
                <th>状态</th>
                {{--<th>操作</th>--}}
            </tr>
            </thead>

            <tbody>
            @if(!empty($transaction))
            @foreach($transaction as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['username']}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['price']}}</td>
                <td>{{$item['type_name']}}</td>
                <td>{{$item['phone']}}</td>
                <td>{{$item['created_at']}}</td>
                <td>
                    @if($item['status'] == 'valid') 正在交易中
                    @elseif($item['status'] == 'invalid') 已完成交易
                    @endif
                </td>
                {{--<td>--}}
                    {{--<div class="hidden-sm hidden-xs btn-group">--}}
                        {{--<a title="浏览" class="btn btn-xs btn-success" href="/manage/transactionDetail/{{$item['id']}}">--}}
                            {{--<i class="ace-icon fa fa-search bigger-120"></i>查看--}}
                        {{--</a>--}}


                    {{--</div>--}}
                {{--</td>--}}
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="dataTables_paginate paging_bootstrap text-right">
                <ul class="pagination">
                    {!! $transaction->render() !!}
                </ul>
            </div>
        </div>
    </div>

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}


