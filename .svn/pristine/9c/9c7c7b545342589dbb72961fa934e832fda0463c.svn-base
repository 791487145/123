<h3 class="header smaller lighter blue mg-bottom20 mg-top12">交易维权</h3>
<div class="well">
    <form role="form" class="form-inline search-group" action="/manage/ShopRightsList" method="get">
        <div class="form-group search-list">
            <label for="">维权人　　</label>
            <input type="text" name="username" @if(isset($merge['username'])) value="{!! $merge['username'] !!}" @endif >
        </div>
        <div class="form-group search-list width285">
            <label for="">维权类型　</label>
            <select name="reportType" >
                <option {!! (!isset($merge['reportType']) || $merge['reportType']==0)?'selected':'' !!}  value="0">全部</option>
                <option {!!(isset($merge['reportType']) && $merge['reportType']==1)?'selected':'' !!} value="1">违规信息</option>
                <option {!! (isset($merge['reportType']) && $merge['reportType']==2)?'selected':'' !!} value="2">虚假交换</option>
                <option {!! (isset($merge['reportType']) && $merge['reportType']==3)?'selected':'' !!} value="3">涉嫌抄袭</option>
                <option {!!(isset($merge['reportType']) && $merge['reportType']==4)?'selected':'' !!} value="4">其他</option>
            </select>
        </div>
        <div class="form-group search-list width285">
            <label for="">类型　</label>
            <select name="objectType">
                <option {!! (!isset($merge['objectType']) || $merge['objectType']==0)?'selected':'' !!} value="0">全部</option>
                <option {!! (isset($merge['objectType']) && $merge['objectType']==1)?'selected':'' !!} value="1">雇佣</option>
                <option {!! (isset($merge['objectType']) && $merge['objectType']==2)?'selected':'' !!} value="2">作品</option>
            </select>
        </div>
        <div class="space"></div>
        <div class="form-group search-list">
            <label for="namee">维权时间　　</label>
            <div class="input-daterange input-group">
                <input type="text" name="start" class="input-sm form-control" @if(isset($merge['start']))value="{!! $merge['start'] !!}" @endif>
                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                <input type="text" name="end" class="input-sm form-control" @if(isset($merge['end']))value="{!! $merge['end'] !!}" @endif>
            </div>
        </div>
        <div class="form-group search-list width285">
            <label for="">维权状态　</label>
            <select name="reportStatus">
                <option {!! (!isset($merge['reportStatus']) || $merge['reportStatus']==0)?'selected':'' !!} value="0">全部</option>
                <option {!! (isset($merge['reportStatus']) && $merge['reportStatus']==1)?'selected':'' !!} value="1">已处理</option>
                <option {!! (isset($merge['reportStatus']) && $merge['reportStatus']==2)?'selected':'' !!} value="2">未处理</option>
                <option {!! (isset($merge['reportStatus']) && $merge['reportStatus']==3)?'selected':'' !!} value="3">不成立</option>
            </select>
        </div>
        <div class="form-group search-list ">
            <button class="btn btn-primary btn-sm">搜索</button>
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
                    <th>类型</th>
                    <th>交易名称</th>
                    <th >维权类型</th>

                    <th>
                        维权人
                    </th>
                    <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>维权时间</th>
                    <th>
                        维权状态
                    </th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                @if($rights_list)
                @foreach($rights_list as $item)
                    <tr>
                        <td>
                            <a href="#">{!! $item->id !!}</a>
                        </td>
                        <td>@if($item->object_type == 1)雇佣@elseif($item->object_type == 2)作品@endif</td>
                        <td>{!! $item->title !!}</td>
                        <td>
                            @if($item->type == 1)维归信息
                            @elseif($item->type == 2)虚假交稿
                            @elseif($item->type == 3)涉嫌抄袭
                            @elseif($item->type == 4)其他
                            @endif
                        </td>
                        <td>{!! $item->name !!}</td>
                        <td>{!! date('Y-m-d H:i:s',strtotime($item->created_at)) !!}</td>
                        <td>
                            @if($item->status == 0)
                            <span class="label label-sm label-warning">未处理</span>
                            @elseif($item->status == 1)
                            <span class="label label-sm label-success">已处理</span>
                            @elseif($item->status == 2)
                                <span class="label label-sm label-success">不成立</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-xs btn-warning" href="/manage/shopRightsInfo/{!! $item->id !!}">
                                    <i class="ace-icon fa fa-search bigger-120"></i>查看
                                </a>
                                @if($item->status != 0)
                                    <a class="btn btn-xs btn-danger" href="/manage/deleteShopRights/{!! $item->id !!}">
                                        <i class="ace-icon fa fa-ban bigger-120"></i>删除
                                    </a>
                                @endif


                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
                @endif
            </table>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_bootstrap row">
                    <ul class="">
                        {!! $rights_list->appends($merge)->render() !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('enterpriseauthlist', 'js/doc/enterpriseauthlist.js') !!}
