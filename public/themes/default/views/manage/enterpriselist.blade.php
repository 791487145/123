<div class="row">
    <div class="col-xs-12">
        <div class="clearfix table-responsive">
            <h3 class="header smaller lighter blue mg-bottom20 mg-top12">企业认证</h3>
            <div class="form-inline clearfix well">
            <form  role="form" action="/manage/enterpriseAuthList" method="get">
        		<div class="form-group search-list width285">
                    认证用户&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="form-control" id="name" name="name" placeholder="请输入用户名" @if(isset($merge['name']))value="{!! $merge['name'] !!}" @endif>
                </div>
                <div class="form-group search-list width285">
                    公司名称&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="请输入公司名" @if(isset($merge['company_name']))value="{!! $merge['company_name'] !!}" @endif>
                </div>
                <div class="form-group">
                	 <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                </div>
                <div class="space"></div>
                <div class="form-inline search-group " >
                    <div class="form-group search-list">
                        <select class="" name="time_type">
                            <option value="enterprise_auth.created_at" @if(isset($merge['time_type']) && $merge['time_type'] == 'enterprise_auth.created_at')selected="selected"@endif>申请时间</option>
                            <option value="enterprise_auth.auth_time" @if(isset($merge['time_type']) && $merge['time_type'] == 'enterprise_auth.auth_time')selected="selected"@endif>认证时间</option>
                        </select>
                        <div class="input-daterange input-group">
                            <input type="text" name="start" class="input-sm form-control" value="@if(isset($merge['start'])){!! $merge['start'] !!}@endif">
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                            <input type="text" name="end" class="input-sm form-control" value="@if(isset($merge['end'])){!! $merge['end'] !!}@endif">
                        </div>
                    </div>
                    <div class="form-group search-list ">
                        <label for="namee" class="">认证状态　</label>
                        <select class="sort-list" name="status">
                            <option value="0">全部</option>
                            <option value="3" @if(isset($merge['status']) && $merge['status'] == 3)selected="selected"@endif>待审核</option>
                            <option value="1" @if(isset($merge['status']) && $merge['status'] == 1)selected="selected"@endif>审核通过</option>
                            <option value="2" @if(isset($merge['status']) && $merge['status'] == 2)selected="selected"@endif>审核失败</option>
                        </select>
                    </div>
                </div>
            </form>
            </div>
        </div>

        <!-- <div class="table-responsive"> -->

        <!-- <div class="dataTables_borderWrap"> -->
        <div class="table-responsive">
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">
                        <label class="position-relative">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>

                    </th>
                    <th>编号</th>
                    <th>认证用户</th>
                    <th>认证公司名称</th>
                    <th >所属行业</th>

                    <th>
                        <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                        申请时间
                    </th>
                    <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>认证时间</th>
                    <th>
                        状态
                    </th>
                    <th>处理</th>
                </tr>
                </thead>

                <tbody>
                @if(!empty($enterprise->toArray()['data']))
                @foreach($enterprise as $item)
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
                        <td>{!! $item->name !!}</td>
                        <td>{!! $item->company_name !!}</td>
                        <td>{!! $item->cate_name !!}</td>
                        <td>{!! $item->created_at !!}</td>
                        <td>
                            @if($item->auth_time){!! $item->auth_time !!}@else N/A @endif
                        </td>
                        <td>
                            @if($item->status == 0)
                            <span class="label label-sm label-warning">待审核</span>
                            @elseif($item->status == 1)
                            <span class="label label-sm label-success">已认证</span>
                            @elseif($item->status == 2)
                            <span class="label label-sm label-danger">认证失败</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                @if($item->status == 0)
                                <a class="btn btn-xs btn-success" href="/manage/enterpriseAuthHandle/{!! $item->id !!}/pass">
                                    <i class="ace-icon fa fa-check bigger-120"></i>成功
                                </a>

                                <a class="btn btn-xs btn-danger" href="/manage/enterpriseAuthHandle/{!! $item->id !!}/deny">
                                    <i class="ace-icon fa fa-ban bigger-120"></i>失败
                                </a>
                                @endif
                                <a class="btn btn-xs btn-warning" href="{!! url('manage/enterpriseAuth/' . $item->id) !!}">
                                    <i class="ace-icon fa fa-search bigger-120"></i>查看
                                </a>

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
                <div class="col-sm-12">
                    <div class="dataTables_info row" id="sample-table-2_info">
                        <label><input type="checkbox" class="ace" id="allcheck"/>
                            <span class="lbl"></span> 全选
                        </label>
                        <button id="pass" type="submit" class="btn btn-sm btn-primary ">审核通过</button>
                        <button id="deny" type="submit" class="btn btn-sm btn-primary ">审核失败</button>
                    </div>
                </div>
            </div>
            <div class="space-10 col-xs-12"></div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_bootstrap ">
                    <ul class="pagination">
                        {!! $enterprise->appends($merge)->render() !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->

{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('enterpriseauthlist', 'js/doc/enterpriseauthlist.js') !!}





