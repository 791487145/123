
    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">学生身份认证</h3>
    <div class="row">
        <div class="col-xs-12">
            <div class="well">
                <form  role="form" action="/manage/educationAuth" class="form-inline search-group" method="get">
                    <div class="form-group search-list width285">
                        <label class="">认证状态　</label>
                        <select name="status">
                            <option value="">全部</option>
                            @foreach($type as $v)
                                <option value="{{$v['id']}}" @if(isset($status)) {{($status == $v['id']) ? 'selected':''}}@endif>{{$v['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                </form>
            </div>
            {{--<div class="well h4 blue">投诉建议</div>--}}
            <div>
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">编号</th>
                        <th>姓名</th>
                        <th>学号</th>
                        <th>学生证</th>
                        <th>状态</th>
                        <th>认证时间</th>
                        <th>审核员</th>
                        <th>审核时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($student))
                    @foreach($student as $v)
                        <tr>
                            <td class="center">{!! $v->id !!}</td>
                            <td>{!! $v->realname !!}</td>
                            <td>{!! $v->student_number !!}</td>
                            <td><a href="http://www.zfy0351.cn/{{$v->student_id_card}}" target="_blank"><img src="/{{$v->student_id_card}}" alt="" height="30px"></a></td>
                            <td>@if($v->status == 1) 未认证 @elseif($v->status == 2) 认证成功 @else 认证失败 @endif</td>
                            <td>{!! $v->create_at !!}</td>
                            <td>{!! $v->auth_user !!}</td>
                            <td>{!! $v->auth_time !!}</td>
                            <td>
                                @if($v->status == 1)
                                <a href="/manage/educationAuthHandle/{!! $v->id !!}/pass">
                                    <button class="btn btn-xs btn-success">通过认证</button>
                                </a>
                                <a href="/manage/educationAuthHandle/{!! $v->id !!}/deny">
                                    <button class="btn btn-xs btn-danger">认证失败</button>
                                </a>
                                @endif
                                <a class="btn btn-xs btn-warning" href="{!! url('manage/educationAuthInfo/' . $v->id) !!}">
                                    <i class="ace-icon fa fa-search bigger-120"></i>查看
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_bootstrap row">
                    <div class="row">
                        <ul class="pagination">
                            {!! $student->render() !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->

    {!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}

    {{--时间插件--}}
    {!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
    {!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
    {!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}