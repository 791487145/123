
    {{--<div class="space-2"></div>
    <div class="page-header">
        <h1>
            搜索
        </h1>
    </div><!-- /.page-header -->--}}
    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">物品配送</h3>
    <div class="row">
        <div class="col-xs-12">
            <div class="well">
                <form  role="form" action="/manage/distribution" class="form-inline search-group" method="get">
                    <div class="form-group search-list width285">
                        <label class="">配送状态　</label>
                        <select name="amount">
                            <option value="">全部</option>
                            @foreach($type as $v)
                                <option value="{{$v['id']}}" @if(isset($amount)) {{($amount == $v['id']) ? 'selected':''}}@endif>{{$v['name']}}</option>
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
                        <th>申请用户</th>
                        <th>收货人姓名</th>
                        <th>电话</th>
                        <th>配送物品</th>
                        <th>数量</th>
                        <th>配送地址</th>
                        <th>是否包邮</th>
                        <th>配送状态</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($goods))
                    @foreach($goods as $v)
                        <tr>
                            <td class="center">{!! $v->id !!}</td>
                            <td>{!! $v->username !!}</td>
                            <td>{!! $v->name !!}</td>
                            <td>{!! $v->phone !!}</td>
                            <td>{{$v->good_name}}</td>
                            <td>{!! $v->amount !!}</td>
                            <td>{!! $v->province_cn !!}{!! $v->city_cn !!}{!! $v->area_cn !!}{!! $v->address !!}</td>
                            <td>@if($v->is_free == 1) 到付 @else 包邮 @endif</td>
                            <td>@if($v->status == 2) 已配送 @else 未配送 @endif</td>
                            <td>@if($v->remarks == '') 无 @else  {!! $v->remarks !!}  @endif</td>
                            <!-- <td>
                                @if($v->amount != 0)
                                <a href="/manage/finishDistribution/{!! $v->id !!}">
                                    <button class="btn btn-xs btn-success">完成配送</button>
                                </a>
                                <a catid="{!! $v->id !!}" class="service" style="cursor:pointer;">填写物流</a>
                                <a href="/manage/inputLogistics/{!! $v->id !!}">
                                    <button class="btn btn-xs btn-success">完成配送</button>
                                </a>
                                @endif
                            </td> -->
                            <td>
                                <a class="btn btn-xs btn-info" href="{!! url('manage/inputLogistics/' . $v->id) !!}">
                                    <i class="fa fa-edit"></i>详情
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
                            {!! $goods->render() !!}
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
    {!! Theme::asset()->container('custom-js')->usePath()->add('layer-js', 'js/layer/layer.js') !!}
    {!! Theme::asset()->container('custom-js')->usePath()->add('laytpl-js', 'js/laytpl/laytpl.js') !!}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.service').click(function(){
                $this = $(this);
                var id = $this.attr('catid');alert(id);
                layer.open({
                    type: 2,
                    title:'赠送服务详情',
                    maxmin:true,
                    area:['700px','500px'],
                    closeBtn: 0,
                    shift: 2,
                    shadeClose: true,
                    content: "/manage/inputLogistics/"+id,
                });
            });
        });
    </script>>