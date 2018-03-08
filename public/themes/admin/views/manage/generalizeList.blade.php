
<h3 class="header smaller lighter blue mg-top12 mg-bottom20">推广员列表</h3>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix  well">
            <div class="form-inline search-group">
                <form  role="form" action="/manage/generalize_list" method="get">
                    <div class="form-group search-list">
                        <label for="name">姓名</label>
                        <input type="text" class="form-control" id="task_title" name="name" @if(isset($merge['name']))value="{!! $merge['name'] !!}"@endif>
                    </div>
                    <div class="form-group search-list">
                        <label for="name">电话</label>
                        <input type="text" class="form-control" id="task_title" name="mobile" @if(isset($merge['mobile']))value="{!! $merge['mobile'] !!}"@endif>
                    </div>
                    <div class="space"></div>
                    <div class="form-group search-list">
                        <label for="">发布时间　</label>
                        <div class="input-daterange input-group">
                            <input type="text" name="start" class="input-sm form-control" value="@if(isset($merge['start'])){!! $merge['start'] !!}@endif">
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                            <input type="text" name="end" class="input-sm form-control" value="@if(isset($merge['end'])){!! $merge['end'] !!}@endif">
                        </div>
                    </div>
                    <div class="form-group">
                    	<button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>姓名</th>
                    <th>电话</th>
                    <th>一级推广人数</th>
                    <th>一级推广金额</th>
                    <th>二级推广人数</th>
                    <th>二级推广金额</th>
                    <th>三级推广人数</th>
                    <th>三级推广金额</th>
                    <th>总推广金额</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($generalize['data']))
                @foreach($generalize['data'] as $item)
                    <tr>
                        <td>{!! $item['id'] !!}</td>
                        <td>{!! $item['name'] !!}</td>
                        <td>{!! $item['mobile'] !!}</td>
                        <td>@if(isset($item['one_number'])){!! $item['one_number'] !!}@else 0 @endif</td>
                        <td>@if(isset($item['one_number'])){!! $item['one_money'] !!}@else 0 @endif</td>
                        <td>@if(isset($item['two_number'])){!! $item['two_number'] !!}@else 0 @endif</td>
                        <td>@if(isset($item['two_money'])){!! $item['two_money'] !!}@else 0 @endif</td>
                        <td>@if(isset($item['three_number'])){!! $item['three_number'] !!}@else 0 @endif</td>
                        <td>@if(isset($item['three_money'])){!! $item['three_money'] !!}@else 0 @endif</td>
                        <th>@if(isset($item['total'])){!! $item['total'] !!}@else 0 @endif</th>

                    </tr>
                @endforeach
                @endif
                </tbody>

            </table>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap row">
            <ul class="">
                {!! $paginate->render() !!}
            </ul>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

{!! Theme::asset()->container('custom-js')->usePath()->add('checked-js', 'js/checkedAll.js') !!}
