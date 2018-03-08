<div class="row">
        <div class="col-xs-12">
            <div class="clearfix table-responsive">
               {{-- <div class="space"></div>--}}
                <h3 class="header smaller lighter blue mg-bottom20 mg-top12" >实名认证</h3>
                <div class="form-inline clearfix  well">
                <form  role="form" action="/manage/realnameAuthList" method="get">
                    <div class="form-group search-list ">
                        <label for="namee" class="">用户名　　</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名" @if(isset($merge['username']))value="{!! $merge['username'] !!}"@endif>
                    </div>
                    <div class="form-group search-list ">
                        <label for="namee" class="">真实姓名　　</label>
                        <input type="text" class="form-control" id="real_name" name="real_name" placeholder="请输入真实姓名" @if(isset($merge['real_name']))value="{!! $merge['real_name'] !!}"@endif>
                    </div>
                    <div class="form-group">
                    	 <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                    <div class="space"></div>
                    <div class="form-inline search-group" >
                        <div class="form-group search-list">
                            <select name="time_type">
                                <option value="created_at" @if(isset($merge['time_type']) && $merge['time_type'] == 'created_at')selected="selected"@endif>申请时间</option>
                                <option value="auth_time" @if(isset($merge['time_type']) && $merge['time_type'] == 'auth_time')selected="selected"@endif>认证时间</option>
                            </select>
                            <div class="input-daterange input-group">
                                <input type="text" name="start" class="input-sm form-control" @if(isset($merge['start']))value="{!! $merge['start'] !!}" @endif>
                                <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                <input type="text" name="end" class="input-sm form-control" @if(isset($merge['end']))value="{!! $merge['end'] !!}" @endif>
                            </div>
                        </div>
                        <div class="form-group search-list">
                            <label for="namee" class="">状态　　</label>
                            <select name="status">
                                <option value="">全部</option>
                                <option value="1" @if(isset($merge['status']) && $merge['status'] == 1)selected="selected"@endif>待审核</option>
                                <option value="2" @if(isset($merge['status']) && $merge['status'] == 2)selected="selected"@endif>已认证</option>
                                <option value="3" @if(isset($merge['status']) && $merge['status'] == 3)selected="selected"@endif>审核失败</option>
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
                        </th>
                        <th>编号</th>
                        <th>用户名</th>
                        <th >真实姓名</th>

                        <th>
                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                            申请时间
                        </th>
                        <th>
                            状态
                        </th>
                        <th>
                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                            认证时间
                        </th>
                        <th>处理</th>
                    </tr>
                    </thead>
                    <form action="/manage/realnameAuthMultiDel" method="post">
                        {!! csrf_field() !!}
                    <tbody>
                    @if(!empty($realname->toArray()['data']))
                    @foreach($realname as $item)
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" name="ckb[]" value="{!! $item->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>

                            <td>
                                <a href="#">{!! $item->id !!}</a>
                            </td>
                            <td>{!! $item->username !!}</td>
                            <td>{!! $item->realname !!}</td>
                            <td>{!! $item->created_at !!}</td>

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
                                @if($item->auth_time){!! $item->auth_time !!}@else N/A @endif
                            </td>

                            <td>
                                <div class="btn-group">
                                    @if($item->status == 0)
                                    <a class="btn btn-xs btn-success" href="/manage/realnameAuthHandle/{!! $item->id !!}/pass">
                                        <i class="ace-icon fa fa-check bigger-120"></i>成功
                                    </a>

                                    <a class="btn btn-xs btn-danger" href="/manage/realnameAuthHandle/{!! $item->id !!}/deny">
                                        <i class="ace-icon fa fa-ban bigger-120"></i>失败
                                    </a>
                                    @endif
                                    <a class="btn btn-xs btn-warning" href="{!! url('manage/realnameAuth/' . $item->id) !!}">
                                        <i class="ace-icon fa fa-search bigger-120"></i>查看
                                    </a>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                    </form>
                </table>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                        <label class="position-relative mg-right10">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"> 全选</span>
                       </label>
                    </div>
                </div>
                <div class="space-10 col-xs-12"></div>
                <div class="col-xs-12">
                    <div class="dataTables_paginate paging_bootstrap row">
                        <ul class="pagination">
                            {!! $realname->appends($merge)->render() !!}

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->


{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{{--时间插件--}}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}