{{--雇佣列表--}}

    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">订单管理</h3>

            <div class="well">
                <form role="form" class="form-inline search-group">
                    <div class="form-group search-list ">
                        <label for="">雇主名　　</label>
                        <input type="text" name="employer_name">
                    </div>
                    <div class="form-group search-list ">
                        <label for="">需求名称　</label>
                        <input type="text" name="employ_title">
                    </div>
                    <div class="form-group search-list ">
                        <label for="">服务状态　</label>
                        <select class="" name="service_status">
                            <option value="" {{ (empty($_GET['service_status']))?'selected':'' }}>全部状态</option>
                            <option value="0" {{ (!empty($_GET['service_status']) && $_GET['service_status']=='0')?'selected':'' }}>待受理</option>
                            <option value="1" {{ (!empty($_GET['service_status']) &&  $_GET['service_status']=='1')?'selected':'' }}>工作中</option>
                            <option value="2" {{ (!empty($_GET['service_status']) &&  $_GET['service_status']=='2')?'selected':'' }}>验收中</option>
                            <option value="3" {{ (!empty($_GET['service_status']) && $_GET['service_status']=='3')?'selected':'' }}>待评价</option>
                            <option value="5" {{ (!empty($_GET['service_status']) && $_GET['service_status']=='5')?'selected':'' }}>交易失败</option>
                            <option value="6,7" {{ (!empty($_GET['service_status']) && $_GET['service_status']=='6,7')?'selected':'' }}>交易维权</option>
                            <option value="4" {{ (!empty($_GET['service_status']) && $_GET['service_status']=='4')?'selected':'' }}>交易完成</option>
                        </select>
                    </div>
                    <div class="form-group search-list">
                        <button class="btn btn-primary btn-sm">搜索
                        </button>
                    </div>
                </form>
            </div>
            <!-- <div class="dataTables_borderWrap"> -->
            <div>
                <form action="/manage/managerDeleteAll" method="post">
                    <input type="hidden" name="_token" value="Q8olGWxsp4BTmFfh3mYWlOYNutLUU16oT7LG1xK6">
                    <table id="sample-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            {{--<th class="center">--}}
                            {{--<label class="position-relative">--}}

                            {{--<input type="checkbox" class="ace">--}}
                            {{--<span class="lbl"></span>--}}

                            {{--</label>--}}
                            {{--</th>--}}
                            <th>编号</th>
                            <th>雇主名</th>
                            <th>需求名称</th>
                            <th>被雇佣服务商</th>
                            <th>金额/元</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($result['data'] as $v)
                            <tr>
                                {{--<td class="center">--}}
                                {{--<label class="position-relative">--}}
                                {{--<input type="checkbox" class="ace" value="{{ $v['id'] }}" name="id">--}}
                                {{--<span class="lbl"></span>--}}
                                {{--</label>--}}
                                {{--</td>--}}
                                <td>
                                    <a href="#">{{ $v['id'] }}</a>
                                </td>
                                <td>{{ $v['employer_name'] }}</td>
                                <td>
                                    {{ $v['title'] }}
                                </td>
                                <td>{{ $v['employee_name'] }}</td>
                                <td>
                                    {{ $v['bounty'] }}
                                </td>
                                <td>
                                    {{ $v['status_text'] }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-info" href="{{ URL('manage/serviceOrderEdit',['id'=>$v['id']]) }}">
                                            <i class="fa fa-search "></i>编辑
                                        </a>
                                        <a class="btn btn-xs btn-danger" href="{{ URL('manage/employDelete',['id'=>$v['id']]) }}">
                                            <i class="fa fa-trash-o"></i>删除
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="dataTables_paginate paging_bootstrap text-right">
                                <ul class="pagination">
                                    {!! $employ_page->render() !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
